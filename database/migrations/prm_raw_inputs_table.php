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
            $table->float('berat_nota');
            $table->float('berat_kotor');
            $table->float('berat_bersih');
            $table->float('selisih_berat');
            $table->float('kadar_air');
            $table->string('id_box');
            $table->decimal('harga_nota', $scale = 2);
            $table->decimal('total-harga_nota', $scale = 2);
            $table->decimal('harga_deal', $scale = 2);
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
