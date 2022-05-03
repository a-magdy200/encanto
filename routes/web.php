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
    return view('layouts.app');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('home');
Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'index'])->name('gymmanagers.index');
Route::get('/gymmanagers/create/', [App\Http\Controllers\GymManagerController::class, 'create'])->name('gymmanagers.create');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');
Route::get('/gymmanagers/{gymmanagerid}/edit', [App\Http\Controllers\GymManagerController::class, 'edit'])->name('gymmanagers.edit');
Route::get('/gymmanagers/{gymmanagerid}', [App\Http\Controllers\GymManagerController::class, 'show'])->name('gymmanagers.show');
Route::put('/gymmanagers/{gymmanagerid}', [App\Http\Controllers\GymManagerController::class, 'update'])->name('gymmanagers.update');
Route::post('gymmanagers/create', [App\Http\Controllers\GymManagerController::class, 'store'])->name('gymmanagers.store');

Auth::routes();
