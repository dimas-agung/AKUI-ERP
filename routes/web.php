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

Route::controller(App\Http\Controllers\WorkstationController::class)->group(function () {
    Route::get('/work', 'index')->name('workstation.index');
    Route::get('/work/create', 'create')->name('workstation.create');
    Route::post('/work/store', 'store')->name('workstation.store');
    Route::get('/work/show/{id}', 'show')->name('workstation.show');
    Route::get('/work/edit/{id}', 'edit')->name('workstation.edit');
    Route::put('/work/update/{id}', 'update')->name('workstation.update');
    Route::delete('/work/hapus/{id}', 'destroy')->name('workstation.destroy');
});

Route::controller(App\Http\Controllers\UnitController::class)->group(function () {
    Route::get('/unit', 'index')->name('index.index');
    Route::get('/unit/create', 'create')->name('index.create');
    Route::post('/unit/store', 'store')->name('index.store');
    Route::get('/unit/show/{id}', 'show')->name('index.show');
    Route::get('/unit/edit/{id}', 'edit')->name('index.edit');
    Route::put('/unit/update/{id}', 'update')->name('unit.update');
    Route::delete('/unit/hapus/{id}', 'destroy')->name('index.destroy');
});

Route::controller(App\Http\Controllers\BiayaHppController::class)->group(function () {
    Route::get('/biayahpp', 'index')->name('biaya.index');
    Route::post('/biayahpp/store', 'store')->name('biaya.store');
    Route::get('/biayahpp/create', 'create')->name('biaya.create');
    Route::get('/biayahpp/show/{id}', 'show')->name('biaya.show');
    Route::get('/biayahpp/edit/{id}', 'edit')->name('biaya.edit');
    Route::put('/biayahpp/update/{id}', 'update')->name('biaya.update');
    Route::delete('/biayahpp/hapus/{id}', 'destroy')->name('biaya.destroy');
});

Route::controller(App\Http\Controllers\MasterSupplierRawMaterialController::class)->group(function () {
    Route::get('/master_supplier_raw_material', 'index')->name('master_supplier_raw_material.index');
    Route::get('/master_supplier_raw_material/create', 'create')->name('master_supplier_raw_material.create');
    Route::post('/master_supplier_raw_material/store', 'store')->name('master_supplier_raw_material.store');
    Route::get('/master_supplier_raw_material/show/{id}', 'show')->name('master_supplier_raw_material.show');
    Route::get('/master_supplier_raw_material/edit/{id}', 'edit')->name('master_supplier_raw_material.edit');
    Route::put('/master_supplier_raw_material/update/{id}', 'update')->name('master_supplier_raw_material.update');
    Route::delete('/master_supplier_raw_material/destroy/{id}', 'destroy')->name('master_supplier_raw_material.destroy');
});

Route::controller(App\Http\Controllers\MasterJenisRawMaterialController::class)->group(function () {
    Route::get('/master_jenis_raw_material', 'index')->name('master_jenis_raw_material.index');
    Route::get('/master_jenis_raw_material/create', 'create')->name('master_jenis_raw_material.create');
    Route::post('/master_jenis_raw_material/store', 'store')->name('master_jenis_raw_material.store');
    Route::get('/master_jenis_raw_material/show/{id}', 'show')->name('master_jenis_raw_material.show');
    Route::get('/master_jenis_raw_material/edit/{id}', 'edit')->name('master_jenis_raw_material.edit');
    Route::put('/master_jenis_raw_material/update/{id}', 'update')->name('master_jenis_raw_material.update');
    Route::delete('/master_jenis_raw_material/destroy/{id}', 'destroy')->name('master_jenis_raw_material.destroy');
});

Route::controller(App\Http\Controllers\MasterTujuanKirimRawMaterialController::class)->group(function () {
    Route::get('/master_tujuan_kirim_raw_material', 'index')->name('master_tujuan_kirim_raw_material.index');
    Route::get('/master_tujuan_kirim_raw_material/create', 'create')->name('master_tujuan_kirim_raw_material.create');
    Route::post('/master_tujuan_kirim_raw_material/store', 'store')->name('master_tujuan_kirim_raw_material.store');
    Route::get('/master_tujuan_kirim_raw_material/show/{id}', 'show')->name('master_tujuan_kirim_raw_material.show');
    Route::get('/master_tujuan_kirim_raw_material/edit/{id}', 'edit')->name('master_tujuan_kirim_raw_material.edit');
    Route::put('/master_tujuan_kirim_raw_material/update/{id}', 'update')->name('master_tujuan_kirim_raw_material.update');
    Route::delete('/master_tujuan_kirim_raw_material/destroy/{id}', 'destroy')->name('master_tujuan_kirim_raw_material.destroy');
});

