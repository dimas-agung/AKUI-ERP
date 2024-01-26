<?php

namespace Database\Seeders;

use App\Models\PrmRawMaterialStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrmRawMaterialStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PrmRawMaterialStock::factory(5)->create();
    }
}
