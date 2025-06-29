<?php

use App\Livewire\Admin\Sections\Dashboard;
use App\Livewire\Admin\Sections\ManageDepartment;
use App\Livewire\Admin\Sections\ManageDoctor;
use App\Livewire\Public\Contact\ContactUs;
use App\Livewire\Public\Hero;
use App\Livewire\Public\LandingPage;
use App\Livewire\Public\OurDoctors\OurDoctors;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/',LandingPage::class)->name('hero');
Route::get('/our-doctors',OurDoctors::class)->name('our-doctors');
Route::get('/contact-us',ContactUs::class)->name('contact-us');


// Admin Routes
Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
Route::get('/admin/manage-doctors', ManageDoctor::class)->name('admin.appointments');
Route::get('/admin/manage-departments', ManageDepartment::class)->name('admin.departments');