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
        Schema::create('grading_halus_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_grading');
            $table->string('id_box_raw_material');
            $table->string('nomor_batch');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->integer('status')->default('1');
            $table->string('jenis_raw_material');
            $table->string('kadar_air')->nullable();
            $table->float('berat_adding');
            $table->float('pcs_adding')->nullable();
            $table->string('jenis_grading');
            $table->float('berat_grading');
            $table->float('pcs_grading')->nullable();
            $table->string('keterangan')->nullable();
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('kategori_susut')->nullable();
            $table->string('id_box_grading_halus');
            $table->string('susut_depan')->nullable();
            $table->string('susut_belakang')->nullable();
            $table->float('biaya_produksi', 16, 4)->nullable();
            $table->string('kontribusi')->nullable();
            $table->float('harga_estimasi', 16, 4);
            $table->float('total_harga', 16, 4)->nullable();
            $table->float('nilai_laba_rugi')->nullable();
            $table->float('nilai_prosentase_total_keuntungan', 16, 4)->nullable();
            $table->float('prosentase_harga_gramasi', 16, 4)->nullable();
            $table->float('selisih_laba_rugi_kg', 16, 4)->nullable();
            $table->float('selisih_laba_rugi_per_gram', 16, 4)->nullable();
            $table->float('hpp', 16, 4)->nullable();
            $table->float('total_hpp', 16, 4)->nullable();
            $table->float('fix_hpp', 16, 4)->nullable();
            $table->float('fix_total_hpp', 16, 4)->nullable();
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
        Schema::dropIfExists('grading_halus_inputs');
    }
};
