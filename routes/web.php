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

Route::controller(App\Http\Controllers\MasterSupplierController::class)->group(function () {
    Route::get('/Mastersupplier', 'index')->name('MasterSupplier.index');
    Route::get('/MasterSupplier/create', 'create')->name('MasterSupplier.create');
});

Route::controller(App\Http\Controllers\MasterJenisController::class)->group(function () {
    Route::get('/Masterjenis', 'index')->name('MasterJenis.index');
    Route::get('/MasterJenis/create', 'create')->name('MasterJenis.create');
});

Route::controller(App\Http\Controllers\MasterJenisController::class)->group(function () {
    Route::get('/Mastertujuan', 'index')->name('MasterTujuan.index');
    Route::get('/MasterTujuan/create', 'create')->name('MasterTujuan.create');
});
