<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kelembagaan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelembagaanController extends Controller
{
    /**
     * Display a listing of kelembagaan.
     */
    public function index(Request $request)
    {
        // Fetch data for desa for filtering purposes
        $kecamatanList = Kecamatan::all();

        // Mengambil daftar desa berdasarkan kecamatan untuk filter
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Apply the filter for desa if it exists
        $desaId = $request->get('desa');

        // Fetch kelembagaan data based on selected desa
        $kelembagaan = Kelembagaan::when($desaId, function ($query) use ($desaId) {
            return $query->where('iddesa', $desaId);
        })->get();

        return view('admin.kelembagaan.index', compact('kelembagaan', 'desaList', 'kecamatanList'));
    }

    /**
     * Show the form for creating a new kelembagaan.
     */
    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.create', compact('desaList', 'kecamatanList'));
    }

    /**
     * Store a newly created kelembagaan in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'jenis' => 'required|in:LPMD/LPMK,TP PKK DESA,BUMDES',
            'jumlah_pengurus' => 'nullable|integer',
            'jumlah_anggota' => 'nullable|integer',
            'jumlah_kegiatan' => 'nullable|integer',
            'jumlah_buku_administrasi' => 'nullable|integer',
            'jumlah_dana' => 'nullable|numeric',
        ]);

        Kelembagaan::create($validated);

        return redirect()->route('kelembagaan.index')->with('success', 'Data kelembagaan berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified kelembagaan.
     */
    public function edit($id)
    {
        $kelembagaan = Kelembagaan::findOrFail($id);
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.edit', compact('kelembagaan', 'desaList', 'kecamatanList'));
    }

    /**
     * Update the specified kelembagaan in the database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'jenis' => 'required|in:LPMD/LPMK,TP PKK DESA,BUMDES',
            'jumlah_pengurus' => 'nullable|integer',
            'jumlah_anggota' => 'nullable|integer',
            'jumlah_kegiatan' => 'nullable|integer',
            'jumlah_buku_administrasi' => 'nullable|integer',
            'jumlah_dana' => 'nullable|numeric',
        ]);

        $kelembagaan = Kelembagaan::findOrFail($id);
        $kelembagaan->update($validated);

        return redirect()->route('kelembagaan.index')->with('success', 'Data kelembagaan berhasil diperbarui.');
    }

    /**
     * Remove the specified kelembagaan from the database.
     */
    public function destroy($id)
    {
        $kelembagaan = Kelembagaan::findOrFail($id);
        $kelembagaan->delete();

        return redirect()->route('kelembagaan.index')->with('success', 'Data kelembagaan berhasil dihapus.');
    }
}
