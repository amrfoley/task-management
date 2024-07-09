<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register','App\Http\Controllers\AuthController@register')->name('register.api');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.api');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout.api');
});