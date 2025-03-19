<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\PerangkatDesa;
use Illuminate\Http\Request;

class PerangkatDesaController extends Controller
{
    public function showProfilDesa(Request $request)
    {                
        $perangkat = PerangkatDesa::all();;                        

        return view('public.profil-desa', compact('perangkat'));
    }
}
