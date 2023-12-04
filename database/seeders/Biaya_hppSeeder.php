<?php

namespace Database\Seeders;

use App\Models\biaya_hpp;
use Illuminate\Database\Seeder;

class Biaya_hppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        biaya_hpp::create([
            'datetime' => '2023-12-04',
            'unit_id' => 1,
            'jenis_biaya' => 1,
            'biaya_per_gram' => 1,
            'status' => 1,
        ]);
        biaya_hpp::create([
            'datetime' => '2023-12-04',
            'unit_id' => 2,
            'jenis_biaya' => 2,
            'biaya_per_gram' => 2,
            'status' => 2,
        ]);
        biaya_hpp::create([
            'datetime' => '2023-12-04',
            'unit_id' => 3,
            'jenis_biaya' => 3,
            'biaya_per_gram' => 3,
            'status' => 3,
        ]);


    }
}