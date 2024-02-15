<?php

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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/unit/store', 'store')->name('Unit.store');
    Route::get('/unit/show/{id}', 'show')->name('Unit.show');
    Route::get('/unit/edit/{id}', 'edit')->name('Unit.edit');
    Route::put('/unit/update/{id}', 'update')->name('Unit.update');
    Route::delete('/unit/hapus/{id}', 'destroy')->name('Unit.destroy');
});

Route::controller(App\Http\Controllers\BiayaHppController::class)->group(function () {
    Route::get('/biayahpp', 'index')->name('Biaya.index');
    Route::post('/biayahpp/store', 'store')->name('Biaya.store');
    Route::get('/biayahpp/create', 'create')->name('Biaya.create');
    Route::get('/biayahpp/show/{id}', 'show')->name('Biaya.show');
    Route::get('/biayahpp/edit/{id}', 'edit')->name('Biaya.edit');
    Route::put('/biayahpp/update/{id}', 'update')->name('Biaya.update');
    Route::delete('/biayahpp/hapus/{id}', 'destroy')->name('Biaya.destroy');
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

Route::controller(App\Http\Controllers\MasterJenisGradingController::class)->group(function () {
    Route::get('/master_jenis_grading', 'index')->name('MasterJenisGrading.index');
    Route::get('/master_jenis_grading/create', 'create')->name('MasterJenisGrading.create');
    Route::post('/master_jenis_grading/store', 'store')->name('MasterJenisGrading.store');
    Route::get('/master_jenis_grading/show/{id}', 'show')->name('MasterJenisGrading.show');
    Route::get('/master_jenis_grading/edit/{id}', 'edit')->name('MasterJenisGrading.edit');
    Route::put('/master_jenis_grading/update/{id}', 'update')->name('MasterJenisGrading.update');
    Route::delete('/master_jenis_grading/destroy/{id}', 'destroy')->name('MasterJenisGrading.destroy');
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

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialInputController::class)->group(function () {
    Route::get('/prm_raw_material_input', 'index')->name('PrmRawMaterialInput.index');
    Route::get('/prm_raw_material_input/create', 'create')->name('PrmRawMaterialInput.create');
    Route::get('/prm_raw_material_input/detail', 'detail')->name('PrmRawMaterialInput.detail');
    Route::post('/prm_raw_material_input/store', 'store')->name('PrmRawMaterialInput.store');
    Route::get('/prm_raw_material_input/show/{id}', 'show')->name('PrmRawMaterialInput.show');
    Route::get('/prm_raw_material_input/edit/{id}', 'edit')->name('PrmRawMaterialInput.edit');
    Route::post('/prm_raw_material_input/update/{id}', 'update')->name('PrmRawMaterialInput.update');
    Route::delete('/prm_raw_material_input/destroyInput/{id}', 'destroyInput')->name('PrmRawMaterialInput.destroyInput');
    Route::delete('/prm_raw_material_input/destroyItem/{id}', 'destroyItem')->name('PrmRawMaterialInput.destroyItem');
    Route::get('/prm_raw_material_input/getDataSupplier', 'getDataSupplier')->name('PrmRawMaterialInput.getDataSupplier');
    Route::get('/prm_raw_material_input/getDataJenis', 'getDataJenis')->name('PrmRawMaterialInput.getDataJenis');
    Route::post('/prm_raw_material_input/simpanData', 'simpanData')->name('PrmRawMaterialInput.simpanData');
    Route::post('/prm_raw_material_input/simpanDataItem', 'simpanDataItem')->name('PrmRawMaterialInput.simpanDataItem');
});

Route::controller(App\Http\Controllers\PurchasingExim\StockTransitRawMaterialController::class)->group(function () {
    Route::get('/StockTransitRawMaterial', 'index')->name('StockTransitRawMaterial.index');
});

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialStockController::class)->group(function () {
    Route::get('/purchasing_exim/prm_raw_material_stock', 'index')->name('purchasing_exim.prm_raw_material_stock.index');
    Route::get('/purchasing_exim/show/{id_box}', 'show')->name('prm_raw_material_stock.show');
});
// Route::get('/PrmRawMaterialStockHistory/{id_box}', 'App\Http\Controllers\PurchasingExim\PrmRawMaterialStockHistoryController@index')->name('PrmRawMaterialStockHistory.index');
Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialOutputController::class)->group(function () {
    Route::get('/PrmRawMaterialOutput', 'index')->name('PrmRawMaterialOutput.index');
    Route::get('/PrmRawMaterialOutput/create', 'create')->name('PrmRawMaterialOutput.create');
    Route::post('/PrmRawMaterialOutput/store', 'store')->name('PrmRawMaterialOutput.store');
    Route::post('/PrmRawMaterialOutput/sendData', 'sendData')->name('PrmRawMaterialOutput.sendData');
    Route::get('/PrmRawMaterialOutput/show/{id}', 'show')->name('PrmRawMaterialOutput.show');
    Route::get('/PrmRawMaterialOutput/edit/{id}', 'edit')->name('PrmRawMaterialOutput.edit');
    Route::put('/PrmRawMaterialOutput/update/{id}', 'update')->name('PrmRawMaterialOutput.update');
    Route::delete('/PrmRawMaterialOutput/destroy/{id}', 'destroy')->name('PrmRawMaterialOutput.destroy');
    Route::delete('/PrmRawMaterialOutput/destroyHead/{id}', 'destroyHead')->name('PrmRawMaterialOutput.destroyHead');
    Route::get('/PrmRawMaterialOutput/get_data_id_box', 'set')->name('PrmRawMaterialOutput.set');
    Route::get('/PrmRawMaterialOutput/get_pcc', 'setpcc')->name('PrmRawMaterialOutput.setpcc');
    Route::get('/getBerat/{id}', 'getBerat')->name('PrmRawMaterialOutput.getBerat');
});
Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarInputController::class)->group(function(){
    Route::get('/GradingKasarInput', 'index')->name('GradingKasarInput.index');
    Route::get('/GradingKasarInput/create', 'create')->name('GradingKasarInput.create');
    Route::get('/GradingKasarInput/get_data', 'set')->name('GradingKasarInput.set');
    Route::post('/GradingKasarInput/store', 'store')->name('GradingKasarInput.store');
    Route::post('/GradingKasarInput/sendData', 'sendData')->name('GradingKasarInput.sendData');
    Route::delete('/GradingKasarInput/destroy/{nomor_bstb}', 'destroy')->name('GradingKasarInput.destroy');
});
Route::controller(App\Http\Controllers\MasterJenisGradingKasarController::class)->group(function () {
    Route::get('/master_jenis_grading_kasar', 'index')->name('master_jenis_grading_kasar.index');
    Route::get('/master_jenis_grading_kasar/create', 'create')->name('master_jenis_grading_kasar.create');
    Route::post('/master_jenis_grading_kasar/store', 'store')->name('master_jenis_grading_kasar.store');
    Route::get('/master_jenis_grading_kasar/show/{id}', 'show')->name('master_jenis_grading_kasar.show');
    Route::get('/master_jenis_grading_kasar/edit/{id}', 'edit')->name('master_jenis_grading_kasar.edit');
    Route::put('/master_jenis_grading_kasar/update/{id}', 'update')->name('master_jenis_grading_kasar.update');
    Route::delete('/master_jenis_grading_kasar/destroy/{id}', 'destroy')->name('master_jenis_grading_kasar.destroy');
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

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialStockController::class)->group(function () {
    Route::get('/prm_raw_material_stock', 'index')->name('PrmRawMaterialStock.index');
    Route::get('/prm_raw_material_stock/show/{id_box}', 'show')->name('PrmRawMaterialStock.show');
});

Route::controller(App\Http\Controllers\TransitGradingKasar\StockTransitGradingKasarController::class)->group(function () {
    Route::get('/stock_transit_grading_kasar', 'index')->name('StockTransitGradingKasar.index');
    Route::get('/stock_transit_grading_kasar/create', 'create')->name('StockTransitGradingKasar.create');
    Route::post('/stock_transit_grading_kasar/store', 'store')->name('StockTransitGradingKasar.store');
    Route::get('/stock_transit_grading_kasar/show/{id}', 'show')->name('StockTransitGradingKasar.show');
    Route::get('/stock_transit_grading_kasar/edit/{id}', 'edit')->name('StockTransitGradingKasar.edit');
    Route::put('/stock_transit_grading_kasar/update/{id}', 'update')->name('StockTransitGradingKasar.update');
    Route::delete('/stock_transit_grading_kasar/destroy/{id}', 'destroy')->name('StockTransitGradingKasar.destroy');
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
    // routes/web.php
    Route::get('/prm_raw_material_output/get_data_id_box', 'set')->name('PrmRawMaterialOutput.set');
    Route::get('/prm_raw_material_output/get_pcc', 'setpcc')->name('PrmRawMaterialOutput.setpcc');
});

// Route::controller(App\Http\Controllers\TransitGradingKasar\StockTransitGradingKasarController::class)->group(function () {
//     Route::get('/StockTransitGradingKasar', 'index')->name('StockTransitGradingKasar.index');
// });

Route::controller(App\Http\Controllers\PreCleaning\PreCleaningStockController::class)->group(function () {
    Route::get('/pre_cleaning_stock', 'index')->name('PreCleaningStock.index');
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

Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusAddingController::class)->group(function () {
    Route::get('/pre_grading_halus_adding', 'index')->name('PreGradingHalusAdding.index');
    Route::get('/pre_grading_halus_adding/create', 'create')->name('PreGradingHalusAdding.create');
    Route::post('/pre_grading_halus_adding/store', 'store')->name('PreGradingHalusAdding.store');
    Route::get('/pre_grading_halus_adding/show/{id}', 'show')->name('PreGradingHalusAdding.show');
    Route::get('/pre_grading_halus_adding/edit/{id}', 'edit')->name('PreGradingHalusAdding.edit');
    Route::put('/pre_grading_halus_adding/update/{id}', 'update')->name('PreGradingHalusAdding.update');
    Route::delete('/pre_grading_halus_adding/destroy/{id}', 'destroy')->name('PreGradingHalusAdding.destroy');
    Route::get('/pre_grading_halus_adding/get_data_nomor_job', 'set')->name('preGradingHalusAdding.set');
    Route::post('/pre_grading_halus_adding/simpanData', 'simpanData')->name('preGradingHalusAdding.simpanData');
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

Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusInputController::class)->group(function () {
    Route::get('/PreGradingHalusInput', 'index')->name('PreGradingHalusInput.index');
    Route::get('/PreGradingHalusInput/create', 'create')->name('PreGradingHalusInput.create');
    Route::get('/PreGradingHalusInput/get_data_id_box', 'set')->name('PreGradingHalusInput.set');
    Route::post('/PreGradingHalusInput/sendData', 'sendData')->name('PreGradingHalusInput.sendData');
    Route::post('/PreGradingHalusInput/store', 'store')->name('PreGradingHalusInput.store');
    Route::get('/PreGradingHalusInput/show/{id}', 'show')->name('PreGradingHalusInput.show');
    Route::get('/PreGradingHalusInput/edit/{id}', 'edit')->name('PreGradingHalusInput.edit');
    Route::put('/PreGradingHalusInput/update/{id}', 'update')->name('PreGradingHalusInput.update');
    Route::delete('/PreGradingHalusInput/destroy/{nomor_bstb}', 'destroy')->name('PreGradingHalusInput.destroy');
});

Route::controller(App\Http\Controllers\PreGradingHalus\PreGradingHalusStockController::class)->group(function () {
    Route::get('/PreGradingHalusStock', 'index')->name('PreGradingHalusStock.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
