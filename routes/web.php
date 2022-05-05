<?php

    use App\Http\Controllers\AttendanceController;
    use App\Http\Controllers\CityController;
    use App\Http\Controllers\CityManagerController;
    use App\Http\Controllers\ClientController;
    use App\Http\Controllers\CoachController;
    use App\Http\Controllers\GymController;
    use App\Http\Controllers\GymManagerController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\TrainingPackageController;
    use App\Http\Controllers\TrainingSessionController;
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
Route::group(['middleware' => ['web']], function () {
    // Route::get('/table', [HomeController::class, 'table'])->name('home');
    Route::get('/gymmanagers/create/', [GymManagerController::class, 'create'])->name('gymmanagers.create');
    Route::get('/gymmanagers/{gymmanagerid}/edit', [GymManagerController::class, 'edit'])->name('gymmanagers.edit');
    Route::get('/gymmanagers/{gymmanagerid}', [GymManagerController::class, 'show'])->name('gymmanagers.show');
    Route::put('/gymmanagers/{gymmanagerid}', [GymManagerController::class, 'update'])->name('gymmanagers.update');
    Route::post('gymmanagers/create', [GymManagerController::class, 'store'])->name('gymmanagers.store');
    Route::get('/gymmanagers', [GymManagerController::class, 'index'])->name('gymmanagers.index');
    Route::delete('/gymmanagers/{gymmanagerid}/delete', [GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');



    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::get('/clients/{client}/show', [ClientController::class, 'show'])->name('clients.show');
    Route::put('/clients/{client}/', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}/', [ClientController::class, 'delete'])->name('clients.delete');



    Route::get('/coaches', [CoachController::class, 'index'])->name('coaches.index');
    Route::get('/coaches/create', [CoachController::class, 'create'])->name('coaches.create');
    Route::post('/coaches/store', [CoachController::class, 'store'])->name('coaches.store');
    Route::get('/coaches/{coach}/edit', [CoachController::class, 'edit'])->name('coaches.edit');
    Route::get('/coaches/{coach}/show', [CoachController::class, 'show'])->name('coaches.show');
    Route::put('/coaches/{coach}/', [CoachController::class, 'update'])->name('coaches.update');
    Route::delete('/coaches/{coach}', [CoachController::class, 'delete'])->name('coaches.delete');


    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
    Route::put('/attendance/{attendance}/', [AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{attendance}/', [AttendanceController::class, 'delete'])->name('attendance.delete');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::delete('/orders/{id}/delete', [OrderController::class, 'delete'])->name('orders.delete');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.info');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/editpass', [ProfileController::class, 'editpass'])->name('profile.editpass');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/updatepass', [ProfileController::class, 'updatepass'])->name('profile.updatepass');


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


    Route::get('/citymanagers', [CityManagerController::class, 'index'])->name('citymanagers.index');
    Route::get('/citymanagers/{citymanager}', [CityManagerController::class, 'show'])->name('citymanagers.show');
    Route::get('/citymanagers/create', [CityManagerController::class, 'create'])->name('citymanagers.create');
    Route::post('/citymanagers', [CityManagerController::class, 'store'])->name('citymanagers.store');
    Route::get('/citymanagers/{citymanager}/edit', [CityManagerController::class, 'edit'])->name('citymanagers.edit');
    Route::put('/citymanagers/{citymanager}', [CityManagerController::class, 'update'])->name('citymanagers.update');
    Route::delete('/citymanagers/{citymanager}', [CityManagerController::class, 'destroy'])->name('citymanagers.destroy');

    Route::get('/packages/create/', [TrainingPackageController::class, 'create'])->name('packages.create');
    Route::get('/packages/purchase', [TrainingPackageController::class, 'purchase'])->name('packages.purchase');
    Route::post('/packages/order', [TrainingPackageController::class, 'order'])->name('packages.order');
    Route::get('/packages', [TrainingPackageController::class, 'index'])->name('packages.index');
    Route::post('/packages', [TrainingPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [TrainingPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}/danger', [TrainingPackageController::class, 'delete'])->name('packages.delete');
    Route::get('/packages/{package}', [TrainingPackageController::class, 'show'])->name('packages.show');

    Route::get('/trainingSessions', [TrainingSessionController::class, 'index'])->name('trainingSessions.index');
    Route::get('/trainingSessions/create', [TrainingSessionController::class, 'create'])->name('trainingSessions.create');
    Route::post('/trainingSessions', [TrainingSessionController::class, 'store'])->name('trainingSessions.store');
    Route::put('/trainingSessions/update/{id}', [TrainingSessionController::class, 'update'])->name('trainingSessions.update');
    Route::get('/trainingSessions/{id}', [TrainingSessionController::class, 'show'])->name('trainingSessions.show');
    Route::get('/trainingSessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('trainingSessions.edit');
    Route::delete('/trainingSessions/{id}/delete', [TrainingSessionsController::class, 'delete'])->name('trainingSessions.delete');
});
Auth::routes();
