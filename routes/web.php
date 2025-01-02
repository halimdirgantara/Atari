<?php

use App\Livewire\Home;
use App\Livewire\CheckIn;
use App\Livewire\CheckAppointment;
use App\Livewire\CheckOutAppointment;
use App\Livewire\AppointmentDetails;

use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/{slug}', Home::class)->name('home');

Route::get('/check-in', CheckIn::class)->name('check-in');
Route::get('/{slug}/check-in', CheckIn::class)->name('check-in');

Route::get('/check', CheckAppointment::class)->name('check-appointment');
Route::get('/{slug}/check', CheckAppointment::class)->name('check-appointment');

Route::get('/check-out', CheckOutAppointment::class)->name('check-out');
Route::get('/{slug}/check-out', CheckOutAppointment::class)->name('check-out');

Route::get('/appointment/{guest_token}', AppointmentDetails::class)->name('appointment-details');
Route::get('/{slug}/appointment/{guest_token}', AppointmentDetails::class)->name('appointment-details');
