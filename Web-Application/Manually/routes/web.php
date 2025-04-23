<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
