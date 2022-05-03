<?php

    use App\Http\Controllers\CityManagerController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\GymManagerController;
    use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingSessionController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/table', [HomeController::class, 'table'])->name('home');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

Route::get('/citymanagers', [CityManagerController::class, 'index'])->name('citymanagers.index');
Route::get('/citymanagers/{citymanager}', [CityManagerController::class, 'show'])->name('citymanagers.show');
Route::get('/citymanagers/create', [CityManagerController::class, 'create'])->name('citymanagers.create');
Route::post('/citymanagers', [CityManagerController::class, 'store'])->name('citymanagers.store');
Route::get('/citymanagers/{citymanager}/edit', [CityManagerController::class, 'edit'])->name('citymanagers.edit');
Route::put('/citymanagers/{citymanager}', [CityManagerController::class, 'update'])->name('citymanagers.update');
Route::delete('/citymanagers/{citymanager}',[CityManagerController::class,'destroy'])->name('citymanagers.destroy');
//Route::get('/gymmanagers', [App\Http\Controllers\GymManagerController::class, 'table'])->name('gymmanagers.index');
//Route::delete('/gymmanagers/{gymmanagerid}/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');
Route::get('/gymmanagers', [GymManagerController::class, 'table'])->name('gymmanagers.index');
Route::delete('/gymmanagers/{gymmanagerid}/delete', [GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');

Route::get('/packages/create/', [TrainingPackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [TrainingPackageController::class, 'store'])->name('packages.store');
Route::get('/packages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('packages.edit');
Route::put('/packages/{package}', [TrainingPackageController::class, 'update'])->name('packages.update');
Route::get('/packages/{package}/danger', [TrainingPackageController::class, 'delete'])->name('packages.delete');
Route::delete('/packages/{package}', [TrainingPackageController::class, 'destroy'])->name('packages.destroy');
Route::get('/packages/{package}', [TrainingPackageController::class, 'show'])->name('packages.show');

Route::get('/trainingSessions', [TrainingSessionController::class, 'index'])->name('trainingSessions.index');
Route::get('/trainingSessions/create', [TrainingSessionController::class, 'create'])->name('trainingSessions.create');
Route::post('/trainingSessions', [TrainingSessionController::class, 'store'])->name('trainingSessions.store');
Route::put('/trainingSessions/update/{id}', [TrainingSessionController::class, 'update'])->name('trainingSessions.update');
Route::get('/trainingSessions/{id}', [TrainingSessionController::class, 'show'])->name('trainingSessions.show');
Route::get('/trainingSessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('trainingSessions.edit');
Auth::routes();
