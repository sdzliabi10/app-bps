<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SekolahPeta;

class SekolahPetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sekolah_peta')->truncate();

        SekolahPeta::create([
            'iddesa' => 3329170017,
            'nama_sekolah' => 'SD Negeri Limbangan Kulon 2',
            'jenjang' => 'SD',
            'alamat' => 'Jl. Tentara Pelajar No.65, Limbangan Kulon, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'tahun_berdiri' => 1995,
            'jumlah_murid' => 180,
            'jumlah_guru' => 12,
            'status' => 'Negeri',
            'latitude' => -6.870525541007384,
            'longitude' => 109.05545756224548,
            'gambar' => '/images/sd2.PNG',
        ]);

        SekolahPeta::create([
            'iddesa' => 3329170017,
            'nama_sekolah' => 'SDN LIMBANGAN KULON 01',
            'jenjang' => 'SD',
            'alamat' => 'Limbangan Kulon, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'tahun_berdiri' => 1995,
            'jumlah_murid' => 180,
            'jumlah_guru' => 12,
            'status' => 'Negeri',
            'latitude' => -6.872165914199748,
            'longitude' => 109.05651971701417,
            'gambar' => '/images/sd1.png',
        ]);

        SekolahPeta::create([
            'iddesa' => 3329170017,
            'nama_sekolah' => 'TK Pertiwi Limbangan Kulon',
            'jenjang' => 'TK',
            'alamat' => 'Limbangan Kulon, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'tahun_berdiri' => 1995,
            'jumlah_murid' => 180,
            'jumlah_guru' => 12,
            'status' => 'Negeri',
            'latitude' => -6.874253653728019, 
            'longitude' => 109.05587598685975,
            'gambar' => '/images/sd1.png',
        ]);

        SekolahPeta::create([
            'iddesa' => 3329170017,
            'nama_sekolah' => 'SD Islam Al Azhar 53 Brebes',
            'jenjang' => 'SD',
            'alamat' => 'Jl. Tentara Pelajar No.12, RT.02/RW.01, Limbangan Kulon, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'tahun_berdiri' => 1995,
            'jumlah_murid' => 180,
            'jumlah_guru' => 12,
            'status' => 'Negeri',
            'latitude' => -6.874647766782062,
            'longitude' => 109.05468508604447,
            'gambar' => '/images/sd1.png',
        ]);

        SekolahPeta::create([
            'iddesa' => 3329170010,
            'nama_sekolah' => 'SMP Negeri 3 Brebes',
            'jenjang' => 'SMP',
            'alamat' => 'Jl. Gajah Mada No.38, Gandasuli, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'tahun_berdiri' => 1995,
            'jumlah_murid' => 180,
            'jumlah_guru' => 12,
            'status' => 'Negeri',
            'latitude' => -6.875649025538786, 
            'longitude' => 109.05552193526727,
            'gambar' => '/images/smp3.jpg',
        ]);
    }
}
