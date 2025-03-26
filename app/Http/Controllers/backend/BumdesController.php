<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bumdes;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BumdesController extends Controller
{
    public function index()
    {
        $bumdes = Bumdes::with('desa.kecamatan')->get();
        return view('admin.kelembagaan.bumdes.index', compact('bumdes'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.bumdes.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        try {
            Bumdes::create([
                'iddesa' => $request->iddesa,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('bumdes.index')
                ->with('success', 'Data BUMDES berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error storing BUMDES data: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.')
                ->withInput();
        }
    }

    public function edit($id)
    {
        $bumdes = Bumdes::findOrFail($id);
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kelembagaan.bumdes.edit', 
            compact('bumdes', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        try {
            $bumdes = Bumdes::findOrFail($id);
            $bumdes->update([
                'iddesa' => $request->iddesa,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            return redirect()->route('bumdes.index')
                ->with('success', 'Data BUMDES berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error("Error updating BUMDES data: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.')
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $bumdes = Bumdes::findOrFail($id);
            $bumdes->delete();

            return redirect()->route('bumdes.index')
                ->with('success', 'Data BUMDES berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error("Error deleting BUMDES data: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

