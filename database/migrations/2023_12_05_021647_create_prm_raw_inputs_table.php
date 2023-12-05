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
        Schema::create('prm_raw_material_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po');
            $table->string('nomor_batch');
            $table->string('nomor_nota_supplier');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat_nota');
            $table->integer('berat_kotor');
            $table->integer('berat_bersih');
            $table->integer('selisih_berat');
            $table->integer('kadar_air');
            $table->integer('id_box');
            $table->integer('harga_nota');
            $table->integer('total-harga_nota');
            $table->integer('harga_deal');
            $table->integer('fix_harga_deal');
            $table->string('keterangan');
            $table->timestamps();
            $table->integer('nip_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prm_raw_material_inputs');
    }
};
