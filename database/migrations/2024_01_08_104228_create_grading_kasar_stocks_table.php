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
        Schema::create('grading_kasar_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no');
            $table->string('id_box');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis_grading');
            $table->string('berat_masuk');
            $table->string('berat_keluar');
            $table->string('pcs_masuk');
            $table->string('pcs_keluar');
            $table->string('avg_kadar_air');
            $table->string('nomor_grading');
            $table->string('modal');
            $table->string('total_modal');
            $table->string('keterangan');
            $table->string('user_created');
            $table->string('user_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_kasar_stocks');
    }
};
