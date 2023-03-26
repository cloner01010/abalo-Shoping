<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\AuthController::class, 'index'])->name('index');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [App\Http\Controllers\AuthController::class, 'isloggedin'])->name('haslogin');
Route::match(['get', 'post'],'/articles', [\App\Http\Controllers\articleController::class, 'index'])->name('articles');

