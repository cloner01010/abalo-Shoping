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
Route::post('/articles',[\App\Http\Controllers\articleController::class,'store']);

Route::get('/shoppingcart',[\App\Http\Controllers\ShoppingcartController::class,'index_api'])->name('shoppingcart_index_api');
Route::get('/category',[\App\Http\Controllers\CategoryController::class,'index_api'])->name('category_index_api');
Route::post('/articles/{id}/sold',[\App\Http\Controllers\ArticleController::class],'sold_api');
Route::get('/current-user',function (){
    return \Illuminate\Support\Facades\Session::get('abalo_id');
});
