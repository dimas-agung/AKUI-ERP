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
        Schema::table('master_jenis_raw_materials', function (Blueprint $table) {
            $table->decimal('upah_operator', 10, 2)->nullable()->change();
            $table->decimal('pengurangan_harga', 10, 2)->nullable()->change();
            $table->decimal('harga_estimasi', 10, 2)->nullable()->change();
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
