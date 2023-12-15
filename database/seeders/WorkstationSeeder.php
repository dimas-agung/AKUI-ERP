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
            'nama'      => 'Jokowi',
            'status'    => 0,
        ]);
        Workstation::create([
            'nama'      => 'Budi',
            'status'    => 1,
        ]);
        Workstation::create([
            'nama'      => 'Jawir',
            'status'    => 1,
        ]);
        Workstation::create([
            'nama'      => 'Jamet',
            'status'    => 0,
        ]);
        Workstation::create([
            'nama'      => 'Supri',
            'status'    => 1,
        ]);
    }
}
