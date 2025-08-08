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
        'pincode',
        'city',
        'state',
    ];

    protected $casts = [
        'qualification' => 'array',
        'available_days' => 'array',
        'unavailable_from' => 'date',
        'unavailable_to' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doctor) {
            if (empty($doctor->slug)) {
                $doctor->slug = $doctor->generateSlug();
            }
        });

        static::updating(function ($doctor) {
            if ($doctor->isDirty('user_id') && empty($doctor->slug)) {
                $doctor->slug = $doctor->generateSlug();
            }
        });
    }

    public function generateSlug()
    {
        if (!$this->user) {
            $this->load('user');
        }

        if (!$this->user) {
            return null;
        }

        $baseSlug = Str::slug($this->user->name);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
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
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $dayName = $days[$dayOfWeek - 1] ?? null;
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

            // Check if doctor is available on this day
            if (empty($this->available_days) || !in_array($dayOfWeek, $this->available_days)) {
                \Log::info("Doctor {$this->id} not available on {$dayOfWeek}");
                return [];
            }

            // Check if doctor is on leave
            if ($this->isOnLeave($date)) {
                \Log::info("Doctor {$this->id} on leave on {$date->toDateString()}");
                return [];
            }

            $workingHours = $this->getWorkingHours();
            $duration = $this->slot_duration_minutes ?? 30;
            $maxPatients = $this->patients_per_slot ?? 1;

            $start = Carbon::parse($workingHours['start_time']);
            $end = Carbon::parse($workingHours['end_time']);
            $currentDateTime = Carbon::parse($date->toDateString() . ' ' . $workingHours['start_time']);
            $now = Carbon::now('Asia/Kolkata');

            // Validate working hours
            if ($start->greaterThanOrEqualTo($end)) {
                \Log::error("Invalid working hours for doctor {$this->id}: start_time {$workingHours['start_time']} >= end_time {$workingHours['end_time']}");
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
            $dayOfWeek = $date->dayOfWeek;
            $weekdaysFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Validate date
            if ($date->lt($today)) {
                \Log::warning("Attempted to generate slots for past date: {$date->toDateString()} for doctor {$this->id}");
                return [];
            }

            // Check day of week availability
            if (!in_array($weekdaysFull[$dayOfWeek], $this->available_days ?? [])) {
                \Log::info("Doctor {$this->id} not available on {$weekdaysFull[$dayOfWeek]}");
                return [];
            }

            // Check leave status
            if ($this->isOnLeave($date)) {
                \Log::info("Doctor {$this->id} on leave on {$date->toDateString()}");
                return [];
            }

            $workingHours = $this->getWorkingHours();
            $startTime = Carbon::parse($workingHours['start_time'], 'Asia/Kolkata');
            $endTime = Carbon::parse($workingHours['end_time'], 'Asia/Kolkata');
            $duration = $this->slot_duration_minutes ?? 30;
            $maxPatients = $this->patients_per_slot ?? 1;
            $now = Carbon::now('Asia/Kolkata');

            // Validate working hours
            if ($startTime->greaterThanOrEqualTo($endTime)) {
                \Log::error("Invalid working hours for doctor {$this->id}: start_time {$workingHours['start_time']} >= end_time {$workingHours['end_time']}");
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



