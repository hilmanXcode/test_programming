<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;

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

// Auth Section
Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'login_process'])->name('login.process')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout_process')->middleware('auth');


// Dashboard Section
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard', function () {
        return view('index', [
            "page" => "dashboard"
        ]);
    })->name('dashboard');

    //Barang Controller
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/barang/add', [BarangController::class, 'insert'])->name('barang.add');
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/barang/add', [BarangController::class, 'store'])->name('barang.store');
    Route::post('/barang/edit/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
});
