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
            $table->string('doc_no')->default('1');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('nomor_nota_internal');
            $table->string('jenis_raw_material');
            $table->string('jenis_grading');
            $table->string('id_box_raw_material');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('pcs_masuk');
            $table->float('pcs_keluar');
            $table->string('avg_kadar_air');
            $table->string('nomor_grading');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->text('keterangan');
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
