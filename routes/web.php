<?php

use App\Livewire\Public\Hero;
use App\Livewire\Public\LandingPage;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/',LandingPage::class)->name('hero');