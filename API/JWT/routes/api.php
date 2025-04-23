<?php

use App\Http\Controllers\API\Auth\DeleteAccountController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\Mail\SendMailNotificationController;
use App\Http\Controllers\API\Auth\Mail\VerifyMailController;
use App\Http\Controllers\API\Auth\Password\NotificationPasswordController;
use App\Http\Controllers\API\Auth\Password\ResetPasswordController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::delete('deleteAcconut', [DeleteAccountController::class, 'deleteAcconut'])->name('delete.acconut');

    //email verification
    Route::post('/email/verification-notification', [SendMailNotificationController::class, 'mailNotification'])->name('mail.notification');
    Route::get('/email/verify/{id}/{hash}', [VerifyMailController::class, 'verifyMail'])->name('verification.verify');
});

//reset password
Route::group(['middleware' => 'guest'], function () {
    Route::post('forgot-password', [NotificationPasswordController::class, 'passwordNotification'])->name('password.notification');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
});
