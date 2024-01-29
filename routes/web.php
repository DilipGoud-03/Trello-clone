<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TicketCommentsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInviteController;
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
    Route::get('/home', 'index')->name('stage_listing');
    Route::post('/stage_order_change', 'stage_order_change')->name('stage_order_change');
    Route::get('/stage/{id}', 'destroy')->name('stageDelete');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets/{id}', 'show')->name('showTicket');
    Route::post('/tickets', 'store')->name('ticketsStore');
    Route::get('/ticket/{id}', 'destroy')->name('deleteTicket');
});
Route::controller(UserInviteController::class)->group(function () {
    Route::get('/editUser/{id}', 'update')->name('editUser');
    Route::post('/inviteUser', 'store')->name('inviteUser');
    Route::get('/deleteUser/{id}', 'destroy')->name('deleteUser');
    Route::get('/userAccepted/{token}', 'userAcceptInvitation')->name('userAcceptInvitation');
    Route::get('/userRejected/{token}', 'userRejectInvitation')->name('userRejectInvitation');
});

Route::controller(TicketCommentsController::class)->group(function () {
    Route::post('/comments', 'store')->name('commentsStore');
    Route::get('/comment', 'destroy')->name('commentsDelete');
});
