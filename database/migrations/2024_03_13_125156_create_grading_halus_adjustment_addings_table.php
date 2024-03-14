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
        Schema::create('grading_halus_adjustment_addings', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_grading_halus');
            $table->string('nomor_batch');
            $table->string('jenis_adding');
            $table->float('berat_adding');
            $table->float('pcs_adding');
            $table->string('keterangan')->nullable();
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('nomor_adjustment');
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
        Schema::dropIfExists('grading_halus_adjustment_addings');
    }
};
