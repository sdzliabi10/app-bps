<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;
use App\Models\Kecamatan;  // Menambahkan model Kecamatan
use App\Models\Desa;      // Menambahkan model Desa
use Illuminate\Support\Facades\Storage;


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
            ->get();

        // Mengirimkan data ke tampilan
        return view('admin.profil-desa.index', compact('profilDesas', 'kecamatanList', 'desaList'));
    }

    // Menambahkan profil desa baru
    public function create()
    {
        $kecamatanList = Kecamatan::all(); // Ambil semua data kecamatan
        $desaList = Desa::all();
        return view('admin.profil-desa.create', compact('kecamatanList', 'desaList'));
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adding validation for photo upload
        ]);

        // Handling the file upload
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('profil-desa', 'public'); // Store photo in 'profil-desa' folder under public disk
        } else {
            $fotoPath = null; // If no photo is uploaded, set to null (you can choose to make it optional)
        }

        ProfilDesa::create([
            'kddesa' => $request->kddesa,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'program_unggulan' => $request->program_unggulan,
            'batas_wilayah' => $request->batas_wilayah,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'foto' => $fotoPath,  // Storing the file path in the database
        ]);

        return redirect()->route('profil-desa.index');
    }

    
    // Menampilkan form untuk mengedit profil desa
    public function edit(ProfilDesa $profilDesa)
    {
        // Get all kecamatan and desa data
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::when($profilDesa->kecamatan, function ($query) use ($profilDesa) {
            return $query->where('kdkec', $profilDesa->kecamatan);
        })->get();

        return view('admin.profil-desa.edit', compact('profilDesa', 'kecamatanList', 'desaList'));
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Prepare data for update
        $data = $request->all();

        // Check if a new photo is uploaded
        if ($request->hasFile('foto')) {
            // Delete the old photo if exists
            if ($profilDesa->foto && Storage::disk('public')->exists($profilDesa->foto)) {
                Storage::disk('public')->delete($profilDesa->foto);
            }
            // Store the new photo
            $data['foto'] = $request->file('foto')->store('profil-desa', 'public');
        }

        // Update the ProfilDesa record
        $profilDesa->update($data);

        return redirect()->route('profil-desa.index');
    }


    // Menghapus profil desa
    public function destroy(ProfilDesa $profilDesa)
    {
        // Check if the file exists and delete it from storage
        if ($profilDesa->foto && Storage::disk('public')->exists($profilDesa->foto)) {
            Storage::disk('public')->delete($profilDesa->foto);
        }

        // Delete the ProfilDesa record
        $profilDesa->delete();

        // Redirect back to the index page
        return redirect()->route('profil-desa.index');
    }
}
