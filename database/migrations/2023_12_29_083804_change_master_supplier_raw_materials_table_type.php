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
        // //
        // Schema::table('master_supplier_raw_materials', function (Blueprint $table) {
        //     $table->string('nama_supplier')->change();
        // });
        Schema::table('master_supplier_raw_materials', function (Blueprint $table) {
            // Drop unique constraint
            $table->dropUnique('master_supplier_raw_materials_nama_supplier_unique');

            // Change column type to string
            $table->string('nama_supplier')->change();
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
