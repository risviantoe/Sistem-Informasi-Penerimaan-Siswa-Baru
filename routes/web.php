<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminPendaftarController;
use App\Http\Controllers\Admin\AdminPenggunaController;
use App\Http\Controllers\Dashboard\DataController;
use App\Http\Controllers\Dashboard\FormulirController;
use App\Http\Controllers\Dashboard\StatusController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return route('login');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/data', [DataController::class, 'index']);
    Route::post('/dashboard/data', [DataController::class, 'update']);

    Route::get('/dashboard/formulir/{user}', [FormulirController::class, 'index']);
    Route::post('/dashboard/formulir', [FormulirController::class, 'store']);
    Route::get('/dashboard/formulir/{user}/print', [FormulirController::class, 'print']);

    Route::get('/dashboard/status/{user}', [StatusController::class, 'index']);
});

//Admin
Route::get('/admin/login', [AdminLoginController::class, 'index'])->middleware('guest:admin')->name('login.admin');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout']);

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/dashboard/pengguna', [AdminPenggunaController::class, 'index'])->name('admin.dashboard.pengguna');
    Route::get('/admin/dashboard/pengguna/{user}/detail', [AdminPenggunaController::class, 'show']);
    Route::get('/admin/dashboard/pengguna/{user}/delete', [AdminPenggunaController::class, 'destroy']);
    Route::get('/admin/dashboard/pengguna/{user}/edit', [AdminPenggunaController::class, 'edit']);
    Route::post('/admin/dashboard/pengguna/{user}/edit', [AdminPenggunaController::class, 'update']);

    Route::get('/admin/dashboard/pendaftar', [AdminPendaftarController::class, 'index'])->name('admin.dashboard.pendaftar');
    Route::get('/admin/dashboard/pendaftar/{pendaftar}/detail', [AdminPendaftarController::class, 'show']);
    Route::get('/admin/dashboard/pendaftar/{pendaftar}/delete', [AdminPendaftarController::class, 'destroy']);
    Route::get('/admin/dashboard/pendaftar/{pendaftar}/edit', [AdminPendaftarController::class, 'edit']);
    Route::post('/admin/dashboard/pendaftar/{pendaftar}/edit', [AdminPendaftarController::class, 'update']);
    Route::get('/admin/dashboard/pendaftar/{user}/print', [AdminPendaftarController::class, 'print']);
});



