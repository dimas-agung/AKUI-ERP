<?php

namespace Database\Seeders;

use App\Models\RambangPengirimanWaste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RambangPengirimanWasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RambangPengirimanWaste::create([
            'id_box_hcr_kotor'  => '230424_HCR Kotor PB',
            'jenis_rambang'     => 'Bulu',
            'berat'             => '50',
            'keterangan'        => 'tes',
            'nomor_bstb'        => 'BSTB_130724_103656_A_UPC',
            'user_created'      => 'Admin123',
            'status'            => 0,
        ]);
    }
}
