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
        Schema::create('dry_a_grading_cabut_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('berat_kotor');
            $table->string('tujuan_kirim');
            $table->string('jenis_grading');
            $table->float('berat_1_grading');
            $table->float('pcs_1_grading');
            $table->string('berat_2_grading');
            $table->string('keterangan');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_grading_cabut_stocks');
    }
};
