<?php

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\ClientController;
use App\Http\Controllers\Apis\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/Clients',[AuthController::class,'show'])->name('Clients');

Route::post('/register',[AuthController::class,'register'])->name('register');

Route::post('/login',[AuthController::class,'login'])->name('api.login');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}',  [VerificationController::class, 'verify'])
->middleware(['signed', 'throttle:6,1'])
->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');


/////////////////////////////////////////////////////////////////////////////////
Route::group(['prefix'=>'profile','middleware'=>['auth:sanctum','verified']],function(){
    Route::get('/{id}',[ClientController::class,'index']);
    Route::put('/{id}/edit',[ClientController::class,'edit']);


});

