<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelembagaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');            
            $table->enum('jenis', ['LPMD/LPMK', 'TP PKK DESA', 'BUMDES']); // Limited to these three options
            $table->integer('jumlah_pengurus')->default(0);
            $table->integer('jumlah_anggota')->default(0);
            $table->integer('jumlah_kegiatan')->default(0);
            $table->integer('jumlah_buku_administrasi')->default(0);
            $table->integer('jumlah_dana')->default(0);
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelembagaans');
    }
};
