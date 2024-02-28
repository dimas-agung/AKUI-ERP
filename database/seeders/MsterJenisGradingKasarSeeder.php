<?php

namespace Database\Seeders;

use App\Models\MasterJenisGradingKasar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MsterJenisGradingKasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MasterJenisGradingKasar::factory(5)->create();
    }
}
