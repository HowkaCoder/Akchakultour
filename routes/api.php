<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registers' ,[ \App\Http\Controllers\RegisterController::class , 'register'] );

Route::post('logins' ,[ \App\Http\Controllers\RegisterController::class , 'login'] );

Route::post('logout' ,[ \App\Http\Controllers\RegisterController::class , 'logout'] );

Route::middleware('auth:sanctum')->group( function() {
// Route::resource('logins' , \App\Http\Controllers\LoginController::class);

Route::resource('mains' , \App\Http\Controllers\MainController::class);

Route::resource('homes' , \App\Http\Controllers\HomeController::class);

Route::resource('laws' , \App\Http\Controllers\LawController::class);

Route::resource('abouts' , \App\Http\Controllers\AboutController::class);

Route::resource('tours' , \App\Http\Controllers\TourController::class);

Route::resource('columns' , \App\Http\Controllers\ColumnController::class);
});