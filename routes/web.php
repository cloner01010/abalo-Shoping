<?php

use Illuminate\Support\Facades\Route;
Route::get('/',[\App\Http\Controllers\articleController::class, 'index'])->name('index');
Route::match(['get','post'],'/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', 'App\Http\Controllers\AuthController@isLoggedIn')->name('haslogin');
Route::match(['get', 'post'],'/articles', [\App\Http\Controllers\articleController::class, 'index'])->name('articles');
Route::get('/newarticle', [\App\Http\Controllers\articleController::class, 'newarticle'])->name('newarticle');
Route::post('/articles', [\App\Http\Controllers\articleController::class, 'store']);
