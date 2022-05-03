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
Route::get('/test', [\App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/table',  [App\Http\Controllers\HomeController::class, 'table'])->name('home');
Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');

Auth::routes();
