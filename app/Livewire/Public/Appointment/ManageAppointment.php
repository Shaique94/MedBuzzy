<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Razorpay\Api\Api;

#[Title('Book Appointment')]
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
    ];

    public function mount($doctor_slug = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        Carbon::setLocale('en');
        config(['app.timezone' => 'Asia/Kolkata']);

        $this->departments = cache()->remember('departments', now()->addHours(24), fn() => Department::all());
        $this->doctors = cache()->remember('doctors', now()->addHours(24), fn() => Doctor::with(['user', 'department'])->get());
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');

        // Handle slug parameter from route
        if ($doctor_slug) {
            $this->selectedDoctor = Doctor::with(['user', 'department'])->where('slug', $doctor_slug)->first();
            if ($this->selectedDoctor) {
                $this->doctor_id = $this->selectedDoctor->id;
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        }
        // Handle legacy doctor_id query parameter for backward compatibility
        elseif (request()->has('doctor_id')) {
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
        if (empty($value) || !preg_match('/^\d{6}$/', $value)) {
            if (!empty($value)) {
                $this->addError('newPatient.pincode', 'Please enter a valid 6-digit PIN code');
            }
            return;
        }

        $this->isProcessing = true;
        try {
            $url = "https://api.postalpincode.in/pincode/{$value}";
            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                ]
            ]);
            $response = file_get_contents($url, false, $context);

            if ($response === false) {
                $this->addError('newPatient.pincode', 'Failed to connect to the API');
                $this->isProcessing = false;
                return;
            }

            $data = json_decode($response, true);
            if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->newPatient['district'] = $postOffice['District'] ?? '';
                $this->newPatient['state'] = $postOffice['State'] ?? '';
                $this->resetErrorBag('newPatient.pincode');
            } else {
                $this->addError('newPatient.pincode', 'Invalid PIN code or no data found');
            }
        } catch (\Exception $e) {
            $this->addError('newPatient.pincode', 'Unable to verify PIN code: ' . $e->getMessage());
        }

        $this->isProcessing = false;

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

        $now = Carbon::now('Asia/Kolkata');
        $isToday = Carbon::parse($this->appointment_date)->isToday();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime))
                break;

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
                'notes' => $this->rules['notes'],
            ]);
        }
    }


    protected $listeners = [
        'payment-failed' => 'handlePaymentFailed',
    ];

    public function createOrder()
    {
        $this->validate();

        try {
            // Check slot availability
            $bookedCount = Appointment::where([
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
            ])->count();

            $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;
            if ($bookedCount >= $maxPatientsPerSlot) {
                throw new \Exception('Selected time slot is no longer available.');
            }

            // Create Razorpay Order
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $order = $api->order->create([
                'receipt' => 'temp_appointment_' . now()->timestamp,
                'amount' => $this->amount,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);

            $this->orderId = $order['id'];

            // Dispatch with all data
            $this->dispatch('razorpay:open', [
                'key' => config('services.razorpay.key'),
                'orderId' => $this->orderId,
                'amount' => $this->amount,
                'patientData' => $this->newPatient,
                'appointmentData' => [
                    'doctor_id' => $this->doctor_id,
                    'appointment_date' => $this->appointment_date,
                    'appointment_time' => $this->appointment_time,
                    'notes' => $this->notes,
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Order creation failed: ' . $e->getMessage());
            $this->addError('payment_error', 'Failed to create appointment: ' . $e->getMessage());
            $this->isProcessing = false;
        }
    }



    #[On('payment-success')]
    // Add this method to handle successful payment
   public function handlePaymentSuccess($paymentId, $allData)
{
    DB::beginTransaction();

    try {
        // 1. Extract and prepare data
        $paymentDetails = [
            'key' => $allData[0]['key'],
            'orderId' => $allData[0]['orderId'],
            'amount' => $allData[0]['amount'] / 100, // Convert from paise to rupees
        ];

        $patientInfo = $allData[0]['patientData'];
        $appointmentInfo = $allData[0]['appointmentData'];

        // 2. Verify payment with Razorpay
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $payment = $api->payment->fetch($paymentId);

        if ($payment->status !== 'authorized') {
            throw new \Exception('Payment not captured');
        }

        // 3. Create/update patient
        $patient = Patient::updateOrCreate(
            ['phone' => $patientInfo['phone']],
            [
                'name' => $patientInfo['name'],
                'email' => $patientInfo['email'],
                'age' => $patientInfo['age'],
                'gender' => $patientInfo['gender'],
                'pincode' => $patientInfo['pincode'],
                'address' => $patientInfo['address'],
                'district' => $patientInfo['district'] ?? null,
                'state' => $patientInfo['state'] ?? null,
            ]
        );

        // 4. Create user account with default password
        $defaultPassword = 'patient@123'; // More secure default password
        $user = User::firstOrCreate(
            ['email' => $patientInfo['email']],
            [
                'name' => $patientInfo['name'],
                'phone' => $patientInfo['phone'],
                'email' => $patientInfo['email'],
                'password' => Hash::make($defaultPassword),
            ]
        );

        // 5. Create appointment
        $appointment = Appointment::create([
            'doctor_id' => $appointmentInfo['doctor_id'],
            'patient_id' => $patient->id,
            'appointment_date' => $appointmentInfo['appointment_date'],
            'appointment_time' => $appointmentInfo['appointment_time'],
            'notes' => $appointmentInfo['notes'] ?? null,
            'status' => 'scheduled',
            'rescheduled' => false,
            'is_rescheduled' => false,
            'original_appointment_id' => null,
            'rescheduled_at' => null,
        ]);
        
        // 6. Record payment
        $payment = Payment::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'amount' => $paymentDetails['amount'],
            'transaction_id' => $paymentId,
            'status' => 'paid',
            'method' => 'upi',
        ]);

        DB::commit();

        // 7. Log in the user automatically
        Auth::login($user);
 
        // 8. Send confirmation (uncomment to implement)
        // $patient->notify(new AppointmentConfirmed($appointment));
        // $user->notify(new AccountCreated($user, $defaultPassword));

        return redirect()->route('appointment.confirmation', $appointment->id)
            ->with('success', 'Appointment booked successfully! You have been automatically logged in.');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error("Payment failed: {$e->getMessage()}", [
            'paymentId' => $paymentId,
            'error' => $e->getTraceAsString()
        ]);

        return redirect()->back()
            ->with('error', 'Payment processing failed. Please try again.');
    }
}



    public function handlePaymentFailed($data)
    {
        session()->flash('error', 'Payment failed: ' . $data['error']);
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