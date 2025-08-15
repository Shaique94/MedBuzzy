<?php

namespace App\Livewire\Public\Appointments;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class DateTimeSelector extends Component
{

  public $doctor;
    public $available_dates = [];
    public $selected_date;
    public $available_slots = [];
    public $active_time_tab = 'morning';
    public $selected_time;

    protected $listeners = ['refreshSlots' => 'generateTimeSlots'];

    public function mount(Doctor $doctor)
    {
        $this->doctor = $doctor;
        $this->prepareAvailableDates();
        $this->selected_date = Carbon::today('Asia/Kolkata')->format('Y-m-d');
        $this->generateTimeSlots();
    }

    public function prepareAvailableDates()
    {
        $availableDays = is_array($this->doctor->available_days)
            ? $this->doctor->available_days
            : (is_string($this->doctor->available_days)
                ? json_decode($this->doctor->available_days, true)
                : []);

        $availableDayNumbers = [];
        $dayNameToNumber = [
            'Sunday' => 0, 'Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3,
            'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6,
        ];

        foreach ($availableDays as $dayName) {
            if (isset($dayNameToNumber[$dayName])) {
                $availableDayNumbers[] = $dayNameToNumber[$dayName];
            }
        }

        $today = Carbon::today('Asia/Kolkata');
        $maxBookingDays = $this->doctor->max_booking_days ?? 30;
        $endDate = $today->copy()->addDays($maxBookingDays - 1);
        $onLeaveDates = [];

        if ($this->doctor->unavailable_from && $this->doctor->unavailable_to) {
            $startDate = Carbon::parse($this->doctor->unavailable_from, 'Asia/Kolkata');
            $endDateLeave = Carbon::parse($this->doctor->unavailable_to, 'Asia/Kolkata');
            for ($date = $startDate; $date->lte($endDateLeave); $date->addDay()) {
                $onLeaveDates[] = $date->format('Y-m-d');
            }
        }

        $this->available_dates = [];
        $currentDate = $today->copy();
        $daysAdded = 0;

        while ($daysAdded < $maxBookingDays && $currentDate <= $endDate) {
            $formattedDate = $currentDate->format('Y-m-d');
            $isAvailableDay = in_array($currentDate->dayOfWeek, $availableDayNumbers);
            $isOnLeave = in_array($formattedDate, $onLeaveDates);
            $isBookable = $isAvailableDay && !$isOnLeave;

            if ($isBookable || $currentDate->isToday()) {
                $this->available_dates[] = [
                    'date' => $formattedDate,
                    'isToday' => $currentDate->isToday(),
                    'dayName' => $currentDate->format('D'),
                    'dayNumber' => $currentDate->format('j'),
                    'monthName' => $currentDate->format('M'),
                    'fullDate' => $currentDate->format('l, F j, Y'),
                ];
                $daysAdded++;
            }
            $currentDate->addDay();
        }
    }

    public function setAppointmentDate($date)
    {
        $this->selected_date = $date;
        $this->selected_time = null;
        $this->generateTimeSlots();

        if ($this->selected_date === Carbon::today('Asia/Kolkata')->format('Y-m-d')) {
            $now = Carbon::now('Asia/Kolkata');
            $hour = $now->hour;
            $this->active_time_tab = $hour < 12 ? 'morning' : ($hour < 16 ? 'afternoon' : 'evening');
        } else {
            $this->active_time_tab = 'morning';
        }

        $this->dispatch('dateSelected', $date);
    }

    public function generateTimeSlots()
    {
        if (!$this->selected_date) {
            $this->selected_date = Carbon::today('Asia/Kolkata')->format('Y-m-d');
        }

        $startTime = Carbon::parse($this->doctor->start_time ?? '09:00');
        $endTime = Carbon::parse($this->doctor->end_time ?? '17:00');
        $duration = $this->doctor->slot_duration_minutes ?? 30;
        $maxPatientsPerSlot = $this->doctor->patients_per_slot ?? 1;
        $this->available_slots = [];
        $currentSlot = $startTime->copy();

        $now = Carbon::now('Asia/Kolkata');
        $isToday = Carbon::parse($this->selected_date)->isToday();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime)) break;

            $timeString = $currentSlot->format('H:i');
            $bookedCount = Appointment::where('doctor_id', $this->doctor->id)
                ->where('appointment_date', $this->selected_date)
                ->where('appointment_time', $timeString)
                ->count();

            $remaining = max(0, $maxPatientsPerSlot - $bookedCount);

            $slotTime = Carbon::parse($this->selected_date . ' ' . $timeString, 'Asia/Kolkata');
            $bufferedNow = $now->copy()->addMinutes(30);
            $disabled = $remaining <= 0 || ($isToday && $slotTime->lt($bufferedNow));

            $this->available_slots[$timeString] = [
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $disabled,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot,
                'tooltip' => $disabled ? ($remaining <= 0 ? 'Fully booked' : 'Time slot has passed') : 'Available'
            ];
            $currentSlot->addMinutes($duration);
        }
    }

    public function setActiveTimeTab($tab)
    {
        $this->active_time_tab = $tab;
    }

    public function selectTimeSlot($time)
    {
        if (isset($this->available_slots[$time]) && !$this->available_slots[$time]['disabled']) {
            $this->selected_time = $time;
            $this->dispatch('timeSelected', $time);
        }
    }
    
    public function render()
    {
        return view('livewire.public.appointments.date-time-selector');
    }
}