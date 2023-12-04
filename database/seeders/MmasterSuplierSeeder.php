<?php

namespace Database\Seeders;

use App\Models\MmasterSuplier;
use Illuminate\Database\Seeder;

class MmasterSuplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MmasterSuplier::create([
            'nama_supplier' => 'Supplier 1',
            'inisial_supplier' => 'sp-A',
            'status' => 1,
        ]);

        MmasterSuplier::create([
            'nama_supplier' => 'Supplier 2',
            'inisial_supplier' => 'sp-B',
            'status' => 0,
        ]);

        MmasterSuplier::create([
            'nama_supplier' => 'Supplier 3',
            'inisial_supplier' => 'sp-C',
            'status' => 1,
        ]);
    }
}