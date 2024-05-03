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
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
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
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
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
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
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
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
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
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
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
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Agung Dwi Wahyudi',
            'nip' => 'Perendaman123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Perendaman',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Agus Mulyanto',
            'nip' => 'Bilas123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Bilas',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Heri Susilo',
            'nip' => 'Bilas123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Bilas',
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Diki Arnando Prastio',
            'nip' => 'Perendaman123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Perendaman',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Kurniawan Tegar Wibowo',
            'nip' => 'Box123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Box',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'M Reza Ramadhan',
            'nip' => 'Box123',
            'plant' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation' => 'Bahan Baku',
            'unit' => 'Pre Cleaning',
            'job' => 'Box',
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
            'status' => 1,
        ]);
    }
}
