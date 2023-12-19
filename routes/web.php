<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index'])->name('user');
Route::get('/add-data', [UserController::class, 'create'])->name('add-data');


Route::resource('users', UserController::class);

// Menampilkan semua user
Route::get('/user', [UserController::class, 'index'])->name('user');

// Menyimpan user baru
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Menampilkan formulir untuk mengedit user
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user-edit');

// Menyimpan perubahan pada user yang telah diubah
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Menghapus user
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
