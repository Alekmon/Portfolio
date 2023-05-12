<?php

use Illuminate\Support\Facades\Route;

//главная 
Route::get('/', [MainController::class, 'index'])->name('main');

//фронт
require __DIR__.'/front.php';

//админка 
require __DIR__.'/admin.php';