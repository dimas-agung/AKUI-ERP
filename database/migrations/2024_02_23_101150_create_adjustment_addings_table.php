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
        Schema::create('adjustment_addings', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_grading_halus');
            $table->string('nomor_batch');
            $table->string('jenis_adding');
            $table->float('berat_adding');
            $table->float('pcs_adding');
            $table->string('keterangan');
            $table->float('modal');
            $table->float('total_modal');
            $table->string('nomor_adjustment');
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
        Schema::dropIfExists('adjustment_addings');
    }
};
