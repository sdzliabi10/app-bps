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
        Schema::create('lpmdks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');
            $table->integer('jumlah_pengurus');
            $table->integer('jumlah_anggota');
            $table->integer('jumlah_kegiatan');
            $table->integer('jumlah_buku_administrasi');
            $table->decimal('jumlah_dana', 15, 2);
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpmdks');
    }
};
