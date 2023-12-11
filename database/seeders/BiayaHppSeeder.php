<?php

namespace Database\Seeders;

use App\Models\BiayaHpp;
use Illuminate\Database\Seeder;

class BiayaHppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BiayaHpp::create([
            'unit_id' => 1,
            'jenis_biaya' => 1,
            'biaya_per_gram' => 1,
            'status' => 1,
        ]);
        BiayaHpp::create([
            'unit_id' => 2,
            'jenis_biaya' => 2,
            'biaya_per_gram' => 2,
            'status' => 2,
        ]);
    }
}
