<?php

namespace App\Http\Controllers\Backend;

use App\Models\PkkDesa;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;  // Add this import

class PkkDesaController extends Controller
{
    // Show list of pkk_desas records
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Retrieve pkk_desas data along with Kecamatan and Desa relationships
        $pkk_desas = PkkDesa::with('desa.kecamatan')->get();
        return view('admin.kelembagaan.pkk_desas.index', compact('pkk_desas', 'kecamatanList', 'desaList'));
    }

    // Show form for creating a new pkk_desas
    public function create()
    {
        // Get list of Kecamatan and Desa
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.pkk_desas.create', compact('kecamatanList', 'desaList'));
    }

    // Store a new pkk_desas
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

        // Create a new pkk_desas record
        try {
            PkkDesa::create([
                'iddesa' => $request->iddesa,  // Map input from form to the database field
                'jumlah_pengurus' => $request->jumlah_pengurus,
                'jumlah_anggota' => $request->jumlah_anggota,
                'jumlah_kegiatan' => $request->jumlah_kegiatan,
                'jumlah_buku_administrasi' => $request->jumlah_buku_administrasi,
                'jumlah_dana' => $request->jumlah_dana,  // Store as a numeric value
            ]);

            return redirect()->route('pkk_desas.index')->with('success', 'Data LPMPDK berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error storing data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal disimpan.');
        }
    }

    // Show form to edit pkk_desas
    public function edit($id)
    {
        $pkk_desas = PkkDesa::findOrFail($id);
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.pkk_desas.edit', compact('pkk_desas', 'kecamatanList', 'desaList'));
    }

    // Update the pkk_desas
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

        $pkk_desas = PkkDesa::findOrFail($id);

        // Update pkk_desas record
        try {
            $pkk_desas->update([
                'iddesa' => $request->iddesa,  // Ensure the correct 'iddesa' is updated
                'jumlah_pengurus' => $request->jumlah_pengurus,
                'jumlah_anggota' => $request->jumlah_anggota,
                'jumlah_kegiatan' => $request->jumlah_kegiatan,
                'jumlah_buku_administrasi' => $request->jumlah_buku_administrasi,
                'jumlah_dana' => $request->jumlah_dana,  // Ensure 'jumlah_dana' is updated correctly
            ]);

            return redirect()->route('pkk_desas.index')->with('success', 'Data LPMPDK berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Error updating data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal diperbarui.');
        }
    }

    // Delete an pkk_desas record
    public function destroy($id)
    {
        try {
            $pkk_desas = PkkDesa::findOrFail($id);
            $pkk_desas->delete();

            return redirect()->route('pkk_desas.index')->with('success', 'Data LPMPDK berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Error deleting data: " . $e->getMessage());
            return redirect()->back()->with('error', 'Data gagal dihapus.');
        }
    }
}
