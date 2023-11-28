<?php

use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login.index');
        Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
        Route::get('/forgot-password', [ForgotController::class, 'index'])->name('forgot.index');
        Route::post('/forgot-password/send', [ForgotController::class, 'send'])->name('forgot.send');
        Route::get('/reset-password', [ResetController::class, 'index'])->name('reset.index');
        Route::post('/reset-password/recovery', [ResetController::class, 'recovery'])->name('reset.recovery');
    });
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::resource('users', UserController::class);

    Route::prefix('auth')->group(function () {
        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
