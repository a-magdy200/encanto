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
Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/create', [App\Http\Controllers\AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/attendance/{attendance}/edit', [App\Http\Controllers\AttendanceController::class, 'edit'])->name('attendance.edit');
Route::put('/attendance/{attendance}/', [App\Http\Controllers\AttendanceController::class, 'update'])->name('attendance.update');
Route::delete('/attendance/{attendance}/', [App\Http\Controllers\AttendanceController::class, 'delete'])->name('attendance.delete');
Route::get('/coaches', [App\Http\Controllers\CoachController::class, 'index'])->name('coaches.index');
Route::get('/coaches/create', [App\Http\Controllers\CoachController::class, 'create'])->name('coaches.create');
Route::post('/coaches/store', [App\Http\Controllers\CoachController::class, 'store'])->name('coaches.store');
Route::get('/coaches/{coach}/edit', [App\Http\Controllers\CoachController::class, 'edit'])->name('coaches.edit');
Route::get('/coaches/{coach}/show', [App\Http\Controllers\CoachController::class, 'show'])->name('coaches.show');
Route::put('/coaches/{coach}/', [App\Http\Controllers\CoachController::class, 'update'])->name('coaches.update');
Route::delete('/coaches/{coach}/', [App\Http\Controllers\CoachController::class, 'delete'])->name('coaches.delete');
Auth::routes();
