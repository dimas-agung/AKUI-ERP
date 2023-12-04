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
        Schema::create('mmaster_tujuan_kirims', function (Blueprint $table) {
            $table->id();
            $table->varchar('tujuan_kirim');
            $table->varchar('letak_tujuan');
            $table->varchar('inisial_tujuan');
            $table->int('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mmaster_tujuan_kirims');
    }
};
