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
        Schema::create('transit_rambang_wastes', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_bstb');
            $table->string('jenis_rambang');
            $table->float('berat');
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_rambang_wastes');
    }
};
