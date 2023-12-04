<?php

namespace Database\Seeders;

use App\Models\workstation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkstationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'perbarui',
            'status'    => 0,
        ]);
        workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Pengiriman',
            'status'    => 1,
        ]);
    }
}
