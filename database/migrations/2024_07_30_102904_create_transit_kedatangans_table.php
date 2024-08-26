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
        Schema::create('transit_kedatangans', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_batch');
            $table->string('jenis');
            $table->float('berat');
            $table->float('pcs');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_kedatangans');
    }
};
