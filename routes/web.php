<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\NilaiController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/show', 'show');
});
