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
        Schema::create('ugk_grading_kasar_stok', function (Blueprint $table) {
            $table->id();
            $table->string('id_box');
            $table->integer('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->string('berat_masuk');
            $table->string('berat_keluar');
            $table->string('pcs_masuk');
            $table->string('pcs_keluar');
            $table->string('sisa_berat');
            $table->string('sisa_pcs');
            $table->string('avg_kadar_air');
            $table->string('modal');
            $table->string('total_modal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugk_grading_kasar_stok');
    }
};
