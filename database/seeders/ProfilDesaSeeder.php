<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilDesaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kddesa' => '3329010001',
                'visi' => 'Menjadikan Desa Gunung Jaya sebagai desa mandiri yang sejahtera',
                'misi' => 'Meningkatkan ekonomi desa, memperbaiki infrastruktur, dan meningkatkan pendidikan',
                'program_unggulan' => 'Pemberdayaan UMKM, perbaikan jalan desa, dan pembangunan sekolah',
                'batas_wilayah' => 'Sebelah utara: Desa Indrajaya, Selatan: Desa Banjaran, Timur: Desa Salem, Barat: Desa Gunung Larang',
                'alamat' => 'Jl. Raya Gunung Jaya No.1, Kecamatan Salem',
                'kontak' => '081234567890',
            ],
            [
                'kddesa' => '3329010002',
                'visi' => 'Menjadikan Indrajaya desa yang maju dan berdaya saing',
                'misi' => 'Mengembangkan sektor pertanian, memperbaiki infrastruktur desa',
                'program_unggulan' => 'Pelatihan petani, pembangunan jalan usaha tani',
                'batas_wilayah' => 'Sebelah utara: Desa Gunung Jaya, Selatan: Desa Banjaran, Timur: Desa Salem, Barat: Desa Gunung Larang',
                'alamat' => 'Jl. Desa Indrajaya No.2, Kecamatan Salem',
                'kontak' => '082345678901',
            ],
            [
                'kddesa' => '3329010003',
                'visi' => 'Banjaran sebagai desa hijau dan lestari',
                'misi' => 'Mengembangkan sektor pariwisata alam dan meningkatkan kesejahteraan masyarakat',
                'program_unggulan' => 'Ekowisata, reboisasi, pelatihan UMKM',
                'batas_wilayah' => 'Sebelah utara: Desa Indrajaya, Selatan: Desa Gunung Larang, Timur: Desa Salem, Barat: Desa Gunung Sugih',
                'alamat' => 'Jl. Wisata Banjaran No.3, Kecamatan Salem',
                'kontak' => '083456789012',
            ],
            [
                'kddesa' => '3329010004',
                'visi' => 'Desa Salem unggul dalam pendidikan dan ekonomi kreatif',
                'misi' => 'Mendorong pendidikan berkualitas dan meningkatkan sektor ekonomi kreatif',
                'program_unggulan' => 'Bantuan pendidikan gratis, pusat ekonomi kreatif desa',
                'batas_wilayah' => 'Sebelah utara: Desa Indrajaya, Selatan: Desa Gunung Larang, Timur: Desa Gunung Sugih, Barat: Desa Banjaran',
                'alamat' => 'Jl. Pendidikan Salem No.4, Kecamatan Salem',
                'kontak' => '084567890123',
            ],
            [
                'kddesa' => '3329010005',
                'visi' => 'Gunung Larang sebagai desa berdaya dan mandiri',
                'misi' => 'Meningkatkan ketahanan pangan dan memperkuat ekonomi desa',
                'program_unggulan' => 'Program ketahanan pangan, pelatihan kewirausahaan',
                'batas_wilayah' => 'Sebelah utara: Desa Banjaran, Selatan: Desa Gunung Sugih, Timur: Desa Salem, Barat: Kecamatan Bantarkawung',
                'alamat' => 'Jl. Raya Gunung Larang No.5, Kecamatan Salem',
                'kontak' => '085678901234',
            ],
            [
                'kddesa' => '3329010006',
                'visi' => 'Gunung Sugih sebagai desa wisata alam unggulan',
                'misi' => 'Mengembangkan potensi wisata alam dan meningkatkan ekonomi desa',
                'program_unggulan' => 'Pembangunan destinasi wisata, pemasaran produk lokal',
                'batas_wilayah' => 'Sebelah utara: Desa Banjaran, Selatan: Kecamatan Bantarkawung, Timur: Desa Gunung Larang, Barat: Desa Gunung Jaya',
                'alamat' => 'Jl. Wisata Gunung Sugih No.6, Kecamatan Salem',
                'kontak' => '086789012345',
            ],
        ];

        DB::table('profil_desas')->insert($data);
    }
}
