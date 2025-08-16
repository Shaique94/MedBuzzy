<?php
namespace App\Jobs;

use App\Mail\BookingConfirmationMail;
use App\Models\Patient;
use App\Models\Appointment; // Updated
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $patient;
    public $appointment;

    public function __construct(Patient $patient, Appointment $appointment)
    {
        $this->patient = $patient;
        $this->appointment = $appointment;

    }

    public function handle()
    {

        \Log::info('Processing SendBookingConfirmationEmail job', [
            'patient_id' => $this->patient->id,
            'appointment_id' => $this->appointment->id,
            'email' => $this->patient->email,
            'patient_data' => $this->patient->toArray(),
            'appointment_data' => $this->appointment->toArray(),
        ]);
        $email = new BookingConfirmationMail($this->patient, $this->appointment);
        Mail::to($this->patient->email)->send($email);
    }
}