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
    Route::get('/master_supplier_raw_material/edit{id}', 'edit')->name('master_supplier_raw_material.edit');
    Route::put('/master_supplier_raw_material/update{id}', 'update')->name('master_supplier_raw_material.update');
    Route::delete('/master_supplier_raw_material/destroy{id}', 'destroy')->name('master_supplier_raw_material.destroy');
});

Route::controller(App\Http\Controllers\MasterJenisRawMaterialController::class)->group(function () {
    Route::get('/master_jenis_raw_material', 'index')->name('master_jenis_raw_material.index');
    Route::get('/master_jenis_raw_material/create', 'create')->name('master_jenis_raw_material.create');
    Route::post('/master_jenis_raw_material/store', 'store')->name('master_jenis_raw_material.store');
    Route::get('/master_jenis_raw_material/show/{id}', 'show')->name('master_jenis_raw_material.show');
    Route::get('/master_jenis_raw_material/edit{id}', 'edit')->name('master_jenis_raw_material.edit');
    Route::put('/master_jenis_raw_material/update{id}', 'update')->name('master_jenis_raw_material.update');
    Route::delete('/master_jenis_raw_material/destroy{id}', 'destroy')->name('master_jenis_raw_material.destroy');
});

Route::controller(App\Http\Controllers\MasterTujuanKirimRawMaterialController::class)->group(function () {
    Route::get('/master_tujuan_kirim_raw_material', 'index')->name('master_tujuan_kirim_raw_material.index');
    Route::get('/master_tujuan_kirim_raw_material/create', 'create')->name('master_tujuan_kirim_raw_material.create');
    Route::post('/master_tujuan_kirim_raw_material/store', 'store')->name('master_tujuan_kirim_raw_material.store');
    Route::get('/master_tujuan_kirim_raw_material/show/{id}', 'show')->name('master_tujuan_kirim_raw_material.show');
    Route::get('/master_tujuan_kirim_raw_material/edit{id}', 'edit')->name('master_tujuan_kirim_raw_material.edit');
    Route::put('/master_tujuan_kirim_raw_material/update{id}', 'update')->name('master_tujuan_kirim_raw_material.update');
    Route::delete('/master_tujuan_kirim_raw_material/destroy{id}', 'destroy')->name('master_tujuan_kirim_raw_material.destroy');
});

Route::controller(App\Http\Controllers\PurchasingExim\StockTransitGradingKasarController::class)->group(function () {
    Route::get('/StockTransitGradingKasar', 'index')->name('StockTransitGradingKasar.index');
    Route::get('/StockTransitGradingKasar/create', 'create')->name('StockTransitGradingKasar.create');
    Route::post('/StockTransitGradingKasar/store', 'store')->name('StockTransitGradingKasar.store');
    Route::get('/StockTransitGradingKasar/show/{id}', 'show')->name('StockTransitGradingKasar.show');
    Route::get('/StockTransitGradingKasar/edit{id}', 'edit')->name('StockTransitGradingKasar.edit');
    Route::put('/StockTransitGradingKasar/update{id}', 'update')->name('StockTransitGradingKasar.update');
    Route::delete('/StockTransitGradingKasar/destroy{id}', 'destroy')->name('StockTransitGradingKasar.destroy');
});

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialOutputHeaderController::class)->group(function () {
    Route::get('/PrmRawMaterialOutputHeader', 'index')->name('PrmRawMaterialOutputHeader.index');
    Route::get('/PrmRawMaterialOutputHeader/create', 'create')->name('PrmRawMaterialOutputHeader.create');
    Route::post('/PrmRawMaterialOutputHeader/store', 'store')->name('PrmRawMaterialOutputHeader.store');
    Route::get('/PrmRawMaterialOutputHeader/show/{id}', 'show')->name('PrmRawMaterialOutputHeader.show');
    Route::get('/PrmRawMaterialOutputHeader/edit{id}', 'edit')->name('PrmRawMaterialOutputHeader.edit');
    Route::put('/PrmRawMaterialOutputHeader/update{id}', 'update')->name('PrmRawMaterialOutputHeader.update');
    Route::delete('/PrmRawMaterialOutputHeader/destroy{id}', 'destroy')->name('PrmRawMaterialOutputHeader.destroy');
});

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialOutputItemController::class)->group(function () {
    Route::get('/PrmRawMaterialOutputItem', 'index')->name('PrmRawMaterialOutputItem.index');
    Route::get('/PrmRawMaterialOutputItem/create', 'create')->name('PrmRawMaterialOutputItem.create');
    Route::post('/PrmRawMaterialOutputItem/store', 'store')->name('PrmRawMaterialOutputItem.store');
    Route::get('/PrmRawMaterialOutputItem/show/{id}', 'show')->name('PrmRawMaterialOutputItem.show');
    Route::get('/PrmRawMaterialOutputItem/edit{id}', 'edit')->name('PrmRawMaterialOutputItem.edit');
    Route::put('/PrmRawMaterialOutputItem/update{id}', 'update')->name('PrmRawMaterialOutputItem.update');
    Route::delete('/PrmRawMaterialOutputItem/destroy{id}', 'destroy')->name('PrmRawMaterialOutputItem.destroy');
});

Route::controller(App\Http\Controllers\PurchasingExim\PrmRawMaterialOutputController::class)->group(function () {
    Route::get('/PrmRawMaterialOutput', 'index')->name('PrmRawMaterialOutput.index');
    Route::get('/PrmRawMaterialOutput/create', 'create')->name('PrmRawMaterialOutput.create');
    Route::post('/PrmRawMaterialOutput/store', 'store')->name('PrmRawMaterialOutput.store');
    Route::get('/PrmRawMaterialOutput/show/{id}', 'show')->name('PrmRawMaterialOutput.show');
    Route::get('/PrmRawMaterialOutput/edit{id}', 'edit')->name('PrmRawMaterialOutput.edit');
    Route::put('/PrmRawMaterialOutput/update{id}', 'update')->name('PrmRawMaterialOutput.update');
    Route::delete('/PrmRawMaterialOutput/destroy{id}', 'destroy')->name('PrmRawMaterialOutput.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
