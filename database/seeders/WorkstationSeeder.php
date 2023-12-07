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
            'nama'      => 'Joko',
            'status'    => 0,
        ]);
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Budi',
            'status'    => 1,
        ]);
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Jawir',
            'status'    => 1,
        ]);
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Jamet',
            'status'    => 0,
        ]);
        Workstation::create([
            'datetime'      => '2023-12-04',
            'nama'      => 'Supri',
            'status'    => 1,
        ]);
    }
}
