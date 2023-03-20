<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/main', [AdminController::class, 'index']);
});