<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistFormController;

/*

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [TodolistFormController::class, 'index']);
Route::get('/todo_list', [TodolistFormController::class, 'index'])->name('todo_list');
Route::get('/create-page', [TodolistFormController::class, 'createPage']);
Route::post('/create', [TodolistFormController::class, 'create']);
Route::get('/edit-page/{id}', [TodolistFormController::class, 'editPage']);
Route::post('/edit', [TodolistFormController::class, 'edit']);
Route::get('/delete-page/{id}', [TodolistFormController::class, 'deletePage']);
Route::post('/delete/{id}', [TodolistFormController::class, 'delete']);