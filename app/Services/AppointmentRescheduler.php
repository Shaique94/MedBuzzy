<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AppointmentRescheduler
{
    public function rescheduleForDoctorLeave(Doctor $doctor, $startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', '>=', $start)
            ->whereDate('appointment_date', '<=', $end)
            ->whereIn('status', ['scheduled', 'pending'])
            ->get();
            
        $rescheduledCount = 0;
        
        foreach ($appointments as $appointment) {
            if ($this->rescheduleSingleAppointment($appointment)) {
                $rescheduledCount++;
            }
        }
        
        return $rescheduledCount;
    }
    
    protected function rescheduleSingleAppointment(Appointment $appointment)
    {
        $newDate = $this->findNextAvailableSlot($appointment->doctor, $appointment->appointment_date);
        
        if (!$newDate) {
            Log::error("No available slot found for appointment ID: {$appointment->id}");
            return false;
        }
        
        try {
            // Update existing appointment instead of creating a new one
            $appointment->update([
                'original_date' => $appointment->appointment_date,
                'appointment_date' => $newDate,
                'rescheduled' => true,
                'status' => 'rescheduled',
                'rescheduled_at' => now(),
            ]);
            
            $this->notifyPatient($appointment);
            
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to reschedule appointment ID: {$appointment->id} - " . $e->getMessage());
            return false;
        }
    }
    
    protected function findNextAvailableSlot(Doctor $doctor, $originalDate)
    {
        $availableDays = $doctor->available_days ?? [];
        $currentDate = Carbon::parse($originalDate);
        $attempts = 0;
        $maxAttempts = 30; // 30 days max lookahead
        
        do {
            $currentDate->addDay();
            $attempts++;
            
            $dayOfWeek = $currentDate->dayOfWeek; // 0 (Sunday) to 6 (Saturday)
            
            // Check if doctor is available this day of week
            if (!in_array($dayOfWeek, $availableDays)) {
                continue;
            }
            
            // Check if doctor is on leave this day
            if ($this->isDoctorOnLeave($doctor, $currentDate)) {
                continue;
            }
            
            // Return the date as we found an available day
            return $currentDate->format('Y-m-d');
            
        } while ($attempts < $maxAttempts);
        
        return null;
    }
    
    protected function isDoctorOnLeave(Doctor $doctor, Carbon $date)
    {
        // No leave dates set
        if (!$doctor->unavailable_from || !$doctor->unavailable_to) {
            return false;
        }
        
        $leaveStart = Carbon::parse($doctor->unavailable_from);
        $leaveEnd = Carbon::parse($doctor->unavailable_to);
        
        return $date->between($leaveStart, $leaveEnd);
    }
    
    protected function notifyPatient(Appointment $appointment)
    {
        // Implement your actual notification logic here
        // Example:
        // $patient = $appointment->patient;
        // $patient->notify(new AppointmentRescheduled($appointment));
        
        Log::info("Appointment {$appointment->id} rescheduled to {$appointment->appointment_date}");
    }
}