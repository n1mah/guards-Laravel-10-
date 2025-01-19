<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AuthController as AdminAuthController;
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
});


Route::middleware('guest:web')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AuthController::class, 'registerForm'])->name('admin.registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.register');
});




Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminAuthController::class, 'index'])->name('dashboard');
});

