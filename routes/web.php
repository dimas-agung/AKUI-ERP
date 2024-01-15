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

//route resource
// Route::resource('/Mastersupplier', \App\Http\Controllers\MasterSupplierController::class);
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

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialInputController::class)->group(function () {
    Route::get('/purchasing_exim/prm_raw_material_input', 'index')->name('prm_raw_material_input.index');
    Route::get('/purchasing_exim/prm_raw_material_input/create', 'create')->name('prm_raw_material_input.create');
    Route::get('/purchasing_exim/prm_raw_material_input/create_item', 'createItem')->name('prm_raw_material_input.createItem');
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
Route::controller(App\Http\Controllers\PurchasingExim\StockTransitRawMaterialController::class)->group(function () {
    Route::get('/StockTransitGradingKasar', 'index')->name('StockTransitGradingKasar.index');
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

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
