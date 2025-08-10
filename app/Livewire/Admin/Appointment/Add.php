<?php

namespace App\Livewire\Admin\Appointment;

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

#[Title('Book New Appointment')]
class Add extends Component
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
    public $time_slots = []; // For blade template compatibility
    public $pincode;
    public $pincode_loading = false;
    public $amount = 5000; // Fixed ₹50 (5000 paise)
    public $booking_fee = 50;
    public $doctor_fee = 0;
    public $payment_method = 'cash'; // Default to cash for admin bookings
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
    public $activeTimeTab = 'morning'; // Track active time tab (morning/afternoon/evening)
    public $availableDates = []; // To store available dates for tabs

    protected $rules = [
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required_if:slot_enabled,true',
        'newPatient.name' => 'required|string|min:3|max:255',
        'newPatient.email' => 'nullable|email|max:255',
        'newPatient.phone' => 'required|string|digits:10',
        'newPatient.age' => 'required|integer|min:1|max:120',
        'newPatient.gender' => 'required|string|in:male,female,other',
        'newPatient.pincode' => 'required|digits:6',
        'newPatient.address' => 'nullable|string|max:500',
        'payment_method' => 'required|string|in:cash,card,upi',
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
        'newPatient.phone.digits' => 'Phone number must be exactly 10 digits.',
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

    public function mount($doctor_slug = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        Carbon::setLocale('en');
        config(['app.timezone' => 'Asia/Kolkata']);
        $this->departments = cache()->remember('departments', now()->addHours(24), fn() => Department::where('status', 1)->orderBy('name', 'desc')->get());
        // $this->doctors = cache()->remember('doctors', now()->addHours(24), fn() => Doctor::with(['user', 'department'])->get());
         $this->doctors = $this->getFilteredDoctors();
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

        // When mounting with a selected doctor, prepare the available dates
        if ($this->selectedDoctor) {
            $this->prepareAvailableDates();
        }
    }
     public function updatedSelectedDepartment()
    {
        // Reset doctor and appointment-related fields when department changes
        $this->doctor_id = null;
        $this->selectedDoctor = null;
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
        // Refresh doctor list based on new department filter
        $this->doctors = $this->getFilteredDoctors();
    }
     protected function getFilteredDoctors()
    {
        // Cache doctors based on department filter for 24 hours
        return cache()->remember("doctors_department_{$this->selectedDepartment}", now()->addHours(24), fn() => 
            Doctor::when($this->selectedDepartment, function ($query) {
                // Apply department filter if selectedDepartment is set
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
    public function updatedAppointmentDate($value)
    {
        if ($this->selectedDoctor) {
            $this->generateTimeSlots();
        }
    }

    public function selectDoctor($doctorId)
    {
        $this->doctor_id = $doctorId;
        $this->selectedDoctor = Doctor::with(['user', 'department'])->find($doctorId);
        $this->doctor_fee = $this->selectedDoctor->fee ?? 0;
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
        $this->time_slots = [];
        $this->prepareAvailableDates();
        $this->validateOnly('doctor_id');
        
        // Automatically move to next step after selecting doctor
        $this->nextStep();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['pincode', 'selectedDepartment', 'doctor_id'])) {
            return;
        }

        $this->validateOnly($propertyName);
    }

    public function updatedNewPatientPhone($value)
    {
        // Remove any non-numeric characters and limit to 10 digits
        $cleanValue = preg_replace('/[^0-9]/', '', $value);
        $cleanValue = substr($cleanValue, 0, 10);
        
        if ($cleanValue !== $value) {
            $this->newPatient['phone'] = $cleanValue;
        }
        
        // Check if phone number already exists and show message only
        if (strlen($cleanValue) === 10) {
            $existingPatient = Patient::where('phone', $cleanValue)->first();
            if ($existingPatient) {
                session()->flash('phone_exists', 'This phone number is already registered to ' . $existingPatient->name . '. You can update the information if needed.');
            } else {
                session()->forget('phone_exists');
            }
        }
        
        $this->validateOnly('newPatient.phone');
    }

    public function updatedNewPatientPincode($value)
    {
        $this->validateOnly('newPatient.pincode');
        if (empty($value) || !preg_match('/^\d{6}$/', $value)) {
            if (!empty($value)) {
                $this->addError('newPatient.pincode', 'Please enter a valid 6-digit PIN code');
            }
            return;
        }

        $this->pincode_loading = true;
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
                $this->pincode_loading = false;
                return;
            }

            $data = json_decode($response, true);
            if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->newPatient['district'] = $postOffice['District'] ?? '';
                $this->newPatient['state'] = $postOffice['State'] ?? '';
                $this->newPatient['country'] = 'India';
                $this->resetErrorBag('newPatient.pincode');
            } else {
                $this->addError('newPatient.pincode', 'Invalid PIN code or no data found');
            }
        } catch (\Exception $e) {
            $this->addError('newPatient.pincode', 'Unable to verify PIN code: ' . $e->getMessage());
        }

        $this->pincode_loading = false;
    }

    // Generate the available dates for the selected doctor
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

        $today = Carbon::today();
        $maxBookingDays = $this->selectedDoctor->max_booking_days ?? 30;
        $endDate = $today->copy()->addDays($maxBookingDays - 1);
        $onLeaveDates = [];

        if ($this->selectedDoctor->unavailable_from && $this->selectedDoctor->unavailable_to) {
            $startDate = Carbon::parse($this->selectedDoctor->unavailable_from, 'Asia/Kolkata');
            $endDate = Carbon::parse($this->selectedDoctor->unavailable_to, 'Asia/Kolkata');
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
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

    public function setAppointmentDate($date)
    {
        $this->appointment_date = $date;
        $this->appointment_time = null;
        $this->validate(['appointment_date' => $this->rules['appointment_date']]);
        $this->generateTimeSlots();

        // Set active time tab based on current time of day when selecting a date
        if ($this->appointment_date === Carbon::today()->format('Y-m-d')) {
            $now = Carbon::now('Asia/Kolkata');
            $hour = (int)$now->format('H');

            if ($hour < 12) {
                $this->activeTimeTab = 'morning';
            } elseif ($hour < 16) {
                $this->activeTimeTab = 'afternoon';
            } else {
                $this->activeTimeTab = 'evening';
            }
        } else {
            // Default to morning tab for other days
            $this->activeTimeTab = 'morning';
        }
    }

    public function setActiveTimeTab($tab)
    {
        $this->activeTimeTab = $tab;
    }

    public function updatedDoctorId($value)
    {
        $this->selectedDoctor = Doctor::with(['user', 'department'])->find($value);
        $this->validate(['doctor_id' => $this->rules['doctor_id']]);
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->availableSlots = [];
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');
        $this->prepareAvailableDates(); // Prepare available dates when doctor changes
    }

    public function generateTimeSlots()
    {
        if (!$this->selectedDoctor || !$this->appointment_date) {
            $this->availableSlots = [];
            $this->time_slots = [];
            return;
        }

        $startTime = Carbon::parse($this->selectedDoctor->start_time);
        $endTime = Carbon::parse($this->selectedDoctor->end_time);
        $duration = $this->selectedDoctor->slot_duration_minutes;
        $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;
        $this->availableSlots = [];
        $this->time_slots = [];
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

            $slotData = [
                'key' => $timeString, // Add the H:i format key for selection
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $disabled,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot,
                'tooltip' => $disabled ?
                    ($remaining <= 0 ? 'Fully booked' : 'Time slot has passed') :
                    'Available'
            ];

            $this->availableSlots[$timeString] = $slotData;
            $this->time_slots[] = $slotData;

            $currentSlot->addMinutes($duration);
        }

        // After generating slots, check if the selected tab has any slots
        // If not, switch to a tab that does have slots
        $morningSlots = $afternoonSlots = $eveningSlots = 0;

        foreach ($this->availableSlots as $time => $slot) {
            $hour = (int)date('H', strtotime($slot['start']));

            if ($hour < 12) {
                $morningSlots++;
            } elseif ($hour < 16) {
                $afternoonSlots++;
            } else {
                $eveningSlots++;
            }
        }

        // Auto-switch to a tab with slots if current tab has none
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

    public function selectTimeSlot($time)
    {
        if (isset($this->availableSlots[$time]) && !$this->availableSlots[$time]['disabled']) {
            $this->appointment_time = $time;
            $this->validate(['appointment_time' => $this->rules['appointment_time']]);
            
            // Automatically proceed to the next step after selecting a time slot
            $this->nextStep();
        }
    }

    public function nextStep()
    {
        $this->validateStep($this->step);
        $this->step++;

        if ($this->step === 2) {
            // Default to today's date when reaching the date selection step
            if (empty($this->appointment_date)) {
                $today = Carbon::today()->format('Y-m-d');
                $this->setAppointmentDate($today);
            } else {
                $this->generateTimeSlots();
            }
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
            // Only validate appointment_date when moving from step 2 to step 3
            // appointment_time will be validated when selected
            $this->validate([
                'appointment_date' => $this->rules['appointment_date'],
            ]);
            // Only validate appointment_time if it's set
            if (!empty($this->appointment_time)) {
                $this->validate(['appointment_time' => $this->rules['appointment_time']]);
            }
        } elseif ($step === 3) {
            $this->validate([
                'newPatient.name' => $this->rules['newPatient.name'],
                'newPatient.phone' => $this->rules['newPatient.phone'],
                'newPatient.age' => $this->rules['newPatient.age'],
                'newPatient.gender' => $this->rules['newPatient.gender'],
                'newPatient.email' => $this->rules['newPatient.email'],
                'newPatient.pincode' => $this->rules['newPatient.pincode'],
            ]);
            // Validate address only if it's provided
            if (!empty($this->newPatient['address'])) {
                $this->validate(['newPatient.address' => $this->rules['newPatient.address']]);
            }
        } elseif ($step === 4) {
            $this->validate([
                'payment_method' => $this->rules['payment_method'],
                'notes' => $this->rules['notes'],
            ]);
        }
    }

    protected $listeners = [
        'payment-failed' => 'handlePaymentFailed',
        'payment-success' => 'handlePaymentSuccess',
    ];

    public function save()
    {
        $this->validate();

        // If UPI payment is selected, redirect to payment processing
        if ($this->payment_method === 'upi') {
            $this->createOrder();
            return;
        }

        // For cash/card payments, create appointment directly
        try {
            DB::beginTransaction();

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

            // Create/update patient
            $patient = Patient::updateOrCreate(
                ['phone' => $this->newPatient['phone']],
                [
                    'name' => $this->newPatient['name'],
                    'email' => $this->newPatient['email'],
                    'age' => $this->newPatient['age'],
                    'gender' => $this->newPatient['gender'],
                    'pincode' => $this->newPatient['pincode'],
                    'address' => $this->newPatient['address'],
                    'district' => $this->newPatient['district'] ?? null,
                    'state' => $this->newPatient['state'] ?? null,
                ]
            );

            // Create user account if email provided
            if (!empty($this->newPatient['email'])) {
                $defaultPassword = 'patient@123';
                User::firstOrCreate(
                    ['email' => $this->newPatient['email']],
                    [
                        'name' => $this->newPatient['name'],
                        'phone' => $this->newPatient['phone'],
                        'email' => $this->newPatient['email'],
                        'password' => Hash::make($defaultPassword),
                    ]
                );
            }

            // Create appointment
            $appointment = Appointment::create([
                'doctor_id' => $this->doctor_id,
                'patient_id' => $patient->id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'notes' => $this->notes ?? null,
                'status' => 'scheduled',
                'rescheduled' => false,
                'is_rescheduled' => false,
                'original_appointment_id' => null,
                'rescheduled_at' => null,
            ]);

            // Create payment record for admin bookings with fixed 50 rupees
            $payment = \App\Models\Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'amount' => 50.00, // 50 rupees as decimal
                'method' => $this->payment_method, // Use 'method' column
                'status' => $this->payment_method === 'cash' ? 'pending' : 'paid',
                'transaction_id' => 'admin_booking_' . now()->timestamp,
                'created_by' => auth()->id(), // Track who created the payment
            ]);

            DB::commit();

            session()->flash('success', 'Appointment booked successfully! 
                <br><strong>Patient:</strong> ' . $patient->name . ' 
                <br><strong>Doctor:</strong> Dr. ' . $this->selectedDoctor->user->name . ' 
                <br><strong>Date:</strong> ' . Carbon::parse($this->appointment_date)->format('d M Y') . ' 
                <br><strong>Time:</strong> ' . Carbon::parse($this->appointment_time)->format('h:i A') . ' 
                <br><strong>Payment:</strong> ₹50 has been recorded.');
            
            // Dispatch event to refresh appointment list
            $this->dispatch('appointmentCreated');
            
            // Redirect to appointments list
            return redirect()->route('admin.appointment');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Admin appointment creation failed: ' . $e->getMessage());
            $this->addError('booking_error', 'Failed to create appointment: ' . $e->getMessage());
        }
    }

    public function createOrder()
    {
        $this->validate();
        $this->isProcessing = true;

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
            $this->addError('payment_error', 'Failed to create payment order: ' . $e->getMessage());
        } finally {
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
            
            try {
                $payment = $api->payment->fetch($paymentId);
                \Log::info('Payment verification', ['payment_id' => $paymentId, 'status' => $payment->status]);
                
                if ($payment->status !== 'authorized' && $payment->status !== 'captured') {
                    throw new \Exception('Payment not completed. Status: ' . $payment->status);
                }
            } catch (\Exception $e) {
                \Log::error('Payment verification failed', ['payment_id' => $paymentId, 'error' => $e->getMessage()]);
                throw new \Exception('Payment verification failed: ' . $e->getMessage());
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
            $paymentRecord = Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'amount' => $paymentDetails['amount'],
                'transaction_id' => $paymentId,
                'status' => 'paid',
                'method' => 'upi',
                'razorpay_payment_id' => $paymentId,
                'razorpay_order_id' => $paymentDetails['orderId'],
                'created_by' => auth()->id() ?? null,
            ]);

            DB::commit();

            session()->flash('success', 'Appointment booked successfully! Payment completed via UPI.');
            
            // Dispatch event to refresh appointment list
            $this->dispatch('appointmentCreated');
            
            // Redirect to appointments list instead of confirmation page
            return redirect()->route('admin.appointment');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Payment failed: {$e->getMessage()}", [
                'paymentId' => $paymentId,
                'error' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Payment processing failed. Please try again.');
            return redirect()->route('admin.appointment');
        }
    }

    public function handlePaymentFailed($data = null)
    {
        $errorMessage = 'Payment was cancelled or failed.';
        if ($data && isset($data['error'])) {
            $errorMessage = 'Payment failed: ' . $data['error'];
        }
        
        \Log::warning('Payment failed', ['data' => $data, 'user' => auth()->id()]);
        session()->flash('error', $errorMessage);
        $this->isProcessing = false;
        
        // Reset payment state
        $this->orderId = null;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.add', [
            'selectedDepartment' => $this->selectedDepartment,
            'departments' => $this->departments,
            'selectedDoctor' => $this->selectedDoctor,
            'currentMonth' => $this->currentMonth,
            'availableDates' => $this->availableDates,
            'activeTimeTab' => $this->activeTimeTab,
        ]);
    }
}