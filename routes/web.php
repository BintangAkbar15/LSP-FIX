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


Route::middleware('CheckUserRole:Murid')->group(function(){
    Route::controller(NilaiController::class)->prefix('nilai-raport')->group(function()
    {
        Route::get('/show','show')->name('muridShow');
    });
});
Route::middleware('CheckUserRole:Walas')->group(function(){
    
    Route::controller(NilaiController::class)->prefix('nilai-raport')->group(function()
    {
        Route::get('/index','index')->name('guruShow');
        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/edit/{nilai}', 'edit');

        Route::put('/update/{nilai}', 'update')->name('update');
        
        Route::get('/destroy/{nilai}', 'destroy');
        Route::get('/show/{id}','showNilai');
        Route::get('/show', 'show');
    });
});
