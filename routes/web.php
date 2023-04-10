<?php

use App\Http\Controllers\AdminController;
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
->name('index.create')->middleware('auth');

Route::post('/create/store', [TodolistController::class, 'store'])->middleware('auth');

Route::get('/edit/{todolist}', [TodolistController::class, 'edit'])->middleware('auth');

Route::post('/update/{id}', [TodolistController::class, 'update'])->middleware('auth');

Route::get('done/{todolist}', [TodolistController::class, 'done'])
->name('done')->middleware('auth');

Route::delete('/delete/{todolist}', [TodolistController::class, 'delete'])->middleware('auth');

/* Todo Route*/

Route::get('/add', [TodoController::class,'add'])->middleware('auth');

Route::post('/todo', [TodoController::class,'store'])->middleware('auth');

Route::delete('/remove/{todo}', [TodoController::class, 'destroy'])->middleware('auth');

// Register Controller

Route::get('/register', [RegisterController::class,'register'])->middleware('guest');
Route::post('/singup', [RegisterController::class,'store'])->middleware('guest');


//log in/log out

Route::get('/login/', [SessionController::class, 'create'])->middleware('guest');
Route::post('/session', [SessionController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

//admin routes

Route::get('/admin/todos', [AdminController::class, 'add'])->middleware('admin');
Route::post('/admin/todos/add', [AdminController::class, 'post'])->middleware('admin');

Route::get('/admin/notification', [AdminController::class, 'get'])->middleware('admin');