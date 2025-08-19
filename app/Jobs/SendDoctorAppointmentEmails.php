<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Mail\DoctorAppointmentReminder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendDoctorAppointmentEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $selectedDoctorId;


public function __construct($selectedDoctorId = null)
{
    // Ensure only simple, serializable data is stored
    $this->selectedDoctorId = $selectedDoctorId;
}

 public function handle()
{
    $tomorrow = Carbon::tomorrow('Asia/Kolkata')->toDateString();
    
    $query = Appointment::with([
            'patient' => function($query) {
                $query->select('id', 'name', 'email');
            },
            'doctor.user' => function($query) {
                $query->select('id', 'name', 'email');
            }
        ])
        ->whereDate('appointment_date', $tomorrow)
        ->whereIn('status', ['scheduled', 'rescheduled'])
        ->whereHas('patient') // Only appointments with patients
        ->whereHas('doctor.user'); // Only appointments with valid doctors

    if ($this->selectedDoctorId) {
        $query->where('doctor_id', $this->selectedDoctorId);
    }

    $appointments = $query->get();
    
    if ($appointments->isEmpty()) {
        Log::info("No valid appointments found for {$tomorrow}");
        return;
    }

    foreach ($appointments->groupBy('doctor_id') as $doctorId => $doctorAppointments) {
        try {
            $this->processDoctorAppointments($doctorId, $doctorAppointments, $tomorrow);
        } catch (\Exception $e) {
            Log::error("Failed processing doctor {$doctorId}: " . $e->getMessage());
            continue; // Skip to next doctor instead of failing entire job
        }
    }
}

 protected function processDoctorAppointments($doctorId, $appointments, $date)
{
    $doctor = Doctor::with('user')->find($doctorId);
    
    if (!$doctor || !$doctor->user) {
        Log::error("Doctor ID {$doctorId} not found");
        return;
    }

    try {
        Log::info("Generating PDF for doctor {$doctor->user->email}");
        $pdf = Pdf::loadView('pdf.doctor_appointments', [
            'doctor' => $doctor,
            'appointments' => $appointments,
            'date' => Carbon::parse($date)->format('F j, Y'),
            'clinicName' => config('app.name'),
            'generatedAt' => now()->format('M j, Y g:i A')
        ]);

        Log::info("Attempting to send email to {$doctor->user->email}");
        $response = Mail::to($doctor->user->email)->send(
            new DoctorAppointmentReminder($doctor, $appointments, $pdf->output())
        );
        
        if ($response) {
            Log::info("Email successfully sent to {$doctor->user->email}");
        } else {
            Log::error("Email send returned false for {$doctor->user->email}");
        }
        
    } catch (\Exception $e) {
        Log::error("Email sending failed: " . $e->getMessage());
    }
}

}