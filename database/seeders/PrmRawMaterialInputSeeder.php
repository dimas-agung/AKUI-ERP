<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PrmRawMaterialInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrmRawMaterialInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PrmRawMaterialInput::create([
            'doc_no' => '2024071101',
            'nomor_po' => 'P001',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_supplier' => 'NT123',
            'nomor_nota_internal' => 'AB_ABEL_NT123_120724',
            'nama_supplier' => 'Abel',
            'keterangan' => 'tes',
            'user_created' => 'admin123',
        ]);
        PrmRawMaterialInput::create([
            'doc_no' => '2024071102',
            'nomor_po' => 'P002',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_supplier' => 'NT456',
            'nomor_nota_internal' => 'DH_DHOFIN_NT456_130724',
            'nama_supplier' => 'Dhofin',
            'keterangan' => 'tes',
            'user_created' => 'admin123',
        ]);
        PrmRawMaterialInput::create([
            'doc_no' => '2024071103',
            'nomor_po' => 'P003',
            'nomor_batch' => 'P202311.006.1012',
            'nomor_nota_supplier' => 'NT789',
            'nomor_nota_internal' => 'PS_PAK SALEH_NT789_140724',
            'nama_supplier' => 'Pak Saleh',
            'keterangan' => 'tes',
            'user_created' => 'admin123',
        ]);
    }
}
