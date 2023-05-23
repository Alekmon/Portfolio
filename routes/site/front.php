<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ReservationController;

//категории
Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function() {

    Route::get('/', 'index')->name('index');

    Route::get('{category}', 'show')->name('show');

});
//меню
Route::get('menus', [MenuController::class, 'index'])->name('menus.index');

//бронирование
Route::prefix('reservation')->controller(ReservationController::class)->as('reservation.')->group(function() {

    Route::get('step_one', 'stepOne')->name('one');

    Route::post('step_one', 'storeStepOne')->name('storeOne');

    Route::get('step_two', 'stepTwo')->name('two');

    Route::post('step_two', 'storeStepTwo')->name('storeTwo');

});

//спасибо за бронирование
Route::get('thanks', [WelcomeController::class, 'thanks'])->name('thanks');

