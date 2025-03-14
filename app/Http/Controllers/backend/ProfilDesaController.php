<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profilDesas = ProfilDesa::all();
        return view('admin.profil-desa.index', compact('profilDesas'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.profil-desa.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'kecamatan' => 'required',
            'desa' => 'required',
            'tahun' => 'required',
            'visi_misi' => 'required',
            'program_unggulan' => 'required',
            'batas_wilayah' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        ProfilDesa::create($request->all());
        return redirect()->route('admin-profil-desa.index');
    }

    // Show the form for editing the specified resource
    public function edit(ProfilDesa $profilDesa)
    {
        return view('admin.profil-desa.edit', compact('profilDesa'));
    }

    // Update the specified resource in storage
    public function update(Request $request, ProfilDesa $profilDesa)
    {
        $request->validate([
            'kecamatan' => 'required',
            'desa' => 'required',
            'tahun' => 'required',
            'visi_misi' => 'required',
            'program_unggulan' => 'required',
            'batas_wilayah' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $profilDesa->update($request->all());
        return redirect()->route('admin-profil-desa.index');
    }

    // Remove the specified resource from storage
    public function destroy(ProfilDesa $profilDesa)
    {
        $profilDesa->delete();
        return redirect()->route('admin-profil-desa.index');
    }
}
