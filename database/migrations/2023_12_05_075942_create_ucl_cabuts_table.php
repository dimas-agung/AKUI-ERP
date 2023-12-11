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
        Schema::create('ucl_cabut', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->integer('nomor_batch');
            $table->string('jenis');
            $table->string('berat');
            $table->string('pcs');
            $table->string('kadar_air');
            $table->string('modal');
            $table->string('total_modal');
            $table->string('nip_operator');
            $table->string('nama_operator');
            $table->string('waktu_ambil');
            $table->string('keterangan_ambil');
            $table->string('timestamp_ambil');
            $table->string('nip_admin_ambil');
            $table->string('waktu_kembali');
            $table->string('keterangan_kembali');
            $table->string('timestamp_kembali');
            $table->string('nip_admin_kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ucl_cabut');
    }
};
