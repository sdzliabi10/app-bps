<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RumahPotongHewan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RumahPotongHewanController extends Controller
{
    public function index()
    {
        $rumahPotongHewans = RumahPotongHewan::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.rumah-potong-hewan.index', compact('rumahPotongHewans'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.rumah-potong-hewan.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_rph' => 'required|string',
            'luas' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        try {
            RumahPotongHewan::create($request->all());
            return redirect()->route('rumah-potong-hewan.index')
                ->with('success', 'Data rumah potong hewan berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(RumahPotongHewan $rumahPotongHewan)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.rumah-potong-hewan.edit', 
            compact('rumahPotongHewan', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, RumahPotongHewan $rumahPotongHewan)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_rph' => 'required|string',
            'luas' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        try {
            $rumahPotongHewan->update($request->all());
            return redirect()->route('rumah-potong-hewan.index')
                ->with('success', 'Data rumah potong hewan berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(RumahPotongHewan $rumahPotongHewan)
    {
        try {
            $rumahPotongHewan->delete();
            return redirect()->route('rumah-potong-hewan.index')
                ->with('success', 'Data rumah potong hewan berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}