Route::controller(App\Http\Controllers\MasterTujuanKirimGradingKasarController::class)->group(function () {
    Route::get('/master_tujuan_kirim_grading_kasar', 'index')->name('master_tujuan_kirim_grading_kasar.index');
    Route::get('/master_tujuan_kirim_grading_kasar/create', 'create')->name('master_tujuan_kirim_grading_kasar.create');
    Route::post('/master_tujuan_kirim_grading_kasar/store', 'store')->name('master_tujuan_kirim_grading_kasar.store');
    Route::get('/master_tujuan_kirim_grading_kasar/show/{id}', 'show')->name('master_tujuan_kirim_grading_kasar.show');
    Route::get('/master_tujuan_kirim_grading_kasar/edit/{id}', 'edit')->name('master_tujuan_kirim_grading_kasar.edit');
    Route::put('/master_tujuan_kirim_grading_kasar/update/{id}', 'update')->name('master_tujuan_kirim_grading_kasar.update');
    Route::delete('/master_tujuan_kirim_grading_kasar/destroy/{id}', 'destroy')->name('master_tujuan_kirim_grading_kasar.destroy');
});

Route::controller(App\Http\Controllers\MasterJenisGradingController::class)->group(function () {
    Route::get('/master_jenis_grading', 'index')->name('master_jenis_grading.index');
    Route::get('/master_jenis_grading/create', 'create')->name('master_jenis_grading.create');
    Route::post('/master_jenis_grading/store', 'store')->name('master_jenis_grading.store');
    Route::get('/master_jenis_grading/show/{id}', 'show')->name('master_jenis_grading.show');
    Route::get('/master_jenis_grading/edit/{id}', 'edit')->name('master_jenis_grading.edit');
    Route::put('/master_jenis_grading/update/{id}', 'update')->name('master_jenis_grading.update');
    Route::delete('/master_jenis_grading/destroy/{id}', 'destroy')->name('master_jenis_grading.destroy');
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

Route::controller(App\Http\Controllers\MasterOperatorController::class)->group(function () {
    Route::get('/master_operator', 'index')->name('master_operator.index');
    Route::get('/master_operator/create', 'create')->name('master_operator.create');
    Route::post('/master_operator/store', 'store')->name('master_operator.store');
    Route::get('/master_operator/show/{id}', 'show')->name('master_operator.show');
    Route::get('/master_operator/edit/{id}', 'edit')->name('master_operator.edit');
    Route::put('/master_operator/update/{id}', 'update')->name('master_operator.update');
    Route::delete('/master_operator/destroy/{id}', 'destroy')->name('master_operator.destroy');
});

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialInputController::class)->group(function () {
    Route::get('/purchasing_exim/prm_raw_material_input', 'index')->name('prm_raw_material_input.index');
    Route::get('/purchasing_exim/prm_raw_material_input/create', 'create')->name('prm_raw_material_input.create');
    Route::get('/purchasing_exim/prm_raw_material_input/detail', 'detail')->name('prm_raw_material_input.detail');
    Route::post('/purchasing_exim/prm_raw_material_input/store', 'store')->name('prm_raw_material_input.store');
    Route::get('/purchasing_exim/prm_raw_material_input/show/{id}', 'show')->name('prm_raw_material_input.show');
    Route::get('/purchasing_exim/prm_raw_material_input/edit/{id}', 'edit')->name('prm_raw_material_input.edit');
    Route::post('/purchasing_exim/prm_raw_material_input/update/{id}', 'update')->name('prm_raw_material_input.update');
    Route::delete('/purchasing_exim/prm_raw_material_input/destroyInput/{id}', 'destroyInput')->name('prm_raw_material_input.destroyInput');
    Route::delete('/purchasing_exim/prm_raw_material_input/destroyItem/{id}', 'destroyItem')->name('prm_raw_material_input.destroyItem');
    Route::get('/purchasing_exim/prm_raw_material_input/getDataSupplier', 'getDataSupplier')->name('prm_raw_material_input.getDataSupplier');
    Route::get('/purchasing_exim/prm_raw_material_input/getDataJenis', 'getDataJenis')->name('prm_raw_material_input.getDataJenis');
    Route::post('/purchasing_exim/prm_raw_material_input/simpanData', 'simpanData')->name('prm_raw_material_input.simpanData');
    Route::post('/purchasing_exim/prm_raw_material_input/simpanDataItem', 'simpanDataItem')->name('prm_raw_material_input.simpanDataItem');
});
Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarHasilController::class)->group(function () {
    Route::get('/transit_grading_kasar/grading_kasar_hasil', 'index')->name('grading_kasar_hasil.index');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/create', 'create')->name('grading_kasar_hasil.create');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/create_item', 'createItem')->name('grading_kasar_hasil.createItem');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/store', 'store')->name('grading_kasar_hasil.store');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/show/{id}', 'show')->name('grading_kasar_hasil.show');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/edit/{id}', 'edit')->name('grading_kasar_hasil.edit');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/update/{id}', 'update')->name('grading_kasar_hasil.update');
    Route::delete('/transit_grading_kasar/grading_kasar_hasil/destroyInput/{id}', 'destroyInput')->name('grading_kasar_hasil.destroyInput');
    Route::delete('/transit_grading_kasar/grading_kasar_hasil/destroyItem/{id}', 'destroyItem')->name('grading_kasar_hasil.destroyItem');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/getDataSupplier', 'getDataSupplier')->name('grading_kasar_hasil.getDataSupplier');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/getDataJenis', 'getDataJenis')->name('grading_kasar_hasil.getDataJenis');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/simpanData', 'simpanData')->name('grading_kasar_hasil.simpanData');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/get_data_nama_jenis', 'set')->name('gradingKasarHasil.set');
});

Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarStockController::class)->group(function () {
    Route::get('/transit_grading_kasar/grading_kasar_stock', 'index')->name('grading_kasar_stock.index');
    Route::get('/transit_grading_kasar/grading_kasar_stock/create', 'create')->name('grading_kasar_stock.create');
    Route::post('/transit_grading_kasar/grading_kasar_stock/store', 'store')->name('grading_kasar_stock.store');
    Route::get('/transit_grading_kasar/grading_kasar_stock/show/{id}', 'show')->name('grading_kasar_stock.show');
    Route::get('/transit_grading_kasar/grading_kasar_stock/edit/{id}', 'edit')->name('grading_kasar_stock.edit');
    Route::post('/transit_grading_kasar/grading_kasar_stock/update/{id}', 'update')->name('grading_kasar_stock.update');
    Route::get('/transit_grading_kasar/grading_kasar_stock/getDataJenis', 'getDataJenis')->name('grading_kasar_stock.getDataJenis');
    Route::post('/transit_grading_kasar/grading_kasar_stock/simpanData', 'simpanData')->name('grading_kasar_stock.simpanData');
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
});
Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarInputController::class)->group(function(){
    Route::get('/GradingKasarInput', 'index')->name('GradingKasarInput.index');
    Route::get('/GradingKasarInput/create', 'create')->name('GradingKasarInput.create');
    Route::get('/GradingKasarInput/get_data', 'set')->name('GradingKasarInput.set');
    Route::post('/GradingKasarInput/store', 'store')->name('GradingKasarInput.store');
    Route::post('/GradingKasarInput/sendData', 'sendData')->name('GradingKasarInput.sendData');
    Route::get('/GradingKasarInput/edit/{id}', 'edit')->name('GradingKasarInput.edit');
    Route::put('/GradingKasarInput/update/{id}', 'update')->name('GradingKasarInput.update');
    Route::delete('/GradingKasarInput/destroy/{id}', 'destroy')->name('GradingKasarInput.destroy');
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
    Route::get('/transit_grading_kasar/grading_kasar_hasil', 'index')->name('grading_kasar_hasil.index');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/create', 'create')->name('grading_kasar_hasil.create');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/create_item', 'createItem')->name('grading_kasar_hasil.createItem');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/store', 'store')->name('grading_kasar_hasil.store');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/show/{id}', 'show')->name('grading_kasar_hasil.show');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/edit/{id}', 'edit')->name('grading_kasar_hasil.edit');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/update/{id}', 'update')->name('grading_kasar_hasil.update');
    Route::delete('/transit_grading_kasar/grading_kasar_hasil/destroyInput/{id}', 'destroyInput')->name('grading_kasar_hasil.destroyInput');
    Route::delete('/transit_grading_kasar/grading_kasar_hasil/destroyItem/{id}', 'destroyItem')->name('grading_kasar_hasil.destroyItem');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/getDataSupplier', 'getDataSupplier')->name('grading_kasar_hasil.getDataSupplier');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/getDataJenis', 'getDataJenis')->name('grading_kasar_hasil.getDataJenis');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/simpanData', 'simpanData')->name('grading_kasar_hasil.simpanData');
    Route::post('/transit_grading_kasar/grading_kasar_hasil/simpanDataItem', 'simpanDataItem')->name('grading_kasar_hasil.simpanDataItem');
    Route::get('/transit_grading_kasar/grading_kasar_hasil/get_data_nama_jenis', 'set')->name('gradingKasarHasil.set');
});
Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarStockController::class)->group(function(){
    Route::get('/GradingKasarStock', 'index')->name('GradingKasarStock.index');
    Route::get('/GradingKasarStock/create', 'create')->name('GradingKasarStock.create');
    Route::get('/GradingKasarStock/get_data', 'set')->name('GradingKasarStock.set');
    Route::post('/GradingKasarStock/store', 'store')->name('GradingKasarStock.store');
    Route::post('/GradingKasarStock/sendData', 'sendData')->name('GradingKasarStock.sendData');
    Route::get('/GradingKasarStock/edit/{id}', 'edit')->name('GradingKasarStock.edit');
    Route::put('/GradingKasarStock/update/{id}', 'update')->name('GradingKasarStock.update');
    Route::delete('/GradingKasarStock/destroy/{id}', 'destroy')->name('GradingKasarStock.destroy');
});

