<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use App\Models\Kecamatan;  // Menambahkan model Kecamatan
use App\Models\Desa;      // Menambahkan model Desa

class ProfilDesaController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil daftar kecamatan untuk filter
        $kecamatanList = Kecamatan::all();

        // Mengambil daftar desa berdasarkan kecamatan untuk filter
        $desaList = Desa::when($request->kecamatan, function ($query) use ($request) {
            return $query->where('kdkec', $request->kecamatan);
        })->get();

        // Mengambil data profil desa berdasarkan filter kecamatan, desa, dan tahun
        $profilDesas = ProfilDesa::with('desa.kecamatan')  // Memuat relasi desa dan kecamatan
            ->when($request->kecamatan, function ($query) use ($request) {
                return $query->whereHas('desa', function ($query) use ($request) {
                    $query->where('kdkec', $request->kecamatan);
                });
            })
            ->when($request->desa, function ($query) use ($request) {
                return $query->where('kddesa', $request->desa);
            })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereYear('created_at', $request->tahun);
            })
            ->get();

        // Mengirimkan data ke tampilan
        return view('admin.profil-desa.index', compact('profilDesas', 'kecamatanList', 'desaList'));
    }

    // Menambahkan profil desa baru
    public function create()
    {
        return view('admin.profil-desa.create');
    }

    // Menyimpan profil desa baru
    public function store(Request $request)
    {
        $request->validate([
            'kddesa' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'program_unggulan' => 'required',
            'batas_wilayah' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        ProfilDesa::create($request->all());
        return redirect()->route('profil-desa.index');
    }

    // Menampilkan form untuk mengedit profil desa
    public function edit(ProfilDesa $profilDesa)
    {
        return view('admin.profil-desa.edit', compact('profilDesa'));
    }

    // Memperbarui profil desa
    public function update(Request $request, ProfilDesa $profilDesa)
    {
        $request->validate([
            'kddesa' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'program_unggulan' => 'required',
            'batas_wilayah' => 'required',
            'alamat' => 'required',
            'kontak' => 'required',
        ]);

        $profilDesa->update($request->all());
        return redirect()->route('profil-desa.index');
    }

    // Menghapus profil desa
    public function destroy(ProfilDesa $profilDesa)
    {
        $profilDesa->delete();
        return redirect()->route('profil-desa.index');
    }
}
