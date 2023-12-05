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
        Schema::create('prm_raw_material_stok', function (Blueprint $table) {
            $table->integer('unit');
            $table->integer('id_box');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat_masuk');
            $table->integer('berat_keluar');
            $table->integer('sisa_berat');
            $table->integer('avg_kadar_air');
            $table->integer('modal');
            $table->integer('total_modal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prm_raw_material_stok');
    }
};
