<?php

use App\Livewire\Login;
use App\Livewire\Profile;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', Register::class)->name('register');
Route::get('login', Login::class)->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', Profile::class)->name('profile');
});
