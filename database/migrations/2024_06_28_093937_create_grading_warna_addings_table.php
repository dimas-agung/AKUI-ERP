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
        Schema::create('grading_warna_addings', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->float('berat_kotor');
            $table->string('jenis_grading');
            $table->float('berat_1_grading', 16, 4);
            $table->float('pcs_1_grading', 16, 4);
            $table->float('berat_2_grading', 16, 4);
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('nomor_lot');
            $table->float('berat_kotor_adding', 16, 4);
            $table->float('prosentase_susut', 16, 4);
            $table->string('keterangan')->nullable();
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->string('user_created');
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_warna_addings');
    }
};
