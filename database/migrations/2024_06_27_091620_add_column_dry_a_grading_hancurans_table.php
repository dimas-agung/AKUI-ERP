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
        Schema::table('dry_a_grading_hancurans', function (Blueprint $table) {
            $table->float('harga_estimasi', 16, 4);
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
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
