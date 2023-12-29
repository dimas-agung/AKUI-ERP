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

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialStockController::class)->group(function () {
    Route::get('/purchasing_exim/prm_raw_material_stock', 'index')->name('purchasing_exim.prm_raw_material_stock.index');
    Route::get('/purchasing_exim/prm_raw_material_stock_history', 'show')->name('prm_raw_material_stock_history.show');
});
Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialStockHistoryController::class)->group(function () {
    // Route::get('/purchasing_exim/prm_raw_material_stock', 'index')->name('purchasing_exim.prm_raw_material_stock.index');
    Route::get('/purchasing_exim/prm_raw_material_stock_history', 'show')->name('prm_raw_material_stock_history.show');
});

Route::controller(App\Http\Controllers\PurchasingExim\StockTransitGradingKasarController::class)->group(function () {
    Route::get('/StockTransitGradingKasar', 'index')->name('StockTransitGradingKasar.index');
    Route::get('/StockTransitGradingKasar/create', 'create')->name('StockTransitGradingKasar.create');
    Route::post('/StockTransitGradingKasar/store', 'store')->name('StockTransitGradingKasar.store');
    Route::get('/StockTransitGradingKasar/show/{id}', 'show')->name('StockTransitGradingKasar.show');
    Route::get('/StockTransitGradingKasar/edit/{id}', 'edit')->name('StockTransitGradingKasar.edit');
    Route::put('/StockTransitGradingKasar/update/{id}', 'update')->name('StockTransitGradingKasar.update');
    Route::delete('/StockTransitGradingKasar/destroy/{id}', 'destroy')->name('StockTransitGradingKasar.destroy');
});

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
    // routes/web.php
    Route::get('/PrmRawMaterialOutput/get_data_id_box', 'set')->name('PrmRawMaterialOutput.set');
    Route::get('/PrmRawMaterialOutput/get_pcc', 'setpcc')->name('PrmRawMaterialOutput.setpcc');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
