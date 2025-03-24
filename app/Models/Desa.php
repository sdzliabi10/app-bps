<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $primaryKey = 'iddesa';
    protected $fillable = ['kdkec', 'kddesa', 'nmdesa', 'klas', 'stat_pem', 'latitude', 'longitude'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kdkec', 'kdkec');
    }

    public function profil()
    {
        return $this->hasMany(ProfilDesa::class, 'iddesa');
    }
    
    public function perangkatDesa(){        
        return $this->hasMany(PerangkatDesa::class, 'iddesa');
    }

    // Relasi ke tabel Struktur Perangkat Desa
//     public function perangkat()
//     {
//         return $this->hasMany(StrukturPerangkatDesa::class, 'id_desa');
//     }

//     // Relasi ke tabel Keuangan
//     public function keuangan()
//     {
//         return $this->hasMany(Keuangan::class, 'id_desa');
//     }

//     // Relasi ke tabel Sarana Pendidikan
//     public function saranaPendidikan()
//     {
//         return $this->hasMany(SaranaPendidikan::class, 'id_desa');
//     }

//     // Relasi ke tabel Sarana Ibadah
//     public function saranaIbadah()
//     {
//         return $this->hasMany(SaranaIbadah::class, 'id_desa');
//     }

//     // Relasi ke tabel Sarana Kesehatan
//     public function saranaKesehatan()
//     {
//         return $this->hasMany(SaranaKesehatan::class, 'id_desa');
//     }

//     // Relasi ke tabel Sarana Olahraga
//     public function saranaOlahraga()
//     {
//         return $this->hasMany(SaranaOlahraga::class, 'id_desa');
//     }

//     // Relasi ke tabel Ekonomi
//     public function ekonomi()
//     {
//         return $this->hasMany(Ekonomi::class, 'id_desa');
//     }

//     // Relasi ke tabel Transportasi
//     public function transportasi()
//     {
//         return $this->hasMany(Transportasi::class, 'id_desa');
//     }
}
