<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PusatPerdagangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'iddesa',
        'nama_pusat_perdagangan',
        'panjang',
        'lebar',
        'kondisi',
        'lokasi'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}

