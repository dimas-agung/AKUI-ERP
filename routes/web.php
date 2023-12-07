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

Route::get('/', function () {
    return view('welcome');
});

//route resource
// Route::resource('/Mastersupplier', \App\Http\Controllers\MasterSupplierController::class);
Route::controller(App\Http\Controllers\MasterSupplierController::class)->group(function () {
    Route::get('/master_supplier', 'index')->name('master_supplier.index');
    Route::get('/master_supplier/create', 'create')->name('master_supplier.create');
    Route::post('/master_supplier/store', 'store')->name('master_supplier.store');
    Route::get('/master_supplier/show/{id}', 'show')->name('master_supplier.show');
    Route::get('/master_supplier/edit{id}', 'edit')->name('master_supplier.edit');
    Route::put('/master_supplier/update{id}', 'update')->name('master_supplier.update');
    Route::delete('/master_supplier/destroy{id}', 'destroy')->name('master_supplier.destroy');
});

Route::controller(App\Http\Controllers\MasterJenisController::class)->group(function () {
    Route::get('/master_jenis', 'index')->name('master_jenis.index');
    Route::get('/master_jenis/create', 'create')->name('master_jenis.create');
    Route::post('/master_jenis/store', 'store')->name('master_jenis.store');
    Route::get('/master_jenis/show/{id}', 'show')->name('master_jenis.show');
    Route::get('/master_jenis/edit{id}', 'edit')->name('master_jenis.edit');
    Route::put('/master_jenis/update{id}', 'update')->name('master_jenis.update');
    Route::delete('/master_jenis/destroy{id}', 'destroy')->name('master_jenis.destroy');
});
