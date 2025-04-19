<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\DeleteAccountController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::group(['prefix' => ['auth'], 'middleware' => ['auth:sanctum']], function () {
    Route::post('logout', action: [LogoutController::class, 'logout'])->name('logout');
    Route::get(uri: 'profile', action: [RegisterController::class, 'profile'])->name('profile');
    Route::post('deleteAccount', [DeleteAccountController::class, 'deleteAccount'])->name('delete.account');
});
