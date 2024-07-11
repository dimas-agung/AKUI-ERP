<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\MasterJenisGradingKasar;
use App\Models\MasterJenisHcrKotor;
use App\Models\MasterJenisRambang;
use App\Models\MasterOngkosCuci;
use App\Models\MasterTujuanKirimGradingKasar;
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

        $this->call(RoleSeeder::class);
        $this->call(UsersSeeder::class);
        // MASTER LAIN LAIN
        $this->call(PerusahaanSeeder::class);
        // $this->call(WorkstationSeeder::class);
        // $this->call(UnitSeeder::class);
        // $this->call(BiayaHppSeeder::class);
        $this->call(MasterOperatorSeeder::class);
        $this->call(MasterOngkosCuciSeeder::class);
        $this->call(MasterSupplierRawMaterialSeeder::class);
        // MASTER JENIS
        $this->call(MasterJenisRawMaterialSeeder::class);
        $this->call(MasterJenisGradingKasarSeeder::class);
        // $this->call(MasterJenisGradingHalusSeeder::class);
        $this->call(MasterJenisHcrKotorSeeder::class);
        $this->call(MasterJenisRambangSeeder::class);
        $this->call(MasterJenisWasteSeeder::class);
        $this->call(MasterJenisDryASeeder::class);
        $this->call(MasterJenisGradingWarnaSeeder::class);
        // MASTER TUJUAN
        $this->call(MasterTujuanKirimRawMaterialSeeder::class);
        $this->call(MasterTujuanKirimGradingKasarSeeder::class);
        $this->call(MasterTujuanKirimGradingHalusSeeder::class);
        $this->call(MasterTujuanKirimWasteSeeder::class);
        $this->call(MasterTujuanKirimDryASeeder::class);
        $this->call(MasterTujuanKirimMouldingSeeder::class);
        // Purchasing Raw Material
        // $this->call(PrmRawMaterialStockSeeder::class);
        // $this->call(PrmRawMaterialOutputSeeder::class);
        // $this->call(StockTransitRawMaterialSeeder::class);

        // $this->call(TransitPreCleaningStockSeeder::class);
        // $this->call(PrmRawMaterialStockSeeder::class);
        // $this->call(GradingKasarInputSeeder::class);
        // $this->call(PreCleaningStockSeeder::class);
        // $this->call(PreGradingHalusStockSeeder::class);
        // $this->call(GradingHalusStockSeeder::class);
        // $this->call(MasterOngkosCuciSeeder::class);
        // $this->call(TransitGradingHalusSeeder::class);
        // $this->call(RambangBasahStockSeeder::class);
        // $this->call(MasterJenisGradingHalusSeeder::class);

        // $this->call(CabutBuluPenerimaanSeeder::class);
        // $this->call(CabutBuluStockSeeder::class);
        // $this->call(CabutHancuranPersiapanStockSeeder::class);
        // $this->call(DryAPenerimaanCabutStockSeeder::class);
        // $this->call(MasterJenisDryASeeder::class);
        // $this->call(MasterTujuanKirimDryASeeder::class);
        // $this->call(DryAPenerimaanHancuranSeeder::class);
        // $this->call(DryAPenerimaanHancuranStockSeeder::class);
        // $this->call(MasterJenisWasteSeeder::class);
        // $this->call(DryAWasteInputSeeder::class);
        // $this->call(GradingWarnaPenerimaanStockSeeder::class);
        // $this->call(MasterJenisGradingWarnaSeeder::class);
        // $this->call(MasterTujuanKirimMouldingSeeder::class);
        // $this->call(MouldingStockSeeder::class);
    }
}
