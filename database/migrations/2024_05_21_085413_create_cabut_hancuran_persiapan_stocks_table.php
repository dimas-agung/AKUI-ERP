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
        Schema::create('cabut_hancuran_persiapan_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('jenis_rambang');
            $table->string('upah_operator');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('sisa_berat');
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabut_hancuran_persiapan_stocks');
    }
};
