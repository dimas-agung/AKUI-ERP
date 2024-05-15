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
        Schema::table('pre_wash_outputs', function (Blueprint $table) {
            $table->string('upah_operator');
            $table->string('upah_operator_bersih');
            $table->float('berat_bersih');
            $table->float('pcs_bersih')->nullabel();
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
