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
    Route::get('/biayahpp/create', 'create')->name('biaya.create');
    Route::post('/biayahpp/store', 'store')->name('biaya.store');
    Route::get('/biayahpp/show/{id}', 'show')->name('biaya.show');
    Route::get('/biayahpp/edit/{id}', 'edit')->name('biaya.edit');
    Route::put('/biayahpp/update/{id}', 'update')->name('biaya.update');
    Route::delete('/biayahpp/hapus/{id}', 'destroy')->name('biaya.destroy');
});
