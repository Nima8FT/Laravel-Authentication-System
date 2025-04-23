<?php

use App\Http\Controllers\Auth\BrowseSessionController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorAuthenticationController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('2fa')->name('dashboard');

    Route::post('logout', action: [LogoutController::class, 'logout'])->name('logout');
    Route::post('delete-account', action: [LogoutController::class, 'deleteAccount'])->name('delete.account');
    Route::post('logout-other-device', [LogoutController::class, 'logoutOtherDevice'])->name('logout.other.device');

    //verify mail
    Route::post('email/verification-notification', [MailController::class, 'notification'])->name('verification.send');
    Route::get('email/verify/{id}/{hash}', [MailController::class, 'verify'])->name('verification.verify');

    //verify two factor authentication
    Route::get('enable-2fa-show', [TwoFactorAuthenticationController::class, 'enable2FAShow'])->name('enable.2fa.show');
    Route::post('enable-2fa', [TwoFactorAuthenticationController::class, 'enable2FA'])->name('enable.2fa');
    Route::post('disable-2fa', [TwoFactorAuthenticationController::class, 'disable2FA'])->name('disable.2fa');
    Route::get('secret-code-show', [TwoFactorAuthenticationController::class, 'secretCodeShow'])->name('secret.code.show');
    Route::post('secret-code', [TwoFactorAuthenticationController::class, 'secretCode'])->name('secret.code');

    //profile
    Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    //change password in profile
    Route::get('change-password', [PasswordController::class, 'changePasswordPage'])->name('change.password.show');
    Route::post('change-password', [PasswordController::class, 'changePassword'])->name('change.password');

    //browse session
    Route::get('browse-session', [BrowseSessionController::class, 'browseSession'])->name('browse.session');
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
