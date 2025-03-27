<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desa;

class JalanKab extends Model
{
    use HasFactory;
    protected $table = 'jalan_kabs';

    protected $fillable = [
        'iddesa',
        'nama_jalan',
        'panjang',
        'lebar',
        'kondisi',
        'jenis',
        'lokasi'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}
