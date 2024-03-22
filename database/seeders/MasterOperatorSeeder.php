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
        MasterOperator::create([
            'nama' => 'Arhan Saputra',
            'nip' => '2002050871',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Perendaman',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Muhammad Ramadhan',
            'nip' => '2002050872',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Perendaman',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Fiki Dzikri',
            'nip' => '2002050873',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Bilas',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'M Reza Ramadhan',
            'nip' => '2002050874',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Bilas',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Auliya Permata',
            'nip' => '2002050875',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Box',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Purwodadi',
            'nip' => '2002050876',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Box',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Siti Romlah',
            'nip' => 'FlekPl123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Wash',
            'job' => 'Box',
            'status' => 1,
        ]);
    }
}
