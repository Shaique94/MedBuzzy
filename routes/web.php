<?php

use App\Livewire\Public\Hero;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/',Hero::class)->name('hero');