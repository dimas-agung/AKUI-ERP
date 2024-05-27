<?php

namespace Database\Seeders;

use App\Models\TransitCabutBulu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransitCabutBuluSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\TransitCabutBulu::factory(5)->create();
        TransitCabutBulu::create([
            'workstation' => 'Cabut Bulu',
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093511',
            'nomor_batch' => '093513',
            'jenis_job' => 'AB',
            'berat_job' => '10',
            'pcs_job' => '5',
            'upah_operator' => '55000',
            'tujuan_kirim' => 'jombang',
            'keterangan' => 'oke',
            'nama_operator' => 'Koko Lim',
            'nip_operator' => '7715528',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'Angelo',
            'modal' => '5000',
            'total_modal' => '50000',
            'status' => '1',
        ]);
        TransitCabutBulu::create([
            'workstation' => 'Cabut Bulu',
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093522',
            'nomor_batch' => '093522',
            'jenis_job' => 'CD',
            'berat_job' => '30',
            'pcs_job' => '15',
            'upah_operator' => '15000',
            'tujuan_kirim' => 'Malang',
            'keterangan' => 'Test',
            'nama_operator' => 'Joko Tarub',
            'nip_operator' => '77152861',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'Michel',
            'modal' => '10000',
            'total_modal' => '300000',
            'status' => '1',
        ]);
        TransitCabutBulu::create([
            'workstation' => 'Cabut Bulu',
            'unit' => 'Cleaning',
            'nomor_job' => '010324-093533',
            'nomor_batch' => '093533',
            'jenis_job' => 'CD',
            'berat_job' => '50',
            'pcs_job' => '25',
            'upah_operator' => '25000',
            'tujuan_kirim' => 'Surabaya',
            'keterangan' => 'Cek',
            'nama_operator' => 'Ujang',
            'nip_operator' => '9278186',
            'grade_operator' => 'KL',
            'nama_team_leader' => 'John',
            'modal' => '15000',
            'total_modal' => '750000',
            'status' => '1',
        ]);
    }
}
