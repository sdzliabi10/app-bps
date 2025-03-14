<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfilDesa;

class ProfilDesaController extends Controller
{
    public function index(Request $request)
    {   
        // Fetch ProfilDesas data
        $profilDesas = ProfilDesa::all(); // Get all data from the ProfilDesa model

        // Optionally, apply filters if needed
        if ($request->has('kecamatan')) {
            $profilDesas = $profilDesas->where('kecamatan', $request->kecamatan);
        }

        if ($request->has('desa')) {
            $profilDesas = $profilDesas->where('desa', $request->desa);
        }

        if ($request->has('tahun')) {
            $profilDesas = $profilDesas->where('tahun', $request->tahun);
        }

        // Pass the data to the view
        return view('public.profil-desa', compact('profilDesas'));
    }    
}
