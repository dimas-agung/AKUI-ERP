<?php

namespace Database\Seeders;

use App\Models\RambangKeringInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RambangKeringInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RambangKeringInput::create([
            'id_box_hcr_kotor'  => '230424_HCR Kotor PB',
            'jenis_rambang'     => 'Bulu',
            'berat_basah'       => 200,
            'berat_kering'      => 50,
            'susut'             => 0.75,
            'keterangan'        => 'tes',
            'status'            => 0,
            'user_created'      => 'Admin123',
            'user_updated'      => 'Admin123',
        ]);
    }
}
