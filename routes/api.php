<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\Board;
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

Route::post('/register', [UserController::class, 'store'])->name('store');

Route::get('/login', [LoginController::class, 'loginRequest'])->name('loginRequest');

Route::controller(BoardController::class)->group(function () {
    Route::post('board', 'store')->name('storeBoard');
    Route::put('/board/{id}', 'update')->name('updateBoard');
});
