<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pasar;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    public function index()
    {
        $pasars = Pasar::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.pasar.index', compact('pasars'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pasar.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_pasar' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        Pasar::create($request->all());

        return redirect()->route('pasar.index')
            ->with('success', 'Data pasar berhasil ditambahkan');
    }

    public function edit(Pasar $pasar)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pasar.edit', compact('pasar', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, Pasar $pasar)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_pasar' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        $pasar->update($request->all());

        return redirect()->route('pasar.index')
            ->with('success', 'Data pasar berhasil diperbarui');
    }

    public function destroy(Pasar $pasar)
    {
        $pasar->delete();

        return redirect()->route('pasar.index')
            ->with('success', 'Data pasar berhasil dihapus');
    }
}

