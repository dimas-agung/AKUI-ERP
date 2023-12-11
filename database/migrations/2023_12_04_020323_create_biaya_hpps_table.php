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
        Schema::create('biaya_hpp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('unit');
            $table->string('jenis_biaya');
            $table->float('biaya_per_gram');
            $table->integer('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_hpp');
    }
};
