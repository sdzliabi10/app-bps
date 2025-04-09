<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transparansis', function (Blueprint $table) {
            $table->string('file')->nullable()->after('sumber');
            $table->decimal('anggaran', 15, 2)->nullable()->after('nama');
        });
    }

    public function down()
    {
        Schema::table('transparansis', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('anggaran');
        });
    }
};