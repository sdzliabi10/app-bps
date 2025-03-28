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
        Schema::create('data_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kd_Kategori', 5);
            $table->string('nama_data', 100);
            $table->timestamps();

            $table->foreign('kd_Kategori')->references('kd_Kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kategori');
    }
};
