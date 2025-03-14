<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('profil_desas', function (Blueprint $table) {
        $table->id();
        $table->string('kecamatan');
        $table->string('desa');
        $table->year('tahun');
        $table->text('visi_misi');
        $table->text('program_unggulan');
        $table->text('batas_wilayah');
        $table->string('alamat');
        $table->string('telepon');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
