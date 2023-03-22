<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::controller(UserController::class)->as('user.')->group(function() {

    Route::get('registration', 'registration')->name('registration')->middleware('guest');
    
    Route::get('login', 'login')->name('login')->middleware('guest');
    
    Route::post('users', 'store')->name('store')->middleware('guest');
    
    Route::post('login', 'logUser')->name('logUser')->middleware('guest');
    
    Route::get('logout', 'logout')->name('logout')->middleware('auth');
});

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function() {
    
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);

    Route::resource('menus', MenuController::class);

    Route::resource('tables', TableController::class);

    Route::resource('reservation', ReservationController::class);
});