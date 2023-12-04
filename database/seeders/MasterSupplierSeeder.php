<?php

namespace Database\Seeders;

use App\Models\MasterSupplier;
use Illuminate\Database\Seeder;

class MasterSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterSupplier::create([
            'nama_supplier' => 'Supplier 1',
            'inisial_supplier' => 'sp-A',
            'status' => 1,
        ]);

        MasterSupplier::create([
            'nama_supplier' => 'Supplier 2',
            'inisial_supplier' => 'sp-B',
            'status' => 0,
        ]);

        MasterSupplier::create([
            'nama_supplier' => 'Supplier 3',
            'inisial_supplier' => 'sp-C',
            'status' => 1,
        ]);
    }
}