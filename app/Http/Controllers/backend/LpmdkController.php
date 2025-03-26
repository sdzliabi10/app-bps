<?php

namespace App\Http\Controllers\Backend;

use App\Models\Lpmdk;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;  // Add this import

class LpmdkController extends Controller
{
    // Show list of LPMDK records
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Retrieve LPMDK data along with Kecamatan and Desa relationships
        $lpmdk = Lpmdk::with('desa.kecamatan')->get();
        return view('admin.kelembagaan.lpmdk.index', compact('lpmdk', 'kecamatanList', 'desaList'));
    }

    // Show form for creating a new LPMDK
    public function create()
    {
        // Get list of Kecamatan and Desa
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.lpmdk.create', compact('kecamatanList', 'desaList'));
    }

    // Store a new LPMDK
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',  // Ensure 'iddesa' exists in the 'desa' table
            'jumlah_pengurus' => 'required|integer|min:0',
            'jumlah_anggota' => 'required|integer|min:0',
            'jumlah_kegiatan' => 'required|integer|min:0',
            'jumlah_buku_administrasi' => 'required|integer|min:0',
            'jumlah_dana' => 'required|numeric|min:0',  // Make sure 'jumlah_dana' is a number
        ]);

        // Create a new LPMDK record
        try {
            Lpmdk::create([
                'iddesa' => $request->iddesa,  // Map input from form to the database field
                'jumlah_pengurus' => $request->jumlah_pengurus,
                'jumlah_anggota' => $request->jumlah_anggota,
                'jumlah_kegiatan' => $request->jumlah_kegiatan,
                'jumlah_buku_administrasi' => $request->jumlah_buku_administrasi,
                'jumlah_dana' => $request->jumlah_dana,  // Store as a numeric value
            ]);

            return redirect()->route('lpmdk.index')->with('success', 'Data LPMPDK berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error storing data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal disimpan.');
        }
    }

    // Show form to edit LPMDK
    public function edit($id)
    {
        $lpmdk = Lpmdk::findOrFail($id);
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.lpmdk.edit', compact('lpmdk', 'kecamatanList', 'desaList'));
    }

    // Update the LPMDK
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',  // Ensure 'iddesa' exists in the 'desa' table
            'jumlah_pengurus' => 'nullable|integer',
            'jumlah_anggota' => 'nullable|integer',
            'jumlah_kegiatan' => 'nullable|integer',
            'jumlah_buku_administrasi' => 'nullable|integer',
            'jumlah_dana' => 'nullable|numeric',  // Ensure 'jumlah_dana' is numeric
        ]);

        $lpmdk = Lpmdk::findOrFail($id);

        // Update LPMDK record
        try {
            $lpmdk->update([
                'iddesa' => $request->iddesa,  // Ensure the correct 'iddesa' is updated
                'jumlah_pengurus' => $request->jumlah_pengurus,
                'jumlah_anggota' => $request->jumlah_anggota,
                'jumlah_kegiatan' => $request->jumlah_kegiatan,
                'jumlah_buku_administrasi' => $request->jumlah_buku_administrasi,
                'jumlah_dana' => $request->jumlah_dana,  // Ensure 'jumlah_dana' is updated correctly
            ]);

            return redirect()->route('lpmdk.index')->with('success', 'Data LPMPDK berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Error updating data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        }
    }

    // Delete an LPMDK record
    public function destroy($id)
    {
        try {
            $lpmdk = Lpmdk::findOrFail($id);
            $lpmdk->delete();

            return redirect()->route('lpmdk.index')->with('success', 'Data LPMPDK berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Error deleting data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal dihapus.');
        }
    }
}
