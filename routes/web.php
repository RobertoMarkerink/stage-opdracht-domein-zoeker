<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/checkout', 'checkout');
Route::view('/overview', 'overview');

require __DIR__.'/auth.php';
