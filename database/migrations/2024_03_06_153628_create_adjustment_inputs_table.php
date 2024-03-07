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
        Schema::create('adjustment_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_adjustment');
            $table->string('nomor_batch');
            $table->float('berat_adding');
            $table->float('pcs_adding');
            $table->string('jenis_adjustment');
            $table->float('berat_adjustment');
            $table->float('pcs_adjustment');
            $table->string('keterangan')->nullable();
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('kategori_susut');
            $table->string('id_box_grading_halus');
            $table->float('susut_depan', 16, 4);
            $table->float('susut_belakang', 16, 4);
            $table->float('biaya_produksi', 16, 4);
            $table->float('kontribusi', 16, 4);
            $table->float('harga_estimasi', 16, 4);
            $table->float('total_harga', 16, 4);
            $table->float('nilai_laba_rugi', 16, 4);
            $table->float('nilai_prosentase_total_keuntungan', 16, 4);
            $table->float('nilai_dikurangi_keuntungan', 16, 4);
            $table->float('prosentase_harga_gramasi', 16, 4);
            $table->float('selisih_laba_rugi_kg', 16, 4);
            $table->float('selisih_laba_rugi_per_gram', 16, 4);
            $table->float('hpp', 16, 4);
            $table->float('total_hpp', 16, 4);
            $table->float('fix_total_hpp', 16, 4);
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
        Schema::dropIfExists('adjustment_inputs');
    }
};
