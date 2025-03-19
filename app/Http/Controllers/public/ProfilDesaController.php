<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\ProfilDesa;
use App\Models\PerangkatDesa;

class ProfilDesaController extends Controller
{

    public function showProfilDesa(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        $perangkat = PerangkatDesa::all();                        
        $keuangan = [];
        $bpd = [];


        // Filter berdasarkan desa yang dipilih
        $profilDesas = collect(); // Buat koleksi kosong

        if ($request->has('desa')) {
            $profilDesas = ProfilDesa::where('kddesa', $request->desa)->get();
        }

        return view('public.profil-desa', compact('kecamatanList', 'desaList', 'profilDesas', 'keuangan', 'perangkat', 'bpd'));
    }
}
