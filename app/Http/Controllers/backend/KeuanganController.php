<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pendapatan;
use App\Models\Pembelanjaan;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeuanganController extends Controller
{
    /**
     * Display a listing of pendapatan and pembelanjaan.
     */
    public function index(Request $request)
    {
        // Ambil data desa untuk filter
        $desaList = Desa::all();

        // Filter berdasarkan desa jika ada
        $desaId = $request->get('desa');

        // Ambil data pendapatan dan pembelanjaan sesuai filter desa
        $pendapatan = Pendapatan::when($desaId, function ($query) use ($desaId) {
            return $query->where('iddesa', $desaId);
        })->get();

        $pengeluaran = Pembelanjaan::when($desaId, function ($query) use ($desaId) {
            return $query->where('iddesa', $desaId);
        })->get();

        return view('admin.keuangan.index', compact('pendapatan', 'pengeluaran', 'desaList'));
    }

    /**
     * Show the form for creating a new pendapatan or pembelanjaan.
     */
    public function create()
    {
        // Ambil data desa untuk dropdown
        $desaList = Desa::all();
        return view('admin.keuangan.create', compact('desaList'));
    }

    /**
     * Store a newly created pendapatan or pembelanjaan in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'tipe' => 'required|in:pendapatan,pengeluaran',
            'sumber_pendapatan' => 'nullable|required_if:tipe,pendapatan|string|max:255',
            'jenis_pengeluaran' => 'nullable|required_if:tipe,pengeluaran|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        if ($validated['tipe'] === 'pendapatan') {
            Pendapatan::create([
                'iddesa' => $validated['iddesa'],
                'sumber_pendapatan' => $validated['sumber_pendapatan'],
                'jumlah' => $validated['jumlah'],
            ]);
        } else {
            Pembelanjaan::create([
                'iddesa' => $validated['iddesa'],
                'jenis_pengeluaran' => $validated['jenis_pengeluaran'],
                'jumlah' => $validated['jumlah'],
            ]);
        }

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified pendapatan or pembelanjaan.
     */
    public function edit($id)
    {
        $pendapatan = Pendapatan::find($id);
        $pembelanjaan = Pembelanjaan::find($id);
        $desaList = Desa::all();

        return view('admin.keuangan.edit', compact('pendapatan', 'pembelanjaan', 'desaList'));
    }

    /**
     * Update the specified pendapatan or pembelanjaan in the database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'tipe' => 'required|in:pendapatan,pengeluaran',
            'sumber_pendapatan' => 'nullable|required_if:tipe,pendapatan|string|max:255',
            'jenis_pengeluaran' => 'nullable|required_if:tipe,pengeluaran|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        if ($validated['tipe'] === 'pendapatan') {
            $pendapatan = Pendapatan::find($id);
            $pendapatan->update([
                'iddesa' => $validated['iddesa'],
                'sumber_pendapatan' => $validated['sumber_pendapatan'],
                'jumlah' => $validated['jumlah'],
            ]);
        } else {
            $pembelanjaan = Pembelanjaan::find($id);
            $pembelanjaan->update([
                'iddesa' => $validated['iddesa'],
                'jenis_pengeluaran' => $validated['jenis_pengeluaran'],
                'jumlah' => $validated['jumlah'],
            ]);
        }

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified pendapatan or pembelanjaan from the database.
     */
    public function destroy($id)
    {
        $pendapatan = Pendapatan::find($id);
        if ($pendapatan) {
            $pendapatan->delete();
        } else {
            $pembelanjaan = Pembelanjaan::find($id);
            if ($pembelanjaan) {
                $pembelanjaan->delete();
            }
        }

        return redirect()->route('keuangan.index')->with('success', 'Data berhasil dihapus.');
    }
}