Route::controller(App\Http\Controllers\TransitGradingKasar\GradingKasarOutputController::class)->group(function () {
    Route::get('/GradingKasarOutput', 'index')->name('GradingKasarOutput.index');
    Route::get('/GradingKasarOutput/create', 'create')->name('GradingKasarOutput.create');
    Route::post('/GradingKasarOutput/store', 'store')->name('GradingKasarOutput.store');
    Route::post('/GradingKasarOutput/sendData', 'sendData')->name('GradingKasarOutput.sendData');
    Route::delete('/GradingKasarOutput/destroy/{id}', 'destroy')->name('GradingKasarOutput.destroy');
    Route::get('/GradingKasarOutput/get_data_id_box', 'set')->name('GradingKasarOutput.set');
    Route::get('/GradingKasarOutput/get_pcc', 'setpcc')->name('GradingKasarOutput.setpcc');
});

Route::controller(App\Http\Controllers\PreCleaning\PreCleaningInputController::class)->group(function () {
    Route::get('/PreCleaningInput', 'index')->name('PreCleaningInput.index');
    Route::get('/PreCleaningInput/create', 'create')->name('PreCleaningInput.create');
    Route::post('/PreCleaningInput/store', 'store')->name('PreCleaningInput.store');
    Route::post('/PreCleaningInput/sendData', 'sendData')->name('PreCleaningInput.sendData');
    Route::delete('/PreCleaningInput/destroy/{id}', 'destroy')->name('PreCleaningInput.destroy');
    Route::get('/PreCleaningInput/get_data_id_box', 'set')->name('PreCleaningInput.set');
    Route::get('/PreCleaningInput/get_pcc', 'setpcc')->name('PreCleaningInput.setpcc');
});

