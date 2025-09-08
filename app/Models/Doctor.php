<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'manager_id',
        'department_id',
        'available_days',
        'fee',
        'status',
        'image',
        'image_id',
        'qualification',
        'languages_spoken',
        'clinic_hospital_name',
        'registration_number',
        'professional_bio',
        'achievements_awards',
        'verification_documents',
        'social_media_links',
        'pincode',
        'city',
        'state',
        'slug',
        'start_time',
        'end_time',
        'slot_duration_minutes',
        'patients_per_slot',
        'unavailable_from',
        'unavailable_to',
        'max_booking_days',
        'experience',
        'review_avg',
        'day_specific_schedule',
        'use_day_specific_schedule',
    ];

    protected $casts = [
        'qualification' => 'array',
        'available_days' => 'array',
        'unavailable_from' => 'date',
        'unavailable_to' => 'date',
        'languages_spoken' => 'array',
        'achievements_awards' => 'array',
        'verification_documents' => 'array',
        'social_media_links' => 'array',
        'review_avg' => 'float', // Cast review_avg as float
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'day_specific_schedule' => 'array',
        'use_day_specific_schedule' => 'boolean',
    ];

   protected static function boot()
{
    parent::boot();

    static::creating(function ($doctor) {
        $doctor->slug = $doctor->generateSlug();
    });

    static::updating(function ($doctor) {
        if ($doctor->isDirty('user_id') || $doctor->user->isDirty('name')) {
            $doctor->slug = $doctor->generateSlug();
        }
    });
}

   public function generateSlug()
{
    if (!$this->user) {
        $this->load('user');
    }

    // Fallback to name directly if user is not available
    $name = $this->user ? $this->user->name : $this->name;

    // Capitalize the first letter of the name
    $name = ucfirst(trim($name));

    if (!$name) {
        return null;
    }

    $baseSlug = Str::slug($name);
    $slug = $baseSlug;
    $counter = 1;

    while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}


