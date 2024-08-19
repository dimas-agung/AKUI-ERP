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
        Schema::create('grading_warna_penerimaan_kedatangans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->float('berat_kotor');
            $table->string('jenis_grading');
            $table->float('berat_1_grading');
            $table->float('pcs_1_grading');
            $table->float('berat_2_grading');
            $table->float('modal');
            $table->float('total_modal');
            $table->string('user_created');
            $table->string('user_updated')->nullable();
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_warna_penerimaan_kedatangans');
    }
};
