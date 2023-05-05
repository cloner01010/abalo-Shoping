<?php

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

Route::get('/articles',[\App\Http\Controllers\articleController::class,'index_api'])->name('articles_api');
Route::post('/shoppingcart',[\App\Http\Controllers\ShoppingcartController::class,'store_api'])->name('shoppingcart_api');
Route::delete('/shoppingcart/{shoppingcartid}/articles/{articleId}',[\App\Http\Controllers\ShoppingcartController::class,'destroy_api']);
