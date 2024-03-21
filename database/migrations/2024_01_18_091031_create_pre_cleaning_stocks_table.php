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
        Schema::create('pre_cleaning_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_bstb');
            $table->string('id_box_raw_material');
            $table->string('nomor_batch');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->string('jenis_raw_material');
            $table->string('kadar_air');
            $table->string('jenis_kirim');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('pcs_masuk');
            $table->float('pcs_keluar');
            $table->float('sisa_berat');
            $table->float('sisa_pcs');
            $table->string('tujuan_kirim');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->text('keterangan')->nullable();
            $table->string('nomor_grading')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_cleaning_stocks');
    }
};
