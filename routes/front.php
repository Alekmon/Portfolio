<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ReservationController;

//главная 
Route::get('/', [MainController::class, 'index'])->name('main');
//категории
Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function() {

    Route::get('/', 'index')->name('index');

    Route::get('{category}', 'show')->name('show');

});
//меню
Route::get('menus', [MenuController::class, 'index'])->name('menus.index');

//бронирование
Route::prefix('reservation')->as('reservation.')->group(function() {

    Route::controller(ReservationController::class)->group(function() {

        Route::get('step_one', 'stepOne')->name('one');

        Route::post('step_one', 'storeStepOne')->name('storeOne');

        Route::get('step_two', 'stepTwo')->name('two');

        Route::post('step_two', 'storeStepTwo')->name('storeTwo');

    });
    //статус 
    Route::get('status/{reservation}', [MainController::class, 'reservationStatus'])->name('status')->middleware('auth');
    //спасибо за бронироание
    Route::get('thanks', [WelcomeController::class, 'thanks'])->name('thanks');
});


//регистрация, логин
Route::controller(UserController::class)->as('user.')->group(function() {

    Route::middleware('guest')->group(function () {

        Route::get('registration', 'registration')->name('registration');
    
        Route::get('login', 'login')->name('login');
        
        Route::post('users', 'store')->name('store');
        
        Route::post('login', 'logUser')->name('logUser');

    });
    
        Route::get('logout', 'logout')->name('logout')->middleware('auth');

    //изменение пароля
    Route::middleware('guest')->group(function(){

        Route::get('forget-password', 'showForgetPassword')->name('showForgetPassword');

        Route::post('forget-password', 'submitForgetPassword')->name('submitForgetPassword');

        Route::get('reset-password', 'showResetPassword')->name('showResetPassword');

        Route::post('reset-password', 'submitResetPassword')->name('submitResetPassword');

    });
});