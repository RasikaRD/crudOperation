<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/todo', [TodoController::class,'store'])->name('todo.store');

Route::get('/register', [RegisterController::class,'register'])->middleware('guest');

Route::post('/singup', [RegisterController::class,'store'])->middleware('guest');

Route::post('/session', [SessionController::class, 'store'])->middleware('guest');

Route::delete('/delete/{todolist}', [TodolistController::class, 'delete'])->middleware('auth');

Route::post('/update/{id}', [TodolistController::class, 'update']);

Route::delete('/remove/{todo}', [TodoController::class, 'destroy'])->middleware('auth');

