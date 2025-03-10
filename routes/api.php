<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register','App\Http\Controllers\AuthController@register')->name('register.api');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login.api');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout.api');

    Route::resource('tasks', TaskController::class)->except(['create', 'edit']);
    Route::get('tasks/assigned', [TaskController::class, 'assigned'])->name('tasks.assigned');
    Route::post('tasks/{id}/assign', [TaskController::class, 'assign'])->name('tasks.assign');

    Route::resource('tasks/{task_id}/comments', CommentController::class)->only(['index', 'store', 'update', 'destroy']);
});