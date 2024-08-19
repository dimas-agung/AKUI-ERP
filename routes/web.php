<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::controller(App\Http\Controllers\MasterOperatorController::class)->group(function () {
         Route::get('/master_operator/getDataOperator', 'getDataOperator')->name('MasterOperator.getDataByUnit');

    });
    Route::controller(App\Http\Controllers\RegisterController::class)->group(function () {
        Route::get('/reset', 'index')->name('reset.index');
        Route::post('/reset/create', 'update')->name('reset.create');
        Route::post('/reset/store', 'store')->name('reset.store');
    });
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('master')->middleware(['role:master|admin'])->group(function () {
        Route::controller(App\Http\Controllers\PerusahaanController::class)->group(function () {
            Route::get('/perusahaan', 'index')->name('Perusahaan.index');
            Route::get('/perusahaan/create', 'create')->name('Perusahaan.create');
            Route::post('/perusahaan/store', 'store')->name('Perusahaan.store');
            Route::get('/perusahaan/show/{id}', 'show')->name('Perusahaan.show');
            Route::get('/perusahaan/edit/{id}', 'edit')->name('Perusahaan.edit');
            Route::put('/perusahaan/update/{id}', 'update')->name('Perusahaan.update');
            Route::delete('/perusahaan/hapus/{id}', 'destroy')->name('Perusahaan.destroy');
        });

        Route::controller(App\Http\Controllers\WorkstationController::class)->group(function () {
            Route::get('/workstation', 'index')->name('Workstation.index');
            Route::get('/workstation/create', 'create')->name('Workstation.create');
            Route::post('/workstation/store', 'store')->name('Workstation.store');
            Route::get('/workstation/show/{id}', 'show')->name('Workstation.show');
            Route::get('/workstation/edit/{id}', 'edit')->name('Workstation.edit');
            Route::put('/workstation/update/{id}', 'update')->name('Workstation.update');
            Route::delete('/workstation/hapus/{id}', 'destroy')->name('Workstation.destroy');
        });

        Route::controller(App\Http\Controllers\UnitController::class)->group(function () {
            Route::get('/unit', 'index')->name('Unit.index');
            Route::get('/unit/create', 'create')->name('Unit.create');
            Route::get('/unit/getWorkstations/{perusahaan_id}', 'getWorkstations')->name('Unit.getWorkstations');
            Route::post('/unit/store', 'store')->name('Unit.store');
            Route::get('/unit/show/{id}', 'show')->name('Unit.show');
            Route::get('/unit/edit/{id}', 'edit')->name('Unit.edit');
            Route::put('/unit/update/{id}', 'update')->name('Unit.update');
            Route::delete('/unit/hapus/{id}', 'destroy')->name('Unit.destroy');
        });

        Route::controller(App\Http\Controllers\BiayaHppController::class)->group(function () {
            Route::get('/biayahpp', 'index')->name('BiayaHpp.index');
            Route::post('/biayahpp/store', 'store')->name('BiayaHpp.store');
            Route::get('/biayahpp/create', 'create')->name('BiayaHpp.create');
            Route::get('/biayahpp/show/{id}', 'show')->name('BiayaHpp.show');
            Route::get('/biayahpp/edit/{id}', 'edit')->name('BiayaHpp.edit');
            Route::put('/biayahpp/update/{id}', 'update')->name('BiayaHpp.update');
            Route::delete('/biayahpp/hapus/{id}', 'destroy')->name('BiayaHpp.destroy');
        });

        Route::controller(App\Http\Controllers\MasterSupplierRawMaterialController::class)->group(function () {
            Route::get('/master_supplier_raw_material', 'index')->name('MasterSupplierRawMaterial.index');
            Route::get('/master_supplier_raw_material/create', 'create')->name('MasterSupplierRawMaterial.create');
            Route::post('/master_supplier_raw_material/store', 'store')->name('MasterSupplierRawMaterial.store');
            Route::get('/master_supplier_raw_material/show/{id}', 'show')->name('MasterSupplierRawMaterial.show');
            Route::get('/master_supplier_raw_material/edit/{id}', 'edit')->name('MasterSupplierRawMaterial.edit');
            Route::put('/master_supplier_raw_material/update/{id}', 'update')->name('MasterSupplierRawMaterial.update');
            Route::delete('/master_supplier_raw_material/destroy/{id}', 'destroy')->name('MasterSupplierRawMaterial.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisRawMaterialController::class)->group(function () {
            Route::get('/master_jenis_raw_material', 'index')->name('MasterJenisRawMaterial.index');
            Route::get('/master_jenis_raw_material/create', 'create')->name('MasterJenisRawMaterial.create');
            Route::post('/master_jenis_raw_material/store', 'store')->name('MasterJenisRawMaterial.store');
            Route::get('/master_jenis_raw_material/show/{id}', 'show')->name('MasterJenisRawMaterial.show');
            Route::get('/master_jenis_raw_material/edit/{id}', 'edit')->name('MasterJenisRawMaterial.edit');
            Route::put('/master_jenis_raw_material/update/{id}', 'update')->name('MasterJenisRawMaterial.update');
            Route::delete('/master_jenis_raw_material/destroy/{id}', 'destroy')->name('MasterJenisRawMaterial.destroy');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimRawMaterialController::class)->group(function () {
            Route::get('/master_tujuan_kirim_raw_material', 'index')->name('MasterTujuanKirimRawMaterial.index');
            Route::get('/master_tujuan_kirim_raw_material/create', 'create')->name('MasterTujuanKirimRawMaterial.create');
            Route::post('/master_tujuan_kirim_raw_material/store', 'store')->name('MasterTujuanKirimRawMaterial.store');
            Route::get('/master_tujuan_kirim_raw_material/show/{id}', 'show')->name('MasterTujuanKirimRawMaterial.show');
            Route::get('/master_tujuan_kirim_raw_material/edit/{id}', 'edit')->name('MasterTujuanKirimRawMaterial.edit');
            Route::put('/master_tujuan_kirim_raw_material/update/{id}', 'update')->name('MasterTujuanKirimRawMaterial.update');
            Route::delete('/master_tujuan_kirim_raw_material/destroy/{id}', 'destroy')->name('MasterTujuanKirimRawMaterial.destroy');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimGradingKasarController::class)->group(function () {
            Route::get('/master_tujuan_kirim_grading_kasar', 'index')->name('MasterTujuanKirimGradingKasar.index');
            Route::get('/master_tujuan_kirim_grading_kasar/create', 'create')->name('MasterTujuanKirimGradingKasar.create');
            Route::post('/master_tujuan_kirim_grading_kasar/store', 'store')->name('MasterTujuanKirimGradingKasar.store');
            Route::get('/master_tujuan_kirim_grading_kasar/show/{id}', 'show')->name('MasterTujuanKirimGradingKasar.show');
            Route::get('/master_tujuan_kirim_grading_kasar/edit/{id}', 'edit')->name('MasterTujuanKirimGradingKasar.edit');
            Route::put('/master_tujuan_kirim_grading_kasar/update/{id}', 'update')->name('MasterTujuanKirimGradingKasar.update');
            Route::delete('/master_tujuan_kirim_grading_kasar/destroy/{id}', 'destroy')->name('MasterTujuanKirimGradingKasar.destroy');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimGradingHalusController::class)->group(function () {
            Route::get('/master_tujuan_kirim_grading_halus', 'index')->name('MasterTujuanKirimGradingHalus.index');
            Route::get('/master_tujuan_kirim_grading_halus/create', 'create')->name('MasterTujuanKirimGradingHalus.create');
            Route::post('/master_tujuan_kirim_grading_halus/store', 'store')->name('MasterTujuanKirimGradingHalus.store');
            Route::get('/master_tujuan_kirim_grading_halus/show/{id}', 'show')->name('MasterTujuanKirimGradingHalus.show');
            Route::get('/master_tujuan_kirim_grading_halus/edit/{id}', 'edit')->name('MasterTujuanKirimGradingHalus.edit');
            Route::put('/master_tujuan_kirim_grading_halus/update/{id}', 'update')->name('MasterTujuanKirimGradingHalus.update');
            Route::delete('/master_tujuan_kirim_grading_halus/destroy/{id}', 'destroy')->name('MasterTujuanKirimGradingHalus.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisGradingKasarController::class)->group(function () {
            Route::get('/master_jenis_grading_kasar', 'index')->name('MasterJenisGradingKasar.index');
            Route::get('/master_jenis_grading_kasar/create', 'create')->name('MasterJenisGradingKasar.create');
            Route::post('/master_jenis_grading_kasar/store', 'store')->name('MasterJenisGradingKasar.store');
            Route::get('/master_jenis_grading_kasar/show/{id}', 'show')->name('MasterJenisGradingKasar.show');
            Route::get('/master_jenis_grading_kasar/edit/{id}', 'edit')->name('MasterJenisGradingKasar.edit');
            Route::put('/master_jenis_grading_kasar/update/{id}', 'update')->name('MasterJenisGradingKasar.update');
            Route::delete('/master_jenis_grading_kasar/destroy/{id}', 'destroy')->name('MasterJenisGradingKasar.destroy');
        });

        Route::controller(App\Http\Controllers\MasterOperatorController::class)->group(function () {
            Route::get('/master_operator', 'index')->name('MasterOperator.index');
            Route::get('/master_operator/create', 'create')->name('MasterOperator.create');
            Route::post('/master_operator/store', 'store')->name('MasterOperator.store');
            Route::get('/master_operator/show/{id}', 'show')->name('MasterOperator.show');
            Route::get('/master_operator/edit/{id}', 'edit')->name('MasterOperator.edit');
            Route::put('/master_operator/update/{id}', 'update')->name('MasterOperator.update');
            Route::delete('/master_operator/destroy/{id}', 'destroy')->name('MasterOperator.destroy');
        });

        Route::controller(App\Http\Controllers\MasterOngkosCuciController::class)->group(function () {
            Route::get('/master_ongkos_cuci', 'index')->name('MasterOngkosCuci.index');
            Route::get('/master_ongkos_cuci/create', 'create')->name('MasterOngkosCuci.create');
            Route::post('/master_ongkos_cuci/store', 'store')->name('MasterOngkosCuci.store');
            Route::get('/master_ongkos_cuci/show/{id}', 'show')->name('MasterOngkosCuci.show');
            Route::get('/master_ongkos_cuci/edit/{id}', 'edit')->name('MasterOngkosCuci.edit');
            Route::put('/master_ongkos_cuci/update/{id}', 'update')->name('MasterOngkosCuci.update');
            Route::delete('/master_ongkos_cuci/destroy/{id}', 'destroy')->name('MasterOngkosCuci.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisGradingHalusController::class)->group(function () {
            Route::get('/master_jenis_grading_halus', 'index')->name('MasterJenisGradingHalus.index');
            Route::get('/master_jenis_grading_halus/create', 'create')->name('MasterJenisGradingHalus.create');
            Route::post('/master_jenis_grading_halus/store', 'store')->name('MasterJenisGradingHalus.store');
            Route::get('/master_jenis_grading_halus/show/{id}', 'show')->name('MasterJenisGradingHalus.show');
            Route::get('/master_jenis_grading_halus/edit/{id}', 'edit')->name('MasterJenisGradingHalus.edit');
            Route::put('/master_jenis_grading_halus/update/{id}', 'update')->name('MasterJenisGradingHalus.update');
            Route::delete('/master_jenis_grading_halus/destroy/{id}', 'destroy')->name('MasterJenisGradingHalus.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisHcrKotorController::class)->group(function () {
            Route::get('/master_jenis_hancuran_kotor', 'index')->name('MasterJenisHcrKotor.index');
            Route::post('/master_jenis_hancuran_kotor/store', 'store')->name('MasterJenisHcrKotor.store');
            Route::get('/master_jenis_hancuran_kotor/edit/{id}', 'edit')->name('MasterJenisHcrKotor.edit');
            Route::put('/master_jenis_hancuran_kotor/update/{id}', 'update')->name('MasterJenisHcrKotor.update');
            Route::delete('/master_jenis_hancuran_kotor/destroy/{id}', 'destroy')->name('MasterJenisHcrKotor.destroy');
        });
        Route::controller(App\Http\Controllers\MasterJenisRambangController::class)->group(function () {
            Route::get('/master_jenis_rambang', 'index')->name('MasterJenisRambang.index');
            Route::post('/master_jenis_rambang/store', 'store')->name('MasterJenisRambang.store');
            Route::get('/master_jenis_rambang/edit/{id}', 'edit')->name('MasterJenisRambang.edit');
            Route::put('/master_jenis_rambang/update/{id}', 'update')->name('MasterJenisRambang.update');
            Route::delete('/master_jenis_rambang/destroy/{id}', 'destroy')->name('MasterJenisRambang.destroy');
        });
        Route::controller(App\Http\Controllers\MasterTujuanKirimWasteController::class)->group(function () {
            Route::get('/master_tujuan_kirim_waste', 'index')->name('MasterTujuanKirimWaste.index');
            Route::post('/master_tujuan_kirim_waste/store', 'store')->name('MasterTujuanKirimWaste.store');
            Route::get('/master_tujuan_kirim_waste/edit/{id}', 'edit')->name('MasterTujuanKirimWaste.edit');
            Route::put('/master_tujuan_kirim_waste/update/{id}', 'update')->name('MasterTujuanKirimWaste.update');
            Route::delete('/master_tujuan_kirim_waste/destroy/{id}', 'destroy')->name('MasterTujuanKirimWaste.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisDryAController::class)->group(function () {
            Route::get('/master_jenis_dry_a', 'index')->name('MasterJenisDryA.index');
            Route::post('/master_jenis_dry_a/store', 'store')->name('MasterJenisDryA.store');
            Route::get('/master_jenis_dry_a/edit/{id}', 'edit')->name('MasterJenisDryA.edit');
            Route::put('/master_jenis_dry_a/update/{id}', 'update')->name('MasterJenisDryA.update');
            Route::delete('/master_jenis_dry_a/destroy/{id}', 'destroy')->name('MasterJenisDryA.destroy');
            Route::get('/master_jenis_dry_a_a/getDataByJenis', 'getDataByJenis')->name('MasterJenisDryA.getDataByJenis');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimDryAController::class)->group(function () {
            Route::get('/master_tujuan_kirim_dry_a', 'index')->name('MasterTujuanKirimDryA.index');
            Route::post('/master_tujuan_kirim_dry_a/store', 'store')->name('MasterTujuanKirimDryA.store');
            Route::get('/master_tujuan_kirim_dry_a/edit/{id}', 'edit')->name('MasterTujuanKirimDryA.edit');
            Route::put('/master_tujuan_kirim_dry_a/update/{id}', 'update')->name('MasterTujuanKirimDryA.update');
            Route::delete('/master_tujuan_kirim_dry_a/destroy/{id}', 'destroy')->name('MasterTujuanKirimDryA.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisWasteController::class)->group(function () {
            Route::get('/master_jenis_waste', 'index')->name('MasterJenisWaste.index');
            Route::post('/master_jenis_waste/store', 'store')->name('MasterJenisWaste.store');
            Route::get('/master_jenis_waste/edit/{id}', 'edit')->name('MasterJenisWaste.edit');
            Route::put('/master_jenis_waste/update/{id}', 'update')->name('MasterJenisWaste.update');
            Route::delete('/master_jenis_waste/destroy/{id}', 'destroy')->name('MasterJenisWaste.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisGradingWarnaController::class)->group(function () {
            Route::get('/master_jenis_grading_warna', 'index')->name('MasterJenisGradingWarna.index');
            Route::post('/master_jenis_grading_warna/store', 'store')->name('MasterJenisGradingWarna.store');
            Route::get('/master_jenis_grading_warna/edit/{id}', 'edit')->name('MasterJenisGradingWarna.edit');
            Route::put('/master_jenis_grading_warna/update/{id}', 'update')->name('MasterJenisGradingWarna.update');
            Route::delete('/master_jenis_grading_warna/destroy/{id}', 'destroy')->name('MasterJenisGradingWarna.destroy');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimMouldingController::class)->group(function () {
            Route::get('/master_tujuan_kirim_moulding', 'index')->name('MasterTujuanKirimMoulding.index');
            Route::post('/master_tujuan_kirim_moulding/store', 'store')->name('MasterTujuanKirimMoulding.store');
            Route::get('/master_tujuan_kirim_moulding/edit/{id}', 'edit')->name('MasterTujuanKirimMoulding.edit');
            Route::put('/master_tujuan_kirim_moulding/update/{id}', 'update')->name('MasterTujuanKirimMoulding.update');
            Route::delete('/master_tujuan_kirim_moulding/destroy/{id}', 'destroy')->name('MasterTujuanKirimMoulding.destroy');
        });

        Route::controller(App\Http\Controllers\MasterBatchController::class)->group(function () {
            Route::get('/master_batch', 'index')->name('MasterBatch.index');
            Route::post('/master_batch/store', 'store')->name('MasterBatch.store');
            Route::get('/master_batch/edit/{id}', 'edit')->name('MasterBatch.edit');
            Route::put('/master_batch/update/{id}', 'update')->name('MasterBatch.update');
            Route::delete('/master_batch/destroy/{id}', 'destroy')->name('MasterBatch.destroy');
        });

        Route::controller(App\Http\Controllers\MasterJenisKedatanganController::class)->group(function () {
            Route::get('/master_jenis_kedatangan', 'index')->name('MasterJenisKedatangan.index');
            Route::post('/master_jenis_kedatangan/store', 'store')->name('MasterJenisKedatangan.store');
            Route::get('/master_jenis_kedatangan/edit/{id}', 'edit')->name('MasterJenisKedatangan.edit');
            Route::put('/master_jenis_kedatangan/update/{id}', 'update')->name('MasterJenisKedatangan.update');
            Route::delete('/master_jenis_kedatangan/destroy/{id}', 'destroy')->name('MasterJenisKedatangan.destroy');
        });

        Route::controller(App\Http\Controllers\MasterTujuanKirimKedatanganController::class)->group(function () {
            Route::get('/master_tujuan_kirim_kedatangan', 'index')->name('MasterTujuanKirimKedatangan.index');
            Route::post('/master_tujuan_kirim_kedatangan/store', 'store')->name('MasterTujuanKirimKedatangan.store');
            Route::get('/master_tujuan_kirim_kedatangan/edit/{id}', 'edit')->name('MasterTujuanKirimKedatangan.edit');
            Route::put('/master_tujuan_kirim_kedatangan/update/{id}', 'update')->name('MasterTujuanKirimKedatangan.update');
            Route::delete('/master_tujuan_kirim_kedatangan/destroy/{id}', 'destroy')->name('MasterTujuanKirimKedatangan.destroy');
        });
    });
    Route::prefix('purchasing')->middleware(['role:purchasing|admin'])->group(function () {
        Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialInputController::class)->group(function () {
            Route::get('/prm_raw_material_input', 'index')->name('PrmRawMaterialInput.index');
            Route::get('/prm_raw_material_input/create', 'create')->name('PrmRawMaterialInput.create');
            Route::get('/prm_raw_material_input/detail', 'detail')->name('PrmRawMaterialInput.detail');
            Route::post('/prm_raw_material_input/store', 'store')->name('PrmRawMaterialInput.store');
            Route::get('/prm_raw_material_input/show/{id}', 'show')->name('PrmRawMaterialInput.show');
            Route::get('/prm_raw_material_input/edit/{id}', 'edit')->name('PrmRawMaterialInput.edit');
            Route::post('/prm_raw_material_input/update/{id}', 'update')->name('PrmRawMaterialInput.update');
            Route::delete('/prm_raw_material_input/destroy/{id}', 'destroy')->name('PrmRawMaterialInput.destroy');
            Route::delete('/prm_raw_material_input/destroyInput/{id}', 'destroyInput')->name('PrmRawMaterialInput.destroyInput');
            Route::delete('/prm_raw_material_input/destroyItem/{id}', 'destroyItem')->name('PrmRawMaterialInput.destroyItem');
            Route::get('/prm_raw_material_input/getDataSupplier', 'getDataSupplier')->name('PrmRawMaterialInput.getDataSupplier');
            Route::get('/prm_raw_material_input/getDataJenis', 'getDataJenis')->name('PrmRawMaterialInput.getDataJenis');
            Route::post('/prm_raw_material_input/simpanData', 'simpanData')->name('PrmRawMaterialInput.simpanData');
            Route::post('/prm_raw_material_input/simpanDataItem', 'simpanDataItem')->name('PrmRawMaterialInput.simpanDataItem');
            Route::post('/prm_raw_material_input/importExcel', 'importExcel')->name('PrmRawMaterialInput.importExcel');
            Route::get('/prm_raw_material_input/nextDocNo', 'getNextDocumentNumber')->name('PrmRawMaterialInput.getNextDocumentNumber');
        });


        Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialStockController::class)->group(function () {
            Route::get('/prm_raw_material_stock', 'index')->name('PrmRawMaterialStock.index');
            Route::get('/prm_raw_material_stock/show/{id_box}', 'show')->name('PrmRawMaterialStock.show');
        });

        Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialOutputController::class)->group(function () {
            Route::get('/prm_raw_material_output', 'index')->name('PrmRawMaterialOutput.index');
            Route::get('/prm_raw_material_output/create', 'create')->name('PrmRawMaterialOutput.create');
            Route::post('/prm_raw_material_output/store', 'store')->name('PrmRawMaterialOutput.store');
            Route::post('/prm_raw_material_output/sendData', 'sendData')->name('PrmRawMaterialOutput.sendData');
            Route::get('/prm_raw_material_output/show/{id}', 'show')->name('PrmRawMaterialOutput.show');
            Route::get('/prm_raw_material_output/edit/{id}', 'edit')->name('PrmRawMaterialOutput.edit');
            Route::put('/prm_raw_material_output/update/{id}', 'update')->name('PrmRawMaterialOutput.update');
            Route::delete('/prm_raw_material_output/destroy/{id}', 'destroy')->name('PrmRawMaterialOutput.destroy');
            Route::delete('/prm_raw_material_output/destroyHead/{id}', 'destroyHead')->name('PrmRawMaterialOutput.destroyHead');
            Route::get('/prm_raw_material_output/get_data_id_box', 'set')->name('PrmRawMaterialOutput.set');
            Route::get('/prm_raw_material_output/get_pcc', 'setpcc')->name('PrmRawMaterialOutput.setpcc');
            Route::post('/prm_raw_material_output/cek_data', 'CeksendData')->name('PrmRawMaterialOutput.CeksendData');
            Route::get('/prm_raw_material_output/getBerat/{id}', 'getBerat')->name('PrmRawMaterialOutput.getBerat');
        });
        Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialAdjustmentController::class)->group(function () {
            Route::get('/prm_raw_material_adjustment', 'index')->name('PrmRawMaterialAdjustment.index');
            Route::get('/prm_raw_material_adjustment/create', 'create')->name('PrmRawMaterialAdjustment.create');
            Route::post('/prm_raw_material_adjustment/store', 'store')->name('PrmRawMaterialAdjustment.store');

            Route::delete('/prm_raw_material_adjustment/destroy/{id}', 'destroy')->name('PrmRawMaterialAdjustment.destroy');

            Route::get('/prm_raw_material_adjustment/get_data_id_box', 'getDataStock')->name('PrmRawMaterialAdjustment.getDataStock');

        });
    });
    Route::controller(App\Http\Controllers\PurchasingExim\StockTransitRawMaterialController::class)->middleware(['role:purchasing|grading_kasar|admin|production|ppic'])->group(function () {
        Route::get('/stock_transit_raw_material', 'index')->name('StockTransitRawMaterial.index');
    });
    Route::prefix('bahan_baku')->group(function () {
        Route::prefix('grading_kasar')->middleware(['role:grading_kasar|admin|production|ppic|ppic'])->group(function () {
            Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarInputController::class)->group(function () {
                Route::get('/grading_kasar_input', 'index')->name('GradingKasarInput.index');
                Route::get('/grading_kasar_input/create', 'create')->name('GradingKasarInput.create');
                Route::get('/grading_kasar_input/get_data', 'set')->name('GradingKasarInput.set');
                Route::post('/grading_kasar_input/store', 'store')->name('GradingKasarInput.store');
                Route::post('/grading_kasar_input/sendData', 'sendData')->name('GradingKasarInput.sendData');
                Route::delete('/grading_kasar_input/destroy/{nomor_bstb}', 'destroy')->name('GradingKasarInput.destroy');
                Route::post('/grading_kasar_input/cek_data', 'CeksendData')->name('GradingKasarInput.CeksendData');
            });

            Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarHasilController::class)->group(function () {
                Route::get('/grading_kasar_hasil', 'index')->name('GradingKasarHasil.index');
                Route::get('/grading_kasar_hasil/create', 'create')->name('GradingKasarHasil.create');
                Route::get('/grading_kasar_hasil/create_item', 'createItem')->name('GradingKasarHasil.createItem');
                Route::post('/grading_kasar_hasil/store', 'store')->name('GradingKasarHasil.store');
                Route::get('/grading_kasar_hasil/show/{id}', 'show')->name('GradingKasarHasil.show');
                Route::get('/grading_kasar_hasil/edit/{id}', 'edit')->name('GradingKasarHasil.edit');
                Route::post('/grading_kasar_hasil/update/{id}', 'update')->name('GradingKasarHasil.update');
                Route::delete('/grading_kasar_hasil/destroyInput/{id}', 'destroyInput')->name('GradingKasarHasil.destroyInput');
                Route::delete('/grading_kasar_hasil/destroyItem/{id}', 'destroyItem')->name('GradingKasarHasil.destroyItem');
                Route::get('/grading_kasar_hasil/getDataSupplier', 'getDataSupplier')->name('GradingKasarHasil.getDataSupplier');
                Route::get('/grading_kasar_hasil/getDataJenis', 'getDataJenis')->name('GradingKasarHasil.getDataJenis');
                Route::post('/grading_kasar_hasil/simpanData', 'simpanData')->name('GradingKasarHasil.simpanData');
                Route::get('/grading_kasar_hasil/get_data_nama_jenis', 'set')->name('GradingKasarHasil.set');
            });

            Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarStockController::class)->group(function () {
                Route::get('/grading_kasar_stock', 'index')->name('GradingKasarStock.index');
                Route::get('/grading_kasar_stock/create', 'create')->name('GradingKasarStock.create');
                Route::post('/grading_kasar_stock/store', 'store')->name('GradingKasarStock.store');
                Route::get('/grading_kasar_stock/show/{id}', 'show')->name('GradingKasarStock.show');
                Route::get('/grading_kasar_stock/edit/{id}', 'edit')->name('GradingKasarStock.edit');
                Route::post('/grading_kasar_stock/update/{id}', 'update')->name('GradingKasarStock.update');
                Route::get('/grading_kasar_stock/getDataJenis', 'getDataJenis')->name('GradingKasarStock.getDataJenis');
                Route::post('/grading_kasar_stock/simpanData', 'simpanData')->name('GradingKasarStock.simpanData');
            });

            Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarOutputController::class)->group(function () {
                Route::get('/grading_kasar_output', 'index')->name('GradingKasarOutput.index');
                Route::get('/grading_kasar_output/create', 'create')->name('GradingKasarOutput.create');
                Route::post('/grading_kasar_output/store', 'store')->name('GradingKasarOutput.store');
                Route::post('/grading_kasar_output/sendData', 'sendData')->name('GradingKasarOutput.sendData');
                Route::delete('/grading_kasar_output/destroy/{nomor_bstb}', 'destroy')->name('GradingKasarOutput.destroy');
                Route::get('/grading_kasar_output/get_data_id_box', 'set')->name('GradingKasarOutput.set');
                Route::post('/grading_kasar_output/post_data_nomor_job', 'validasi')->name('GradingKasarOutput.validasi');
                Route::get('/grading_kasar_output/get_pcc', 'setpcc')->name('GradingKasarOutput.setpcc');
                Route::post('/grading_kasar_output/cek_data', 'CeksendData')->name('GradingKasarOutput.CeksendData');
            });
            Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarAdjustmentController::class)->group(function () {
                Route::get('/GradingKasarAdjustment', 'index')->name('GradingKasarAdjustment.index');
                Route::get('/GradingKasarAdjustment/create', 'create')->name('GradingKasarAdjustment.create');
                Route::post('/GradingKasarAdjustment/store', 'store')->name('GradingKasarAdjustment.store');

                Route::delete('/GradingKasarAdjustment/destroy/{id}', 'destroy')->name('GradingKasarAdjustment.destroy');

                Route::get('/GradingKasarAdjustment/get_data_id_box', 'getDataStock')->name('GradingKasarAdjustment.getDataStock');

            });
            // Route::controller(App\Http\Controllers\TransitGradingKasar\StockTransitGradingKasarController::class)->group(function () {
            //     Route::get('/stock_transit_grading_kasar', 'index')->name('StockTransitGradingKasar.index');
            // });
            Route::controller(App\Http\Controllers\TransitGradingKasar\ReportController::class)->group(function () {
                Route::get('/report', 'index')->name('ReportGradingKasar.index');
                Route::get('/report_input', 'input')->name('ReportGradingKasar.input');
                Route::post('/report_filter', 'filter')->name('ReportGradingKasar.filter');
                Route::get('/report_hasil', 'hasil')->name('ReportGradingKasar.hasil');
                Route::post('/report_filter_h', 'filterH')->name('ReportGradingKasar.filterH');
                Route::get('/report_stock', 'stock')->name('ReportGradingKasar.stock');
                Route::post('/report_filter_s', 'filterS')->name('ReportGradingKasar.filterS');
                Route::get('/report_output', 'output')->name('ReportGradingKasar.output');
                Route::post('/report_filter_o', 'filterO')->name('ReportGradingKasar.filterO');
                Route::get('/report_transit', 'transit')->name('ReportGradingKasar.transit');
                Route::post('/report_filter_t', 'filterT')->name('ReportGradingKasar.filterT');
            });
        });
        Route::controller(App\Http\Controllers\TransitGradingKasar\StockTransitGradingKasarController::class)->group(function () {
            Route::get('/stock_transit_grading_kasar', 'index')->name('StockTransitGradingKasar.index');
            Route::get('/stock_transit_grading_kasar/create', 'create')->name('StockTransitGradingKasar.create');
            Route::post('/stock_transit_grading_kasar/store', 'store')->name('StockTransitGradingKasar.store');
            Route::get('/stock_transit_grading_kasar/show/{id}', 'show')->name('StockTransitGradingKasar.show');
            Route::get('/stock_transit_grading_kasar/edit/{id}', 'edit')->name('StockTransitGradingKasar.edit');
            Route::put('/stock_transit_grading_kasar/update/{id}', 'update')->name('StockTransitGradingKasar.update');
            Route::delete('/stock_transit_grading_kasar/destroy/{id}', 'destroy')->name('StockTransitGradingKasar.destroy');
        })->middleware(['role:grading_kasar|pre_cleaning|admin|production|ppic|ppic']);
        Route::prefix('pre_cleaning')->middleware(['role:pre_cleaning|admin|production|ppic|ppic'])->group(function () {
            Route::controller(App\Http\Controllers\PreCleaning\PreCleaningInputController::class)->group(function () {
                Route::get('/pre_cleaning_input', 'index')->name('PreCleaningInput.index');
                Route::get('/pre_cleaning_input/create', 'create')->name('PreCleaningInput.create');
                Route::post('/pre_cleaning_input/store', 'store')->name('PreCleaningInput.store');
                Route::post('/pre_cleaning_input/sendData', 'sendData')->name('PreCleaningInput.sendData');
                Route::delete('/pre_cleaning_input/destroy/{nomor_bstb}', 'destroy')->name('PreCleaningInput.destroy');
                Route::get('/pre_cleaning_input/get_data_id_box', 'set')->name('PreCleaningInput.set');
                Route::get('/pre_cleaning_input/get_pcc', 'setpcc')->name('PreCleaningInput.setpcc');
                Route::post('/pre_cleaning_input/cek_data', 'CeksendData')->name('PreCleaningInput.CeksendData');
            });

            Route::controller(App\Http\Controllers\PreCleaning\PreCleaningStockController::class)->group(function () {
                Route::get('/pre_cleaning_stock', 'index')->name('PreCleaningStock.index');
            });

            Route::controller(App\Http\Controllers\PreCleaning\ReportController::class)->group(function () {
                Route::get('/pre_cleaning_report', 'index')->name('PreCleaningReport.index');
                Route::get('/pre_cleaning_report/input', 'input')->name('PreCleaningReport.input');
                Route::get('/pre_cleaning_report/stock', 'stock')->name('PreCleaningReport.stock');
                Route::get('/pre_cleaning_report/output', 'output')->name('PreCleaningReport.output');
                Route::get('/pre_cleaning_report/transit', 'transit')->name('PreCleaningReport.transit');
                Route::post('/pre_cleaning_report/inputFilter', 'inputFilter')->name('PreCleaningReport.inputFilter');
                Route::post('/pre_cleaning_report/outputFilter', 'outputFilter')->name('PreCleaningReport.outputFilter');
                Route::post('/pre_cleaning_report/stockFilter', 'stockFilter')->name('PreCleaningReport.stockFilter');
                Route::post('/pre_cleaning_report/transitFilter', 'transitFilter')->name('PreCleaningReport.transitFilter');
            });

            Route::controller(App\Http\Controllers\PreCleaning\PreCleaningOutputController::class)->group(function () {
                Route::get('/pre_cleaning_output', 'index')->name('PreCleaningOutput.index');
                Route::get('/pre_cleaning_output/create', 'create')->name('PreCleaningOutput.create');
                Route::post('/pre_cleaning_output/store', 'store')->name('PreCleaningOutput.store');
                Route::get('/pre_cleaning_output/show/{id}', 'show')->name('PreCleaningOutput.show');
                Route::get('/pre_cleaning_output/edit/{id}', 'edit')->name('PreCleaningOutput.edit');
                Route::put('/pre_cleaning_output/update/{id}', 'update')->name('PreCleaningOutput.update');
                Route::delete('/pre_cleaning_output/destroy/{id}', 'destroy')->name('PreCleaningOutput.destroy');
                Route::get('/pre_cleaning_output/get_data_nomor_job', 'set')->name('preCleaningOutput.set');
                Route::post('/pre_cleaning_output/simpanData', 'simpanData')->name('PreCleaningOutput.simpanData');
            });

            Route::controller(App\Http\Controllers\PreCleaning\TransitPreCleaningStockController::class)->group(function () {
                Route::get('/transit_pre_cleaning_stock', 'index')->name('TransitPreCleaningStock.index');
                Route::get('/transit_pre_cleaning_stock/create', 'create')->name('TransitPreCleaningStock.create');
                Route::post('/transit_pre_cleaning_stock/store', 'store')->name('TransitPreCleaningStock.store');
                Route::get('/transit_pre_cleaning_stock/show/{id}', 'show')->name('TransitPreCleaningStock.show');
                Route::get('/transit_pre_cleaning_stock/edit/{id}', 'edit')->name('TransitPreCleaningStock.edit');
                Route::put('/transit_pre_cleaning_stock/update/{id}', 'update')->name('TransitPreCleaningStock.update');
                Route::delete('/transit_pre_cleaning_stock/destroy/{id}', 'destroy')->name('TransitPreCleaningStock.destroy');
            });
        });
        Route::prefix('grading_halus')->middleware(['role:grading_halus|admin|production|ppic'])->group(function () {
            Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusInputController::class)->group(function () {
                Route::get('/pre_grading_halus_input', 'index')->name('PreGradingHalusInput.index');
                Route::get('/pre_grading_halus_input/create', 'create')->name('PreGradingHalusInput.create');
                Route::get('/pre_grading_halus_input/get_data_id_box', 'set')->name('PreGradingHalusInput.set');
                Route::get('/pre_grading_halus_input/get_data_id_box/unit', 'setUnit')->name('PreGradingHalusInput.setUnit');
                Route::post('/pre_grading_halus_input/sendData', 'sendData')->name('PreGradingHalusInput.sendData');
                Route::post('/pre_grading_halus_input/store', 'store')->name('PreGradingHalusInput.store');
                Route::delete('/pre_grading_halus_input/destroy/{nomor_bstb}', 'destroy')->name('PreGradingHalusInput.destroy');
                Route::post('/pre_grading_halus_input/cek_data', 'CeksendData')->name('PreGradingHalusInput.CeksendData');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusStockController::class)->group(function () {
                Route::get('/pre_grading_halus_stock', 'index')->name('PreGradingHalusStock.index');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusAddingController::class)->group(function () {
                Route::get('/pre_grading_halus_adding', 'index')->name('PreGradingHalusAdding.index');
                Route::get('/pre_grading_halus_adding/create', 'create')->name('PreGradingHalusAdding.create');
                Route::post('/pre_grading_halus_adding/store', 'store')->name('PreGradingHalusAdding.store');
                Route::get('/pre_grading_halus_adding/show/{id}', 'show')->name('PreGradingHalusAdding.show');
                Route::get('/pre_grading_halus_adding/edit/{id}', 'edit')->name('PreGradingHalusAdding.edit');
                Route::put('/pre_grading_halus_adding/update/{id}', 'update')->name('PreGradingHalusAdding.update');
                Route::delete('/pre_grading_halus_adding/destroy/{id}', 'destroy')->name('PreGradingHalusAdding.destroy');
                Route::get('/pre_grading_halus_adding/get_data_nomor_job', 'set')->name('PreGradingHalusAdding.set');
                Route::post('/pre_grading_halus_adding/simpanData', 'simpanData')->name('PreGradingHalusAdding.simpanData');
                Route::post('/pre_grading_halus_adding/getDataPerusahaan', 'getDataPerusahaan')->name('PreGradingHalusAdding.getDataPerusahaan');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusAddingStockController::class)->group(function () {
                Route::get('/pre_grading_halus_adding_stock', 'index')->name('PreGradingHalusAddingStock.index');
                Route::get('/pre_grading_halus_adding_stock/create', 'create')->name('PreGradingHalusAddingStock.create');
                Route::post('/pre_grading_halus_adding_stock/store', 'store')->name('PreGradingHalusAddingStock.store');
                Route::get('/pre_grading_halus_adding_stock/show/{id}', 'show')->name('PreGradingHalusAddingStock.show');
                Route::get('/pre_grading_halus_adding_stock/edit/{id}', 'edit')->name('PreGradingHalusAddingStock.edit');
                Route::put('/pre_grading_halus_adding_stock/update/{id}', 'update')->name('PreGradingHalusAddingStock.update');
                Route::delete('/pre_grading_halus_adding_stock/destroy/{id}', 'destroy')->name('PreGradingHalusAddingStock.destroy');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusInputController::class)->group(function () {
                Route::get('/grading_halus_input', 'index')->name('GradingHalusInput.index');
                Route::get('/grading_halus_input/create', 'create')->name('GradingHalusInput.create');
                Route::get('/grading_halus_input/get_data_id_box', 'set')->name('GradingHalusInput.set');
                Route::get('/grading_halus_input/get_data_id_box/jenis_grading', 'setUnit')->name('GradingHalusInput.setUnit');
                Route::post('/grading_halus_input/sendData', 'sendData')->name('GradingHalusInput.sendData');
                Route::post('/grading_halus_input/store', 'store')->name('GradingHalusInput.store');
                Route::delete('/grading_halus_input/destroy/{nomor_grading}', 'destroy')->name('GradingHalusInput.destroy');
                Route::post('/grading_halus_input/cek_data', 'CeksendData')->name('GradingHalusInput.CeksendData');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusStockContoller::class)->group(function () {
                Route::get('/grading_halus_stock', 'index')->name('GradingHalusStock.index');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusAdjustmentAddingController::class)->group(function () {
                Route::get('/grading_halus_adjustment_adding', 'index')->name('GradingHalusAdjustmentAdding.index');
                Route::get('/grading_halus_adjustment_adding/create', 'create')->name('GradingHalusAdjustmentAdding.create');
                Route::post('/grading_halus_adjustment_adding/store', 'store')->name('GradingHalusAdjustmentAdding.store');
                Route::get('/grading_halus_adjustment_adding/show/{id}', 'show')->name('GradingHalusAdjustmentAdding.show');
                Route::get('/grading_halus_adjustment_adding/edit/{id}', 'edit')->name('GradingHalusAdjustmentAdding.edit');
                Route::put('/grading_halus_adjustment_adding/update/{id}', 'update')->name('GradingHalusAdjustmentAdding.update');
                Route::delete('/grading_halus_adjustment_adding/destroy/{id}', 'destroy')->name('GradingHalusAdjustmentAdding.destroy');
                Route::get('/grading_halus_adjustment_adding/get_data_nomor_job', 'set')->name('GradingHalusAdjustmentAdding.set');
                Route::post('/grading_halus_adjustment_adding/simpanData', 'simpanData')->name('GradingHalusAdjustmentAdding.simpanData');
                Route::post('/grading_halus_adjustment_adding/getDataPerusahaan', 'getDataPerusahaan')->name('GradingHalusAdjustmentAdding.getDataPerusahaan');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusAdjustmentStockController::class)->group(function () {
                Route::get('/grading_halus_adjustment_stock', 'index')->name('GradingHalusAdjustmentStock.index');
                Route::get('/grading_halus_adjustment_stock/create', 'create')->name('GradingHalusAdjustmentStock.create');
                Route::post('/grading_halus_adjustment_stock/store', 'store')->name('GradingHalusAdjustmentStock.store');
                Route::get('/grading_halus_adjustment_stock/show/{id}', 'show')->name('GradingHalusAdjustmentStock.show');
                Route::get('/grading_halus_adjustment_stock/edit/{id}', 'edit')->name('GradingHalusAdjustmentStock.edit');
                Route::put('/grading_halus_adjustment_stock/update/{id}', 'update')->name('GradingHalusAdjustmentStock.update');
                Route::delete('/grading_halus_adjustment_stock/destroy/{id}', 'destroy')->name('GradingHalusAdjustmentStock.destroy');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusAdjustmentInputController::class)->group(function () {
                Route::get('/grading_halus_adjustment_input', 'index')->name('GradingHalusAdjustmentInput.index');
                Route::get('/grading_halus_adjustment_input/create', 'create')->name('GradingHalusAdjustmentInput.create');
                Route::post('/grading_halus_adjustment_input/store', 'store')->name('GradingHalusAdjustmentInput.store');
                Route::get('/grading_halus_adjustment_input/show/{id}', 'show')->name('GradingHalusAdjustmentInput.show');
                Route::get('/grading_halus_adjustment_input/edit/{id}', 'edit')->name('GradingHalusAdjustmentInput.edit');
                Route::put('/grading_halus_adjustment_input/update/{id}', 'update')->name('GradingHalusAdjustmentInput.update');
                Route::delete('/grading_halus_adjustment_input/destroy/{id}', 'destroy')->name('GradingHalusAdjustmentInput.destroy');
                Route::get('/grading_halus_adjustment_input/get_data_nomor_adjustment', 'getNomorAdjustment')->name('GradingHalusAdjustmentAdding.getNomorAdjustment');
                Route::get('/grading_halus_adjustment_input/get_data_jenis_adjustment', 'getJenisGradingHalus')->name('GradingHalusAdjustmentAdding.getJenisGradingHalus');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\GradingHalusOutputController::class)->group(function () {
                Route::get('/grading_halus_output', 'index')->name('GradingHalusOutput.index');
                Route::get('/grading_halus_output/create', 'create')->name('GradingHalusOutput.create');
                Route::get('/grading_halus_output/get_data_id_box', 'set')->name('GradingHalusOutput.set');
                Route::get('/grading_halus_output/get_data_id_box/jenis_grading', 'setUnit')->name('GradingHalusOutput.setUnit');
                Route::get('/grading_halus_output/get_data_id_box/jenis', 'setUpah')->name('GradingHalusOutput.setUpah');
                Route::post('/grading_halus_output/sendData', 'sendData')->name('GradingHalusOutput.sendData');
                Route::get('/grading_halus_output/get_pcc', 'setpcc')->name('GradingHalusOutput.setpcc');
                Route::post('/grading_halus_output/store', 'store')->name('GradingHalusOutput.store');
                Route::delete('/grading_halus_output/destroy/{id_box_grading_halus}', 'destroy')->name('GradingHalusOutput.destroy');
            });

            Route::controller(App\Http\Controllers\PreGradingHalus\TransitGradingHalusController::class)->group(function () {
                Route::get('/transit_grading_halus', 'index')->name('TransitGradingHalus.index');
            });

        });
        Route::prefix('pre_wash')->middleware(['role:pre_wash|admin|production|ppic'])->group(function (){
            Route::controller(App\Http\Controllers\PreWash\PreWashInputController::class)->group(function () {
                Route::get('/pre_wash_input', 'index')->name('PreWashInput.index');
                Route::get('/pre_wash_input/create', 'create')->name('PreWashInput.create');
                Route::post('/pre_wash_input/store', 'store')->name('PreWashInput.store');
                Route::post('/pre_wash_input/cek_data', 'CeksendData')->name('PreWashInput.CeksendData');
                Route::get('/pre_wash_input/set', 'set')->name('PreWashInput.set');
                Route::delete('/pre_wash_input/destroy/{nomor_bstb}', 'destroy')->name('PreWashInput.destroy');
            });

            Route::controller(App\Http\Controllers\PreWash\PreWashStockController::class)->group(function () {
                Route::get('/pre_wash_stock', 'index')->name('PreWashStock.index');
            });
            Route::controller(App\Http\Controllers\PreWash\PreWashOutputController::class)->group(function () {
                Route::get('/pre_wash_output', 'index')->name('PreWashOutput.index');
                Route::get('/pre_wash_output/create', 'create')->name('PreWashOutput.create');
                Route::post('/pre_wash_output/store', 'store')->name('PreWashOutput.store');
                Route::get('/pre_wash_output/show/{id}', 'show')->name('PreWashOutput.show');
                Route::get('/pre_wash_output/edit/{id}', 'edit')->name('PreWashOutput.edit');
                Route::put('/pre_wash_output/update/{id}', 'update')->name('PreWashOutput.update');
                Route::delete('/pre_wash_output/destroy/{nomor_job}', 'destroy')->name('PreWashOutput.destroy');
                Route::get('/pre_wash_output/get_data_nomor_job', 'set')->name('preWashOutput.set');
                Route::post('/pre_wash_output/simpanData', 'simpanData')->name('PreWashOutput.simpanData');
                Route::post('/pre_wash_output/cek_data', 'CeksendData')->name('PreWashOutput.CeksendData');
            });

            // Route::controller(App\Http\Controllers\CabutBulu\CabutBuluPenyebaranContoller::class)->group(function () {
            //     Route::get('/cabut_bulu_penyebaran', 'index')->name('CabutBuluPenyebaran.index');
            //     Route::get('/cabut_bulu_penyebaran/create', 'create')->name('CabutBuluPenyebaran.create');
            //     Route::post('/cabut_bulu_penyebaran/store', 'store')->name('CabutBuluPenyebaran.store');
            //     Route::post('/cabut_bulu_penyebaran/cek_data', 'CeksendData')->name('CabutBuluPenyebaran.CeksendData');
            //     Route::post('/cabut_bulu_penyebaran/simpanData', 'simpanData')->name('CabutBuluPenyebaran.simpanData');
            //     Route::get('/cabut_bulu_penyebaran/set', 'set')->name('CabutBuluPenyebaran.set');
            //     Route::get('/cabut_bulu_penyebaran/setnip', 'setNip')->name('CabutBuluPenyebaran.setNip');
            //     Route::delete('/cabut_bulu_penyebaran/destroy/{nomor_bstb}', 'destroy')->name('CabutBuluPenyebaran.destroy');
            // });
            Route::controller(App\Http\Controllers\PreWash\TransitPreWashController::class)->group(function () {
                Route::get('/transit_pre_wash', 'index')->name('TransitPreWash.index');
            });
            // Route::controller(App\Http\Controllers\CabutBulu\CabutBuluStockController::class)->group(function () {
            //     Route::get('/cabut_bulu_stock', 'index')->name('CabutBuluStock.index');
            // });
        });
    });
    Route::prefix('cleaning')->middleware(['role:cleaning|admin|production|ppic'])->group(function () {
        Route::prefix('cabut_bulu')->middleware(['role:cleaning|admin|production|ppic'])->group(function () {
            Route::controller(App\Http\Controllers\CabutBulu\CabutBuluPenerimaanController::class)->group(function () {
                Route::get('/cabut_bulu_penerimaan', 'index')->name('CabutBuluPenerimaan.index');
                Route::get('/cabut_bulu_penerimaan/create', 'create')->name('CabutBuluPenerimaan.create');
                Route::post('/cabut_bulu_penerimaan/store', 'store')->name('CabutBuluPenerimaan.store');
                Route::get('/cabut_bulu_penerimaan/show/{id}', 'show')->name('CabutBuluPenerimaan.show');
                Route::get('/cabut_bulu_penerimaan/edit/{id}', 'edit')->name('CabutBuluPenerimaan.edit');
                Route::put('/cabut_bulu_penerimaan/update/{id}', 'update')->name('CabutBuluPenerimaan.update');
                Route::delete('/cabut_bulu_penerimaan/destroy/{nomor_bstb}', 'destroy')->name('CabutBuluPenerimaan.destroy');
                Route::get('/cabut_bulu_penerimaan/get_data_nomor_job', 'set')->name('CabutBuluPenerimaan.set');
                Route::post('/cabut_bulu_penerimaan/simpanData', 'simpanData')->name('CabutBuluPenerimaan.simpanData');
                Route::post('/cabut_bulu_penerimaan/cek_data', 'CeksendData')->name('CabutBuluPenerimaan.CeksendData');
            });

            Route::controller(App\Http\Controllers\CabutBulu\CabutBuluStockController::class)->group(function () {
                Route::get('/cabut_bulu_stock', 'index')->name('CabutBuluStock.index');
            });
            Route::controller(App\Http\Controllers\CabutBulu\CabutBuluPenyebaranContoller::class)->group(function () {
                Route::get('/cabut_bulu_penyebaran', 'index')->name('CabutBuluPenyebaran.index');
                Route::get('/cabut_bulu_penyebaran/create', 'create')->name('CabutBuluPenyebaran.create');
                Route::post('/cabut_bulu_penyebaran/store', 'store')->name('CabutBuluPenyebaran.store');
                Route::post('/cabut_bulu_penyebaran/cek_data', 'CeksendData')->name('CabutBuluPenyebaran.CeksendData');
                Route::post('/cabut_bulu_penyebaran/simpanData', 'simpanData')->name('CabutBuluPenyebaran.simpanData');
                Route::get('/cabut_bulu_penyebaran/set', 'set')->name('CabutBuluPenyebaran.set');
                Route::get('/cabut_bulu_penyebaran/setnip', 'setNip')->name('CabutBuluPenyebaran.setNip');
                Route::delete('/cabut_bulu_penyebaran/destroy/{nomor_bstb}', 'destroy')->name('CabutBuluPenyebaran.destroy');
            });

            Route::controller(App\Http\Controllers\CabutBulu\CabutBuluPengembalianController::class)->group(function () {
                Route::get('/cabut_bulu_pengembalian', 'index')->name('CabutBuluPengembalian.index');
                Route::get('/cabut_bulu_pengembalian/create', 'create')->name('CabutBuluPengembalian.create');
                Route::post('/cabut_bulu_pengembalian/store', 'store')->name('CabutBuluPengembalian.store');
                Route::post('/cabut_bulu_pengembalian/cek_data', 'CeksendData')->name('CabutBuluPengembalian.CeksendData');
                Route::post('/cabut_bulu_pengembalian/simpanData', 'simpanData')->name('CabutBuluPengembalian.simpanData');
                Route::get('/cabut_bulu_pengembalian/set', 'set')->name('CabutBuluPengembalian.set');
                Route::get('/cabut_bulu_pengembalian/setnip', 'setNip')->name('CabutBuluPengembalian.setNip');
                Route::delete('/cabut_bulu_pengembalian/destroy/{nomor_bstb}', 'destroy')->name('CabutBuluPengembalian.destroy');
            });


        });

        Route::prefix('Rambang')->middleware('role:cleaning|admin|production|ppic')->group(function (){
            Route::controller(App\Http\Controllers\Rambang\HcrKotorInputController::class)->group(function () {
                Route::get('/input_hcr_kotor', 'index')->name('InputHcrKotor.index');
                Route::get('/input_hcr_kotor/create', 'create')->name('InputHcrKotor.create');
                Route::post('/input_hcr_kotor/store', 'store')->name('InputHcrKotor.store');
                Route::get('/input_hcr_kotor/show/{id}', 'show')->name('InputHcrKotor.show');
                Route::get('/input_hcr_kotor/edit/{id}', 'edit')->name('InputHcrKotor.edit');
                Route::put('/input_hcr_kotor/update/{id}', 'update')->name('InputHcrKotor.update');
                Route::delete('/input_hcr_kotor/destroy/{id}', 'destroy')->name('InputHcrKotor.destroy');
                Route::get('/input_hcr_kotor/get_data_nomor_job', 'set')->name('InputHcrKotor.set');
                Route::post('/input_hcr_kotor/simpanData', 'simpanData')->name('InputHcrKotor.simpanData');
                Route::post('/input_hcr_kotor/cek_data', 'CeksendData')->name('InputHcrKotor.CeksendData');
            });

            Route::controller(App\Http\Controllers\Rambang\HcrKotorStockController::class)->group(function () {
                Route::get('/stock_hcr_stock', 'index')->name('StockHcrKotor.index');
            });
            Route::controller(App\Http\Controllers\Rambang\RambangKeringInputController::class)->group(function () {
                Route::get('/rambang_kering_input', 'index')->name('RambangKeringInput.index');
                Route::get('/rambang_kering_input/create', 'create')->name('RambangKeringInput.create');
                Route::post('/rambang_kering_input/store', 'store')->name('RambangKeringInput.store');
                Route::post('/rambang_kering_input/cek_data', 'CeksendData')->name('RambangKeringInput.CeksendData');
                Route::get('/rambang_kering_input/set', 'set')->name('RambangKeringInput.set');
                Route::delete('/rambang_kering_input/destroy/{nomor_bstb}', 'destroy')->name('RambangKeringInput.destroy');
            });

            Route::controller(App\Http\Controllers\Rambang\RambangKeringStockController::class)->group(function () {
                Route::get('/rambang_kering_stock', 'index')->name('RambangKeringStock.index');
            });

            Route::controller(App\Http\Controllers\Rambang\RambangPengirimanWasteController::class)->group(function () {
                Route::get('/rambang_pengiriman_waste', 'index')->name('RambangPengirimanWaste.index');
                Route::get('/rambang_pengiriman_waste/create', 'create')->name('RambangPengirimanWaste.create');
                Route::post('/rambang_pengiriman_waste/store', 'store')->name('RambangPengirimanWaste.store');
                Route::post('/rambang_pengiriman_waste/cek_data', 'CeksendData')->name('RambangPengirimanWaste.CeksendData');
                Route::get('/rambang_pengiriman_waste/set', 'set')->name('RambangPengirimanWaste.set');
                Route::delete('/rambang_pengiriman_waste/destroy/{nomor_bstb}', 'destroy')->name('RambangPengirimanWaste.destroy');
            });



            Route::controller(App\Http\Controllers\Rambang\RambangBasahInputController::class)->group(function () {
                Route::get('/input_rambang_basah', 'index')->name('InputRambangBasah.index');
                Route::get('/input_rambang_basah/create', 'create')->name('InputRambangBasah.create');
                Route::post('/input_rambang_basah/store', 'store')->name('InputRambangBasah.store');
                Route::get('/input_rambang_basah/show/{id}', 'show')->name('InputRambangBasah.show');
                Route::get('/input_rambang_basah/edit/{id}', 'edit')->name('InputRambangBasah.edit');
                Route::put('/input_rambang_basah/update/{id}', 'update')->name('InputRambangBasah.update');
                Route::delete('/input_rambang_basah/destroy/{id}', 'destroy')->name('InputRambangBasah.destroy');
                Route::get('/input_rambang_basah/get_data_nomor_job', 'set')->name('InputRambangBasah.set');
                Route::post('/input_rambang_basah/simpanData', 'simpanData')->name('InputRambangBasah.simpanData');
                Route::post('/input_rambang_basah/cek_data', 'CeksendData')->name('InputRambangBasah.CeksendData');
            });

            Route::controller(App\Http\Controllers\Rambang\RambangBasahStockController::class)->group(function () {
                Route::get('/stock_rambang_basah', 'index')->name('StockRambangBasah.index');
            });
        });
        Route::prefix('cabut_hancuran')->middleware(['role:cleaning|admin|production|ppic'])->group(function () {
            Route::controller(App\Http\Controllers\CabutHancuran\CabutHancuranPersiapanController::class)->group(function () {
                Route::get('/cabut_hancuran_persiapan', 'index')->name('CabutHancuranPersiapan.index');
                Route::get('/cabut_hancuran_persiapan/create', 'create')->name('CabutHancuranPersiapan.create');
                Route::post('/cabut_hancuran_persiapan/store', 'store')->name('CabutHancuranPersiapan.store');
                Route::get('/cabut_hancuran_persiapan/show/{id}', 'show')->name('CabutHancuranPersiapan.show');
                Route::get('/cabut_hancuran_persiapan/edit/{id}', 'edit')->name('CabutHancuranPersiapan.edit');
                Route::put('/cabut_hancuran_persiapan/update/{id}', 'update')->name('CabutHancuranPersiapan.update');
                Route::delete('/cabut_hancuran_persiapan/destroy/{id_stock_hcr_kotor}', 'destroy')->name('CabutHancuranPersiapan.destroy');
                Route::get('/cabut_hancuran_persiapan/get_data_id_box_hcr_kotor', 'set')->name('CabutHancuranPersiapan.set');
                Route::post('/cabut_hancuran_persiapan/simpanData', 'simpanData')->name('CabutHancuranPersiapan.simpanData');
                Route::post('/cabut_hancuran_persiapan/sendData', 'sendData')->name('CabutHancuranPersiapan.sendData');
            });
            Route::controller(App\Http\Controllers\CabutHancuran\CabutHancuranPersiapanStockController::class)->group(function () {
                Route::get('/cabut_hancuran_stock', 'index')->name('CabutHancuranStock.index');
            });
            Route::controller(App\Http\Controllers\CabutHancuran\CabutHancuranPersiapanStockController::class)->group(function () {
                Route::get('/cabut_hancuran_persiapan_stock', 'index')->name('CabutHancuranPersiapanStock.index');
            });

            Route::controller(App\Http\Controllers\CabutHancuran\CabutHancuranPenyebaranController::class)->group(function () {
                Route::get('/cabut_hancuran_penyebaran', 'index')->name('CabutHancuranPenyebaran.index');
                Route::get('/cabut_hancuran_penyebaran/create', 'create')->name('CabutHancuranPenyebaran.create');
                Route::post('/cabut_hancuran_penyebaran/store', 'store')->name('CabutHancuranPenyebaran.store');
                Route::post('/cabut_hancuran_penyebaran/cek_data', 'CeksendData')->name('CabutHancuranPenyebaran.CeksendData');
                Route::post('/cabut_hancuran_penyebaran/simpanData', 'simpanData')->name('CabutHancuranPenyebaran.simpanData');
                Route::get('/cabut_hancuran_penyebaran/set', 'set')->name('CabutHancuranPenyebaran.set');
                Route::get('/cabut_hancuran_penyebaran/setnip', 'setNip')->name('CabutHancuranPenyebaran.setNip');
                Route::delete('/cabut_hancuran_penyebaran/destroy/{nomor_bstb}', 'destroy')->name('CabutHancuranPenyebaran.destroy');
            });

            Route::controller(App\Http\Controllers\CabutHancuran\CabutHancuranPengembalianController::class)->group(function () {
                Route::get('/cabut_hancuran_pengembalian', 'index')->name('CabutHancuranPengembalian.index');
                Route::get('/cabut_hancuran_pengembalian/create', 'create')->name('CabutHancuranPengembalian.create');
                Route::post('/cabut_hancuran_pengembalian/store', 'store')->name('CabutHancuranPengembalian.store');
                Route::post('/cabut_hancuran_pengembalian/cek_data', 'CeksendData')->name('CabutHancuranPengembalian.CeksendData');
                Route::post('/cabut_hancuran_pengembalian/simpanData', 'simpanData')->name('CabutHancuranPengembalian.simpanData');
                Route::get('/cabut_hancuran_pengembalian/set', 'set')->name('CabutHancuranPengembalian.set');
                Route::get('/cabut_hancuran_pengembalian/setnip', 'setNip')->name('CabutHancuranPengembalian.setNip');
                Route::delete('/cabut_hancuran_pengembalian/destroy/{nomor_bstb}', 'destroy')->name('CabutHancuranPengembalian.destroy');
            });

        });
    });
    Route::prefix('transit_cleaning')->middleware(['role:cleaning|admin|production|ppic|dry_a'])->group(function () {
        Route::controller(App\Http\Controllers\CabutHancuran\TransitCabutBuluHancuranController::class)->group(function () {
            Route::get('/transit_cabut_hancuran', 'index')->name('TransitCabutHancuran.index');
        });
        Route::controller(App\Http\Controllers\Rambang\TransitRambangWasteController::class)->group(function () {
            Route::get('/transit_rambang_waste', 'index')->name('TransitRambangWaste.index');
        });
        Route::controller(App\Http\Controllers\CabutBulu\TransitCabutBuluController::class)->group(function () {
            Route::get('/transit_cabut_bulu', 'index')->name('TransitCabutBulu.index');
        });
    });
    // Route::prefix('dry_a')->middleware(['role:dry_a|admin|production|ppic'])->group(function (){
    // });
    Route::prefix('dry_a')->middleware(['role:dry_a|admin|production|ppic'])->group(function (){
        Route::controller(App\Http\Controllers\DryA\DryAGradingCabutController::class)->group(function () {
            Route::get('/dry_a_grading_cabut', 'index')->name('DryAGradingCabut.index');
            Route::get('/dry_a_grading_cabut/create', 'create')->name('DryAGradingCabut.create');
            Route::get('/dry_a_grading_cabut/create_trial', 'create_trial')->name('DryAGradingCabut.create_trial');
            Route::post('/dry_a_grading_cabut/store', 'store')->name('DryAGradingCabut.store');
            Route::post('/dry_a_grading_cabut/cek_data', 'CeksendData')->name('DryAGradingCabut.CeksendData');
            Route::get('/dry_a_grading_cabut/set', 'set')->name('DryAGradingCabut.set');
            Route::get('/dry_a_grading_cabut/setjenis', 'setJenis')->name('DryAGradingCabut.setJenis');
            Route::delete('/dry_a_grading_cabut/destroy/{nomor_bstb}', 'destroy')->name('DryAGradingCabut.destroy');
            Route::get('/dry_a_grading_cabuts/getJenisGradings', 'getJenisGradings')->name('DryAGradingCabut.getJenisGrading');
        });
        Route::controller(App\Http\Controllers\DryA\DryAGradingCabutStockController::class)->group(function () {
            Route::get('/dry_a_grading_cabut_stock', 'index')->name('DryAGradingCabutStock.index');
        });
        Route::controller(App\Http\Controllers\DryA\DryAPenerimaanController::class)->group(function () {
            Route::get('/dry_a_penerimaan', 'index')->name('DryAPenerimaan.index');
            Route::get('/dry_a_penerimaan/create', 'create')->name('DryAPenerimaan.create');
            Route::post('/dry_a_penerimaan/store', 'store')->name('DryAPenerimaan.store');
            Route::get('/dry_a_penerimaan/show/{id}', 'show')->name('DryAPenerimaan.show');
            Route::get('/dry_a_penerimaan/edit/{id}', 'edit')->name('DryAPenerimaan.edit');
            Route::put('/dry_a_penerimaan/update/{id}', 'update')->name('DryAPenerimaan.update');
            Route::delete('/dry_a_penerimaan/destroy/{nomor_job}', 'destroy')->name('DryAPenerimaan.destroy');
            Route::get('/dry_a_penerimaan/get_data_nomor_job', 'set')->name('DryAPenerimaan.set');
            Route::post('/dry_a_penerimaan/simpanData', 'simpanData')->name('DryAPenerimaan.simpanData');
            Route::post('/dry_a_penerimaan/cek_data', 'CeksendData')->name('DryAPenerimaan.CeksendData');
        });

        Route::controller(App\Http\Controllers\DryA\DryAPenerimaanStockController::class)->group(function () {
            Route::get('/dry_a_penerimaan_stock', 'index')->name('DryAPenerimaanStock.index');
        });

        Route::controller(App\Http\Controllers\DryA\DryAOutputController::class)->group(function () {
            Route::get('/dry_a_output', 'index')->name('DryAOutput.index');
            Route::get('/dry_a_output/create', 'create')->name('DryAOutput.create');
            Route::post('/dry_a_output/store', 'store')->name('DryAOutput.store');
            Route::post('/dry_a_output/sendData', 'sendData')->name('DryAOutput.sendData');
            Route::delete('/dry_a_output/destroy/{nomor_job}', 'destroy')->name('DryAOutput.destroy');
            Route::get('/dry_a_output/get_data_id_box', 'set')->name('DryAOutput.set');
            Route::get('/dry_a_output/get_pcc', 'setpcc')->name('DryAOutput.setpcc');
            Route::post('/dry_a_output/cek_data', 'CeksendData')->name('DryAOutput.CeksendData');
        });

        Route::controller(App\Http\Controllers\DryA\TransitDryAController::class)->group(function () {
            Route::get('/transit_dry_a', 'index')->name('TransitDryA.index');
        });
        Route::prefix('dry_a_hancuran')->middleware('role:dry_a|admin|production|ppic')->group(function () {
            Route::controller(App\Http\Controllers\DryAHancuran\DryAGradingHancuranController::class)->group(function () {
                Route::get('/dry_a_grading_hancuran', 'index')->name('DryAGradingHancuran.index');
                Route::get('/dry_a_grading_hancuran/create', 'create')->name('DryAGradingHancuran.create');
                Route::post('/dry_a_grading_hancuran/store', 'store')->name('DryAGradingHancuran.store');
                Route::post('/dry_a_grading_hancuran/cek_data', 'CeksendData')->name('DryAGradingHancuran.CeksendData');
                Route::get('/dry_a_grading_hancuran/set', 'set')->name('DryAGradingHancuran.set');
                Route::get('/dry_a_grading_hancuran/setjenis', 'setJenis')->name('DryAGradingHancuran.setJenis');
                Route::delete('/dry_a_grading_hancuran/destroy/{nomor_job}', 'destroy')->name('DryAGradingHancuran.destroy');
            });
            Route::controller(App\Http\Controllers\DryAHancuran\DryAGradingHancuranStockController::class)->group(function () {
                Route::get('/dry_a_grading_hancuran_stock', 'index')->name('DryAGradingHancuranStock.index');
            });
        });

        Route::prefix('dry_a_hancuran')->middleware('role:dry_a|admin|production|ppic')->group(function (){
            Route::controller(App\Http\Controllers\DryAHancuran\DryAPenerimaanHancuranController::class)->group(function () {
                Route::get('/dry_a_penerimaan_hancuran', 'index')->name('DryAPenerimaanHancuran.index');
                Route::get('/dry_a_penerimaan_hancuran/create', 'create')->name('DryAPenerimaanHancuran.create');
                Route::post('/dry_a_penerimaan_hancuran/store', 'store')->name('DryAPenerimaanHancuran.store');
                Route::get('/dry_a_penerimaan_hancuran/show/{id}', 'show')->name('DryAPenerimaanHancuran.show');
                Route::get('/dry_a_penerimaan_hancuran/edit/{id}', 'edit')->name('DryAPenerimaanHancuran.edit');
                Route::put('/dry_a_penerimaan_hancuran/update/{id}', 'update')->name('DryAPenerimaanHancuran.update');
                Route::delete('/dry_a_penerimaan_hancuran/destroy/{nomor_job}', 'destroy')->name('DryAPenerimaanHancuran.destroy');
                Route::get('/dry_a_penerimaan_hancuran/get_data_nomor_job', 'set')->name('DryAPenerimaanHancuran.set');
                Route::post('/dry_a_penerimaan_hancuran/simpanData', 'simpanData')->name('DryAPenerimaanHancuran.simpanData');
                Route::post('/dry_a_penerimaan_hancuran/cek_data', 'CeksendData')->name('DryAPenerimaanHancuran.CeksendData');
            });

            Route::controller(App\Http\Controllers\DryAHancuran\DryAPenerimaanHancuranStockController::class)->group(function () {
                Route::get('/dry_a_penerimaan_hancuran_stock', 'index')->name('DryAPenerimaanHancuranStock.index');
            });

            Route::controller(App\Http\Controllers\DryAHancuran\DryAOutputHancuranController::class)->group(function () {
                Route::get('/dry_a_output_hancuran', 'index')->name('DryAOutputHancuran.index');
                Route::get('/dry_a_output_hancuran/create', 'create')->name('DryAOutputHancuran.create');
                Route::post('/dry_a_output_hancuran/store', 'store')->name('DryAOutputHancuran.store');
                Route::post('/dry_a_output_hancuran/sendData', 'sendData')->name('DryAOutputHancuran.sendData');
                Route::delete('/dry_a_output_hancuran/destroy/{jenis_grading}', 'destroy')->name('DryAOutputHancuran.destroy');
                Route::get('/dry_a_output_hancuran/get_data_id_box', 'set')->name('DryAOutputHancuran.set');
                Route::get('/dry_a_output_hancuran/get_pcc', 'setpcc')->name('DryAOutputHancuran.setpcc');
                Route::post('/dry_a_output_hancuran/cek_data', 'CeksendData')->name('DryAOutputHancuran.CeksendData');
            });

            Route::controller(App\Http\Controllers\DryAHancuran\TransitDryAHancuranController::class)->group(function () {
                Route::get('/transit_dry_a_hancuran', 'index')->name('TransitDryAHancuran.index');
            });
        });
        Route::prefix('dry_a_waste')->middleware('role:dry_a|admin|production|ppic')->group(function () {
            Route::controller(App\Http\Controllers\DryAWaste\DryAWasteInputController::class)->group(function () {
                Route::get('/dry_a_waste_input', 'index')->name('DryAWasteInput.index');
                Route::get('/dry_a_waste_input/create', 'create')->name('DryAWasteInput.create');
                Route::post('/dry_a_waste_input/store', 'store')->name('DryAWasteInput.store');
                Route::get('/dry_a_waste_input/setjenis', 'setJenis')->name('DryAWasteInput.setJenis');
                Route::delete('/dry_a_waste_input/destroy/{id}', 'destroy')->name('DryAWasteInput.destroy');
            });
            Route::controller(App\Http\Controllers\DryAWaste\DryAWasteStockController::class)->group(function () {
                Route::get('/dry_a_waste_stock', 'index')->name('DryAWasteStock.index');
            });

            Route::controller(App\Http\Controllers\DryAWaste\DryAWasteOutputController::class)->group(function () {
                Route::get('/dry_a_waste_output', 'index')->name('DryAWasteOutput.index');
                Route::get('/dry_a_waste_output/create', 'create')->name('DryAWasteOutput.create');
                Route::get('/dry_a_waste_output/get_pcc', 'setpcc')->name('DryAWasteOutput.setpcc');
                Route::get('/dry_a_waste_output/get_data_id_box', 'set')->name('DryAWasteOutput.set');
                Route::post('/dry_a_waste_output/sendData', 'sendData')->name('DryAWasteOutput.sendData');
                Route::post('/dry_a_waste_output/store', 'store')->name('DryAWasteOutput.store');
                Route::get('/dry_a_waste_output/setjenis', 'setJenis')->name('DryAWasteOutput.setJenis');
                Route::delete('/dry_a_waste_output/destroy/{id}', 'destroy')->name('DryAWasteOutput.destroy');
            });
            Route::controller(App\Http\Controllers\DryAWaste\TransitDryAWasteController::class)->group(function () {
                Route::get('/transit_dry_a_waste', 'index')->name('TransitDryAWaste.index');
            });
        });
    });
    Route::prefix('kedatangan')->middleware(['role:kedatangan|admin'])->group(function () {
        Route::prefix('kedatangan_output')->middleware('role:kedatangan|admin')->group(function () {
            Route::controller(App\Http\Controllers\Kedatangan\KedatanganOutputController::class)->group(function () {
                Route::get('/kedatangan_output', 'index')->name('KedatanganOutput.index');
                Route::get('/kedatangan_output/create', 'create')->name('KedatanganOutput.create');
                Route::post('/kedatangan_output/store', 'store')->name('KedatanganOutput.store');
                Route::delete('/kedatangan_output/destroy/{nomor_bstb}', 'destroy')->name('KedatanganOutput.destroy');
                Route::get('/kedatangan_output/set_batch', 'setBatch')->name('KedatanganOutput.setBatch');
                Route::get('/kedatangan_output/set_jenis', 'setJenis')->name('KedatanganOutput.setJenis');
                Route::get('/kedatangan_output/set_tujuan_kirim', 'setTujuanKirim')->name('KedatanganOutput.setTujuanKirim');
            });
        });
        Route::prefix('transit_kedatangan')->middleware('role:kedatangan|admin')->group(function () {
            Route::controller(App\Http\Controllers\Kedatangan\TransitKedatanganController::class)->group(function () {
                Route::get('/transit_kedatangan', 'index')->name('TransitKedatangan.index');
            });
        });
    });
    Route::prefix('moulding')->middleware(['role:moulding|admin'])->group(function () {
        Route::prefix('grading_warna')->middleware('role:moulding|admin')->group(function () {
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaPenerimaanKedatanganController::class)->group(function () {
                Route::get('/grading_warna_penerimaan_kedatangan', 'index')->name('GradingWarnaPenerimaanKedatangan.index');
                Route::get('/grading_warna_penerimaan_kedatangan/create', 'create')->name('GradingWarnaPenerimaanKedatangan.create');
                Route::post('/grading_warna_penerimaan_kedatangan/store', 'store')->name('GradingWarnaPenerimaanKedatangan.store');
                Route::post('/grading_warna_penerimaan_kedatangan/cek_data', 'CeksendData')->name('GradingWarnaPenerimaanKedatangan.CeksendData');
                Route::get('/grading_warna_penerimaan_kedatangan/set_bstb', 'setBSTB')->name('GradingWarnaPenerimaanKedatangan.setBSTB');
                Route::delete('/grading_warna_penerimaan_kedatangan/destroy/{nomor_job}', 'destroy')->name('GradingWarnaPenerimaanKedatangan.destroy');
            });
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaAddingController::class)->group(function () {
                Route::get('/grading_warna_adding', 'index')->name('GradingWarnaAdding.index');
                Route::get('/grading_warna_adding/create', 'create')->name('GradingWarnaAdding.create');
                Route::post('/grading_warna_adding/store', 'store')->name('GradingWarnaAdding.store');
                Route::post('/grading_warna_adding/cek_data', 'CeksendData')->name('GradingWarnaAdding.CeksendData');
                Route::get('/grading_warna_adding/get_data/{nomor_job}', 'getDataByNomorJob')->name('GradingWarnaAdding.getData');
                Route::delete('/grading_warna_adding/destroy/{nomor_job}', 'destroy')->name('GradingWarnaAdding.destroy');
            });
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaAddingStockController::class)->group(function () {
                Route::get('/grading_warna_adding_stock', 'index')->name('GradingWarnaAddingStock.index');
            });
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaController::class)->group(function () {
                Route::get('/grading_warna', 'index')->name('GradingWarna.index');
                Route::get('/grading_warna/create', 'create')->name('GradingWarna.create');
                Route::post('/grading_warna/store', 'store')->name('GradingWarna.store');
                Route::post('/grading_warna/cek_data', 'CeksendData')->name('GradingWarna.CeksendData');
                Route::delete('/grading_warna/destroy/{nomor_lot}', 'destroy')->name('GradingWarna.destroy');
                Route::get('/grading_warna/set_lot', 'setLot')->name('GradingWarna.setLot');
                Route::get('/grading_warna/set_jenis', 'setJenis')->name('GradingWarna.setJenis');
            });
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaStockController::class)->group(function () {
                Route::get('/grading_warna_stock', 'index')->name('GradingWarnaStock.index');
            });
            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaPenerimaanController::class)->group(function () {
                Route::get('/grading_warna_penerimaan', 'index')->name('GradingWarnaPenerimaan.index');
                Route::get('/grading_warna_penerimaan/create', 'create')->name('GradingWarnaPenerimaan.create');
                Route::post('/grading_warna_penerimaan/store', 'store')->name('GradingWarnaPenerimaan.store');
                Route::get('/grading_warna_penerimaan/getDataHancuran', 'getDataHancuran')->name('GradingWarnaPenerimaan.getDataHancuran');
                Route::get('/grading_warna_penerimaan/getDataCabut', 'getDataCabut')->name('GradingWarnaPenerimaan.getDataCabut');
                Route::get('/grading_warna_penerimaan/get_data', 'setHancuran')->name('GradingWarnaPenerimaan.setHancuran');
                Route::get('/grading_warna_penerimaan/get_data_id_box', 'setCabut')->name('GradingWarnaPenerimaan.setCabut');
                Route::delete('/grading_warna_penerimaan/destroy/{nomor_bstb}', 'destroy')->name('GradingWarnaPenerimaan.destroy');
                Route::get('/grading_warna_penerimaan/get_data_nomor_job', 'set')->name('GradingWarnaPenerimaan.set');
                Route::post('/grading_warna_penerimaan/simpanData', 'simpanData')->name('GradingWarnaPenerimaan.simpanData');
                Route::post('/grading_warna_penerimaan/cek_data', 'CeksendData')->name('GradingWarnaPenerimaan.CeksendData');
            });

            Route::controller(App\Http\Controllers\GradingWarna\GradingWarnaPenerimaanStockController::class)->group(function () {
                Route::get('/grading_warna_penerimaan_stock', 'index')->name('GradingWarnaPenerimaanStock.index');
            });
        });

        Route::prefix('moulding')->middleware('role:moulding|admin|production')->group(function (){
            Route::controller(App\Http\Controllers\MasterJobMouldingController::class)->group(function () {
                Route::get('/master_job_moulding', 'index')->name('MasterJobMoulding.index');
                Route::post('/master_job_moulding/store', 'store')->name('MasterJobMoulding.store');
                Route::get('/master_job_moulding/edit/{id}', 'edit')->name('MasterJobMoulding.edit');
                Route::put('/master_job_moulding/update/{id}', 'update')->name('MasterJobMoulding.update');
                Route::delete('/master_job_moulding/destroy/{id}', 'destroy')->name('MasterJobMoulding.destroy');
            });

            Route::controller(App\Http\Controllers\Moulding\MouldingPersiapanController::class)->group(function () {
                Route::get('/moulding_persiapan', 'index')->name('MouldingPersiapan.index');
                Route::get('/moulding_persiapan/create', 'create')->name('MouldingPersiapan.create');
                Route::post('/moulding_persiapan/store', 'store')->name('MouldingPersiapan.store');
                Route::post('/moulding_persiapan/sendData', 'sendData')->name('MouldingPersiapan.sendData');
                Route::delete('/moulding_persiapan/destroy/{nomor_job}', 'destroy')->name('MouldingPersiapan.destroy');
                Route::get('/moulding_persiapan/get_data_id_box', 'set')->name('MouldingPersiapan.set');
                Route::get('/moulding_persiapan/get_pcc', 'setpcc')->name('MouldingPersiapan.setpcc');
                Route::post('/moulding_persiapan/cek_data', 'CeksendData')->name('MouldingPersiapan.CeksendData');
            });
            Route::controller(App\Http\Controllers\Moulding\MouldingPenyebaranController::class)->group(function () {
                Route::get('/moulding_penyebaran', 'index')->name('MouldingPenyebaran.index');
                Route::get('/moulding_penyebaran/create', 'create')->name('MouldingPenyebaran.create');
                Route::post('/moulding_penyebaran/store', 'store')->name('MouldingPenyebaran.store');
                Route::post('/moulding_penyebaran/cek_data', 'CeksendData')->name('MouldingPenyebaran.CeksendData');
                Route::delete('/moulding_penyebaran/destroy/{nomor_job}', 'destroy')->name('MouldingPenyebaran.destroy');
                Route::get('/moulding_penyebaran/set_job', 'setJob')->name('MouldingPenyebaran.setJob');
                Route::get('/moulding_penyebaran/set_nip', 'setNip')->name('MouldingPenyebaran.setNip');
            });

            Route::controller(App\Http\Controllers\Moulding\MouldingStockController::class)->group(function () {
                Route::get('/moulding_stock', 'index')->name('MouldingStock.index');
            });
            Route::controller(App\Http\Controllers\Moulding\MouldingPengembalianController::class)->group(function () {
                Route::get('/moulding_pengembalian', 'index')->name('MouldingPengembalian.index');
                Route::get('/moulding_pengembalian/create', 'create')->name('MouldingPengembalian.create');
                Route::post('/moulding_pengembalian/store', 'store')->name('MouldingPengembalian.store');
                Route::post('/moulding_pengembalian/cek_data', 'CeksendData')->name('MouldingPengembalian.CeksendData');
                Route::delete('/moulding_pengembalian/destroy/{nomor_job}', 'destroy')->name('MouldingPengembalian.destroy');
                Route::get('/moulding_pengembalian/set_job', 'setJob')->name('MouldingPengembalian.setJob');
                Route::get('/moulding_pengembalian/set_nip', 'setNip')->name('MouldingPengembalian.setNip');
            });
            Route::controller(App\Http\Controllers\Moulding\TransitMouldingController::class)->group(function () {
                Route::get('/transit_moulding', 'index')->name('TransitMoulding.index');
            });

            Route::controller(App\Http\Controllers\Moulding\MouldingWasteInputController::class)->group(function () {
                Route::get('/moulding_waste_input', 'index')->name('MouldingWasteInput.index');
                Route::get('/moulding_waste_input/create', 'create')->name('MouldingWasteInput.create');
                Route::post('/moulding_waste_input/store', 'store')->name('MouldingWasteInput.store');
                Route::post('/moulding_waste_input/cek_data', 'CeksendData')->name('MouldingWasteInput.CeksendData');
                Route::delete('/moulding_waste_input/destroy/{id}', 'destroy')->name('MouldingWasteInput.destroy');
                Route::get('/moulding_waste_input/set_jenis', 'setJenis')->name('MouldingWasteInput.setJenis');
            });
            Route::controller(App\Http\Controllers\Moulding\MouldingWasteStockController::class)->group(function () {
                Route::get('/moulding_waste_stock', 'index')->name('MouldingWasteStock.index');
            });
            Route::controller(App\Http\Controllers\MouldingWaste\MouldingWasteStockController::class)->group(function () {
                Route::get('/moulding_waste_stock', 'index')->name('MouldingWasteStock.index');
            });

            Route::controller(App\Http\Controllers\MouldingWaste\MouldingWasteOutputController::class)->group(function () {
                Route::get('/moulding_waste_output', 'index')->name('MouldingWasteOutput.index');
                Route::get('/moulding_waste_output/create', 'create')->name('MouldingWasteOutput.create');
                Route::get('/moulding_waste_output/get_pcc', 'setpcc')->name('MouldingWasteOutput.setpcc');
                Route::get('/moulding_waste_output/getdataidboxwaste', 'getWaste')->name('MouldingWasteOutput.getWaste');
                Route::get('/moulding_waste_output/getdataidbox', 'getGrading')->name('MouldingWasteOutput.getGrading');
                Route::get('/moulding_waste_output/get_data_id_box_waste', 'setWaste')->name('MouldingWasteOutput.setWaste');
                Route::get('/moulding_waste_output/get_data_id_box', 'setGrading')->name('MouldingWasteOutput.setGrading');
                Route::post('/moulding_waste_output/sendData', 'sendData')->name('MouldingWasteOutput.sendData');
                Route::post('/moulding_waste_output/store', 'store')->name('MouldingWasteOutput.store');
                Route::get('/moulding_waste_output/setjenis', 'setJenis')->name('MouldingWasteOutput.setJenis');
                Route::delete('/moulding_waste_output/destroy/{id_box}', 'destroy')->name('MouldingWasteOutput.destroy');
            });

            Route::controller(App\Http\Controllers\MouldingWaste\TransitMouldingWasteController::class)->group(function () {
                Route::get('/transit_moulding_waste', 'index')->name('TransitMouldingWaste.index');
            });
        });
        Route::prefix('moulding')->middleware('role:moulding|admin')->group(function (){
            Route::controller(App\Http\Controllers\MouldingRework\MouldingPersiapanReworkController::class)->group(function () {
                Route::get('/moulding_rework_persiapan', 'index')->name('MouldingReworkPersiapan.index');
                Route::get('/moulding_rework_persiapan/create', 'create')->name('MouldingReworkPersiapan.create');
                Route::post('/moulding_rework_persiapan/store', 'store')->name('MouldingReworkPersiapan.store');
                Route::post('/moulding_rework_persiapan/sendData', 'sendData')->name('MouldingReworkPersiapan.sendData');
                Route::delete('/moulding_rework_persiapan/destroy/{nomor_job_rework}', 'destroy')->name('MouldingReworkPersiapan.destroy');
                Route::get('/moulding_rework_persiapan/get_data_id_box', 'set')->name('MouldingReworkPersiapan.set');
                Route::get('/moulding_rework_persiapan/get_pcc', 'setpcc')->name('MouldingReworkPersiapan.setpcc');
                Route::post('/moulding_rework_persiapan/cek_data', 'CeksendData')->name('MouldingReworkPersiapan.CeksendData');
            });

            Route::controller(App\Http\Controllers\MouldingRework\MouldingPersiapanReworkStockController::class)->group(function () {
                Route::get('/moulding_rework_stock', 'index')->name('MouldingReworkPersiapanStock.index');
            });

            Route::controller(App\Http\Controllers\MouldingRework\MouldingPenyebaranReworkController::class)->group(function () {
                Route::get('/moulding_rework_penyebaran', 'index')->name('MouldingReworkPenyebaran.index');
                Route::get('/moulding_rework_penyebaran/create', 'create')->name('MouldingReworkPenyebaran.create');
                Route::post('/moulding_rework_penyebaran/store', 'store')->name('MouldingReworkPenyebaran.store');
                Route::post('/moulding_rework_penyebaran/cek_data', 'CeksendData')->name('MouldingReworkPenyebaran.CeksendData');
                Route::delete('/moulding_rework_penyebaran/destroy/{nomor_job_rework}', 'destroy')->name('MouldingReworkPenyebaran.destroy');
                Route::get('/moulding_rework_penyebaran/set_job', 'setJob')->name('MouldingReworkPenyebaran.setJob');
                Route::get('/moulding_rework_penyebaran/set_nip', 'setNip')->name('MouldingReworkPenyebaran.setNip');
            });

            Route::controller(App\Http\Controllers\MouldingRework\MouldingPengembalianReworkController::class)->group(function () {
                Route::get('/moulding_rework_pengembalian', 'index')->name('MouldingReworkPengembalian.index');
                Route::get('/moulding_rework_pengembalian/create', 'create')->name('MouldingReworkPengembalian.create');
                Route::post('/moulding_rework_pengembalian/store', 'store')->name('MouldingReworkPengembalian.store');
                Route::post('/moulding_rework_pengembalian/cek_data', 'CeksendData')->name('MouldingReworkPengembalian.CeksendData');
                Route::delete('/moulding_rework_pengembalian/destroy/{nomor_job_rework}', 'destroy')->name('MouldingReworkPengembalian.destroy');
                Route::get('/moulding_rework_pengembalian/set_job', 'setJob')->name('MouldingReworkPengembalian.setJob');
                Route::get('/moulding_rework_pengembalian/set_nip', 'setNip')->name('MouldingReworkPengembalian.setNip');
            });

            Route::controller(App\Http\Controllers\MouldingRework\TransitMouldingReworkController::class)->group(function () {
                Route::get('/transit_moulding_rework', 'index')->name('TransitMouldingRework.index');
            });
        });
    });
    Route::prefix('final_grading_and_wip_steam')->middleware(['role:final_grading_and_wip_steam|admin'])->group(function (){
        Route::prefix('final_grading')->middleware('role:final_grading|admin')->group(function (){
            Route::controller(App\Http\Controllers\FinalGrading\TransitFinalGradingReworkController::class)->group(function () {
                Route::get('/transit_final_grading_rework', 'index')->name('TransitFinalGradingRework.index');
            });
        });
    });
    Route::prefix('final_grading')->middleware(['role:final_grading|admin'])->group(function () {
        Route::prefix('final_grading')->middleware('role:final_grading|admin')->group(function () {
            Route::controller(App\Http\Controllers\FinalGrading\FinalGradingController::class)->group(function () {
                Route::get('/final_grading', 'index')->name('FinalGrading.index');
                Route::get('/final_grading/create', 'create')->name('FinalGrading.create');
                Route::post('/final_grading/store', 'store')->name('FinalGrading.store');
                Route::delete('/final_grading/destroy/{nomor_bstb}', 'destroy')->name('FinalGrading.destroy');
                Route::get('/final_grading/get_moulding', 'getMoulding')->name('FinalGrading.getMoulding');
                Route::get('/final_grading/get_rework', 'getRework')->name('FinalGrading.getRework');
                Route::get('/final_grading/set_moulding', 'setMoulding')->name('FinalGrading.setMoulding');
                Route::get('/final_grading/set_rework', 'setRework')->name('FinalGrading.setRework');
                Route::get('/final_grading/set_jenis', 'setJenis')->name('FinalGrading.setJenis');
            });
        });
        Route::prefix('transit_moulding')->middleware('role:final_grading|admin')->group(function () {
            Route::controller(App\Http\Controllers\FinalGrading\TransitFinalGradingController::class)->group(function () {
                Route::get('/transit_moulding', 'index')->name('TransitFinalGrading.index');
            });
        });
        // Route::prefix('transit_moulding_rework')->middleware('role:final_grading|admin')->group(function () {
        //     Route::controller(App\Http\Controllers\FinalGrading\TransitFinalGradingReworkController::class)->group(function () {
        //         Route::get('/transit_moulding_rework', 'index')->name('TransitFinalGradingRework.index');
        //     });
        // });
    });
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
