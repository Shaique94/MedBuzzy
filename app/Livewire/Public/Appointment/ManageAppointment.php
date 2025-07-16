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
    public $availableTimes = [];
    public $timeSlotCounts = [];
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
    public $maxBookingDays = 0;

    public function mount()
    {
        $this->departments = Department::all();
        $this->doctors = Doctor::with(['user', 'department'])->get();


        if (request()->has('doctor_id')) {
            $this->doctor_id = request()->query('doctor_id');
            $this->selectedDoctor = Doctor::with(['user', 'department'])
                ->find($this->doctor_id);
            if ($this->selectedDoctor) {
                $this->step = 2;
            }
        }

    }

    public function updatedSelectedDepartment($value)
    {
        if ($value) {
            $this->doctors = Doctor::with(['user', 'department'])
                ->where('department_id', $value)
                ->get();
        } else {
            $this->doctors = Doctor::with(['user', 'department'])->get();
        }

        $this->doctor_id = null;
        $this->selectedDoctor = null;
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableTimes = [];
        $this->timeSlotCounts = [];
    }

    // slots work
    public $timeSlots = [];
    public $availableSlots = [];

    public function generateTimeSlots()
    {
        if (!$this->selectedDoctor) {
            return;
        }

        $startTime = Carbon::parse($this->selectedDoctor->start_time);
        $endTime = Carbon::parse($this->selectedDoctor->end_time);
        $duration = $this->selectedDoctor->slot_duration_minutes;
        $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;

        $this->timeSlots = [];
        $this->availableSlots = [];

        $currentSlot = $startTime->copy();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);

            // Skip if slot would go past end time
            if ($slotEnd->gt($endTime)) {
                break;
            }

            $timeString = $currentSlot->format('H:i');
            $formattedTime = $currentSlot->format('g:i A');
            
            // Get booked count for this slot
            $bookedCount = $this->getBookedCountForSlot($timeString);
            $remaining = max(0, $maxPatientsPerSlot - $bookedCount);

            $this->availableSlots[$timeString] = [
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $remaining <= 0,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot
            ];
            $currentSlot->addMinutes($duration);
        }

        // Also generate the grouped time slots for display
        $this->timeSlots = $this->getTimeSlotsProperty();
    }

    public function getBookedCountForSlot($time)
    {
        if (!$this->selectedDoctor || !$this->appointment_date) {
            return 0;
        }

        return Appointment::where('doctor_id', $this->selectedDoctor->id)
            ->where('appointment_date', $this->appointment_date)
            ->where('appointment_time', $time)
            ->count();
    }

    public function getTimeSlotsProperty()
    {
        $morningSlots = [];
        $afternoonSlots = [];
        $eveningSlots = [];
        
        foreach ($this->availableSlots as $time => $slot) {
            $hour = date('H', strtotime($slot['start']));
            
            if ($hour < 12) {
                $morningSlots[$time] = $slot;
            } elseif ($hour < 17) {
                $afternoonSlots[$time] = $slot;
            } else {
                $eveningSlots[$time] = $slot;
            }
        }
        
        return [
            'morning' => $morningSlots,
            'afternoon' => $afternoonSlots,
            'evening' => $eveningSlots,
        ];
    }

    public function getMorningSlotsProperty()
    {
        $slots = $this->getTimeSlotsProperty();
        return $slots['morning'] ?? [];
    }

    public function getAfternoonSlotsProperty()
    {
        $slots = $this->getTimeSlotsProperty();
        return $slots['afternoon'] ?? [];
    }

    public function getEveningSlotsProperty()
    {
        $slots = $this->getTimeSlotsProperty();
        return $slots['evening'] ?? [];
    }

    public function updatedDoctorId($value)
    {
        $this->selectedDoctor = Doctor::with(['user', 'department'])
            ->find($value);
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableTimes = [];
        $this->timeSlotCounts = [];
        $this->generateTimeSlots();
    }

    // public function selectDateTab($tab)
    // {
    //     if ($tab === 'tomorrow') {
    //         $this->appointment_date = now()->addDay()->toDateString();
    //         $this->generateAvailableSlots();
    //     }
    // }

    protected function generateAvailableSlots()
    {
        $this->availableTimes = [];
        $this->timeSlotCounts = [];

        if (!$this->selectedDoctor || !$this->appointment_date) {
            return;
        }

        $doctor = $this->selectedDoctor;
        $selectedDate = Carbon::parse($this->appointment_date);
        $tomorrow = Carbon::now()->addDay();

        // // Check if appointment is for tomorrow
        // if (!$selectedDate->isSameDay($tomorrow)) {
        //     $this->dispatch('doctor-not-available', [
        //         'message' => 'Appointments are only available for tomorrow. Please select tomorrow\'s date.'
        //     ]);
        //     return;
        // }

        // Check doctor availability for the selected day
        $dayOfWeek = $selectedDate->format('l');
        $availableDays = is_array($doctor->available_days) ? $doctor->available_days : [];

        if (!in_array($dayOfWeek, $availableDays)) {
            $this->dispatch('doctor-not-available', [
                'message' => "This doctor is not available on {$selectedDate->format('l, d M Y')}. Please choose another doctor or date."
            ]);
            return;
        }

        // Regenerate time slots with updated availability
        $this->generateTimeSlots();
    }

    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->fetchPincodeDetails($value);
        } else {
            $this->newPatient['district'] = '';
            $this->newPatient['state'] = '';
        }
    }

    protected function fetchPincodeDetails($pincode)
    {
        try {
            $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
            $data = $response->json();
            \Log::info('Pincode API response:', ['pincode' => $pincode, 'data' => $data]);

            if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->newPatient['district'] = $postOffice['District'] ?? '';
                $this->newPatient['state'] = $postOffice['State'] ?? '';
            } else {
                $this->newPatient['district'] = '';
                $this->newPatient['state'] = '';
            }
        } catch (\Exception $e) {
            \Log::error('Pincode API error:', ['pincode' => $pincode, 'error' => $e->getMessage()]);
            $this->newPatient['district'] = '';
            $this->newPatient['state'] = '';
        }
    }

    public function nextStep()
    {
        $this->validateStep($this->step);
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    protected function validateStep($step)
    {
        if ($step === 1) {
            $this->validate([
                'doctor_id' => 'required|exists:doctors,id',
                // 'appointment_time' => 'required'
            ]);
        } elseif ($step === 4) {
            $this->validate([
                'newPatient.name' => 'required|string|max:255',
                'newPatient.phone' => 'required|string|max:15',
                'newPatient.age' => 'required|integer|min:0|max:120',
                'newPatient.gender' => 'required|string|in:male,female,other',
                'newPatient.address' => 'required|string|max:500',
                'newPatient.email' => 'nullable|email|max:255',
                'newPatient.pincode' => 'nullable|digits:6',
            ]);
        } elseif ($step === 5) {
            $this->validate([
                'payment_method' => 'required|in:' . implode(',', $this->available_payment_methods),
                'notes' => 'nullable|string|max:1000',
            ]);
        }
    }

    public function submit()
    {
        $this->validateStep(5);

        $patient = Patient::create([
            'name' => $this->newPatient['name'],
            'email' => $this->newPatient['email'],
            'phone' => $this->newPatient['phone'],
            'age' => $this->newPatient['age'],
            'gender' => $this->newPatient['gender'],
            'pincode' => $this->newPatient['pincode'],
            'address' => $this->newPatient['address'],
            'district' => $this->newPatient['district'] ?? null,
            'state' => $this->newPatient['state'] ?? null,
        ]);

        $appointment = Appointment::create([
            'doctor_id' => $this->doctor_id,
            'patient_id' => $patient->id,
            'appointment_date' => $this->appointment_date ?? now()->addDay()->toDateString(),
            'appointment_time' => $this->slot_enabled ? $this->appointment_time : now()->format('H:i'),
            'notes' => $this->notes,
            'status' => 'scheduled',
        ]);

        $doctor = Doctor::find($this->doctor_id);
        $amount = $doctor ? $doctor->fee : 0;

        Payment::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'amount' => $amount,
            'method' => $this->payment_method,
            'status' => 'paid',
            'transaction_id' => null,
        ]);

        return redirect()->route('appointment.confirmation', ['appointment' => $appointment->id]);
    }

    public function selectTimeSlot($time)
    {
        // Only allow selection if slot is not disabled
        if (isset($this->availableSlots[$time]) && !$this->availableSlots[$time]['disabled']) {
            $this->appointment_time = $time;
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.appointment.manage-appointment', [
            'selectedDepartment' => $this->selectedDepartment,
            'departments' => $this->departments,
            'selectedDoctor' => $this->selectedDoctor,
            'timeSlotCounts' => $this->timeSlotCounts,
        ]);
    }
}