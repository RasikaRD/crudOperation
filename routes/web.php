<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodolistController;
use App\Models\Todolist;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Todolist Route*/

Route::get('/', [TodolistController::class, 'index'])
->name('index');

Route::get('/create/{todo}', [TodolistController::class, 'create']);

Route::post('/store', [TodolistController::class, 'store']);

Route::get('/edit/{todolist}', [TodolistController::class, 'edit']);

Route::post('/update/{todolist}', [TodolistController::class, 'update'])
->name('update');

Route::get('delete/{todolist}', [TodolistController::class, 'delete'])
->name('delete');

/* Todo Route*/

Route::get('/add', [TodoController::class,'add']);

Route::post('/todo', [TodoController::class,'store']);

Route::get('/remove/{todo}', [TodoController::class, 'remove']);
