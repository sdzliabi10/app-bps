<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Kemiskinan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class KemiskinanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kemiskinan::with(['desa.kecamatan']);
        
        if ($request->has('kecamatan')) {
            $query->whereHas('desa', function($q) use ($request) {
                $q->where('kdkec', $request->kecamatan);
            });
        }

        if ($request->has('desa')) {
            $query->where('iddesa', $request->desa);
        }

        $kemiskinanList = $query->get();
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();

        return view('admin.kemiskinan.index', compact('kemiskinanList', 'kecamatanList', 'desaList'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.kemiskinan.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'iddesa' => 'required|exists:desa,iddesa',
                'nama_program' => 'required|string|max:255',
                'jumlah_penerima' => 'required|integer|min:0',
            ]);

            Kemiskinan::create($validated);

            return redirect()
                ->route('kemiskinan.index')
                ->with('success', 'Data program kemiskinan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $kemiskinan = Kemiskinan::findOrFail($id);
            $kecamatanList = Kecamatan::all();
            $desaList = Desa::all();
            
            return view('admin.kemiskinan.edit', compact('kemiskinan', 'kecamatanList', 'desaList'));
        } catch (\Exception $e) {
            return redirect()
                ->route('kemiskinan.index')
                ->with('error', 'Data program kemiskinan tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'iddesa' => 'required|exists:desa,iddesa',
                'nama_program' => 'required|string|max:255',
                'jumlah_penerima' => 'required|integer|min:0',
            ]);

            $kemiskinan = Kemiskinan::findOrFail($id);
            $kemiskinan->update($validated);

            return redirect()
                ->route('kemiskinan.index')
                ->with('success', 'Data program kemiskinan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $kemiskinan = Kemiskinan::findOrFail($id);
            $kemiskinan->delete();

            return redirect()
                ->route('kemiskinan.index')
                ->with('success', 'Data program kemiskinan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function getDesaByKecamatan(Request $request)
    {
        $desaList = Desa::where('kdkec', $request->kdkec)->get();
        return response()->json($desaList);
    }
}



