<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['iddesa' => '3329010001', 'kdkec' => '010', 'kddesa' => '001', 'nmdesa' => 'GUNUNG JAYA', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.178', 'longitude' => '108.759'],
            ['iddesa' => '3329010002', 'kdkec' => '010', 'kddesa' => '002', 'nmdesa' => 'INDRAJAYA', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.176', 'longitude' => '108.775'],
            ['iddesa' => '3329010003', 'kdkec' => '010', 'kddesa' => '003', 'nmdesa' => 'BANJARAN', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.19', 'longitude' => '108.798'],
            ['iddesa' => '3329010004', 'kdkec' => '010', 'kddesa' => '004', 'nmdesa' => 'SALEM', 'klas' => '1', 'stat_pem' => 'DESA', 'latitude' => '-7.182', 'longitude' => '108.804'],
            ['iddesa' => '3329010005', 'kdkec' => '010', 'kddesa' => '005', 'nmdesa' => 'GUNUNG LARANG', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.196', 'longitude' => '108.831'],
            ['iddesa' => '3329010006', 'kdkec' => '010', 'kddesa' => '006', 'nmdesa' => 'GUNUNG SUGIH', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.103', 'longitude' => '108.494'],
            ['iddesa' => '3329020001', 'kdkec' => '020', 'kddesa' => '001', 'nmdesa' => 'CINANAS', 'klas' => '2', 'stat_pem' => 'DESA', 'latitude' => '-7.291', 'longitude' => '108.973'],

            
        ];

        DB::table('desa')->insert($data);
    }
}
