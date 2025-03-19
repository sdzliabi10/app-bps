<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use App\Models\KeuanganDesa;
use App\Models\Bpd;

use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function index()
    {
        // Variabel perangkat dikosongkan (tidak ada data)
        $perangkat = [];
        $keuangan = [];
        $bpd = [];
        return view('profil-desa', compact('perangkat', 'keuangan', 'bpd'));
    }
}
