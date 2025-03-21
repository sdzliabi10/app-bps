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
        Schema::create('pembelanjaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa'); // Menambahkan kolom iddesa
            $table->string('jenis_pengeluaran');  // Jenis pengeluaran (misalnya gaji, infrastruktur)
            $table->decimal('jumlah', 15, 2);     // Jumlah pengeluaran
            $table->timestamps();                 // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk iddesa
            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelanjaans');
    }
};
