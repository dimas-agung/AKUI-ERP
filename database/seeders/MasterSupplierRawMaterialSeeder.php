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
            'nama_supplier' => 'Supplier 1',
            'inisial_supplier' => 'SPA',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'Supplier 2',
            'inisial_supplier' => 'SPB',
            'status' => 1,
        ]);
        MasterSupplierRawMaterial::create([
            'nama_supplier' => 'Supplier C',
            'inisial_supplier' => 'SPC',
            'status' => 1,
        ]);
    }
}
