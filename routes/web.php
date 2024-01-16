<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TicketController;
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
    return view('home');
});

Route::post('/modalData', [ModalController::class, 'modalData'])->name('modalData');

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/loginRequest', 'loginRequest')->name('loginRequest');
    Route::get('/boards', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(BoardController::class)->group(function () {

    Route::get('/board/{id}', 'index')->name('board');
    Route::post('/board', 'store')->name('boardStore');
    Route::get('/deleteBoard/{id}', 'destroy')->name('deleteBoard');
});

Route::controller(StageController::class)->group(function () {
    Route::post('/stage', 'store')->name('stageStore');
    Route::get('/stage/{id}', 'destroy')->name('stageDelete');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets/{id}', 'show')->name('showTicket');
    Route::post('/tickets', 'store')->name('ticketsStore');
    Route::get('/ticket/{id}', 'destroy')->name('deleteTicket');
});
