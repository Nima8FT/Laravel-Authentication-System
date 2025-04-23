<?php

use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', action: [LogoutController::class, 'logout'])->name('logout');
    Route::post('delete-account', action: [LogoutController::class, 'deleteAccount'])->name('delete.account');

    //verify mail
    Route::post('email/verification-notification', [MailController::class, 'notification'])->name('verification.send');
    Route::get('email/verify/{id}/{hash}', [MailController::class, 'verify'])->name('verification.verify');
});


Route::group(['middleware' => 'guest'], function () {
    //forgot password
    Route::get('forgot-password-page', [PasswordController::class, 'forgotPasswordPage'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'forgotPasswordNotification'])->name('password.email');
    Route::get('reset-password/{token}', [PasswordController::class, 'resetPasswordPage'])->name('password.reset');
    Route::post('reset-password', [PasswordController::class, 'resetPassword'])->name('password.update');

    //social login
    Route::get('/auth/github/redirect', [SocialLoginController::class, 'redirect'])->name('github.redirect');
    Route::get('/auth/github/callback', [SocialLoginController::class, 'callback'])->name('github.callback');
});
