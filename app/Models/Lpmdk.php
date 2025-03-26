<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpmdk extends Model
{
    use HasFactory;
    protected $fillable = ['iddesa', 'jumlah_pengurus', 'jumlah_anggota', 'jumlah_kegiatan', 'jumlah_buku_administrasi', 'jumlah_dana'];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa');
    }
}