public function updateReviewAverage()
{
    $average = $this->reviews()->where('approved', true)->avg('rating');
    $previousAvg = $this->review_avg;
    
    \Log::info("Calculating review_avg for doctor {$this->id} with ratings: " . $this->reviews()->where('approved', true)->pluck('rating')->implode(', '));
    
    // Update the review_avg column directly without triggering model events
    $this->timestamps = false; // Prevent updated_at from being modified
    $this->update(['review_avg' => $average ?: null]);
    $this->timestamps = true; // Re-enable timestamps
    
    // Refresh the model to ensure we have the latest data
    $this->refresh();
    
    \Log::info("Updated review_avg from {$previousAvg} to {$average} for doctor {$this->id}");
    
    return $average;
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function managers()
    {
        return $this->belongsToMany(User::class, 'managers', 'doctor_id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getWorkingHours()
    {
        return [
            'start_time' => $this->start_time ?? '09:00:00',
            'end_time' => $this->end_time ?? '17:00:00'
        ];
    }

    /**
     * Get working hours for a specific day
     */
    public function getWorkingHoursForDay($dayName)
    {
        // Convert day name to lowercase for consistency
        $dayName = strtolower($dayName);
        
        // If day-specific scheduling is enabled and configured
        if ($this->use_day_specific_schedule && $this->day_specific_schedule) {
            if (isset($this->day_specific_schedule[$dayName])) {
                $daySchedule = $this->day_specific_schedule[$dayName];
                return [
                    'start_time' => $daySchedule['start_time'] ?? '09:00:00',
                    'end_time' => $daySchedule['end_time'] ?? '17:00:00',
                    'patients_per_slot' => $daySchedule['patients_per_slot'] ?? 1,
                    'is_available' => $daySchedule['is_available'] ?? false
                ];
            }
        }
        
        // Fall back to general schedule
        return [
            'start_time' => $this->start_time ?? '09:00:00',
            'end_time' => $this->end_time ?? '17:00:00',
            'patients_per_slot' => $this->patients_per_slot ?? 1,
            'is_available' => in_array($dayName, $this->available_days ?? [])
        ];
    }

    /**
     * Get patients per slot for a specific day
     */
    public function getPatientsPerSlotForDay($dayName)
    {
        $daySchedule = $this->getWorkingHoursForDay(strtolower($dayName));
        return $daySchedule['patients_per_slot'];
    }

    /**
     * Check if doctor is available on a specific day
     */
    public function isAvailableOnDay($dayName)
    {
        $dayName = strtolower($dayName);
        $daySchedule = $this->getWorkingHoursForDay($dayName);
        return $daySchedule['is_available'];
    }

    /**
     * Initialize default day-specific schedule
     */
    public function initializeDaySpecificSchedule()
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $schedule = [];
        
        foreach ($days as $day) {
            $schedule[$day] = [
                'start_time' => $this->start_time ?? '09:00',
                'end_time' => $this->end_time ?? '17:00',
                'patients_per_slot' => $this->patients_per_slot ?? 1,
                'is_available' => in_array($day, $this->available_days ?? [])
            ];
        }
        
        return $schedule;
    }

    public function isOnLeave(Carbon $date): bool
    {
        if (!$this->unavailable_from || !$this->unavailable_to) {
            return false;
        }

        $leaveStart = Carbon::parse($this->unavailable_from)->startOfDay();
        $leaveEnd = Carbon::parse($this->unavailable_to)->endOfDay();

        return $date->between($leaveStart, $leaveEnd);
    }

    public function isAvailableOn($dayOfWeek): bool
    {
        // Handle both numeric (1-7) and string day formats
        if (is_numeric($dayOfWeek)) {
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            $dayName = $days[$dayOfWeek - 1] ?? null;
        } else {
            $dayName = strtolower($dayOfWeek);
        }
        
        if (!$dayName) {
            return false;
        }

        // Use day-specific scheduling if enabled
        if ($this->use_day_specific_schedule && $this->day_specific_schedule) {
            return $this->day_specific_schedule[$dayName]['is_available'] ?? false;
        }
        
        // Fall back to general schedule
        return $dayName && in_array($dayName, $this->available_days ?? []);
    }

    public function getRatingAttribute()
    {
        return $this->reviews()->where('approved', true)->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->where('approved', true)->count();
    }

    public function availableTimeSlots($date)
    {
        try {
            $date = Carbon::parse($date)->startOfDay();
            $dayOfWeek = strtolower($date->englishDayOfWeek);

            // Get day-specific working hours and availability
            $daySchedule = $this->getWorkingHoursForDay($dayOfWeek);
            
            // Check if doctor is available on this day
            if (!$daySchedule['is_available']) {
                \Log::info("Doctor {$this->id} not available on {$dayOfWeek}");
                return [];
            }

            // Check if doctor is on leave
            if ($this->isOnLeave($date)) {
                \Log::info("Doctor {$this->id} on leave on {$date->toDateString()}");
                return [];
            }

            $duration = $this->slot_duration_minutes ?? 30;
            $maxPatients = $daySchedule['patients_per_slot'];

            $start = Carbon::parse($daySchedule['start_time']);
            $end = Carbon::parse($daySchedule['end_time']);
            $currentDateTime = Carbon::parse($date->toDateString() . ' ' . $daySchedule['start_time']);
            $now = Carbon::now('Asia/Kolkata');

            // Validate working hours
            if ($start->greaterThanOrEqualTo($end)) {
                \Log::error("Invalid working hours for doctor {$this->id} on {$dayOfWeek}: start_time {$daySchedule['start_time']} >= end_time {$daySchedule['end_time']}");
                return [];
            }

            // Get booked appointments
            $bookedAppointments = $this->appointments()
                ->whereDate('appointment_date', $date)
                ->whereNotIn('status', ['cancelled', 'completed', 'no-show'])
                ->get()
                ->groupBy(function ($appointment) {
                    return Carbon::parse($appointment->appointment_time)->format('H:i');
                });

            $slots = [];
            $current = $start->copy();

            while ($current->lt($end)) {
                $slotEnd = $current->copy()->addMinutes($duration);
                if ($slotEnd->gt($end)) {
                    break;
                }

                $timeKey = $current->format('H:i');
                $slotDateTime = $date->copy()->setTimeFrom($current);
                $isPastSlot = $slotDateTime->lt($now->copy()->addMinutes(30));
                $bookedCount = $bookedAppointments->get($timeKey, collect())->count();
                $remaining = max(0, $maxPatients - $bookedCount);

                $slots[] = [
                    'start' => $current->format('h:i A'),
                    'end' => $slotEnd->format('h:i A'),
                    'time_value' => $timeKey . ':00',
                    'disabled' => $isPastSlot || $remaining <= 0,
                    'remaining_capacity' => $remaining,
                    'max_capacity' => $maxPatients,
                    'tooltip' => $isPastSlot ? 'Time slot has passed' : ($remaining <= 0 ? 'Fully booked' : 'Available')
                ];

                $current->addMinutes($duration);
            }

            return $slots;
        } catch (\Exception $e) {
            \Log::error("Error generating slots for doctor {$this->id} on {$date->toDateString()}: " . $e->getMessage());
            return [];
        }
    }

    public function generateTimeSlots($date)
    {
        try {
            $date = Carbon::parse($date, 'Asia/Kolkata')->startOfDay();
            $today = Carbon::today('Asia/Kolkata');
            $dayOfWeek = strtolower($date->englishDayOfWeek);

            // Validate date
            if ($date->lt($today)) {
                \Log::warning("Attempted to generate slots for past date: {$date->toDateString()} for doctor {$this->id}");
                return [];
            }

            // Get day-specific working hours and availability
            $daySchedule = $this->getWorkingHoursForDay($dayOfWeek);
            
            // Check if doctor is available on this day
            if (!$daySchedule['is_available']) {
                \Log::info("Doctor {$this->id} not available on {$dayOfWeek}");
                return [];
            }

            // Check leave status
            if ($this->isOnLeave($date)) {
                \Log::info("Doctor {$this->id} on leave on {$date->toDateString()}");
                return [];
            }

            $startTime = Carbon::parse($daySchedule['start_time'], 'Asia/Kolkata');
            $endTime = Carbon::parse($daySchedule['end_time'], 'Asia/Kolkata');
            $duration = $this->slot_duration_minutes ?? 30;
            $maxPatients = $daySchedule['patients_per_slot'];
            $now = Carbon::now('Asia/Kolkata');

            // Validate working hours
            if ($startTime->greaterThanOrEqualTo($endTime)) {
                \Log::error("Invalid working hours for doctor {$this->id}: start_time {$daySchedule['start_time']} >= end_time {$daySchedule['end_time']}");
                return [];
            }

            $bookedAppointments = $this->appointments()
                ->whereDate('appointment_date', $date)
                ->whereNotIn('status', ['cancelled', 'completed', 'no-show'])
                ->get()
                ->groupBy(function ($appointment) {
                    try {
                        return Carbon::parse($appointment->appointment_time)->format('H:i');
                    } catch (\Exception $e) {
                        \Log::error("Invalid appointment time for appointment ID {$appointment->id}: " . $e->getMessage());
                        return null;
                    }
                })->filter();

            $slots = [];
            $currentSlot = $startTime->copy();

            while ($currentSlot->lt($endTime)) {
                $slotEnd = $currentSlot->copy()->addMinutes($duration);
                if ($slotEnd->gt($endTime)) {
                    break;
                }

                $timeKey = $currentSlot->format('H:i');
                $slotDateTime = $date->copy()->setTimeFrom($currentSlot);
                $isPastSlot = $slotDateTime->lt($now->copy()->addMinutes(30));
                $bookedCount = $bookedAppointments->get($timeKey, collect())->count();
                $remaining = max(0, $maxPatients - $bookedCount);

                $slots[] = [
                    'start' => $currentSlot->format('h:i A'),
                    'end' => $slotEnd->format('h:i A'),
                    'time_value' => $timeKey . ':00',
                    'disabled' => $isPastSlot || $remaining <= 0,
                    'remaining_capacity' => $remaining,
                    'max_capacity' => $maxPatients,
                    'tooltip' => $isPastSlot ? 'Time slot has passed' : ($remaining <= 0 ? 'Fully booked' : 'Available')
                ];

                $currentSlot->addMinutes($duration);
            }

            \Log::info("Generated " . count($slots) . " slots for doctor {$this->id} on {$date->toDateString()}");
            return $slots;
        } catch (\Exception $e) {
            \Log::error("Error generating time slots for doctor {$this->id} on {$date->toDateString()}: " . $e->getMessage());
            throw new \Exception("Failed to generate time slots: " . $e->getMessage());
        }
    }

}



