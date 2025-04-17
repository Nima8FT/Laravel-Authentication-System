<?php

use App\Http\Controllers\API\Auth\DeleteAccountController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('profile', function () {
        return "hi";
    });
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('deleteAcconut', [DeleteAccountController::class, 'deleteAcconut'])->name('delete.acconut');
});
