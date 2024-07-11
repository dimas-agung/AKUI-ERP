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
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Cutter',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Agus Mulyanto',
            'nip' => 'SikatKomp123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Sikat + Kompresor',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Heri Susilo',
            'nip' => 'FlekPl123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Flek + Poles',
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Diki Arnando Prastio',
            'nip' => 'Cutter123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Cutter',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Kurniawan Tegar Wibowo',
            'nip' => 'SikatKomp123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Sikat + Kompresor',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Budi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'M Reza Ramadhan',
            'nip' => 'FlekPl123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Cleaning',
            'job' => 'Flek + Poles',
            'grade_operator' => 'C',
            'nama_team_leader' => 'Cici',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Angga Dwi Oktavianto',
            'nip' => 'Perendaman123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Perendaman',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Dodi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Dito Arya Narendra',
            'nip' => 'Perendaman123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Perendaman',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Dodi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Andi Nugroho',
            'nip' => 'Bilas123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Bilas',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Cobi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Akhmad Sutrisno',
            'nip' => 'Bilas123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Bilas',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Cobi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Denes Marlifah',
            'nip' => 'Box123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Box',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Cobi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Harmini',
            'nip' => 'Box123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Bahan Baku',
            'unit_id' => 'Pre Wash',
            'job' => 'Box',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Cobi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Rara Ayu Isnandah',
            'nip' => 'CabutBulu123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Cleaning',
            'unit_id' => 'Cabut Bulu',
            'job' => 'Cabut Bulu',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Sandora Oktaviani',
            'nip' => 'CabutBulu123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Cleaning',
            'unit_id' => 'Cabut Bulu',
            'job' => 'Cabut Bulu',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Andi',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Nartik',
            'nip' => 'Moulding123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Moulding',
            'unit_id' => 'Moulding',
            'job' => 'Moulding',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Bino',
            'status' => 1,
        ]);
        MasterOperator::create([
            'nama' => 'Putri Ari Mardiyanti',
            'nip' => 'Moulding123',
            'perusahaan_id' => 'Akui',
            'divisi' => 'Operational',
            'departemen' => 'Production',
            'bagian' => 'Production',
            'workstation_id' => 'Moulding',
            'unit_id' => 'Moulding',
            'job' => 'Moulding',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Bino',
            'status' => 1,
        ]);
    }
}
