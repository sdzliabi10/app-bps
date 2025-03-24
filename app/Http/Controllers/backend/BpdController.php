<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bpd;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Storage;

class BpdController extends Controller
{
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        // Mengambil daftar desa untuk filter
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Mengambil data perangkat desa berdasarkan filter desa
        $bpds = Bpd::with('desa')
            ->when($request->kecamatan, function ($query) use ($request) {
                // Mengambil perangkat desa yang hanya berada di kecamatan yang dipilih
                return $query->whereHas('desa', function ($query) use ($request) {
                    $query->where('kdkec', $request->kecamatan);
                });
            })
            ->when($request->desa, function ($query) use ($request) {
                return $query->where('iddesa', $request->desa);
            })
            ->get();


        return view('admin.bpd.index', compact('bpds', 'desaList', 'kecamatanList'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        return view('admin.bpd.create', compact('desaList', 'kecamatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'iddesa' => 'required',
        ]);

        $fotoPath = $request->file('foto')->store('bpd', 'public');

        Bpd::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'iddesa' => $request->iddesa,
        ]);

        return redirect()->route('bpd.index');
    }

    public function edit(Bpd $bpd)
    {
        $desaList = Desa::all();
        return view('admin.bpd.edit', compact('bpd', 'desaList'));
    }

    public function update(Request $request, Bpd $bpd)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'iddesa' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bpd', 'public');
        }

        $bpd->update($data);
        return redirect()->route('bpd.index');
    }

    public function destroy(Bpd $bpd)
    {
        if ($bpd->foto && Storage::disk('public')->exists($bpd->foto)) {
            Storage::disk('public')->delete($bpd->foto);
        }

        $bpd->delete();

        return redirect()->route('bpd.index');
    }
}
