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
        Schema::create('upc_pre_clean_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat');
            $table->string('pcs');
            $table->integer('kadar_air');
            $table->string('operator_flek');
            $table->string('operator_sikat');
            $table->string('operator_oles');
            $table->string('operator_cuter');
            $table->string('berat_akhir');
            $table->string('kuningan');
            $table->string('sterofoam');
            $table->string('karat');
            $table->string('rontokan_flek');
            $table->string('rontokan_bahan');
            $table->string('ws_0_0_0');
            $table->integer('susut');
            $table->string('nomor_bstb');
            $table->integer('modal');
            $table->integer('total_modal');
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
        Schema::dropIfExists('upc_pre_clean_outputs');
    }
};
