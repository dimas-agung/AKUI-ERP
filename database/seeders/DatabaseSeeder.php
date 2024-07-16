<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

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
        $this->call(MasterJenisGradingHalusSeeder::class);
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
        $this->call(PrmRawMaterialInputSeeder::class);
        $this->call(PrmRawMaterialInputItemSeeder::class);
        $this->call(PrmRawMaterialStockSeeder::class);
        $this->call(PrmRawMaterialStockHistorySeeder::class);
        // $this->call(PrmRawMaterialOutputSeeder::class);
        // $this->call(StockTransitRawMaterialSeeder::class);
        // Bahan Baku
        // Grading Kasar
        // $this->call(GradingKasarInputSeeder::class);
        $this->call(GradingKasarHasilSeeder::class);
        // Pre-Clening
        $this->call(PreCleaningStockSeeder::class);
        $this->call(PreCleaningOutputSeeder::class);
        $this->call(TransitPreCleaningStockSeeder::class);
        // Grading Halus
        $this->call(PreGradingHalusStockSeeder::class);
        $this->call(PreGradingHalusAddingSeeder::class);
        $this->call(PreGradingHalusAddingStockSeeder::class);
        $this->call(GradingHalusStockSeeder::class);
        $this->call(GradingHalusAdjustmentAddingSeeder::class);
        $this->call(GradingHalusAdjustmentStockSeeder::class);
        $this->call(GradingHalusAdjustmentInputSeeder::class);
        $this->call(TransitGradingHalusSeeder::class);
        // Pre-Wash
        $this->call(PreWashInputSeeder::class);
        // Cleaning
        // Cabut Bulu
        $this->call(CabutBuluStockSeeder::class);
        $this->call(CabutBuluPenyebaranSeeder::class);
        // // Rambang
        $this->call(RambangBasahStockSeeder::class);
        $this->call(RambangKeringInputSeeder::class);
        $this->call(RambangKeringStockSeeder::class);
        $this->call(RambangPengirimanWasteSeeder::class);
        $this->call(TransitRambangWasteSeeder::class);
        // // Cabut Hancuran
        $this->call(CabutHancuranPersiapanStockSeeder::class);
        $this->call(CabutHancuranPenyebaranSeeder::class);
        $this->call(CabutHancuranPengembalianSeeder::class);
        $this->call(TransitCabutHancuranSeeder::class);
        // Dry A
        $this->call(DryAPenerimaanCabutStockSeeder::class);
        // $this->call(DryAGradingCabutSeeder::class);
        // $this->call(DryAGradingCabutStockSeeder::class);
        $this->call(DryAPenerimaanHancuranSeeder::class);
        $this->call(DryAPenerimaanHancuranStockSeeder::class);
        $this->call(DryAWasteInputSeeder::class);
        // // Mooulding
        $this->call(GradingWarnaPenerimaanStockSeeder::class);
        $this->call(MouldingStockSeeder::class);
        $this->call(MouldingWasteStockSeeder::class);
    }
}
