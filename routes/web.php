<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\NilaiController;
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

// Route::get('/', [IndexController::class, 'index']);

// Route::get('/dashboard', [IndexController::class, 'dashboard']);

Route::controller(IndexController::class)->group(function()
{
    Route::get('/','index');
    Route::post('/login-walas', 'loginWalas');
    Route::post('/login-siswa', 'loginSiswa');
    Route::get('/dashboard', 'dashboard');
    Route::get('/logout', 'logout');
});

Route::controller(NilaiController::class)->prefix('nilai-raport')->group(function()
{
    Route::get('/index','index');
    Route::get('/create', 'create');
    Route::post('/store', 'store');
    Route::get('/edit/{nilai}', 'edit');
    Route::post('/update/{nilai}', 'update');
    Route::get('/destroy/{nilai}', 'destroy');
});

// Route::controller(GuruController::class)->prefix('guru')->group(function () {
//     Route::get('/index', 'index');
//     Route::post('/store', 'store');
//     Route::get('/edit/{guru}', 'edit');
//     Route::post('/update/{guru}', 'update');
//     Route::get('/destroy/{guru}', 'destroy');
//  });