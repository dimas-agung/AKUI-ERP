<?php

namespace Database\Seeders;

use App\Models\DryAPenerimaanCabutStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryAPenerimaanCabutStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DryAPenerimaanCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => '070224-135011.68_A_GH',
            'nomor_batch' => 'P202401.001.1902',
            'jenis_job' => 'PT-1-VIP-KR',
            'berat_job' => 145,
            'pcs_job' => 11,
            'nama_operator' => 'Dedi',
            'nip_operator' => '120100142',
            'grade_operator' => 'D',
            'nama_team_leader' => 'Sisil',
            'tujuan_kirim' => 'Akui',
            'keterangan' => 'Tes',
            'upah_operator' => 50000,
            'modal' => 10671,
            'total_modal' => 1547392,
            'status' => 1,
        ]);
        DryAPenerimaanCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => '090224-135011.88_A_GH',
            'nomor_batch' => 'P202401.001.1902',
            'jenis_job' => 'PT-1-BSA-PB',
            'berat_job' => 89,
            'pcs_job' => 3,
            'nama_operator' => 'Budi',
            'nip_operator' => '120100140',
            'grade_operator' => 'B',
            'nama_team_leader' => 'Niki',
            'tujuan_kirim' => 'Obi',
            'keterangan' => 'Tes',
            'upah_operator' => 60000,
            'modal' => 11061,
            'total_modal' => 984482,
            'status' => 1,
        ]);
        DryAPenerimaanCabutStock::create([
            'unit' => 'Dry A',
            'nomor_job' => '060224-135051.78_A_GH',
            'nomor_batch' => 'P202401.001.1902',
            'jenis_job' => 'PT-1-BSB-PK',
            'berat_job' => 127,
            'pcs_job' => 12,
            'nama_operator' => 'Andi',
            'nip_operator' => '120100139',
            'grade_operator' => 'A',
            'nama_team_leader' => 'Didi',
            'tujuan_kirim' => 'Akui',
            'keterangan' => 'Tes',
            'upah_operator' => 70000,
            'modal' => 9081,
            'total_modal' => 1153287,
            'status' => 1,
        ]);
    }
}
