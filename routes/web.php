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
    Route::get('/unit', 'index')->name('unit.index');
});
