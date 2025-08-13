<?php

namespace App\Livewire\Public\Appointment\Steps;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Component;

class DateTimeSelection extends Component
{
    public $appointmentData = [];
    public $doctor;
    public $appointmentDate;
    public $appointmentTime;
    public $availableSlots = [];
    public $availableDates = [];
    public $activeTimeTab = 'morning';
    
    protected $listeners = ['validateAndProceed'];
    
    public function mount($appointmentData = [])
    {
        $this->appointmentData = $appointmentData;

        if (!isset($appointmentData['doctor_id']) || !isset($appointmentData['selected_doctor'])) {
            return;
        }

        // Ensure $this->doctor is always a Doctor model instance
        if ($appointmentData['selected_doctor'] instanceof Doctor) {
            $this->doctor = $appointmentData['selected_doctor'];
        } elseif (is_array($appointmentData['selected_doctor']) && isset($appointmentData['selected_doctor']['id'])) {
            $this->doctor = Doctor::find($appointmentData['selected_doctor']['id']);
        } else {
            $this->doctor = Doctor::find($appointmentData['doctor_id']);
        }

        // Only set appointmentDate and appointmentTime if they exist (do NOT default to today/time if not set)
        $this->appointmentDate = $appointmentData['appointment_date'] ?? null;
        $this->appointmentTime = $appointmentData['appointment_time'] ?? null;

        $this->prepareAvailableDates();
        $this->generateTimeSlots();
    }
    
    public function prepareAvailableDates()
    {
        if (!$this->doctor instanceof Doctor) {
            $this->availableDates = [];
            return;
        }

        // Ensure $this->doctor->available_days is always an array
        $availableDays = is_array($this->doctor->available_days)
            ? $this->doctor->available_days
            : (is_string($this->doctor->available_days)
                ? json_decode($this->doctor->available_days, true)
                : []);

        $dayNameToNumber = [
            'Sunday' => 0,
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
        ];

        $availableDayNumbers = [];
        foreach ($availableDays as $dayName) {
            if (isset($dayNameToNumber[$dayName])) {
                $availableDayNumbers[] = $dayNameToNumber[$dayName];
            }
        }

        $today = Carbon::today();
        $maxBookingDays = $this->doctor->max_booking_days ?? 30;
        $endDate = $today->copy()->addDays($maxBookingDays - 1);
        
        // Get doctor's leave dates if any
        $onLeaveDates = [];
        if ($this->doctor->unavailable_from && $this->doctor->unavailable_to) {
            $startDate = Carbon::parse($this->doctor->unavailable_from);
            $endDate = Carbon::parse($this->doctor->unavailable_to);
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $onLeaveDates[] = $date->format('Y-m-d');
            }
        }

        $this->availableDates = [];
        $currentDate = $today->copy();
        $daysAdded = 0;

