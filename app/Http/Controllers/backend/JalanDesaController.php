<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JalanDesa;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class JalanDesaController extends Controller
{
    public function index()
    {
        $jalanDesas = JalanDesa::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.jalan-desa.index', compact('jalanDesas'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jalan-desa.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jalan' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'jenis' => 'required|in:Aspal,Beton,Makadam,Tanah',
            'lokasi' => 'required|string',
        ]);

        JalanDesa::create($request->all());

        return redirect()->route('jalan-desa.index')
            ->with('success', 'Data jalan desa berhasil ditambahkan');
    }

    public function edit(JalanDesa $jalanDesa)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jalan-desa.edit', compact('jalanDesa', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, JalanDesa $jalanDesa)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jalan' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'jenis' => 'required|in:Aspal,Beton,Makadam,Tanah',
            'lokasi' => 'required|string',
        ]);

        $jalanDesa->update($request->all());

        return redirect()->route('jalan-desa.index')
            ->with('success', 'Data jalan desa berhasil diperbarui');
    }

    public function destroy(JalanDesa $jalanDesa)
    {
        $jalanDesa->delete();

        return redirect()->route('jalan-desa.index')
            ->with('success', 'Data jalan desa berhasil dihapus');
    }
}