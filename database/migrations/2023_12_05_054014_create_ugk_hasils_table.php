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
        Schema::create('ugk_hasil', function (Blueprint $table) {
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
            $table->decimal('biaya_produksi', $scale = 2);
            $table->string('modal');
            $table->string('total_modal');
            $table->string('hpp');
            $table->string('total_hpp');
            $table->string('keterangan');
            $table->timestamps();
            $table->integer('nip_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugk_hasil');
    }
};
