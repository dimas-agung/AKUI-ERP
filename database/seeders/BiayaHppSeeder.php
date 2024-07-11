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
        \App\Models\BiayaHpp::factory(7)->create();
        BiayaHpp::create([
            'unit_id' => 1,
            'jenis_biaya' => ,
            'biaya_per_gram' => 1000,
            'status' => 1,
        ]);
    }
}
