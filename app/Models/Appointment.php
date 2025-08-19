<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Notifications\AppointmentRescheduled;
class Appointment extends Model
{
    protected $table = 'appointments';
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'status',
        'payment_method',
        'notes',
        'appointment_date',
        'appointment_time',
        'created_by',
        'original_date',
        'rescheduled',
        'is_rescheduled',
        'original_appointment_id',
        'reschedule_reason',
        'rescheduled_at',
        'user_rescheduled',
        'user_reschedule_count',
        'user_rescheduled_at',
        'created_at',
        'updated_at',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected $casts = [
    'appointment_date' => 'datetime',
    ];


  public function rescheduleForLeave(Doctor $doctor, int $maxAttempts = 14): bool
    {
        if (!$this->canBeRescheduled()) {
            throw new \Exception("Cannot reschedule - appointment is in the past or cancelled");
        }

        $newDate = $this->findNextAvailableDate($doctor, $maxAttempts);
        
        if (!$newDate) {
            throw new \Exception("No available slots found within {$maxAttempts} days");
        }

        $success = $this->update([
            'original_date' => $this->appointment_date,
            'appointment_date' => $newDate,
            'rescheduled' => true,
            'status' => 'rescheduled',
            'rescheduled_at' => now()
        ]);

        if ($success) {
            $this->sendRescheduleNotification($newDate);
        }

        return $success;
    }

    /**
     * Find the next available date for rescheduling
     */
 
protected function findNextAvailableDate(Doctor $doctor, int $maxAttempts): ?Carbon
{
    $currentDate = Carbon::parse($this->appointment_date);
    $attempts = 0;
    
    while ($attempts < $maxAttempts) {
        $currentDate->addDay();
        $attempts++;
        
        // Skip weekends if doctor doesn't work weekends
        if (!$doctor->isAvailableOn($currentDate->dayOfWeekIso)) {
            continue;
        }
        
        // Check if doctor is on leave
        if ($doctor->isOnLeave($currentDate)) {
            continue;
        }
        
        // Check if there are available slots
        $slots = $doctor->generateTimeSlots($currentDate->format('Y-m-d'));
        if (!empty($slots)) {
            return $currentDate;
        }
    }
    
    return null;
}


    /**
     * Check if date is available for the doctor
     */

    protected function isDateAvailable(Doctor $doctor, Carbon $date): bool
{
    // Check if doctor is on leave
    if ($doctor->isOnLeave($date)) {
        return false;
    }

    // Check if day of week is available
    if (!$doctor->isAvailableOn($date->dayOfWeekIso)) {
        return false;
    }

    // Check if there are available slots
    $slots = $doctor->generateTimeSlots($date->format('Y-m-d'));
    return !empty($slots);
}

    /**
     * Check if appointment can be rescheduled
     */

  public function canBeRescheduled(): bool
{
    
  // Explicit list of statuses that cannot be rescheduled
    $invalidStatuses = ['completed', 'cancelled', 'no-show', 'rescheduled'];
    
    // Check if appointment is in invalid status
    if (in_array($this->status, $invalidStatuses)) {
        return false;
    }

        // return Carbon::parse($this->appointment_date)
        //         ->tz(config('app.timezone'))
        //         ->isFuture();
         // Check if appointment is already rescheduled
    if ($this->rescheduled) {
        return false;
    }

    // Check if appointment date is in the future
    if (Carbon::parse($this->appointment_date)
            ->tz(config('app.timezone'))
            ->isPast()) {
        return false;
    }

    // Check if doctor is available (not on leave)
    if ($this->doctor->isOnLeave(Carbon::parse($this->appointment_date))) {
        return false;
    }

    return true;
}


public function getAvailableRescheduleDates(Doctor $doctor, int $maxDays = 14): array
{
    $availableDates = [];
    $currentDate = Carbon::now()->startOfDay();
    $endDate = $currentDate->copy()->addDays($maxDays);
    
    while ($currentDate->lte($endDate)) {
        if ($this->isDateAvailable($doctor, $currentDate)) {
            $availableDates[] = $currentDate->format('Y-m-d');
        }
        $currentDate->addDay();
    }
    
    return $availableDates;
}

public function isDoctorAvailable(): bool
{
    return !$this->doctor->isOnLeave($this->appointment_date) && 
           $this->doctor->isAvailableOn($this->appointment_date->dayOfWeekIso);
}
    /**
     * Send notification about rescheduling
     */
    protected function sendRescheduleNotification(Carbon $newDate): void
    {
        try {
            $this->patient->notify(
                new AppointmentRescheduled(
                    $newDate->format('Y-m-d H:i'),
                    $this->original_date?->format('Y-m-d H:i')
                )
            );
        } catch (\Exception $e) {
            \Log::error("Failed to send reschedule notification: " . $e->getMessage());
        }
    }

    

    public function payments()
    {
        return $this->hasMany(Payment::class, 'appointment_id');
    }
}