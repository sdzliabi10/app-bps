<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\KategoriPeta;
use App\Models\Desa;
use App\Models\Paud;
use App\Models\SekolahPeta;
use App\Models\TempatIbadah;

class DesaPetaController extends Controller
{
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $kategoriPetaList = KategoriPeta::all();
        $desaList = Desa::all();

        $selectedKecamatan = $request->get('kecamatan');
        $selectedKategori = $request->get('kategori');
        $selectedDesa = $request->get('desa');

        $selectedKecamatanNama = $this->getKecamatanName($selectedKecamatan);
        $desaKoordinat = $this->getDesaCoordinates($selectedDesa, $selectedKecamatan);

        // Daftar entitas yang akan dikirim ke view
        $paudList = collect();
        $tempatIbadahList = collect();
        $jembatanPetaList = collect();
        $sekolahPetaList = collect();

        if ($selectedDesa && $selectedKecamatan) {
            // PAUD (kategori 6)
            if ($selectedKategori == '6') {
                $sekolahPetaList = $this->getSekolahPetaList($selectedDesa, $selectedKecamatan);
            }

            // Tempat Ibadah (kategori 8)
            if ($selectedKategori == '8') {
                $tempatIbadahList = $this->getTempatIbadahList($selectedDesa, $selectedKecamatan);
            }

            if ($selectedKategori == '9') {
                $jembatanPetaList = $this->getJembatanPetaList($selectedDesa, $selectedKecamatan);
            }            
        }

        $viewPeta = $this->getViewPeta($selectedKecamatan, $selectedKategori);

        return view('public.desa-dalam-peta', compact(
            'kecamatanList',
            'desaList',
            'kategoriPetaList',
            'selectedKecamatan',
            'selectedKategori',
            'selectedDesa',
            'selectedKecamatanNama',
            'desaKoordinat',
            'sekolahPetaList',
            'tempatIbadahList',
            'jembatanPetaList',
            'viewPeta'
        ));
    }

    private function getKecamatanName($selectedKecamatan)
    {
        if ($selectedKecamatan) {
            $kecamatan = Kecamatan::where('kdkec', $selectedKecamatan)->first();
            return $kecamatan ? $kecamatan->nmkec : null;
        }
        return null;
    }

    private function getDesaCoordinates($selectedDesa, $selectedKecamatan)
    {
        if ($selectedDesa && $selectedKecamatan) {
            $desa = Desa::where('iddesa', $selectedDesa)
                        ->where('kdkec', $selectedKecamatan)
                        ->first();

            if ($desa && $desa->latitude && $desa->longitude) {
                return [
                    'lat' => $desa->latitude,
                    'lng' => $desa->longitude,
                    'nama' => $desa->nmdesa
                ];
            }
        }
        return null;
    }

    private function getSekolahPetaList($selectedDesa, $selectedKecamatan)
    {
        $desa = Desa::where('iddesa', $selectedDesa)
                    ->where('kdkec', $selectedKecamatan)
                    ->first();

        if ($desa) {
            return $desa->sekolah_peta;
        }

        return collect();
    }

    private function getTempatIbadahList($selectedDesa, $selectedKecamatan)
    {
        $desa = Desa::where('iddesa', $selectedDesa)
                    ->where('kdkec', $selectedKecamatan)
                    ->first();

        if ($desa) {
            return $desa->tempatIbadah()->get();
        }

        return collect();
    }

    private function getJembatanPetaList($selectedDesa, $selectedKecamatan)
    {
        $desa = Desa::where('iddesa', $selectedDesa)
                    ->where('kdkec', $selectedKecamatan)
                    ->first();
    
        if ($desa) {
            return $desa->jembatan_peta;  // Memanggil relasi dengan nama yang benar
        }
    
        return collect();
    }
    

    private function getViewPeta($selectedKecamatan, $selectedKategori)
    {
        $fallbackKategori = ['2', '3', '4', '5', '7'];

        if ($selectedKategori == '6') {
            return 'public.peta.pendidikan-peta';
        }

        if ($selectedKategori == '8') {
            return 'public.peta.Tempat-ibadah';
        }

        if ($selectedKategori == '9') {
            return 'public.peta.jembatan';
        }

        $kategoriToUse = in_array($selectedKategori, $fallbackKategori) ? '1' : $selectedKategori;
        return 'public.peta.shared';
    }
}
