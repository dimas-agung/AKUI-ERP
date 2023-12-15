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
            'nama_supplier' => 'SupplierA',
            'inisial_supplier' => 'SPA',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'SupplierB',
            'inisial_supplier' => 'SPB',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'SupplierC',
            'inisial_supplier' => 'SPC',
            'status' => 1,
        ]);
    }
}
