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
        Schema::create('ugk_kalkulasi_hpp', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_grading');
            $table->integer('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis_adding');
            $table->string('berat_adding');
            $table->string('kadar_air');
            $table->string('jenis_grading');
            $table->string('berat_grading');
            $table->string('pcs_grading');
            $table->string('id_box');
            $table->foreignId('biaya_produksi')->constrained('biaya_hpp');
            $table->string('modal');
            $table->string('total_modal');
            $table->string('fix_modal');
            $table->string('fix_total_modal');
            $table->string('kontribusi');
            $table->string('harga_estimasi');
            $table->string('total_harga');
            $table->string('nilai_laba_rugi');
            $table->string('nilai_prosentase_total_keuntungan');
            $table->string('nilai_setelah_dikurangi_keuntungan');
            $table->string('prosentase_harga_dan_gramasi');
            $table->string('selisih_laba_rugi_dalam_kg');
            $table->string('selisih_laba_rugi_per_gram');
            $table->string('hpp');
            $table->string('total_hpp');
            $table->string('keterangan');
            $table->date('datetime');
            $table->integer('nip_admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugk_kalkulasi_hpp');
    }
};
