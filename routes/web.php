<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'login_process'])->name('login.process')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout_process')->middleware('auth');

Route::get('/dashboard', function () {
    return view('index');
})->name('dashboard')->middleware('auth');
