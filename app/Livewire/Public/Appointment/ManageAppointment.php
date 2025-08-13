<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Book Appointment')]
#[Layout('layouts.public')]
class ManageAppointment extends Component
{
    public $step = 1;
    public $doctors;
    public $departments;
    public $selectedDepartment = null;
    public $doctor_id;
    public $selectedDoctor;
    public $appointment_date;
    public $appointment_time;
    public $availableSlots = [];
    public $pincode;
    public $amount = 5000; // Fixed ₹50 (5000 paise)
    public $orderId;
    public $appointmentId;
    public $newPatient = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'age' => '',
        'gender' => '',
        'pincode' => '',
        'address' => '',
        'district' => '',
        'state' => '',
    ];
    public $notes;
    public $slot_enabled = true;
    public $currentMonth;
    public $isProcessing = false;
    public $activeTimeTab = 'morning';
    public $availableDates = [];

    protected $listeners = [
        'next-step' => 'nextStep',
        'previous-step' => 'previousStep',
        'update-department' => 'updateDepartment',
    ];

    public function mount($doctor_slug = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        Carbon::setLocale('en');
        config(['app.timezone' => 'Asia/Kolkata']);
        $this->departments = cache()->remember('departments', now()->addHours(24), fn() => Department::where('status', 1)->orderBy('name', 'desc')->get());
        $this->doctors = $this->getFilteredDoctors();
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');

        if ($doctor_slug) {
            $this->selectedDoctor = Doctor::with(['user', 'department'])->where('slug', $doctor_slug)->first();
            if ($this->selectedDoctor) {
                $this->doctor_id = $this->selectedDoctor->id;
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        } elseif (request()->has('doctor_id')) {
            $this->doctor_id = request()->query('doctor_id');
            $this->selectedDoctor = Doctor::with(['user', 'department'])->find($this->doctor_id);
            if ($this->selectedDoctor) {
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        }

        if ($this->selectedDoctor) {
            $this->prepareAvailableDates();
        }
    }

    protected function getFilteredDoctors()
    {
        return cache()->remember(
            "doctors_department_{$this->selectedDepartment}",
            now()->addHours(24),
            fn() => Doctor::when($this->selectedDepartment, function ($query) {
                return $query->where('department_id', $this->selectedDepartment);
            })
                ->whereHas('department', function ($query) {
                    $query->where('status', 1);
                })
                ->where('status', '1')
                ->with(['user', 'department'])
                ->get()
        );
    }

    public function updateDepartment($data)
    {
        $this->selectedDepartment = $data['selectedDepartment'];
        $this->doctors = $this->getFilteredDoctors();
        $this->doctor_id = null;
        $this->selectedDoctor = null;
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
    }

    public function prepareAvailableDates()
    {
        if (!$this->selectedDoctor) {
            $this->availableDates = [];
            return;
        }

        $availableDays = is_array($this->selectedDoctor->available_days)
            ? $this->selectedDoctor->available_days
            : (is_string($this->selectedDoctor->available_days)
                ? json_decode($this->selectedDoctor->available_days, true)
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

        $availableDayNumbers = array_filter(array_map(fn($day) => $dayNameToNumber[$day] ?? null, $availableDays));
        $today = Carbon::today();
        $maxBookingDays = $this->selectedDoctor->max_booking_days ?? 30;
        $endDate = $today->copy()->addDays($maxBookingDays - 1);
        $onLeaveDates = [];

        if ($this->selectedDoctor->unavailable_from && $this->selectedDoctor->unavailable_to) {
            $startDate = Carbon::parse($this->selectedDoctor->unavailable_from, 'Asia/Kolkata');
            $endDateLeave = Carbon::parse($this->selectedDoctor->unavailable_to, 'Asia/Kolkata');
            for ($date = $startDate; $date->lte($endDateLeave); $date->addDay()) {
                $onLeaveDates[] = $date->format('Y-m-d');
            }
        }

        $this->availableDates = [];
        $currentDate = $today->copy();
        $daysAdded = 0;

        while ($daysAdded < $maxBookingDays && $currentDate <= $endDate) {
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
                ];
                $daysAdded++;
            }

            $currentDate->addDay();
        }
    }

    public function nextStep($data = [])
    {
        if (isset($data['selectedDepartment'])) {
            $this->selectedDepartment = $data['selectedDepartment'];
            $this->doctors = $this->getFilteredDoctors();
        }
        if (isset($data['doctor_id'])) {
            $this->doctor_id = $data['doctor_id'];
            $this->selectedDoctor = Doctor::with(['user', 'department'])->find($this->doctor_id);
            $this->prepareAvailableDates();
        }
        if (isset($data['appointment_date'])) {
            $this->appointment_date = $data['appointment_date'];
            $this->activeTimeTab = $data['activeTimeTab'] ?? 'morning';
        }
        if (isset($data['appointment_time'])) {
            $this->appointment_time = $data['appointment_time'];
        }
        if (isset($data['newPatient'])) {
            $this->newPatient = $data['newPatient'];
        }
        if (isset($data['notes'])) {
            $this->notes = $data['notes'];
        }
        if (isset($data['orderId'])) {
            $this->orderId = $data['orderId'];
        }

        $this->step++;
        if ($this->step === 2 && empty($this->appointment_date)) {
            $today = Carbon::today()->format('Y-m-d');
            $this->appointment_date = $today;
            $this->dispatch('set-appointment-date', ['date' => $today]);
        }
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function render()
    {
        return view('livewire.public.appointment.manage-appointment', [
            'selectedDepartment' => $this->selectedDepartment,
            'departments' => $this->departments,
            'selectedDoctor' => $this->selectedDoctor,
            'currentMonth' => $this->currentMonth,
            'availableDates' => $this->availableDates,
            'activeTimeTab' => $this->activeTimeTab,
        ]);
    }
}