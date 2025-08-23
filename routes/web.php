<?php

use App\Http\Controllers\SocialiteController;
use App\Http\Livewire\Admin\Auth\ResetPassword;
use App\Livewire\Admin\AdminReviewApproval;
use App\Livewire\Admin\Appointment\Add;
use App\Livewire\Admin\Appointment\All;
use App\Livewire\Admin\Appointment\Update;
use App\Livewire\Admin\Appointment\ViewDetails;
use App\Livewire\Admin\Auth\ChangePassword;
use App\Livewire\Admin\Auth\ForgotPassword;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Enquiry\EnquiryApproval;
use App\Livewire\Admin\Payment\ManagePayment;
use App\Livewire\Admin\Review\AdminReviewManagement;
use App\Livewire\Admin\Sections\Dashboard;
use App\Livewire\Admin\Sections\EditDoctor;
use App\Livewire\Admin\Sections\ManageDepartment;
use App\Livewire\Admin\Sections\ManageDoctor;
use App\Livewire\Admin\Doctor\ListDoctor;
use App\Livewire\Admin\Doctor\CreateDoctor;
use App\Livewire\Admin\Doctor\UpdateDoctor;
use App\Livewire\Doctor\Section\CreateSlot;
use App\Livewire\Doctor\Section\Leave;
use App\Livewire\Doctor\Section\Manager\CreateManger;
use App\Livewire\Doctor\Section\Doctordashboard;
use App\Livewire\Doctor\Section\Manager\PaymentList;
use App\Livewire\Manager\Sections\AppointmentReport;
use App\Livewire\Public\Appointment\AppointmentConfirmation;
use App\Livewire\Public\Appointment\ManageAppointment;
use App\Livewire\Public\Contact\ContactUs;
use App\Livewire\Public\LandingPage;
use App\Livewire\Public\OurDoctors\OurDoctors;
use App\Livewire\Public\OurDoctors\ViewDoctorDetail;
use App\Livewire\Public\Phone\Verify;
use App\Livewire\Public\Review\Review;
use App\Livewire\Public\Section\About;
use App\Livewire\Public\Section\Contact;
use App\Livewire\Public\Signup\Register;
use App\Livewire\Public\TermsCondition;
use App\Livewire\Public\PrivacyPolicy;
use App\Livewire\Doctor\Profile;
use App\Livewire\Manager\Sections\Managerdashboard;
use App\Livewire\Manager\Sections\AppointmentList;
use App\Livewire\Manager\Sections\Profile as ManagerProfile;
use App\Livewire\Manager\Sections\ManageDoctor as DoctorManage;
use App\Livewire\Manager\Sections\PatientView;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentReceiptController;
use App\Livewire\Public\Appointment\AppointmentWizard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Livewire\User\Sections\Dashboard as UserDashboard;
use App\Livewire\User\Sections\Profile as UserProfile;
use App\Livewire\User\Sections\MyAppointments;

use App\Livewire\Public\Appointment\ConfirmAppointment;
use App\Livewire\Public\Appointment\FailedAppointment;

// Google Auth Routes 
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);


// Public Routes
Route::get('/', LandingPage::class)->name('hero');
Route::get('/doctors/{department?}', OurDoctors::class)->name('our-doctors');
Route::get('/terms-conditions', TermsCondition::class)->name('terms-conditons');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('/doctor/{slug}', ViewDoctorDetail::class)->name('doctor-detail');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/register', Register::class)->name('register');
Route::get('/review',Review::class)->name('review');
Route::get('/appointment/{doctor_slug}', ManageAppointment::class)->name('appointment');
Route::get('/appointment/confirmation/{appointment}', AppointmentConfirmation::class)->name('appointment.confirmations');
Route::get('/appointment/receipt/{appointment}/download', [AppointmentReceiptController::class, 'download'])->name('appointment.receipt.download');
Route::get('/appointment/receipt/{appointment}', [AppointmentReceiptController::class, 'view'])->name('appointment.receipt');
Route::get('/appointments/confirmations/{id}', ConfirmAppointment::class)
    ->name('appointment.confirmation');
