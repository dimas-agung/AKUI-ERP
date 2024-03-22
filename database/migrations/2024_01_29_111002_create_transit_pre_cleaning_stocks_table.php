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
        Schema::create('transit_pre_cleaning_stocks', function (Blueprint $table) {
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
            $table->float('kadar_air');
            $table->string('jenis_kirim');
            $table->float('berat_kirim');
            $table->float('pcs_kirim');
            $table->string('tujuan_kirim');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->float('sisa_berat');
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
        Schema::dropIfExists('transit_pre_cleaning_stocks');
    }
};
