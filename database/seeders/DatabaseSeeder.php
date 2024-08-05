<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PrmRawMaterialStock;
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

        // $this->call(UsersSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(WorkstationSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(BiayaHppSeeder::class);
        $this->call(MasterSupplierRawMaterialSeeder::class);
        $this->call(MasterJenisRawMaterialSeeder::class);
        // $this->call(MasterJenisGradingHalusSeeder::class);
        $this->call(MasterTujuanKirimRawMaterialSeeder::class);
        $this->call(MasterTujuanKirimGradingHalusSeeder::class);
        $this->call(MasterOperatorSeeder::class);
        $this->call(MasterJenisGradingWarnaSeeder::class);
        $this->call(MsterJenisGradingKasarSeeder::class);
        $this->call(PreGradingHalusAddingSeeder::class);
        $this->call(MasterOngkosCuciSeeder::class);
        // $this->call(TransitPreCleaningStockSeeder::class);
        $this->call(PreWashStockSeeder::class);
        $this->call(PrmRawMaterialStockSeeder::class);
        $this->call(GradingkasarstockSeeder::class);
        // $this->call(PrmRawMaterialOutputSeeder::class);
        $this->call(StockTransitRawMaterialSeeder::class);
        $this->call(TransitGradingKasarSeeder::class);
        $this->call(CabutBuluStockSeeder::class);
        $this->call(TransitCabutBuluSeeder::class);
        $this->call(StockRambangBasahSeeder::class);
        $this->call(PreWashInputSeeder::class);
        $this->call(DryAGradingStock::class);
        $this->call(DryAGradingCabutSeeder::class);
        $this->call(TransitCabutBuluHancuranSeeder::class);
        $this->call(MasterTujuanKirimDryASeeder::class);
        $this->call(DryAGradingHancuranStockSeeder::class);
        $this->call(DryAWasteStockSeeder::class);
        $this->call(PreGradingHalusInputSeeder::class);
        $this->call(TransitPreCleaningStockSeeder::class);
        $this->call(TransitGradingHalusSeeder::class);
        $this->call(PreCleaningStockSeeder::class);
        $this->call(TransitDryAHancuranSeeder::class);
        $this->call(TransitDryACabutSeeder::class);
        $this->call(MasterJobMouldingSeeder::class);
        $this->call(GradingWarnaStockSeeder::class);
        $this->call(GradingKasarInputSeeder::class);
        $this->call(GradingkasarOutputSeeder::class);
        $this->call(PreCleaningInputSeeder::class);
        $this->call(PreGradingHalusStockSeeder::class);
        $this->call(GradingHalusInputSeeder::class);
        $this->call(GradingHalusStockSeeder::class);
        $this->call(GradingHalusOutputSeeder::class);
        $this->call(MasterTujuanKirimMouldingSeeder::class);
        $this->call(PreWashOutputSeeder::class);
        $this->call(TransitPreWashSeeder::class);
        $this->call(MouldingWasteStockSeeder::class);
        $this->call(FinalGradingSeeder::class);
        $this->call(TransitFinalGradingSeeder::class);
        $this->call(TransitFinalGradingReworkSeeder::class);
        // $this->call(MouldingPersiapanReworkSeeder::class);
        $this->call(MouldingPersiapanReworkStockSeeder::class);
        $this->call(MouldingPenyebaranReworkSeeder::class);
        $this->call(MouldingPengembalianReworkSeeder::class);
        $this->call(TransitMouldingReworkSeeder::class);
        $this->call(roleSeeders::class);
        $this->call(userSeeders::class);

    }
}
