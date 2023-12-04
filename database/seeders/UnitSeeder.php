<?php

namespace Database\Seeders;

use App\Models\unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'datetime'      => '2023-12-04',
            'workstation_id' => 2,
            'nama'      => 'perbarui',
            'status'    => 0,
        ]);
        Unit::create([
            'datetime'      => '2023-12-04',
            'workstation_id' => 3,
            'nama'      => 'Pengiriman',
            'status'    => 0,
        ]);
    }
}
