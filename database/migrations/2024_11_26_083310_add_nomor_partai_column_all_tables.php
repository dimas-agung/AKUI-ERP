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
        //
        Schema::table('grading_halus_outputs', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('transit_grading_haluses', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('pre_wash_inputs', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('pre_wash_stocks', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('pre_wash_outputs', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('transit_pre_washes', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('cabut_bulu_penerimaans', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('cabut_bulu_stocks', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('cabut_bulu_pengembalians', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
        Schema::table('transit_cabut_bulus', function (Blueprint $table) {
            $table->string('nomor_partai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
