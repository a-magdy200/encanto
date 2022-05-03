<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageContent\CityController;
use App\Http\Controllers\PageContent\GymController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/gyms', [GymController::class, 'showGyms'])->name('show.AllGyms');
Route::get('/gyms/show', [GymController::class, 'showGymForm'])->name('show.gymForm');
Route::post('/gyms/create', [GymController::class, 'createGymForm'])->name('create.gymForm');
Route::get('/gyms/show/{gymId}', [GymController::class, 'showSingleGym'])->name('show.singleGym');
Route::get('/gyms/edit/{gymId}', [GymController::class, 'editGymForm'])->name('edit.gymForm');
Route::put('/gyms/update/{gymId}', [GymController::class, 'updateGymForm'])->name('update.gymForm');
Route::delete('/gyms/delete/{gymId}', [GymController::class, 'deleteGym'])->name('delete.gym');

/////////////////// City Routes ///////////

Route::get('/cities', [CityController::class, 'showCities'])->name('show.cities');
Route::get('/cities/show', [CityController::class, 'showCreateCity'])->name('show.addCity');
Route::post('/cities/create', [CityController::class, 'createCity'])->name('create.city');
Route::get('/cities/show/{cityId}', [CityController::class, 'showSingleCity'])->name('show.singleCity');
Route::get('/cities/edit/{cityId}', [CityController::class, 'editCity'])->name('edit.city');
Route::put('/cities/update/{cityId}', [CityController::class, 'updateCity'])->name('update.city');
Route::delete('/cities/delete/{cityId}', [CityController::class, 'deleteCity'])->name('delete.city');






Auth::routes();
