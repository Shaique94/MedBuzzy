<?php

use App\Livewire\Public\Hero;
use App\Livewire\Public\LandingPage;
use App\Livewire\Public\OurDoctors\OurDoctors;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/',LandingPage::class)->name('hero');
Route::get('/our-doctors',OurDoctors::class)->name('our-doctors');