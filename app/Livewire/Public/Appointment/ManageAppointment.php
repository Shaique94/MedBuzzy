<?php

namespace App\Livewire\Public\Appointment;

use App\Jobs\SendBookingConfirmationEmail;
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
use Razorpay\Api\Utility;

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
    public $amount = 5000; // Fixed ₹50 (5000 paise)
    public $orderId;
    public $appointmentId;
    public $newPatient = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'gender' => '',
    ];

    // Add booking_for: 'self' | 'other'
    public $booking_for = 'self';

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
        'newPatient.phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
        'newPatient.gender' => 'required|string|in:male,female,other',
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
        'newPatient.phone.digits' => 'Phone number must be exactly 10 digits',
        'newPatient.phone.regex' => 'Phone number must start with 6,7,8 or 9',
        'newPatient.gender.required' => 'Gender is required.',
        'newPatient.email.email' => 'Please enter a valid email address.',
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

        // If user wants "self" and is authenticated, pre-fill
        if ($this->booking_for === 'self' && Auth::check()) {
            $this->fillPatientFromAuth();
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
        return cache()->remember(
            "doctors_department_{$this->selectedDepartment}",
            now()->addHours(24),
            fn() =>
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
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selectedDepartment', 'doctor_id', 'appointment_date'])) {
            return;
        }

        $this->validateOnly($propertyName);
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
            'Sunday' => 0,
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
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
            $hour = (int) $now->format('H');

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

        // After generating slots, check if the selected tab has any slots
        // If not, switch to a tab that does have slots
        $morningSlots = $afternoonSlots = $eveningSlots = 0;

        foreach ($this->availableSlots as $time => $slot) {
            $hour = (int) date('H', strtotime($slot['start']));

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
        // Only allow up to step 3 (Doctor -> Date/Time -> Patient+Payment)
        if ($this->step < 3) {
            $this->step++;
        }

        // When arriving to date selection (step 2) ensure date/slots are prepared
        if ($this->step === 2) {
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
            $this->validate([
                'appointment_date' => $this->rules['appointment_date'],
                'appointment_time' => $this->rules['appointment_time'],
            ]);
        } elseif ($step === 3) {
            // Patient info + notes validated before payment
            $this->validate([
                'newPatient.name' => $this->rules['newPatient.name'],
                'newPatient.phone' => $this->rules['newPatient.phone'],
                'newPatient.gender' => $this->rules['newPatient.gender'],
                'newPatient.email' => $this->rules['newPatient.email'],
                'notes' => $this->rules['notes'],
            ]);
        }
    }

    protected $listeners = [
        // Keep for backward compatibility; primary binding is via #[On(...)]
        'payment-failed' => 'handlePaymentFailed',
        'payment-success' => 'handlePaymentSuccess',
        'retry-payment' => 'retryPayment',
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

        DB::beginTransaction();

        // Ensure User exists
        $email = $this->newPatient['email'] ?? 'guest+' . ($this->newPatient['phone'] ?? time()) . '@medbuzzy.local';
        $user = User::firstOrCreate(
            ['phone' => $this->newPatient['phone']],
            [
                'name' => $this->newPatient['name'] ?? 'Patient',
                'email' => $email,
                'password' => Hash::make('patient@123'),
                'role' => 'patient',
                'gender' => $this->newPatient['gender'] ?? null,
            ]
        );


        // Ensure Patient exists
        $patient = Patient::updateOrCreate(
            [
                'user_id' => $user->id,
                'name' => $this->newPatient['name'] ?? $user->name,
            ],
            [
                'email' => $this->newPatient['email'] ?? $user->email,
                'gender' => $this->newPatient['gender'] ?? $user->gender,
                'pincode' => $this->newPatient['pincode'] ?? null,
                'address' => $this->newPatient['address'] ?? null,
                'district' => $this->newPatient['district'] ?? null,
                'state' => $this->newPatient['state'] ?? null,
                'country' => 'India',
            ]
        );



        // Pre-create Appointment
        $appointment = Appointment::create([
            'doctor_id' => $this->doctor_id,
            'patient_id' => $patient->id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'notes' => $this->notes ?? null,
            'status' => 'pending',
            'rescheduled' => false,
            'is_rescheduled' => false,
        ]);

        $this->appointmentId = $appointment->id;

        // Create Razorpay Order
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        if (!config('services.razorpay.key') || !config('services.razorpay.secret')) {
            throw new \Exception('Razorpay API keys are not configured');
        }
        $order = $api->order->create([
            'receipt' => 'appointment_' . $this->appointmentId,
            'amount' => $this->amount,
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        $this->orderId = $order['id'];
        \Log::info('Razorpay order created', ['orderId' => $this->orderId]);

        // Pre-create Payment
        Payment::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'created_by' => Auth::id() ?? $user->id,
            'amount' => round($this->amount / 100, 2),
            'method' => 'upi',
            'status' => 'pending',
            'razorpay_order_id' => $this->orderId,
        ]);

        DB::commit();

        // Dispatch Razorpay event
        $eventData = [
            'key' => config('services.razorpay.key'),
            'orderId' => $this->orderId,
            'amount' => $this->amount,
            'appointmentId' => $this->appointmentId,
            'patientData' => $this->newPatient,
            'appointmentData' => [
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'notes' => $this->notes,
            ],
        ];
        \Log::info('Dispatching razorpay:open event', $eventData);
        $this->dispatch('razorpay:open', $eventData);
        // If a retry is needed, handle it in JS via setTimeout. Livewire events cannot be delayed server-side.
    } catch (\Razorpay\Api\Errors\Error $e) {
        DB::rollBack();
        \Log::error('Razorpay error: ' . $e->getMessage(), [
            'code' => $e->getCode(),
            'trace' => $e->getTraceAsString(),
        ]);
        $this->addError('payment_error', 'Payment initiation failed: ' . $e->getMessage());
        $this->isProcessing = false;
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Order creation failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
        ]);
        $this->addError('payment_error', 'Failed to start payment: ' . $e->getMessage());
        $this->isProcessing = false;
    }
}

    // Handle successful payment (signature verified, update payment + appointment)
    public function handlePaymentSuccess($payload = null, $meta = null)
    {
        dd("success");
        // Normalize payload to support:
        // 1) Livewire.dispatch('payment-success', { paymentId, orderId, signature, ... })
        // 2) Livewire.dispatch('payment-success', paymentId, { orderId, signature, ... })
        // 3) Livewire.dispatch('payment-success', { response: { razorpay_payment_id, razorpay_order_id, razorpay_signature }, ... })
        // 4) Livewire.dispatch('payment-success', { razorpay_payment_id, razorpay_order_id, razorpay_signature, ... })
        $paymentId = $orderId = $signature = null;
        $eventData = $appointmentInfo = [];
        $incomingApptId = null;

        if (is_object($payload)) {
            $payload = json_decode(json_encode($payload), true);
        }
        if (is_object($meta)) {
            $meta = json_decode(json_encode($meta), true);
        }

        if (is_array($payload) && isset($payload['paymentId'])) {
            $paymentId       = $payload['paymentId'] ?? null;
            $orderId         = $payload['orderId'] ?? null;
            $signature       = $payload['signature'] ?? null;
            $eventData       = $payload['allData'] ?? [];
            $appointmentInfo = $payload['appointmentData'] ?? ($payload['appointment'] ?? []);
            $incomingApptId  = $payload['appointmentId'] ?? null;
        } elseif (is_array($payload) && isset($payload['response'])) {
            // Nested response object (some integrations)
            $resp            = is_array($payload['response']) ? $payload['response'] : [];
            $paymentId       = $resp['razorpay_payment_id'] ?? null;
            $orderId         = $resp['razorpay_order_id'] ?? null;
            $signature       = $resp['razorpay_signature'] ?? null;
            $eventData       = $payload['allData'] ?? [];
            $appointmentInfo = $payload['appointmentData'] ?? ($payload['appointment'] ?? []);
            $incomingApptId  = $payload['appointmentId'] ?? null;
        } elseif (is_array($payload) && (isset($payload['razorpay_payment_id']) || isset($payload['razorpay_order_id']))) {
            // Flat Razorpay keys at top-level
            $paymentId       = $payload['razorpay_payment_id'] ?? null;
            $orderId         = $payload['razorpay_order_id'] ?? null;
            $signature       = $payload['razorpay_signature'] ?? null;
            $eventData       = $payload['allData'] ?? [];
            $appointmentInfo = $payload['appointmentData'] ?? ($payload['appointment'] ?? []);
            $incomingApptId  = $payload['appointmentId'] ?? null;
        } elseif (is_string($payload) && is_array($meta)) {
            // Two-arg style
            $paymentId       = $payload;
            $orderId         = $meta['orderId'] ?? null;
            $signature       = $meta['signature'] ?? null;
            $eventData       = $meta['allData'] ?? [];
            $appointmentInfo = $meta['appointmentData'] ?? ($meta['appointment'] ?? []);
            $incomingApptId  = $meta['appointmentId'] ?? null;
        } else {
            // Unknown format
            $paymentId = null;
        }

        // If still missing IDs, log and bail gracefully (don’t throw)
        if (!$paymentId) {
            \Log::warning('payment-success received without IDs', [
                'payload_keys' => is_array($payload) ? array_keys($payload) : gettype($payload),
                'meta_keys'    => is_array($meta) ? array_keys($meta) : gettype($meta),
            ]);
            session()->flash('error', 'Payment could not be verified. Please try again.');
            return;
        }

         DB::beginTransaction();

         try {
            // Verify Razorpay signature if present
            if ($orderId && $signature) {
                Utility::verifyPaymentSignature([
                    'razorpay_order_id'   => $orderId,
                    'razorpay_payment_id' => $paymentId,
                    'razorpay_signature'  => $signature,
                ]);
            } else {
                \Log::warning('Razorpay signature/orderId missing in success payload, proceeding with API status check.', [
                    'paymentId' => $paymentId, 'orderId' => $orderId, 'hasSignature' => (bool) $signature
                ]);
            }

             // Optional: fetch payment and accept captured/authorized
             $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
             $rzpPayment = $api->payment->fetch($paymentId);
             if (!in_array($rzpPayment->status, ['captured', 'authorized'])) {
                 throw new \Exception('Payment not captured');
             }

             // Find pre-created payment record
             $paymentRecord = $orderId
                 ? Payment::where('razorpay_order_id', $orderId)->first()
                 : Payment::where('status', 'pending')->latest('id')->first();
             if (!$paymentRecord) {
                 throw new \Exception('Payment record not found for order.');
             }

             // Update payment with success details
             $paymentRecord->update([
                 'status'               => 'paid',
                 'transaction_id'       => $paymentId,
                 'razorpay_payment_id'  => $paymentId,
                 'razorpay_signature'   => $signature,
                 'method'               => 'upi',
             ]);

             // Update appointment to scheduled
             $appointment = Appointment::find($paymentRecord->appointment_id ?? $incomingApptId);
             if ($appointment) {
                 $appointment->update(['status' => 'scheduled']);
             }

             // Send booking email
             if ($appointment) {
                 $patient = Patient::find($paymentRecord->patient_id);
                 if ($patient) {
                     SendBookingConfirmationEmail::dispatch($patient, $appointment);
                 }
             }

             DB::commit();

             // Auto-login and redirect
             if ($paymentRecord->created_by) {
                 $user = User::find($paymentRecord->created_by);
                 if ($user) {
                     Auth::login($user);
                 }
             }

             $this->dispatch('redirect-to-confirmation', route('appointment.confirmation', $appointment->id));
             return redirect()->route('appointment.confirmation', $appointment->id);
         } catch (\Exception $e) {
             DB::rollBack();
             \Log::error("Payment success handling failed: {$e->getMessage()}", [
                 'paymentId' => $paymentId ?? null,
                 'orderId'   => $orderId ?? null,
             ]);

             // Try to mark payment/appointment failed
             if (!empty($orderId)) {
                 $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
                 if ($paymentRecord) {
                     $paymentRecord->update(['status' => 'failed']);
                     if ($paymentRecord->appointment_id) {
                         Appointment::where('id', $paymentRecord->appointment_id)->update(['status' => 'cancelled']);
                     }
                 }
             }

             session()->flash('error', 'Payment verification failed. Please contact support.');
             // Navigate to a failure page (home with marker)
             $this->redirectRoute('hero', params: ['payment' => 'failed'], navigate: true);
         }
    }

    public function handlePaymentFailed($data)
    {


        dd("failed");

        // Mark pending payment/appointment as failed/cancelled
        $orderId = $data['orderId'] ?? null; // ensure scope outside try
        try {
            if ($orderId) {
                $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
                if ($paymentRecord) {
                    $paymentRecord->update(['status' => 'failed']);
                    if ($paymentRecord->appointment_id) {
                        Appointment::where('id', $paymentRecord->appointment_id)->update(['status' => 'cancelled']);
                    }
                }
            }
        } catch (\Throwable $th) {
            \Log::warning('Failed to mark payment/appointment as failed: ' . $th->getMessage());
        }

        $message = 'Payment failed: ' . ($data['error'] ?? 'Unknown error');
        session()->flash('error', $message);
        // Ask frontend to show a retry overlay
        $this->dispatch('show-payment-failed', [
            'message' => $message,
            'orderId' => $orderId,
        ]);
        // Navigate to a failure page (home with marker)
        $this->redirectRoute('hero', params: ['payment' => 'failed'], navigate: true);
    }

    // Retry creating a payment/order using current component state
    public function retryPayment()
    {
        // Basic guards to avoid retry without context
        if (!$this->doctor_id || !$this->appointment_date || !$this->appointment_time || empty($this->newPatient['name']) || empty($this->newPatient['phone'])) {
            session()->flash('error', 'Missing details to retry payment. Please review your selections.');
            return;
        }
        $this->createOrder();
    }

    // Called when booking_for value changes by Livewire (naming convention)
    public function updatedBookingFor($value)
    {
        if ($value === 'self') {
            $this->fillPatientFromAuth();
        } else {
            // keep any existing typed values but clear validation errors related to patient
            $this->resetErrorBag(['newPatient.*']);
        }
    }

    // Public action to manually trigger autofill (wire:click from blade)
    public function useMyProfile()
    {
        if (!Auth::check()) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => 'Please login to autofill your profile.']);
            return;
        }

        $this->booking_for = 'self';
        $this->fillPatientFromAuth();
    }

    // Helper to copy user / patient info into newPatient
    protected function fillPatientFromAuth()
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();

        // Basic fields from user model
        $this->newPatient['name'] = $user->name ?? $this->newPatient['name'];
        $this->newPatient['email'] = $user->email ?? $this->newPatient['email'];
        $this->newPatient['phone'] = $user->phone ?? $this->newPatient['phone'];
        $this->newPatient['gender'] = $user->gender ?? $this->newPatient['gender'];

        // If you store patient records, prefer patient's stored details (non-destructive)
        $patient = Patient::where('user_id', $user->id)->first();
        if ($patient) {
            $this->newPatient['name'] = $patient->name ?? $this->newPatient['name'];
            $this->newPatient['email'] = $patient->email ?? $this->newPatient['email'];
            $this->newPatient['phone'] = $patient->phone ?? $this->newPatient['phone'] ?? $patient->mobile ?? $this->newPatient['phone'];
            $this->newPatient['gender'] = $patient->gender ?? $this->newPatient['gender'];
        }

        // Clear validation errors for patient fields
        $this->resetErrorBag(['newPatient.*']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.appointment.manage-appointment', [
            'selectedDepartment' => $this->selectedDepartment,
            'departments' => $this->departments,
            'selectedDoctor' => $this->selectedDoctor,
            'currentMonth' => $this->currentMonth,
            'onLeaveDates' => $onLeaveDates ?? [],
            'availableDates' => $this->availableDates,
            'activeTimeTab' => $this->activeTimeTab,
        ]);
    }
}