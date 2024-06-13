<?php

namespace Database\Seeders;
use App\Models\TransitCabutBuluHancuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitCabutBuluHancuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\TransitCabutBulu::factory(5)->create();
        TransitCabutBuluHancuran::create([
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093511',
            'jenis_rambang' => 'AB',
            'berat' => '10',
            'upah_operator' => '55000',
            'nama_operator' => 'Koko Lim',
            'nip_operator' => '7715528',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'Angelo',
            'waktu_penyebaran' => '2024-06-08 11:28:29',
            'waktu_pengembalian' => '2024-06-08 11:28:29',
            'status' => '1',
        ]);
        TransitCabutBuluHancuran::create([
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093522',
            'jenis_rambang' => 'CD',
            'berat' => '30',
            'upah_operator' => '15000',
            'nama_operator' => 'Joko Tarub',
            'nip_operator' => '77152861',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'Michel',
            'waktu_penyebaran' => '2024-06-08 11:28:29',
            'waktu_pengembalian' => '2024-06-08 11:28:29',
            'status' => '1',
        ]);
        TransitCabutBuluHancuran::create([
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093533',
            'jenis_rambang' => 'CD',
            'berat' => '50',
            'upah_operator' => '25000',
            'nama_operator' => 'Ujang',
            'nip_operator' => '9278186',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'John',
            'waktu_penyebaran' => '2024-06-08 11:28:29',
            'waktu_pengembalian' => '2024-06-08 11:28:29',
            'status' => '1',
        ]);
    }
}
