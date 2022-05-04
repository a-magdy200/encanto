<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityManagerController;
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
Route::get('/test', [\App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/citymanagers', [CityManagerController::class, 'index'])->name('citymanagers.index');
Route::get('/home/citymanagers/create', [CityManagerController::class, 'create'])->name('citymanagers.create');
Route::post('/home/citymanagers', [CityManagerController::class, 'store'])->name('citymanagers.store');
Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');
Route::get('/home/citymanagers/{citymanager}/edit', [CityManagerController::class, 'edit'])->name('citymanagers.edit');
Route::put('/home/citymanagers/{citymanager}', [CityManagerController::class, 'update'])->name('citymanagers.update');
Route::delete('/home/citymanagers/{citymanager}',[CityManagerController::class,'destroy'])->name('citymanagers.destroy');
Route::get('/home/citymanagers/{citymanager}', [CityManagerController::class, 'show'])->name('citymanagers.show');

Auth::routes();
