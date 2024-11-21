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
Route::get('/form', [GuestBookController::class, 'create'])->name('form');
Route::post('/form', [GuestBookController::class, 'store']);
Route::get('/check', [GuestBookController::class, 'check'])->name('check');
