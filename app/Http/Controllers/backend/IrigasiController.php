<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Irigasi;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class IrigasiController extends Controller
{
    public function index()
    {
        $irigasis = Irigasi::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.irigasi.index', compact('irigasis'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.irigasi.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_irigasi' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        Irigasi::create($request->all());

        return redirect()->route('irigasi.index')
            ->with('success', 'Data irigasi berhasil ditambahkan');
    }

    public function edit(Irigasi $irigasi)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.irigasi.edit', compact('irigasi', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, Irigasi $irigasi)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_irigasi' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        $irigasi->update($request->all());

        return redirect()->route('irigasi.index')
            ->with('success', 'Data irigasi berhasil diperbarui');
    }

    public function destroy(Irigasi $irigasi)
    {
        $irigasi->delete();

        return redirect()->route('irigasi.index')
            ->with('success', 'Data irigasi berhasil dihapus');
    }
}