<?php

namespace Database\Seeders;

use App\Models\Workstation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'perbarui',
            'status'    => 0,
        ]);
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Pengiriman',
            'status'    => 1,
        ]);
    }
}
