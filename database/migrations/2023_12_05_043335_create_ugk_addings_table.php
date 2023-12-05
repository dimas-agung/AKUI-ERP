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
        Schema::create('ugk_adding', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_btsb');
            $table->integer('id_box');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat_adding');
            $table->integer('kadar_air');
            $table->string('nomor_grading');
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
        Schema::dropIfExists('ugk_adding');
    }
};
