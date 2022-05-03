<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('home');
Route::get('/table/citymanagers', [CityManagerController::class, 'index'])->name('citymanagers.index');
Route::get('/table/citymanagers/{citymanager}', [CityManagerController::class, 'show'])->name('citymanagers.show');
Route::get('/table/citymanagers/create', [CityManagerController::class, 'create'])->name('citymanagers.create');
Route::post('/table/citymanagers', [CityManagerController::class, 'store'])->name('citymanagers.store');
Route::get('/table/citymanagers/{citymanager}/edit', [CityManagerController::class, 'edit'])->name('citymanagers.edit');
Route::put('/table/citymanagers/{citymanager}', [CityManagerController::class, 'update'])->name('citymanagers.update');
Route::delete('/table/citymanagers/{citymanager}',[CityManagerController::class,'destroy'])->name('citymanagers.destroy');
//Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
//Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');
Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');

Auth::routes();
