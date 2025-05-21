<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatIbadah extends Model
{
    use HasFactory;

    protected $table = 'tempat_ibadah';

    protected $fillable = [
        'iddesa',
        'nama',
        'agama',
        'alamat',
        'tahun_berdiri',
        'latitude',
        'longitude',
        'gambar',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}
