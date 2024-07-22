<?php

namespace Database\Seeders;

use App\Models\DryAWasteInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryAWasteInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 0; $i < 10000; $i++) {
            DryAWasteInput::create([
                'tanggal_cabut' => '2024-06-26',
                'jenis_waste' => 'ABC123',
                'berat' => 5,
                'pcs' => 5,
                'keterangan' => 'Tes Seeder',
                'status' => 1,
                'modal' => '1000',
                'total_modal' => '5000',
                'harga_estimasi' => "5000",
                'user_created' => 'Admin',
                'user_updated' => '',
            ]);
        }
    }
}
