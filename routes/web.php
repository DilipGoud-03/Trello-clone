<?php

use App\Http\Controllers\AuthController;
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
    return view('home');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::post('/store', 'store')->name('store');
    Route::post('/loginRequest', 'loginRequest')->name('loginRequest');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});