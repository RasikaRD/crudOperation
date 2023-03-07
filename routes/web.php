<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
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

Route::get('/create/{id}', [TodolistController::class, 'create'])
->name('index.create');

Route::post('/create/store', [TodolistController::class, 'store']);

Route::get('/edit/{todolist}', [TodolistController::class, 'edit']);

Route::post('/update/{id}', [TodolistController::class, 'update']);

Route::get('done/{todolist}', [TodolistController::class, 'done'])
->name('done');

Route::get('delete/{todolist}', [TodolistController::class, 'delete'])
->name('delete');

/* Todo Route*/

Route::get('/add', [TodoController::class,'add']);

Route::post('/todo', [TodoController::class,'store']);

Route::get('/remove/{todo}', [TodoController::class, 'remove']);

// Register Controller

Route::get('/register', [RegisterController::class,'register'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store'])->middleware('guest');


//log in/log out

Route::get('/login/', [SessionController::class, 'create'])->middleware('guest');
Route::post('/session', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');