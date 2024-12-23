<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\OrganizationController;




// Route untuk menangani halaman berdasarkan slug
Route::get('/{slug}', [OrganizationController::class, 'landing'])->name('landing');



// button buat janji
Route::get('/{slug}/check-in', [GuestBookController::class, 'checkin'])->name('check-in');
// data janji
Route::post('/{slug}/check-in', [GuestBookController::class, 'store']);

// Cek janji
Route::get('/{slug}/check', [GuestBookController::class, 'check'])->name('check');

// tombol check-out
Route::get('/{slug}/check-out', [GuestBookController::class, 'checkOutPage'])->name('check_out');
// data checkout
Route::post('/{slug}/checkout/{id}', [OrganizationController::class, 'processCheckOut'])->name('process_check_out');

// Detail janji temu
Route::get('/{slug}/appointment/{guest_token}', [GuestBookController::class, 'show'])->name('appointment_details');







