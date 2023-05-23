<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MainController;

//главная 
Route::get('/', [MainController::class, 'index'])->name('main');

//регистрация\логин, восстановление пароля
require __DIR__.'/site/auth.php';

//фронт
require __DIR__.'/site/front.php';

//админка 
require __DIR__.'/site/admin.php';