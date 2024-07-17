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
<<<<<<< HEAD
        // \App\Models\Unit::factory(5)->create();
        Unit :: create([
            'workstation_id' => '1',
            'perusahaan_id' => '1',
            'nama' => 'master',
            'status' => '1',
        ]);
        Unit :: create([
            'workstation_id' => '2',
            'perusahaan_id' => '2',
            'nama' => 'purchasing & Exim',
            'status' => '1',
        ]);
        Unit :: create([
            'workstation_id' => '3',
            'perusahaan_id' => '3',
            'nama' => 'Grading Kasar',
            'status' => '1',
        ]);
        Unit :: create([
            'workstation_id' => '3',
            'perusahaan_id' => '3',
            'nama' => 'Pre Cleaning',
            'status' => '1',
        ]);
        Unit :: create([
            'workstation_id' => '2',
            'perusahaan_id' => '2',
            'nama' => 'Grading Halus',
            'status' => '1',
=======
        Unit::create([
            'workstation_id'    => '1',
            'perusahaan_id'     => '1',
            'nama'              => 'Purchasing Raw Material',
            'status'            => 1,
        ]);
        Unit::create([
            'workstation_id'    => '2',
            'perusahaan_id'     => '1',
            'nama'              => 'Bahan Baku',
            'status'            => 1,
        ]);
        Unit::create([
            'workstation_id'    => '3',
            'perusahaan_id'     => '1',
            'nama'              => 'Cleaning',
            'status'            => 1,
        ]);
        Unit::create([
            'workstation_id'    => '4',
            'perusahaan_id'     => '1',
            'nama'              => 'Dry A',
            'status'            => 1,
        ]);
        Unit::create([
            'workstation_id'    => '5',
            'perusahaan_id'     => '1',
            'nama'              => 'Moulding',
            'status'            => 1,
>>>>>>> dev-helmi
        ]);
    }
}
