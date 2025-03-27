<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PusatPerdagangan;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PusatPerdaganganController extends Controller
{
    public function index()
    {
        $pusatPerdagangans = PusatPerdagangan::with('desa.kecamatan')->get();
        return view('admin.infrastruktur.pusat-perdagangan.index', compact('pusatPerdagangans'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pusat-perdagangan.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_pusat_perdagangan' => 'required|string',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        try {
            PusatPerdagangan::create($request->all());
            return redirect()->route('pusat-perdagangan.index')
                ->with('success', 'Data pusat perdagangan berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(PusatPerdagangan $pusatPerdagangan)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pusat-perdagangan.edit', 
            compact('pusatPerdagangan', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, PusatPerdagangan $pusatPerdagangan)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_pusat_perdagangan' => 'required|string',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        try {
            $pusatPerdagangan->update($request->all());
            return redirect()->route('pusat-perdagangan.index')
                ->with('success', 'Data pusat perdagangan berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function destroy(PusatPerdagangan $pusatPerdagangan)
    {
        try {
            $pusatPerdagangan->delete();
            return redirect()->route('pusat-perdagangan.index')
                ->with('success', 'Data pusat perdagangan berhasil dihapus');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}

