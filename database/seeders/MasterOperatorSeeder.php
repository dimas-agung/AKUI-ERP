<?php

namespace Database\Seeders;

use App\Models\MasterOperator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterOperator::create([
            'nama' => 'Agung Dwi Wahyudi',
            'nip' => 'Cutter123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Cutter',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Agus Mulyanto',
            'nip' => 'SikatKomp123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Sikat + Kompresor',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Heri Susilo',
            'nip' => 'FlekPl123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Flek + Poles',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Diki Arnando Prastio',
            'nip' => 'Cutter123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Cutter',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Kurniawan Tegar Wibowo',
            'nip' => 'SikatKomp123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Sikat + Kompresor',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'M Reza Ramadhan',
            'nip' => 'FlekPl123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Flek + Poles',
            'status' => 1,
        ]);
    }
}
