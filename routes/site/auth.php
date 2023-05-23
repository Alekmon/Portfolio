<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//регистрация, логин
Route::controller(UserController::class)->as('user.')->group(function() {

    Route::middleware('guest')->group(function () {

        Route::get('registration', 'registration')->name('registration');
    
        Route::get('login', 'login')->name('login')->middleware('throttle:6,1');
        
        Route::post('users', 'store')->name('store');
        
        Route::post('login', 'logUser')->name('logUser');

    });
    
        Route::get('logout', 'logout')->name('logout')->middleware('auth');

    //восстановление пароля
    Route::middleware('guest')->group(function() {

        Route::get('forget-password', 'showForgetPassword')->name('showForgetPassword');

        Route::post('forget-password', 'submitForgetPassword')->name('submitForgetPassword');

        Route::get('reset-password', 'showResetPassword')->name('showResetPassword');

        Route::post('reset-password', 'submitResetPassword')->name('submitResetPassword');

    });
});