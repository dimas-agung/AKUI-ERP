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
        Schema::create('master_ongkos_cucis', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('jenis_bulu');
            $table->float('biaya_per_gram', 16, 4);
            $table->string('status')->default('1');
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_ongkos_cucis');
    }
};
