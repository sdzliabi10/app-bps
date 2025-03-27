<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalanKab;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JalanKabController extends Controller
{
    public function index()
    {
        $jalanKabs = JalanKab::with('desa')->get();
        return view('admin.infrastruktur.jalan-kabupaten.index', compact('jalanKabs'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jalan-kabupaten.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jalan' => 'required|string',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'jenis' => 'required|in:Aspal,Beton,Makadam,Tanah',
            'lokasi' => 'required|string'
        ]);

        try {
            JalanKab::create($request->all());
            return redirect()->route('jalan-kabupaten.index')->with('success', 'Data Jalan Kabupaten berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error storing data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal disimpan.');
        }
    }

    public function show(JalanKab $jalanKab)
    {
        return view('admin.infrastruktur.jalan-kabupaten.show', compact('jalanKab'));
    }

    public function edit(JalanKab $jalanKab)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jalan-kabupaten.edit', compact('jalanKab', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, JalanKab $jalanKab)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jalan' => 'required|string',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'jenis' => 'required|in:Aspal,Beton,Makadam,Tanah',
            'lokasi' => 'required|string'
        ]);

        try {
            $jalanKab->update($request->all());
            return redirect()->route('jalan-kabupaten.index')->with('success', 'Data Jalan Kabupaten berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Error updating data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        }
    }

    public function destroy(JalanKab $jalanKab)
    {
        try {
            $jalanKab->delete();
            return redirect()->route('jalan-kabupaten.index')->with('success', 'Data Jalan Kabupaten berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Error deleting data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal dihapus.');
        }
    }
}

