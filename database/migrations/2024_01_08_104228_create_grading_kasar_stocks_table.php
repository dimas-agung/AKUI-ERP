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
            $table->string('id_box_grading_kasar');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis_grading');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('pcs_masuk');
            $table->float('pcs_keluar');
            $table->string('avg_kadar_air');
            $table->string('nomor_grading');
            $table->float('modal');
            $table->float('total_modal');
            $table->text('keterangan');
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
        Schema::dropIfExists('grading_kasar_stocks');
    }
};
