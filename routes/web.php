<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\OrganizationController;


Route::get('/', [GuestBookController::class, 'index'])->name('landing');

// Route untuk menangani halaman berdasarkan slug
Route::get('/{slug}', [OrganizationController::class, 'landing'])->name('landing');

// Formulir pembuatan janji
Route::get('/{slug}/form', [GuestBookController::class, 'form'])->name('form');
Route::post('/{slug}/form', [GuestBookController::class, 'store']);

// Cek janji
Route::get('/{slug}/check', [GuestBookController::class, 'check'])->name('check');

// Detail janji temu
Route::get('/{slug}/appointment/{guest_token}', [GuestBookController::class, 'show'])->name('appointment_details');





