<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    // Nama tabel (optional)
    protected $table = 'profil_desas';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'kddesa', 'visi', 'misi', 'program_unggulan', 'batas_wilayah', 'alamat', 'kontak', 'foto'
    ];

    // Relasi ke tabel Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'kddesa', 'iddesa');
    }
}
