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
        Schema::create('grading_kasar_hasil', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no')->default('1');
            $table->string('nomor_grading');
            $table->string('id_box_raw_material');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('nomor_nota_internal');
            $table->string('jenis_raw_material');
            $table->float('berat');
            $table->float('kadar_air');
            $table->string('jenis_grading');
            $table->float('berat_grading');
            $table->float('pcs_grading');
            $table->float('susut', 16, 4);
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->float('biaya_produksi', 16, 4)->nullable();
            $table->float('harga_estimasi', 16, 4);
            $table->float('total_harga', 16, 4);
            $table->float('nilai_laba_rugi', 16, 4);
            $table->float('nilai_prosentase_total_keuntungan', 16, 4);
            $table->float('nilai_dikurangi_keuntungan', 16, 4);
            $table->float('prosentase_harga_gramasi', 16, 4);
            $table->float('selisih_laba_rugi_kg', 16, 4);
            $table->float('selisih_laba_rugi_gram', 16, 4);
            $table->float('hpp', 16, 4);
            $table->float('total_hpp', 16, 4);
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
        Schema::dropIfExists('grading_kasar_hasil');
    }
};
