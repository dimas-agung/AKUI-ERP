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
        Schema::create('prm_raw_material_output_items', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no');
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('id_box');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->float('berat');
            $table->float('kadar_air');
            $table->string('tujuan_kirim');
            $table->string('letak_tujuan');
            $table->string('inisial_tujuan');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->text('keterangan_item')->nullable();
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
        Schema::dropIfExists('prm_raw_material_output_items');
    }
};
