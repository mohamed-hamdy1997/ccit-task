<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('user.homePage');
});

Route::get('/admin-login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/login', function () {
    return view('users.auth.login');
})->name('user.login.view');

Route::get('/signup', function () {
    return view('users.auth.signup');
})->name('user.signup.view');

Route::post('admin-login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.submitLogin');
Route::post('signup', [\App\Http\Controllers\User\AuthController::class, 'signup'])->name('user.signup')->middleware(['throttle:5,10']);
Route::post('login-otp', [\App\Http\Controllers\User\AuthController::class, 'sendLoginOtp'])->name('user.login.otp')->middleware(['throttle:5,10']);
Route::post('login', [\App\Http\Controllers\User\AuthController::class, 'login'])->name('user.login');


Route::group(['middleware' => ['admin']], function () {
    Route::get('admin-logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'getAllUsers'])->name('admin.getAllUsers');
    Route::delete('user/{userId}', [\App\Http\Controllers\Admin\UserController::class, 'deleteUser'])->name('admin.deleteUser');
});

Route::group(['middleware' => ['user']], function () {
    Route::get('logout', [\App\Http\Controllers\User\AuthController::class, 'logout'])->name('user.logout');
    Route::get('home', [\App\Http\Controllers\User\HomeController::class, 'homePage'])->name('user.homePage');
});

Route::get('payment/subscribe-to-plan/{planId}', [\App\Http\Controllers\User\SubscriptionController::class, 'subscribeToPlan'])->name('user.subscribeToPlan');