Route::controller(App\Http\Controllers\TransitGradingKasar\StockTransitGradingKasarController::class)->group(function () {
    Route::get('/StockTransitGradingKasar', 'index')->name('StockTransitGradingKasar.index');
});

Route::controller(App\Http\Controllers\PreCleaning\PreCleaningStockController::class)->group(function () {
    Route::get('/PreCleaningStock', 'index')->name('PreCleaningStock.index');
});

Route::controller(App\Http\Controllers\PreCleaning\PreCleaningOutputController::class)->group(function () {
    Route::get('/pre_cleaning_output', 'index')->name('pre_cleaning_output.index');
    Route::get('/pre_cleaning_output/create', 'create')->name('pre_cleaning_output.create');
    Route::post('/pre_cleaning_output/store', 'store')->name('pre_cleaning_output.store');
    Route::get('/pre_cleaning_output/show/{id}', 'show')->name('pre_cleaning_output.show');
    Route::get('/pre_cleaning_output/edit/{id}', 'edit')->name('pre_cleaning_output.edit');
    Route::put('/pre_cleaning_output/update/{id}', 'update')->name('pre_cleaning_output.update');
    Route::delete('/pre_cleaning_output/destroy/{id}', 'destroy')->name('pre_cleaning_output.destroy');
    Route::get('/pre_cleaning_output/get_data_nomor_job', 'set')->name('preCleaningOutput.set');
    // Route::delete('/pre_cleaning_output/destroy/{id}', 'destroy')->name('pre_cleaning_output.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
