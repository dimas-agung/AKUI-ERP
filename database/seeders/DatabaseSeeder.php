<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TransitGradingKasar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UsersSeeder::class);
        $this->call(MasterSupplierRawMaterialSeeder::class);
        $this->call(MasterJenisRawMaterialSeeder::class);
        $this->call(MasterTujuanKirimRawMaterialSeeder::class);
        $this->call(WorkstationSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(BiayaHppSeeder::class);
        $this->call(StockTransitGradingKasarSeeder::class);
        $this->call(PrmRawMaterialOutputHeaderSeeder::class);
        $this->call(PrmRawMaterialOutputItemSeeder::class);
    }
}
