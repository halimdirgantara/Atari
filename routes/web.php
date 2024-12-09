<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;

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

Route::get('/', [GuestBookController::class, 'index'])->name('landing');
Route::get('/form', [GuestBookController::class, 'create'])->name('form.create');
Route::post('/form', [GuestBookController::class, 'store'])->name('form');
Route::get('/check', [GuestBookController::class, 'check'])->name('check');

// Menambahkan route untuk detail janji temu
Route::get('/appointment_details/{id}', [GuestBookController::class, 'show'])->name('appointment_details');
