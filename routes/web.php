<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingPackageController;
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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/table', [TrainingPackageController::class, 'index'])->name('packages.index');
Route::get('/packages/create/', [TrainingPackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [TrainingPackageController::class, 'store'])->name('packages.store');
Route::get('/packages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('packages.edit');
Route::put('/packages/{package}', [TrainingPackageController::class, 'update'])->name('packages.update');
Route::get('/packages/{package}/danger', [TrainingPackageController::class, 'delete'])->name('packages.delete');
Route::delete('/packages/{package}', [TrainingPackageController::class, 'destroy'])->name('packages.destroy');
Route::get('/packages/{package}', [TrainingPackageController::class, 'show'])->name('packages.show');
Auth::routes();
