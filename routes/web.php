<?php

use App\Livewire\Home;
use App\Livewire\CheckIn;
use App\Livewire\CheckAppointment;
use App\Livewire\AppointmentDetails;
use App\Livewire\CheckOut;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/{slug}', Home::class)->name('home');


Route::get('/{slug}/check-in', CheckIn::class)->name('check-in');


Route::get('/{slug}/check', CheckAppointment::class)->name('check-appointment');


Route::get('/{slug}/appointment/{guest_token}', AppointmentDetails::class)->name('appointment-details');

Route::get('/{slug}/checkout', CheckOut::class)->name('check-out');
