<?php

namespace Database\Seeders;

use App\Models\MasterSupplierRawMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSupplierRawMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'Abel',
            'inisial_supplier' => 'AB_ABEL',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'Dhofin',
            'inisial_supplier' => 'DH_DHOFIN',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'JONY',
            'inisial_supplier' => 'JN_JONY',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'PAK SALEH',
            'inisial_supplier' => 'PS_SALEH',
            'status' => 1,
        ]);
    }
}