        while ($daysAdded < $maxBookingDays) {
            $formattedDate = $currentDate->format('Y-m-d');
            $isAvailableDay = in_array($currentDate->dayOfWeek, $availableDayNumbers);
            $isOnLeave = in_array($formattedDate, $onLeaveDates);
            $isBookable = $isAvailableDay && !$isOnLeave;

            if ($isBookable || $currentDate->isToday()) {
                $this->availableDates[] = [
                    'date' => $formattedDate,
                    'isToday' => $currentDate->isToday(),
                    'dayName' => $currentDate->format('D'),
                    'dayNumber' => $currentDate->format('j'),
                    'monthName' => $currentDate->format('M'),
                    'fullDate' => $currentDate->format('l, F j, Y'),
                    'available' => $isBookable
                ];
                $daysAdded++;
            }

            $currentDate->addDay();
        }
    }
    
    public function setAppointmentDate($date)
    {
        $this->appointmentDate = $date;
        $this->appointmentTime = null;
        $this->generateTimeSlots();
        
        // Set active tab based on current time of day
        if ($this->appointmentDate === Carbon::today()->format('Y-m-d')) {
            $now = Carbon::now();
            $hour = (int) $now->format('H');
            
            if ($hour < 12) {
                $this->activeTimeTab = 'morning';
            } elseif ($hour < 16) {
                $this->activeTimeTab = 'afternoon';
            } else {
                $this->activeTimeTab = 'evening';
            }
        } else {
            $this->activeTimeTab = 'morning';
        }
    }
    
    public function setActiveTimeTab($tab)
    {
        $this->activeTimeTab = $tab;
    }
    
    public function selectTimeSlot($time)
    {
        if (isset($this->availableSlots[$time]) && !$this->availableSlots[$time]['disabled']) {
            $this->appointmentTime = $time;
            $this->validate(['appointmentTime' => 'required']);
            // Do NOT auto-advance step here!
            // $this->nextStep(); // <-- REMOVE THIS LINE
        }
    }
    
    public function generateTimeSlots()
    {
        if (!$this->doctor instanceof Doctor || !$this->appointmentDate) {
            $this->availableSlots = [];
            return;
        }

        $startTime = Carbon::parse($this->doctor->start_time ?? '09:00');
        $endTime = Carbon::parse($this->doctor->end_time ?? '17:00');
        $duration = $this->doctor->slot_duration_minutes ?? 30;
        $maxPatientsPerSlot = $this->doctor->patients_per_slot ?? 1;
        $this->availableSlots = [];
        $currentSlot = $startTime->copy();

        $now = Carbon::now();
        $isToday = Carbon::parse($this->appointmentDate)->isToday();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime)) break;

            $timeString = $currentSlot->format('H:i');
            $bookedCount = Appointment::where('doctor_id', $this->doctor->id)
                ->where('appointment_date', $this->appointmentDate)
                ->where('appointment_time', $timeString)
                ->count();

            $remaining = max(0, $maxPatientsPerSlot - $bookedCount);

            $slotTime = Carbon::parse($this->appointmentDate . ' ' . $timeString);
            $bufferedNow = $now->copy()->addMinutes(30);
            $disabled = $remaining <= 0 || ($isToday && $slotTime->lt($bufferedNow));

            $this->availableSlots[$timeString] = [
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $disabled,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot,
                'tooltip' => $disabled ? ($remaining <= 0 ? 'Fully booked' : 'Time slot has passed') : 'Available'
            ];
            
            $currentSlot->addMinutes($duration);
        }

        // Auto-select time tabs based on available slots
        $this->updateActiveTab();
    }
    
    protected function updateActiveTab()
    {
        $morningSlots = $afternoonSlots = $eveningSlots = 0;
        
        foreach ($this->availableSlots as $time => $slot) {
            if ($slot['disabled']) continue;
            
            $hour = (int) date('H', strtotime($slot['start']));
            
            if ($hour < 12) {
                $morningSlots++;
            } elseif ($hour < 16) {
                $afternoonSlots++;
            } else {
                $eveningSlots++;
            }
        }
        
        // Switch to a tab with available slots
        if ($this->activeTimeTab === 'morning' && $morningSlots === 0) {
            if ($afternoonSlots > 0) {
                $this->activeTimeTab = 'afternoon';
            } elseif ($eveningSlots > 0) {
                $this->activeTimeTab = 'evening';
            }
        } elseif ($this->activeTimeTab === 'afternoon' && $afternoonSlots === 0) {
            if ($morningSlots > 0) {
                $this->activeTimeTab = 'morning';
            } elseif ($eveningSlots > 0) {
                $this->activeTimeTab = 'evening';
            }
        } elseif ($this->activeTimeTab === 'evening' && $eveningSlots === 0) {
            if ($morningSlots > 0) {
                $this->activeTimeTab = 'morning';
            } elseif ($afternoonSlots > 0) {
                $this->activeTimeTab = 'afternoon';
            }
        }
    }
    
    public function validateAndProceed()
    {
        $this->validate([
            'appointmentDate' => 'required|date|after_or_equal:today',
            'appointmentTime' => 'required',
        ], [
            'appointmentDate.required' => 'Please select an appointment date.',
            'appointmentDate.after_or_equal' => 'Appointment date must be today or a future date.',
            'appointmentTime.required' => 'Please select an appointment time.',
        ]);
        
        $this->dispatch('step-validated', [
            'appointment_date' => $this->appointmentDate,
            'appointment_time' => $this->appointmentTime,
        ]);
    }

    public function render()
    {
        return view('livewire.public.appointment.steps.date-time-selection');
    }
}
