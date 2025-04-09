<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('kd_kategori');
            $table->string('nama_data');
            $table->string('tabel_referensi');
            $table->timestamps();

            $table->foreign('kd_kategori')->references('kd_kategori')->on('kategoris')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_kategoris');
    }
};