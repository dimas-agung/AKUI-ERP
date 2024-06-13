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
        Schema::create('dry_a_grading_hancuran_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('jenis_grading');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('sisa_berat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_grading_hancuran_stocks');
    }
};
