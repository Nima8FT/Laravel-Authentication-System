<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\DeleteAccountController;
use App\Http\Controllers\API\Auth\Mail\VerifyMailController;
use App\Http\Controllers\API\Auth\Password\ResetPasswordController;
use App\Http\Controllers\API\Auth\Mail\SendMailNotificationController;
use App\Http\Controllers\API\Auth\Password\SendPasswordNotificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('deleteAccount', [DeleteAccountController::class, 'deleteAccount'])->name('deleteAccount');

    //verified email route
    Route::post('email/verification-notification', [SendMailNotificationController::class, 'sendNotification'])->name('mail.notification');
    Route::post('email/verify/{id}/{hash}', [VerifyMailController::class, 'verifyMail'])->name('verification.verify');
});

//route for forgot password
Route::group(['middleware' => ['guest']], function () {
    Route::post('forgot-password', [SendPasswordNotificationController::class, 'passwordNotification'])->name('password.notification');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
});
