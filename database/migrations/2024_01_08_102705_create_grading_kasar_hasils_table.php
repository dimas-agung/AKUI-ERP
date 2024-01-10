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
        Schema::create('grading_kasar_hasils', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no');
            $table->string('nomor_grading');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->float('berat');
            $table->float('kadar_air');
            $table->string('jenis_grading');
            $table->float('berat_grading');
            $table->float('pcs_grading');
            $table->float('susut');
            $table->float('modal');
            $table->float('total_modal');
            $table->float('biaya_produksi');
            $table->float('harga_estimasi');
            $table->float('total_harga');
            $table->float('nilai_laba_rugi');
            $table->float('nilai_prosentase_total_keuntungan');
            $table->float('nilai_dikurangi_keuntungan');
            $table->float('prosentase_harga_gramasi');
            $table->float('selisih_laba_rugi_kg');
            $table->float('selisih_laba_rugi_gram');
            $table->float('hpp');
            $table->float('total_hpp');
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
        Schema::dropIfExists('grading_kasar_hasils');
    }
};
