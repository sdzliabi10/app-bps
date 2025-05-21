<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jembatan_peta extends Model
{
    use HasFactory;

    protected $table = 'jembatan_peta';

    protected $fillable = [
        'iddesa',
        'nama',
        'lokasi',
        'panjang',
        'lebar',
        'konstruksi',
        'tahun_dibangun',
        'latitude',
        'longitude',
        'gambar',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}
