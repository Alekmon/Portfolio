<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//главная фронт 
Route::get('/', [MainController::class, 'index'])->name('main');
//категории фронт
Route::controller(FrontendCategoryController::class)->prefix('categories')->as('categories.')->group(function() {

    Route::get('/', 'index')->name('index');

    Route::get('{category}', 'show')->name('show');

});
//меню фронт
Route::get('menus', [FrontendMenuController::class, 'index'])->name('menus.index');

//бронирование фронт
Route::prefix('reservation')->as('reservation.')->group(function() {

    Route::controller(FrontendReservationController::class)->group(function() {

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

    Route::get('registration', 'registration')->name('registration')->middleware('guest');
    
    Route::get('login', 'login')->name('login')->middleware('guest');
    
    Route::post('users', 'store')->name('store')->middleware('guest');
    
    Route::post('login', 'logUser')->name('logUser')->middleware('guest');
    
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
    //изменение пароля
    Route::middleware('guest')->group(function(){

        Route::get('forget-password', 'showForgetPassword')->name('showForgetPassword');

        Route::post('forget-password', 'submitForgetPassword')->name('submitForgetPassword');

        Route::get('reset-password', 'showResetPassword')->name('showResetPassword');

        Route::post('reset-password', 'submitResetPassword')->name('submitResetPassword');

    });
});

//админка 
Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function() {
    //главная
    Route::get('/', [AdminController::class, 'index'])->name('index');
    //категрии админка
    Route::resource('categories', CategoryController::class);
    //меню админка
    Route::resource('menus', MenuController::class);
    //столики админка
    Route::resource('tables', TableController::class);
    //бронирование админка
    Route::resource('reservation', ReservationController::class);
});