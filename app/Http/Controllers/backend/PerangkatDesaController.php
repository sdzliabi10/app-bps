<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerangkatDesa;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Storage;


class PerangkatDesaController extends Controller
{
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        // Mengambil daftar desa untuk filter
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Mengambil data perangkat desa berdasarkan filter desa
        $perangkatDesas = PerangkatDesa::with('desa')
            ->when($request->desa, function ($query) use ($request) {
                return $query->where('iddesa', $request->desa);
            })
            ->get();

        return view('admin.perangkat-desa.index', compact('perangkatDesas', 'desaList', 'kecamatanList'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();         
        $desaList = Desa::all();
        return view('admin.perangkat-desa.create', compact('desaList', 'kecamatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'iddesa' => 'required',
        ]);

        $fotoPath = $request->file('foto')->store('perangkat-desa', 'public');

        PerangkatDesa::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'iddesa' => $request->iddesa,
        ]);

        return redirect()->route('perangkat-desa.index');
    }

    public function edit(PerangkatDesa $perangkatDesa)
    {
        $desaList = Desa::all();
        return view('admin.perangkat-desa.edit', compact('perangkatDesa', 'desaList'));
    }

    public function update(Request $request, PerangkatDesa $perangkatDesa)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'iddesa' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('perangkat-desa', 'public');
        }

        $perangkatDesa->update($data);
        return redirect()->route('perangkat-desa.index');
    }
    
public function destroy(PerangkatDesa $perangkatDesa)
{    
    if ($perangkatDesa->foto && Storage::disk('public')->exists($perangkatDesa->foto)) {
        Storage::disk('public')->delete($perangkatDesa->foto);
    }
    
    $perangkatDesa->delete();
    
    return redirect()->route('perangkat-desa.index');
}

}
