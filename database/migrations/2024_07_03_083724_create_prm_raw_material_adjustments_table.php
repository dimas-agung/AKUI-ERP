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
        Schema::create('prm_raw_material_adjustments', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_adjustment');
            $table->string('nomor_batch');
            $table->string('nomor_batch_adjustment');
            $table->date('tanggal_adjustment');
            $table->string('id_box_raw_material');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->float('berat_adjustment');
            $table->float('berat_saldo_terakhir');
            $table->float('modal_saldo_terakhir', 16, 4);
            $table->float('total_modal_saldo_terakhir', 16, 4);
            $table->float('berat_saldo_awal');
            $table->float('modal_saldo_awal', 16, 4);
            $table->float('total_modal_saldo_awal', 16, 4);
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
        Schema::dropIfExists('prm_raw_material_adjustments');
    }
};
