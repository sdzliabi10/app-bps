<?php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jembatan extends Model
{
    use HasFactory;
    protected $table = 'jembatans';

    protected $fillable = [
        'iddesa',
        'nama_jembatan',
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

