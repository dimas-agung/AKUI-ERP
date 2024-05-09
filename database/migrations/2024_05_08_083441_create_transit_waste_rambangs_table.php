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
        Schema::create('transit_waste_rambangs', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_bstb');
            $table->string('jenis_rambang');
            $table->float('berat');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_waste_rambangs');
    }
};
