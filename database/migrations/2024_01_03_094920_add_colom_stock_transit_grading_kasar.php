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
        Schema::table('stock_transit_grading_kasars', function (Blueprint $table) {
            //
            $table->string('id_box');
            $table->string('nomor_batch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_transit_grading_kasars', function (Blueprint $table) {
            //
        });
    }
};
