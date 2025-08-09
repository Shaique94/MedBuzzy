<?php

namespace App\Jobs;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Mail\DoctorAppointmentReminder;
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

    /**
     * Create a new job instance.
     */
    public function __construct($selectedDoctorId = null)
    {
        $this->selectedDoctorId = $selectedDoctorId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow('Asia/Kolkata')->toDateString();
        \Log::info("Running SendDoctorAppointmentEmails for {$tomorrow}");

        // Query appointments for tomorrow, optionally filtered by doctor ID
        $query = Appointment::with(['patient', 'doctor.user'])
            ->whereDate('appointment_date', $tomorrow)
            ->whereIn('status', ['scheduled', 'rescheduled']);

        if ($this->selectedDoctorId) {
            $query->where('doctor_id', $this->selectedDoctorId);
        }

        $appointments = $query->get();
        \Log::info("Found {$appointments->count()} appointments for {$tomorrow}");

        if ($appointments->isEmpty()) {
            \Log::info("No appointments found for {$tomorrow}. Skipping email queuing.");
            return;
        }

        // Group appointments by doctor
        $appointmentsByDoctor = $appointments->groupBy('doctor_id');

        foreach ($appointmentsByDoctor as $doctorId => $doctorAppointments) {
            $doctor = Doctor::find($doctorId);
            if (!$doctor || !$doctor->user) {
                \Log::info("Doctor ID {$doctorId} not found or has no user.");
                continue;
            }

            $doctorEmail = $doctor->user->email;
            $data = [
                'appointments' => $doctorAppointments,
                'doctor_name' => $doctor->user->name,
                'date' => Carbon::tomorrow()->format('d-m-Y'),
            ];

            \Log::info("Queuing appointment reminder email for Dr. {$doctor->user->name} (ID: {$doctorId}) to {$doctorEmail} with {$doctorAppointments->count()} appointments.");
            Mail::to($doctorEmail)->queue(new DoctorAppointmentReminder($doctor, $doctorAppointments));
        }
    }
}