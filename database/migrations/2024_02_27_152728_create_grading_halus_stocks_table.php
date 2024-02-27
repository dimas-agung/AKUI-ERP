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
        Schema::create('grading_halus_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('id_box_grading_halus');
            $table->string('nomor_batch');
            $table->string('jenis');
            $table->float('berat_masuk');
            $table->float('pcs_masuk');
            $table->float('berat_keluar');
            $table->float('pcs_keluar');
            $table->float('sisa_berat');
            $table->float('sisa_pcs');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_halus_stocks');
    }
};
