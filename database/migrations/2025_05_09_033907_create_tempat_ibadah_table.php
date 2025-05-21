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
        Schema::create('tempat_ibadah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa'); // FK ke desa
            $table->string('nama');
            $table->string('agama');
            $table->text('alamat')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_ibadah');
    }
};
