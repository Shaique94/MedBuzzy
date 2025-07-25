<?php

namespace App\Console\Commands;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RescheduleAppointments extends Command
{
    protected $signature = 'appointments:reschedule 
        {doctor : ID of the doctor} 
        {leaveDate : Date of leave in YYYY-MM-DD format}
        {--dry-run : Execute without saving changes}
        {--max-attempts=14 : Maximum days to check for availability}';

    protected $description = 'Reschedule appointments for a doctor\'s leave day';

    public function handle()
    {
        try {
            $doctor = Doctor::findOrFail($this->argument('doctor'));
            
            $leaveDate = Carbon::createFromFormat('Y-m-d', $this->argument('leaveDate'));
            if (!$leaveDate) {
                throw new \InvalidArgumentException("Invalid date format. Use YYYY-MM-DD");
            }

            if ($leaveDate->isPast() && !$leaveDate->isToday()) {
                throw new \InvalidArgumentException("Leave date cannot be in the past");
            }

            $appointments = $this->getReschedulableAppointments($doctor, $leaveDate);

            if ($appointments->isEmpty()) {
                return $this->info("No appointments to reschedule.");
            }

            $this->info("Found {$appointments->count()} appointments to reschedule:");
            $this->table(
                ['ID', 'Patient', 'Original Date'],
                $appointments->map(fn($a) => [
                    $a->id,
                    $a->patient->name,
                    $a->appointment_date->format('Y-m-d H:i')
                ])
            );

            if ($this->option('dry-run')) {
                return $this->info("Dry run complete. No changes made.");
            }

            $successCount = $this->rescheduleAppointments($appointments, $doctor);

            $this->info("Successfully rescheduled {$successCount}/{$appointments->count()} appointments.");
            Log::info("Rescheduled {$successCount} appointments for doctor {$doctor->id} on {$leaveDate}");

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            Log::error("Reschedule failed: " . $e->getMessage());
            return 1; // Exit code for failure
        }

        return 0; // Success
    }

    protected function getReschedulableAppointments(Doctor $doctor, Carbon $leaveDate)
    {
        return Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $leaveDate)
            ->whereIn('status', ['scheduled', 'pending'])
            ->get();
    }

    protected function rescheduleAppointments($appointments, Doctor $doctor)
    {
        $successCount = 0;
        $maxAttempts = (int)$this->option('max-attempts');

        foreach ($appointments as $appointment) {
            try {
                if (!$appointment->rescheduleForLeave($doctor, $maxAttempts)) {
                    $this->warn("Failed to find new slot for appointment {$appointment->id}");
                    continue;
                }

                $successCount++;
                $this->info("Rescheduled appointment {$appointment->id} to {$appointment->appointment_date}");

            } catch (\Exception $e) {
                $this->error("Appointment {$appointment->id}: " . $e->getMessage());
                Log::error("Appointment {$appointment->id} reschedule failed: " . $e->getMessage());
            }
        }

        return $successCount;
    }
}