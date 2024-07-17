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
            'perusahaan_id' => '1',
            'nama' => 'Purchasing Raw Material',
            'status' => 1,
        ]);
        Workstation::create([
            'perusahaan_id' => '1',
            'nama' => 'Bahan Baku',
            'status' => 1,
        ]);
        Workstation::create([
            'perusahaan_id' => '1',
            'nama' => 'Cleaning',
            'status' => 1,
        ]);
        Workstation::create([
            'perusahaan_id' => '1',
            'nama' => 'Dry A',
            'status' => 1,
        ]);
        Workstation::create([
            'perusahaan_id' => '1',
            'nama' => 'Moulding',
            'status' => 1,
        ]);
    }
}
