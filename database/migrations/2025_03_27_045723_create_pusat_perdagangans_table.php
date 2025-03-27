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
        Schema::create('pusat_perdagangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');
            $table->string('nama_pusat_perdagangan');
            $table->decimal('panjang', 8, 2);
            $table->decimal('lebar', 8, 2);
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Sedang', 'Rusak Berat']);
            $table->text('lokasi');
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusat_perdagangans');
    }
};
