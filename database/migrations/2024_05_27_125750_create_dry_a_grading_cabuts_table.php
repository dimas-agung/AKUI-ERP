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
        Schema::create('dry_a_grading_cabuts', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('jenis_job');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->string('tujuan_kirim');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->float('modal');
            $table->float('total_modal');
            $table->float('upah_operator');
            $table->string('jenis_grading');
            $table->float('berat_kotor');
            $table->float('berat_1_grading');
            $table->float('pcs_1_grading');
            $table->float('berat_2_grading');
            $table->string('kategori_susut');
            $table->float('susut_depan', 16, 4);
            $table->float('susut_belakang', 16, 4);
            $table->float('biaya_produksi', 16, 4)->nullable();
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
            $table->string('user_created');
            $table->string('user_updated')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_grading_cabuts');
    }
};
