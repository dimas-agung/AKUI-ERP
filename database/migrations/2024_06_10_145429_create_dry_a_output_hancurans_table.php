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
        Schema::create('dry_a_output_hancurans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_grading');
            $table->float('berat_job');
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->string('tujuan_kirim');
            $table->integer('status')->default(1);
            $table->string('user_created');
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_output_hancurans');
    }
};
