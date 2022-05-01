<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingSessionController;
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
Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');
Route::get('/trainingSessions', [TrainingSessionController::class, 'index'])->name('trainingSessions.index');
Route::get('/trainingSessions/create', [TrainingSessionController::class, 'create'])->name('trainingSessions.create');
Route::post('/trainingSessions', [TrainingSessionController::class, 'store'])->name('trainingSessions.store');
Route::put('/trainingSessions/update/{id}', [TrainingSessionController::class, 'update'])->name('trainingSessions.update');
Route::get('/trainingSessions/{id}', [TrainingSessionController::class, 'show'])->name('trainingSessions.show');
Route::get('/trainingSessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('trainingSessions.edit');
Auth::routes();
