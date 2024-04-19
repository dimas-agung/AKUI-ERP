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
        Schema::create('grading_halus_adjustment_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_adjustment');
            $table->string('nomor_batch');
            $table->float('berat_adding');
            $table->float('pcs_adding');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_halus_adjustment_stocks');
    }
};
