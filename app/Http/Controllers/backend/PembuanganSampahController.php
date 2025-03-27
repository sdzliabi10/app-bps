<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PembuanganSampah;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PembuanganSampahController extends Controller
{
    public function index()
    {
        $pembuanganSampahs = PembuanganSampah::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.pembuangan-sampah.index', compact('pembuanganSampahs'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pembuangan-sampah.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_tempat' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        PembuanganSampah::create($request->all());

        return redirect()->route('pembuangan-sampah.index')
            ->with('success', 'Data pembuangan sampah berhasil ditambahkan');
    }

    public function edit(PembuanganSampah $pembuanganSampah)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.pembuangan-sampah.edit', 
            compact('pembuanganSampah', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, PembuanganSampah $pembuanganSampah)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_tempat' => 'required|string',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'lokasi' => 'required|string',
        ]);

        $pembuanganSampah->update($request->all());

        return redirect()->route('pembuangan-sampah.index')
            ->with('success', 'Data pembuangan sampah berhasil diperbarui');
    }

    public function destroy(PembuanganSampah $pembuanganSampah)
    {
        $pembuanganSampah->delete();

        return redirect()->route('pembuangan-sampah.index')
            ->with('success', 'Data pembuangan sampah berhasil dihapus');
    }
}

