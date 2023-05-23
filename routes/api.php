<?php

use App\Http\Controllers\Api\ApiTodoController;
use App\Http\Controllers\Api\AuthController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/addtodolist', [ApiTodoController::class,'store'])->name('add.todo');
    Route::get('/alltodolist', [ApiTodoController::class,'index'])->name('list.todo');
    Route::delete('/todos/{id}', [ApiTodoController::class, 'destroy'])->name('delete.todo');
    Route::post('/update/{id}', [ApiTodoController::class, 'update'])->name('update.todo');
});


// Route::get('/alltodolist', [ApiTodoController::class,'index'])->name('list.todo');
