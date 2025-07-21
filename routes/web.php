<?php

use App\Livewire\Admin\Appointment\Add;
use App\Livewire\Admin\Appointment\All;
use App\Livewire\Admin\Appointment\Update;
use App\Livewire\Admin\Appointment\ViewDetails;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Sections\Dashboard;
use App\Livewire\Admin\Sections\ManageDepartment;
use App\Livewire\Admin\Sections\ManageDoctor;
use App\Livewire\Doctor\Section\CreateSlot;
use App\Livewire\Doctor\Section\Leave;
use App\Livewire\Doctor\Section\Manager\CreateManger;
use App\Livewire\Doctor\Section\Doctordashboard;
use App\Livewire\Public\Appointment\AppointmentConfirmation;
use App\Livewire\Public\Appointment\ManageAppointment;
use App\Livewire\Public\Contact\ContactUs;
use App\Livewire\Public\Hero;
use App\Livewire\Public\LandingPage;
use App\Livewire\Public\OurDoctors\OurDoctors;
use App\Livewire\Public\OurDoctors\ViewDoctorDetail;
use App\Livewire\Public\Review\Review;
use App\Livewire\Public\Section\About;
use App\Livewire\Public\Section\Contact;
use App\Livewire\Public\Signup\Register;
use App\Livewire\Public\TermsCondition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Doctor\Profile;
use App\Livewire\Manager\Sections\Managerdashboard;
use App\Livewire\Manager\Sections\AppointmentList;
// use App\Livewire\Manager\Sections\ViewDetails;
use App\Livewire\Manager\Sections\Profile as ManagerProfile;
use App\Livewire\Manager\Sections\ManageDoctor as DoctorManage;
use Illuminate\Support\Facades\Artisan;

// Public Routes
Route::get('/', LandingPage::class)->name('hero');
Route::get('/our-doctors', OurDoctors::class)->name('our-doctors');
Route::get('/terms-conditions', TermsCondition::class)->name('terms-conditons');
Route::get('/doctor/{doctor_id}', ViewDoctorDetail::class)->name('doctor-detail');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/register', Register::class)->name('register');
Route::get('/review',Review::class)->name('review');
Route::get('/appointment', ManageAppointment::class)->name('appointment');
Route::get('/appointment/confirmation/{appointment}', AppointmentConfirmation::class)->name('appointment.confirmation');
Route::get('/appointment/receipt/{appointment}', [\App\Http\Controllers\AppointmentReceiptController::class, 'download'])
    ->name('appointment.receipt');
Route::get('/about-us', About::class)->name('about-us');
Route::get('/contact-us', Contact::class)->name('contact-us');

Route::get('/login', Login::class)->name('login');

//doctor Routes
Route::prefix('doc')->group(function(){
Route::get('/dashboard',Doctordashboard::class)->name('doctor.dashboard');
Route::get('/manager',CreateManger::class)->name('doctor.manager-list');
Route::get('/manager/create',CreateManger::class)->name('doctor.create-manager');
});

Route::prefix('doc')->group(function () {
    Route::get('/dashboard', Doctordashboard::class)->name('doctor.dashboard');
    Route::get('/manager', CreateManger::class)->name('doctor.create-manager');

    Route::get('/profile', Profile::class)->name('doctor.profile');
    Route::get('/leave', Leave::class)->name('doctor.add-leave');

    Route::get('/crateslot', CreateSlot::class)->name('doctor.create-slot');

    // Manager Routes under Doctor
    Route::prefix('manager')->group(function () {
    Route::get('/', CreateManger::class)->name('doctor.manager.list');
    Route::get('/create', CreateManger::class)->name('doctor.manager.create'); 
    });
});


// Manager Routes
Route::prefix('manager')->name('manager.')->group(function () {
Route::get('/dashboard', Managerdashboard::class)->name('dashboard');
Route::get('/appointments', AppointmentList::class)->name('appointments');
//Route::get('/appointment/view/{id}', ViewDetails::class)->name('manager.view.appointment');
Route::get('/profile', ManagerProfile::class)->name('profile');
    Route::get('/doctors', DoctorManage::class)->name('manage.doctors');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/manage-doctors', ManageDoctor::class)->name('manage.doctors');
    Route::get('/manage-departments', ManageDepartment::class)->name('admin.departments');
    Route::get('/appointment', All::class)->name('admin.appointment');
    Route::get('/appointment/add', Add::class)->name('add.appointment');
    Route::get('/appointment/update/{id}', Update::class)->name('update.appointment');
    Route::get('/appointment/view/{id}', ViewDetails::class)->name('view.appointment');
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});
