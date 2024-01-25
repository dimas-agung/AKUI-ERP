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
        Schema::create('pre_cleaning_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no');
            $table->string('nomor_job');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('nomor_nota_internal');
            $table->string('id_box_raw_material');
            $table->string('jenis_raw_material');
            $table->string('jenis_kirim');
            $table->float('berat_kirim');
            $table->float('pcs_kirim');
            $table->float('modal');
            $table->float('total_modal');
            $table->string('operator_sikat_kompresor');
            $table->string('operator_flek_poles');
            $table->string('operator_flek_cutter');
            $table->float('kuningan');
            $table->float('sterofoam');
            $table->float('karat');
            $table->float('rontokan_fisik');
            $table->float('rontokan_bahan');
            $table->float('rontokan_serabut');
            $table->float('ws_0_0_0');
            $table->float('berat_pre_cleaning');
            $table->float('pcs_pre_cleaning');
            $table->float('susut');
            $table->string('user_created');
            $table->string('user_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_cleaning_outputs');
    }
};
