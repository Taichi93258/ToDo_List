<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

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

Route::get('/', [FormController::class, 'index'])->name('todolist.index');
Route::get('/todo_list', [FormController::class, 'index'])->name('todo_list');
Route::get('/create-page', [FormController::class, 'create']);
Route::post('/create', [FormController::class, 'store']);
Route::get('/edit-page/{id}', [FormController::class, 'edit'])->name('editpage');
Route::post('/edit', [FormController::class, 'update']);
Route::get('/delete-page/{id}', [FormController::class, 'delete'])->name('deletepage');
Route::post('/delete/{id}', [FormController::class, 'destroy']);
Route::get('/mypage', [FormController::class, 'mypage'])->name('mypage');