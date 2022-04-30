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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('home');
Route::get('/table/citymanagers', [CityManagerController::class, 'index'])->name('cityManagers.index');
//Route::get('/table/cityManagers/{cityManager}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth']);
//Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
//Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');

Auth::routes();
