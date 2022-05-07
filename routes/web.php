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
    use App\Http\Controllers\RevenueController;
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
    return view('welcome');
});
Route::get('/test', [HomeController::class, 'test'])->name('test');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['web', 'auth']], function () {
    // Route::get('/table', [HomeController::class, 'table'])->name('home');
    Route::get('/gym-managers/create/', [GymManagerController::class, 'create'])->name('gym-managers.create');
    Route::get('/gym-managers/{gymManager}/ban', [GymManagerController::class, 'ban'])->name('gym-managers.ban');
    Route::get('/gym-managers/{gymManager}/approve', [GymManagerController::class, 'approve'])->name('gym-managers.approve');

    Route::get('/gym-managers/{gymManager}/edit', [GymManagerController::class, 'edit'])->name('gym-managers.edit');
    Route::get('/gym-managers/{gymManager}', [GymManagerController::class, 'show'])->name('gym-managers.show');
    Route::put('/gym-managers/{gymManager}', [GymManagerController::class, 'update'])->name('gym-managers.update');
    Route::post('gym-managers/create', [GymManagerController::class, 'store'])->name('gym-managers.store');
    Route::get('/gym-managers', [GymManagerController::class, 'index'])->name('gym-managers.index')->middleware('forbid-banned-user');
    Route::delete('/gym-managers/{gymManager}/delete', [GymManagerController::class, 'destroy'])->name('gym-managers.destroy');

    Route::get('/revenues', [RevenueController::class, 'index'])->name('revenues.admin');



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
    Route::get('/coaches/{coach}', [CoachController::class, 'show'])->name('coaches.show');
    Route::put('/coaches/{coach}', [CoachController::class, 'update'])->name('coaches.update');
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
    Route::get('/profile/edit-password', [ProfileController::class, 'editPassword'])->name('profile.edit-pass');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatepass');


    Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');
    Route::get('/gyms/create', [GymController::class, 'create'])->name('gyms.create');
    Route::post('/gyms', [GymController::class, 'store'])->name('gyms.store');
    Route::get('/gyms/{gym}/edit', [GymController::class, 'edit'])->name('gyms.edit');
    Route::get('/gyms/{gym}', [GymController::class, 'show'])->name('gyms.show');
    Route::put('/gyms/{gym}', [GymController::class, 'update'])->name('gyms.update');
    Route::delete('/gyms/{gym}', [GymController::class, 'destroy'])->name('gyms.destroy');


    /////////////////// City Routes ///////////

    Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
    Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
    Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');
    Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');
    Route::get('/cities/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{city}/update', [CityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{city}/delete', [CityController::class, 'destroy'])->name('cities.destroy');


    Route::get('/city-managers', [CityManagerController::class, 'index'])->name('city-managers.index');
    Route::get('/city-managers/create', [CityManagerController::class, 'create'])->name('city-managers.create');
    Route::post('/city-managers', [CityManagerController::class, 'store'])->name('city-managers.store');
    Route::get('/city-managers/{cityManager}/edit', [CityManagerController::class, 'edit'])->name('city-managers.edit');
    Route::put('/city-managers/{cityManager}', [CityManagerController::class, 'update'])->name('city-managers.update');
    Route::delete('/city-managers/{cityManager}', [CityManagerController::class, 'destroy'])->name('city-managers.destroy');
    Route::get('/city-managers/{cityManager}', [CityManagerController::class, 'show'])->name('city-managers.show');
    Route::get('/city-managers/{cityManager}/approve', [CityManagerController::class, 'approve'])->name('city-managers.approve');


    Route::get('/packages/create/', [TrainingPackageController::class, 'create'])->name('packages.create');
    Route::get('/packages/purchase', [TrainingPackageController::class, 'purchase'])->name('packages.purchase');
    Route::post('/packages/order', [TrainingPackageController::class, 'order'])->name('packages.order');
    Route::get('/packages', [TrainingPackageController::class, 'index'])->name('packages.index');
    Route::post('/packages', [TrainingPackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [TrainingPackageController::class, 'edit'])->name('packages.edit');
    Route::put('/packages/{package}', [TrainingPackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}/danger', [TrainingPackageController::class, 'delete'])->name('packages.delete');
    Route::get('/packages/ajax', [TrainingPackageController::class, 'ajax'])->name('packages.ajax');
    Route::get('/packages/{package}', [TrainingPackageController::class, 'show'])->name('packages.show');


    Route::get('/training-sessions', [TrainingSessionController::class, 'index'])->name('training-sessions.index');
    Route::get('/training-sessions/create', [TrainingSessionController::class, 'create'])->name('training-sessions.create');
    Route::post('/training-sessions', [TrainingSessionController::class, 'store'])->name('training-sessions.store');
    Route::put('/training-sessions/update/{trainingSession}', [TrainingSessionController::class, 'update'])->name('training-sessions.update');
    Route::get('/training-sessions/{trainingSession}', [TrainingSessionController::class, 'show'])->name('training-sessions.show');
    Route::get('/training-sessions/{trainingSession}/edit', [TrainingSessionController::class, 'edit'])->name('training-sessions.edit');
    Route::delete('/training-sessions/{trainingSession}', [TrainingSessionController::class, 'delete'])->name('training-sessions.delete');
    Route::get('/ajax', [TrainingSessionController::class, 'ajax'])->name('training-sessions.ajax');
});
Auth::routes();
