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
            $table->string('nomor_job');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_bstb');
            $table->string('id_box_raw_material');
            $table->string('nomor_batch');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->string('jenis_raw_material');
            $table->float('kadar_air');
            $table->string('jenis_kirim');
            $table->float('berat_kirim');
            $table->float('pcs_kirim');
            $table->string('tujuan_kirim');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('operator_sikat_n_kompresor');
            $table->string('operator_flek_n_poles');
            $table->string('operator_cutter');
            $table->float('kuningan', 16, 4);
            $table->float('sterofoam', 16, 4);
            $table->float('karat', 16, 4);
            $table->float('rontokan_flek', 16, 4);
            $table->float('rontokan_bahan', 16, 4);
            $table->float('rontokan_serabut', 16, 4);
            $table->float('ws_0_0_0', 16, 4);
            $table->float('berat_pre_cleaning', 16, 4);
            $table->float('pcs_pre_cleaning', 16, 4);
            $table->float('susut', 16, 4);
            $table->text('keterangan')->nullable();
            $table->string('nomor_grading')->nullable();
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
        Schema::dropIfExists('pre_cleaning_outputs');
    }
};
