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
        Schema::create('grading_kasar_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_adjustment');
            $table->string('nomor_batch');
            $table->string('nomor_batch_adjustment');
            $table->date('tanggal_adjustment');
            $table->string('id_box_raw_material');
            $table->string('id_box_grading_kasar');
            $table->string('nama_supplier');
            $table->string('jenis_raw_material');
            $table->string('jenis_grading');
            $table->string('kadar_air');
            $table->float('berat_adjustment');
            // $table->float('total_modal_saldo_awal', 16, 4);
            $table->float('berat_saldo_awal');
            $table->float('modal_saldo_awal', 16, 4);
            $table->float('total_modal_saldo_awal', 16, 4);
            $table->float('berat_saldo_terakhir');
            $table->float('modal_saldo_terakhir', 16, 4);
            $table->float('total_modal_saldo_terakhir', 16, 4);
            $table->text('keterangan');
            $table->string('user_created');
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_kasar_adjustments');
    }
};
