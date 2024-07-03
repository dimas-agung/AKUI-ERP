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
        Schema::table('prm_raw_material_stocks', function (Blueprint $table) {
            $table->float('berat_adjustment', 16, 2)->after('berat_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prm_raw_material_stocks', function (Blueprint $table) {
            //
        });
    }
};
