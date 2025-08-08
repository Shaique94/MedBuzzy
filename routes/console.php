<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



// Schedule::command('report:generate')
// \Log::info('Scheduler loaded in Kernel.php');
Schedule::job(new \App\Jobs\SendDoctorAppointmentEmails)
    ->timezone('Asia/Kolkata')
    ->everyMinute();
