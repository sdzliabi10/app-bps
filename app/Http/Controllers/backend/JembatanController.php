<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Jembatan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class JembatanController extends Controller
{
    public function index()
    {
        $jembatans = Jembatan::with(['desa.kecamatan'])->get();
        return view('admin.infrastruktur.jembatan.index', compact('jembatans'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jembatan.create', compact('kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jembatan' => 'required|string|max:255',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        try {
            // Pastikan angka desimal disimpan dengan format yang benar
            $validated['panjang'] = floatval(str_replace(',', '.', $request->panjang));
            $validated['lebar'] = floatval(str_replace(',', '.', $request->lebar));

            Jembatan::create($validated);
            return redirect()->route('jembatan.index')
                ->with('success', 'Data jembatan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan data jembatan.')
                ->withInput();
        }
    }

    public function edit(Jembatan $jembatan)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.infrastruktur.jembatan.edit', compact('jembatan', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, Jembatan $jembatan)
    {
        $validated = $request->validate([
            'iddesa' => 'required|exists:desa,iddesa',
            'nama_jembatan' => 'required|string|max:255',
            'panjang' => 'required|numeric|min:0',
            'lebar' => 'required|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Sedang,Rusak Berat',
            'lokasi' => 'required|string'
        ]);

        $jembatan->update($validated);

        return redirect()->route('jembatan.index')
            ->with('success', 'Data jembatan berhasil diperbarui.');
    }

    public function destroy(Jembatan $jembatan)
    {
        $jembatan->delete();

        return redirect()->route('jembatan.index')
            ->with('success', 'Data jembatan berhasil dihapus.');
    }
}


