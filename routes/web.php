<?php

    use App\Http\Controllers\AttendanceController;
    use App\Http\Controllers\CityController;
    use App\Http\Controllers\CityManagerController;
    use App\Http\Controllers\GymController;
    use App\Http\Controllers\GymManagerController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\TrainingPackageController;
    use App\Http\Controllers\TrainingSessionController;
    use Illuminate\Support\Facades\Auth;
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
Route::delete('/coaches/{coach}', [App\Http\Controllers\CoachController::class, 'delete'])->name('coaches.delete');
Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
Route::post('/clients/store', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}/edit', [App\Http\Controllers\ClientController::class, 'edit'])->name('clients.edit');
Route::get('/clients/{client}/show', [App\Http\Controllers\ClientController::class, 'show'])->name('clients.show');
Route::put('/clients/{client}/', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}/', [App\Http\Controllers\ClientController::class, 'delete'])->name('clients.delete');
Route::group(['middleware' => ['web']], function () {
    // Route::get('/table', [App\Http\Controllers\HomeController::class, 'table'])->name('home');
    Route::get('/gymmanagers/create/', [GymManagerController::class, 'create'])->name('gymmanagers.create');
    Route::get('/gymmanagers/{gymmanagerid}/edit', [GymManagerController::class, 'edit'])->name('gymmanagers.edit');
    Route::get('/gymmanagers/{gymmanagerid}', [GymManagerController::class, 'show'])->name('gymmanagers.show');
    Route::put('/gymmanagers/{gymmanagerid}', [GymManagerController::class, 'update'])->name('gymmanagers.update');
    Route::post('gymmanagers/create', [GymManagerController::class, 'store'])->name('gymmanagers.store');
    Route::get('/gymmanagers', [GymManagerController::class, 'index'])->name('gymmanagers.index');
    Route::delete('/gymmanagers/{gymmanagerid}/delete', [GymManagerController::class, 'destroy'])->name('gymmanagers.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.info');

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
    Route::get('/packages/{package}/danger', [TrainingPackageController::class, 'delete'])->name('packages.delete');
    Route::get('/packages/{package}', [TrainingPackageController::class, 'show'])->name('packages.show');

    Route::get('/trainingSessions', [TrainingSessionController::class, 'index'])->name('trainingSessions.index');
    Route::get('/trainingSessions/create', [TrainingSessionController::class, 'create'])->name('trainingSessions.create');
    Route::post('/trainingSessions', [TrainingSessionController::class, 'store'])->name('trainingSessions.store');
    Route::put('/trainingSessions/update/{id}', [TrainingSessionController::class, 'update'])->name('trainingSessions.update');
    Route::get('/trainingSessions/{id}', [TrainingSessionController::class, 'show'])->name('trainingSessions.show');
    Route::get('/trainingSessions/{id}/edit', [TrainingSessionController::class, 'edit'])->name('trainingSessions.edit');
    Route::delete('/trainingSessions/{id}/delete', [TrainingSessionController::class, 'delete'])->name('trainingSessions.delete');
});
Auth::routes();
