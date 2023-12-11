<?php

namespace Database\Seeders;

use App\Models\Unit;
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
            'workstation_id' => 1,
            'nama'      => 'perbarui',
            'status'    => 0,
        ]);
        Unit::create([
            'workstation_id' => 2,
            'nama'      => 'Pengiriman',
            'status'    => 0,
        ]);
        Unit::create([
            'workstation_id' => 3,
            'nama'      => 'Pengemasan',
            'status'    => 0,
        ]);
        Unit::create([
            'workstation_id' => 4,
            'nama'      => 'Pengecek',
            'status'    => 0,
        ]);
    }
}
