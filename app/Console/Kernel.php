<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->job(new \App\Jobs\SendDoctorAppointmentEmails)
        //          ->dailyAt('00:00')
        //          ->timezone('Asia/Kolkata');




// \Log::info('Scheduler loaded in Kernel.php');
//                  $schedule->job(\App\Jobs\SendDoctorAppointmentEmails::class)
//          ->dailyAt('00:00')
//          ->timezone('Asia/Kolkata');




        //  $schedule->job(\App\Jobs\SendDoctorAppointmentEmails::class)
        //  ->everyMinute()
        //  ->timezone('Asia/Kolkata');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}




