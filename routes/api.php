<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\UserInviteController;
use App\Http\Controllers\TicketCommentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/modalData', [ModalController::class, 'modalData'])->name('modalData');

// Route::controller(UserController::class)->group(function () {
//     Route::post('/store', 'store')->name('store');
// });

// Route::controller(LoginController::class)->group(function () {
//     Route::post('/loginRequest', 'loginRequest')->name('loginRequest');
// });

// Route::controller(BoardController::class)->group(function () {

//     Route::post('/board', 'store')->name('boardStore');
//     Route::delete('/deleteBoard/{id}', 'destroy')->name('deleteBoard');
// });

// Route::controller(StageController::class)->group(function () {
//     Route::post('/stage', 'store')->name('stageStore');
//     Route::post('/stage_order_change', 'stage_order_change')->name('stage_order_change');
//     Route::delete('/stage/{id}', 'destroy')->name('stageDelete');
// });

// Route::controller(TicketController::class)->group(function () {
//     Route::post('/tickets', 'store')->name('ticketsStore');
//     Route::delete('/ticket/{id}', 'destroy')->name('deleteTicket');
// });
// Route::controller(UserInviteController::class)->group(function () {
//     Route::post('/inviteUser', 'store')->name('inviteUser');
//     Route::delete('/deleteUser/{id}', 'destroy')->name('deleteUser');
// });

// Route::controller(TicketCommentsController::class)->group(function () {
//     Route::post('/comments', 'store')->name('commentsStore');
//     Route::get('/comments/{id}', 'destroy')->name('commentsDelete');
// });
