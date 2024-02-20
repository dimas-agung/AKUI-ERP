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
        \App\Models\BiayaHpp::factory(0)->create();
    }
}
