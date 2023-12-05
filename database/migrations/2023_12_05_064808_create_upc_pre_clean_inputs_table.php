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
        Schema::create('upc_pre_clean_input', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat');
            $table->integer('pcs');
            $table->string('kadar_air');
            $table->string('nomor_job');
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
        Schema::dropIfExists('upc_pre_clean_input');
    }
};
