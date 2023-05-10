<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function() {
    //главная
    Route::get('/', [AdminController::class, 'index'])->name('index');
    //категрии
    Route::resource('categories', CategoryController::class);
    //меню
    Route::resource('menus', MenuController::class);
    //столики
    Route::resource('tables', TableController::class);
    //бронирование
    Route::resource('reservation', ReservationController::class);
});