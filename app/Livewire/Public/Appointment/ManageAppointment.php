<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
    public $payment_method;
    public $notes;
    public $available_payment_methods = ['cash', 'card', 'upi'];
    public $slot_enabled = true;
    public $currentMonth;
    public $isProcessing = false;

    protected $rules = [
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required_if:slot_enabled,true',
        'newPatient.name' => 'required|string|min:3|max:255',
        'newPatient.email' => 'nullable|email|max:255',
        'newPatient.phone' => 'required|string|min:10|max:15',
        'newPatient.age' => 'required|integer|min:1|max:120',
        'newPatient.gender' => 'required|string|in:male,female,other',
        'newPatient.pincode' => 'required|digits:6',
        'newPatient.address' => 'required|string|min:10|max:500',
        'payment_method' => 'required|in:cash,card,upi',
        'notes' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'doctor_id.required' => 'Please select a doctor.',
        'appointment_date.required' => 'Please select an appointment date.',
        'appointment_date.after_or_equal' => 'Appointment date must be today or in the future.',
        'appointment_time.required_if' => 'Please select an appointment time.',
        'newPatient.name.required' => 'Patient name is required.',
        'newPatient.name.min' => 'Name must be at least 3 characters.',
        'newPatient.phone.required' => 'Phone number is required.',
        'newPatient.phone.min' => 'Phone number must be at least 10 digits.',
        'newPatient.age.required' => 'Age is required.',
        'newPatient.age.min' => 'Age must be at least 1 year.',
        'newPatient.age.max' => 'Age must be less than 120 years.',
        'newPatient.gender.required' => 'Gender is required.',
        'newPatient.pincode.required' => 'Pincode is required.',
        'newPatient.pincode.digits' => 'Pincode must be 6 digits.',
        'newPatient.address.required' => 'Address is required.',
        'newPatient.address.min' => 'Address must be at least 10 characters.',
        'payment_method.required' => 'Please select a payment method.',
    ];

    public function mount()
    {
        // Set timezone properly
        date_default_timezone_set('Asia/Kolkata');
        Carbon::setLocale('en');
        config(['app.timezone' => 'Asia/Kolkata']);

        $this->departments = Department::all();
        $this->doctors = Doctor::with(['user', 'department'])->get();
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');

        if (request()->has('doctor_id')) {
            $this->doctor_id = request()->query('doctor_id');
            $this->selectedDoctor = Doctor::with(['user', 'department'])->find($this->doctor_id);
            if ($this->selectedDoctor) {
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['pincode', 'selectedDepartment', 'doctor_id', 'appointment_date'])) {
            return;
        }
        $this->validateOnly($propertyName);
    }

    public function updatedPincode($value)
    {
        $this->newPatient['pincode'] = $value;
        $this->validateOnly('newPatient.pincode');

        if (strlen($value) === 6) {
            $this->isProcessing = true;
            try {
                $response = Http::timeout(5)->get("https://api.postalpincode.in/pincode/{$value}");
                
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                        $postOffice = $data[0]['PostOffice'][0];
                        $this->newPatient['district'] = $postOffice['District'] ?? '';
                        $this->newPatient['state'] = $postOffice['State'] ?? '';
                        $this->resetErrorBag('newPatient.pincode');
                        $this->isProcessing = false;
                        return;
                    }
                }
                
                $this->addError('newPatient.pincode', 'Invalid pincode or no data found.');
            } catch (\Exception $e) {
                $this->addError('newPatient.pincode', 'Unable to verify pincode. Please try again later.');
            }
            $this->isProcessing = false;
        } else {
            $this->newPatient['district'] = '';
            $this->newPatient['state'] = '';
            $this->resetErrorBag('newPatient.pincode');
        }
    }

    public function setAppointmentDate($date)
    {
        $this->appointment_date = $date;
        $this->appointment_time = null;
        $this->validate(['appointment_date' => $this->rules['appointment_date']]);
        $this->generateTimeSlots();
    }

    public function clearAppointmentDate()
    {
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
    }

    public function previousMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->subMonth()->startOfMonth()->format('Y-m-d');
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
    }

    public function nextMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->addMonth()->startOfMonth()->format('Y-m-d');
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
    }

    public function updatedSelectedDepartment($value)
    {
        $this->doctors = $value
            ? Doctor::with(['user', 'department'])->where('department_id', $value)->get()
            : Doctor::with(['user', 'department'])->get();
        $this->doctor_id = null;
        $this->selectedDoctor = null;
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');
    }

    public function updatedDoctorId($value)
    {
        $this->selectedDoctor = Doctor::with(['user', 'department'])->find($value);
        $this->validate(['doctor_id' => $this->rules['doctor_id']]);
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');
        $this->generateTimeSlots();
    }

    public function generateTimeSlots()
    {
        if (!$this->selectedDoctor || !$this->appointment_date) {
            $this->availableSlots = [];
            return;
        }

        $startTime = Carbon::parse($this->selectedDoctor->start_time);
        $endTime = Carbon::parse($this->selectedDoctor->end_time);
        $duration = $this->selectedDoctor->slot_duration_minutes;
        $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;
        $this->availableSlots = [];
        $currentSlot = $startTime->copy();

        // Get current time with proper timezone
        $now = Carbon::now('Asia/Kolkata');
        $isToday = Carbon::parse($this->appointment_date)->isToday();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime)) break;
            
            $timeString = $currentSlot->format('H:i');
            $bookedCount = Appointment::where('doctor_id', $this->selectedDoctor->id)
                ->where('appointment_date', $this->appointment_date)
                ->where('appointment_time', $timeString)
                ->count();
                
            $remaining = max(0, $maxPatientsPerSlot - $bookedCount);
            
            $slotTime = Carbon::parse($this->appointment_date . ' ' . $timeString, 'Asia/Kolkata');
            $bufferedNow = $now->copy()->addMinutes(30);
            $disabled = $remaining <= 0 || ($isToday && $slotTime->lt($bufferedNow));
            
            $this->availableSlots[$timeString] = [
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $disabled,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot,
                'tooltip' => $disabled ? 
                    ($remaining <= 0 ? 'Fully booked' : 'Time slot has passed') : 
                    'Available'
            ];
            $currentSlot->addMinutes($duration);
        }
    }

    public function selectTimeSlot($time)
    {
        if (isset($this->availableSlots[$time]) && !$this->availableSlots[$time]['disabled']) {
            $this->appointment_time = $time;
            $this->validate(['appointment_time' => $this->rules['appointment_time']]);
        }
    }

    public function nextStep()
    {
        $this->validateStep($this->step);
        $this->step++;
        
        if ($this->step === 2) {
            $this->generateTimeSlots();
        }
    }

    public function previousStep()
    {
        $this->step--;
        
        if ($this->step === 2) {
            $this->generateTimeSlots();
        }
    }

    protected function validateStep($step)
    {
        if ($step === 1) {
            $this->validate(['doctor_id' => $this->rules['doctor_id']]);
        } elseif ($step === 2) {
            $this->validate([
                'appointment_date' => $this->rules['appointment_date'],
                'appointment_time' => $this->rules['appointment_time'],
            ]);
        } elseif ($step === 3) {
            $this->validate([
                'newPatient.name' => $this->rules['newPatient.name'],
                'newPatient.phone' => $this->rules['newPatient.phone'],
                'newPatient.age' => $this->rules['newPatient.age'],
                'newPatient.gender' => $this->rules['newPatient.gender'],
                'newPatient.address' => $this->rules['newPatient.address'],
                'newPatient.email' => $this->rules['newPatient.email'],
                'newPatient.pincode' => $this->rules['newPatient.pincode'],
            ]);
        } elseif ($step === 4) {
            $this->validate([
                'payment_method' => $this->rules['payment_method'],
                'notes' => $this->rules['notes'],
            ]);
        }
    }

    public function submit()
    {
        $this->validate();
        $this->isProcessing = true;
        
        try {
            // Create patient
            $patient = Patient::firstOrCreate(
                ['phone' => $this->newPatient['phone']],
                $this->newPatient
            );

            // Create appointment
            $appointment = Appointment::create([
                'doctor_id' => $this->doctor_id,
                'patient_id' => $patient->id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'notes' => $this->notes,
                'status' => 'scheduled',
            ]);

            // Create payment
            Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'amount' => $this->selectedDoctor->fee,
                'method' => $this->payment_method,
                'status' => 'paid',
                'created_by' => auth()->id(),
            ]);

            session()->flash('message', 'Appointment booked successfully!');
            return redirect()->route('appointment.confirmation', ['appointment' => $appointment->id]);
        } catch (\Exception $e) {
            $this->addError('appointment_error', 'Failed to book appointment. Please try again.');
            $this->isProcessing = false;
            throw $e;
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        $today = now('Asia/Kolkata');
        $currentMonthDate = Carbon::parse($this->currentMonth, 'Asia/Kolkata');
        $startOfMonth = $currentMonthDate->copy()->startOfMonth();
        $endOfMonth = $currentMonthDate->copy()->endOfMonth();
        $startDayOfWeek = $startOfMonth->dayOfWeek;
        $daysInMonth = $currentMonthDate->daysInMonth;
        
        $availableDayNumbers = [];
        $weekdaysFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        if ($this->selectedDoctor && is_array($this->selectedDoctor->available_days)) {
            foreach ($this->selectedDoctor->available_days as $day) {
                $availableDayNumbers[] = array_search($day, $weekdaysFull);
            }
        }
        
        $hasAvailableDays = !empty($availableDayNumbers);
        $bookingStart = $today->copy()->startOfDay();
        $validBookingDays = [];
        $bookingEnd = $bookingStart->copy();
        
        if ($this->selectedDoctor && $hasAvailableDays) {
            $maxBookingDays = $this->selectedDoctor->max_booking_days ?? 30;
            $currentDate = $bookingStart->copy();
            $daysCounted = 0;
            $onLeaveDates = [];
            
            if ($this->selectedDoctor->unavailable_from && $this->selectedDoctor->unavailable_to) {
                $startDate = Carbon::parse($this->selectedDoctor->unavailable_from, 'Asia/Kolkata');
                $endDate = Carbon::parse($this->selectedDoctor->unavailable_to, 'Asia/Kolkata');
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $onLeaveDates[] = $date->format('Y-m-d');
                }
            }
            
            while ($daysCounted < $maxBookingDays && $currentDate->lte($endOfMonth)) {
                $formattedDate = $currentDate->format('Y-m-d');
                $isAvailableDay = in_array($currentDate->dayOfWeek, $availableDayNumbers);
                $isOnLeave = in_array($formattedDate, $onLeaveDates);
                
                if ($isAvailableDay && !$isOnLeave && ($currentDate->isToday() || $currentDate->isFuture())) {
                    $validBookingDays[] = $formattedDate;
                    $daysCounted++;
                }
                $bookingEnd = $currentDate->copy()->endOfDay();
                $currentDate->addDay();
            }
        } else {
            $onLeaveDates = [];
        }

        return view('livewire.public.appointment.manage-appointment', [
            'selectedDepartment' => $this->selectedDepartment,
            'departments' => $this->departments,
            'selectedDoctor' => $this->selectedDoctor,
            'currentMonth' => $this->currentMonth,
            'startDayOfWeek' => $startDayOfWeek,
            'daysInMonth' => $daysInMonth,
            'availableDayNumbers' => $availableDayNumbers,
            'bookingStart' => $bookingStart,
            'bookingEnd' => $bookingEnd,
            'onLeaveDates' => $onLeaveDates,
            'weekdaysFull' => $weekdaysFull,
            'hasAvailableDays' => $hasAvailableDays,
            'validBookingDays' => $validBookingDays,
        ]);
    }
}