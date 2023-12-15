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
        Schema::create('prm_raw_material_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->string('id_box');
            $table->string('doc_no');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('sisa_berat');
            $table->float('avg_kadar_air');
            $table->float('modal');
            $table->float('total_modal');
            $table->text('keterangan');
            $table->text('status');
            $table->string('user_created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prm_raw_material_stock_histories');
    }
};