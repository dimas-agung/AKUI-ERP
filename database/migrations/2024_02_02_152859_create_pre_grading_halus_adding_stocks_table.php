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
        Schema::create('pre_grading_halus_adding_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_grading');
            $table->string('id_box_grading_kasar');
            $table->string('nomor_batch');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->string('jenis_raw_material');
            $table->float('kadar_air');
            $table->float('pcs_adding');
            $table->float('modal');
            $table->float('total_modal');
            $table->string('status_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_grading_halus_adding_stocks');
    }
};