Route::get('/appointments/failed/{id}', FailedAppointment::class)
    ->name('appointment.failed');
Route::get('/about-us', About::class)->name('about-us');
Route::get('/contact-us', Contact::class)->name('contact-us');
Route::get('/Phone/verify', Verify::class)->name('phone-verify');
// Authentication Routes
Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Doctor Routes
Route::prefix('doc')->name('doctor.')->middleware(['auth', 'is_doctor'])->group(function () {
    Route::get('/dashboard', Doctordashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/leave', Leave::class)->name('add-leave');
    Route::get('/crateslot', CreateSlot::class)->name('create-slot');
    Route::get('/payments', PaymentList::class)->name('payments');

    // Manager Routes under Doctor
    Route::prefix('manager')->name('manager.')->group(function () {
        Route::get('/', CreateManger::class)->name('list');
        Route::get('/create', CreateManger::class)->name('create');
    });
});

// Manager Routes
Route::prefix('manager')->name('manager.')->middleware(['auth', 'is_manager'])->group(function () {
    Route::get('/dashboard', Managerdashboard::class)->name('dashboard');
    Route::get('/appointments', AppointmentList::class)->name('appointments');
    Route::get('/profile', ManagerProfile::class)->name('profile');
    Route::get('/doctors', DoctorManage::class)->name('manage.doctors');
    Route::get('/patients/{id}/print', [AppointmentReceiptController::class, 'print'])->name('patient.print');
    Route::post('/appointments/{appointment}/reschedule', [AppointmentController::class, 'rescheduleSingle'])->name('appointments.reschedule');
    Route::post('/appointments/reschedule-all', [AppointmentController::class, 'rescheduleAll'])->name('appointments.reschedule-all');
    Route::post('/appointments/check-statuses', [AppointmentController::class, 'checkStatuses'])->name('appointments.check-statuses');
    Route::get('/doctors/{doctor}/slots', [AppointmentController::class, 'getAvailableSlots']);
    Route::get('/report',AppointmentReport::class)->name('report');
    
});
Route::get('manager/patients/{id}', PatientView::class)->name('doctor.patients.view');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/manage-doctors', ManageDoctor::class)->name('manage.doctors');
    Route::get('/doctors', ListDoctor::class)->name('doctors.list');
    Route::get('/doctors/create', CreateDoctor::class)->name('doctors.create');
    Route::get('/doctors/{id}/edit', UpdateDoctor::class)->name('doctors.edit');
    Route::get('/manage-departments', ManageDepartment::class)->name('departments');
    Route::get('/appointment', All::class)->name('appointment');
    Route::get('/appointment/add', Add::class)->name('add.appointment');
    Route::get('/appointment/update/{id}', Update::class)->name('update.appointment');
    Route::get('/appointment/view/{id}', ViewDetails::class)->name('view.appointment');
    Route::get('/review',AdminReviewManagement::class)->name('reviewapprovel');
    Route::get('/doctors/edit/{id}', EditDoctor::class)->name('editDoctor');
        Route::get('/enquiry',EnquiryApproval::class)->name('enquiry');
        Route::get('/managePayment',ManagePayment::class)->name('ManagePayment');

});


// User Routes
Route::middleware(['auth', 'is_patient'])->prefix('user')->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/profile', UserProfile::class)->name('user.profile');
    Route::get('/appointments', MyAppointments::class)->name('user.appointments');
});



Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});

Route::get('/test-email', function () {
    $patient = App\Models\Patient::first();
    $appointment = App\Models\Appointment::first();
    Mail::to($patient->email)->send(new App\Mail\BookingConfirmationMail($patient, $appointment));
    return 'Email sent!';
});

//reset password work 

Route::get('/forgot-password', ForgotPassword::class)
    ->middleware('guest')
    ->name('password.request');

Route::get('/reset-password/{token}', ChangePassword::class)
    ->middleware('guest')
    ->name('password.reset');