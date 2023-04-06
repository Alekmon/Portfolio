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


Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');

Route::get('menus', [FrontendMenuController::class, 'index'])->name('menus.index');

//бронирование
Route::get('reservation/step_one', [FrontendReservationController::class, 'stepOne'])->name('reservation.one');
Route::post('reservation/step_one', [FrontendReservationController::class, 'storeStepOne'])->name('reservation.storeOne');
Route::get('reservation/step_two', [FrontendReservationController::class, 'stepTwo'])->name('reservation.two');
Route::post('reservation/step_two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservation.storeTwo');
Route::get('reservation/status/{reservation}', [MainController::class, 'reservationStatus'])->name('reservation.status')->middleware('auth');

Route::get('thanks', [WelcomeController::class, 'thanks'])->name('reservation.thanks');

//регитсрация, логин, изменение пароля
Route::controller(UserController::class)->as('user.')->group(function() {

    Route::get('registration', 'registration')->name('registration')->middleware('guest');
    
    Route::get('login', 'login')->name('login')->middleware('guest');
    
    Route::post('users', 'store')->name('store')->middleware('guest');
    
    Route::post('login', 'logUser')->name('logUser')->middleware('guest');
    
    Route::get('logout', 'logout')->name('logout')->middleware('auth');

    Route::middleware('guest')->group(function(){

        Route::get('forget-password', 'showForgetPassword')->name('showForgetPassword');
        Route::post('forget-password', 'submitForgetPassword')->name('submitForgetPassword');
        Route::get('reset-password', 'showResetPassword')->name('showResetPassword');
        Route::post('reset-password', 'submitResetPassword')->name('submitResetPassword');

    });
});

//админка 
Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function() {
    
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);

    Route::resource('menus', MenuController::class);

    Route::resource('tables', TableController::class);

    Route::resource('reservation', ReservationController::class);
});