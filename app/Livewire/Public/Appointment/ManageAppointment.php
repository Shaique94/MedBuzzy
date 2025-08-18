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
        'gender' => 'male',
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
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');

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
   
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['appointment_date'])) {
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
            'payment_capture' => $this->amount > 0 ? 1 : 0,
        ]);

        $this->orderId = $order['id'];
        \Log::info('Razorpay order created', ['orderId' => $this->orderId]);

        // Pre-create Payment
        Payment::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'created_by' => $user->id, // Always use the user ID, not Auth::id()
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
    #[On('payment-success')]
    public function handlePaymentSuccess($paymentId = null, $eventData = null)
    {
        // Prevent duplicate processing
        if ($this->isProcessing) {
            \Log::info('Payment success already being processed, ignoring duplicate call');
            return;
        }
        
        $this->isProcessing = true;
        
        // Log what we received for debugging

        \Log::info('handlePaymentSuccess called', [
            'paymentId' => $paymentId,
            'eventData_type' => gettype($eventData),
            'eventData' => is_array($eventData) ? $eventData : (is_object($eventData) ? json_decode(json_encode($eventData), true) : $eventData),
        ]);

        // Convert object to array if needed
        if (is_object($eventData)) {
            try {
                $eventData = json_decode(json_encode($eventData), true);
            } catch (\Exception $e) {
                \Log::error('Failed to convert eventData object to array', ['error' => $e->getMessage()]);
                $eventData = [];
            }
        }
        
        // Ensure we have an array to work with
        if (!is_array($eventData)) {
            $eventData = [];
        }

        // If dispatched as CustomEvent, unwrap detail
        if (is_array($eventData) && isset($eventData['detail']) && is_array($eventData['detail'])) {
            $eventData = $eventData['detail'];
        }

        $orderId = $signature = null;
        $appointmentInfo = [];
        $incomingApptId = null;

        // Extract data from the eventData
        if (is_array($eventData)) {
            $orderId = $eventData['orderId'] ?? $eventData['razorpay_order_id'] ?? $eventData['order_id'] ?? null;
            $signature = $eventData['signature'] ?? $eventData['razorpay_signature'] ?? null;
            $appointmentInfo = $eventData['appointmentData'] ?? ($eventData['appointment'] ?? []);
            $incomingApptId = $eventData['appointmentId'] ?? null;
        }
        
        \Log::info('Extracted payment data', [
            'paymentId' => $paymentId,
            'orderId' => $orderId,
            'signature' => $signature,
            'appointmentId' => $incomingApptId,
            'eventData_keys' => is_array($eventData) ? array_keys($eventData) : 'not_array'
        ]);

        // Fallback: try different payload structures if extraction failed
        // Note: Commented out as method signature has changed to explicit parameters
        /*
        if (!$paymentId || !$orderId) {
            // Normalize common shapes from different integrations / dispatch styles
            if (is_array($payload) && isset($payload['response'])) {
                // Nested response object (some integrations)
                $resp            = is_array($payload['response']) ? $payload['response'] : [];
                $paymentId       = $paymentId ?: ($resp['razorpay_payment_id'] ?? null);
                $orderId         = $orderId ?: ($resp['razorpay_order_id'] ?? null);
                $signature       = $signature ?: ($resp['razorpay_signature'] ?? null);
                $eventData       = $eventData ?: ($payload['allData'] ?? []);
                $appointmentInfo = $appointmentInfo ?: ($payload['appointmentData'] ?? ($payload['appointment'] ?? []));
                $incomingApptId  = $incomingApptId ?: ($payload['appointmentId'] ?? null);
            } elseif (is_string($payload) && is_array($meta)) {
                // Two-arg style
                $paymentId       = $paymentId ?: $payload;
                $orderId         = $orderId ?: ($meta['orderId'] ?? null);
                $signature       = $signature ?: ($meta['signature'] ?? null);
                $eventData       = $eventData ?: ($meta['allData'] ?? []);
                $appointmentInfo = $appointmentInfo ?: ($meta['appointmentData'] ?? ($meta['appointment'] ?? []));
                $incomingApptId  = $incomingApptId ?: ($meta['appointmentId'] ?? null);
            }
        }
        */

        // If still missing IDs, log and bail gracefully (don’t throw)
        if (!$paymentId) {
            \Log::warning('payment-success received without payment ID', [
                'paymentId' => $paymentId,
                'orderId' => $orderId,
                'eventData_keys' => is_array($eventData) ? array_keys($eventData) : 'not_array',
            ]);
            session()->flash('error', 'Payment could not be verified. Please try again or contact support.');
            $this->dispatch('payment-verify-failed', [
                'message' => 'Payment verification data missing. Please try again.'
            ]);
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

             // Find pre-created payment record with better logging
             \Log::info('Looking for payment record', [
                 'orderId' => $orderId,
                 'appointmentId' => $incomingApptId
             ]);

             $paymentRecord = null;
             if ($orderId) {
                 $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
                 \Log::info('Payment record lookup by orderId', [
                     'orderId' => $orderId,
                     'found' => $paymentRecord ? true : false,
                     'payment_id' => $paymentRecord?->id,
                     'current_status' => $paymentRecord?->status
                 ]);
             }
             
             // Fallback: try to find by appointment ID if we have it and no payment found yet
             if (!$paymentRecord && $incomingApptId) {
                 $paymentRecord = Payment::where('appointment_id', $incomingApptId)
                     ->whereIn('status', ['pending', 'paid']) // Include paid status for duplicate calls
                     ->latest('id')
                     ->first();
                 \Log::info('Payment record lookup by appointmentId fallback', [
                     'appointmentId' => $incomingApptId,
                     'found' => $paymentRecord ? true : false,
                     'payment_id' => $paymentRecord?->id,
                     'current_status' => $paymentRecord?->status
                 ]);
             }
             
             // Last fallback: get the latest payment if we have component appointmentId
             if (!$paymentRecord && $this->appointmentId) {
                 $paymentRecord = Payment::where('appointment_id', $this->appointmentId)
                     ->whereIn('status', ['pending', 'paid']) // Include paid status for duplicate calls
                     ->latest('id')
                     ->first();
                 \Log::info('Payment record lookup by component appointmentId fallback', [
                     'componentAppointmentId' => $this->appointmentId,
                     'found' => $paymentRecord ? true : false,
                     'payment_id' => $paymentRecord?->id,
                     'current_status' => $paymentRecord?->status
                 ]);
             }

             if (!$paymentRecord) {
                 $this->isProcessing = false; // Reset processing flag
                 \Log::error('No payment record found - debugging info', [
                     'orderId' => $orderId,
                     'incomingApptId' => $incomingApptId,
                     'componentApptId' => $this->appointmentId,
                     'recent_payments' => Payment::latest('id')->take(5)->get(['id', 'appointment_id', 'razorpay_order_id', 'status'])->toArray()
                 ]);
                 throw new \Exception('Payment record not found for order.');
             }
             
             // If payment is already processed, just redirect to confirmation
             if ($paymentRecord->status === 'paid') {
                 $this->isProcessing = false; // Reset processing flag
                 \Log::info('Payment already processed, redirecting to confirmation', [
                     'paymentId' => $paymentRecord->id,
                     'appointmentId' => $paymentRecord->appointment_id
                 ]);
                 
                 $appointment = Appointment::find($paymentRecord->appointment_id);
                 if ($appointment) {
                     $confirmationRoute = route('appointment.confirmation', ['id' => $appointment->id]);
                     $this->dispatch('redirect-to-confirmation', $confirmationRoute);
                     return $this->redirectRoute('appointment.confirmation', ['id' => $appointment->id]);
                 }
                 return;
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
             if (!$appointment) {
                 throw new \Exception('Appointment not found for payment record');
             }
             $appointment->update(['status' => 'scheduled']);

             // Send booking email
             $patient = Patient::find($paymentRecord->patient_id);
             if ($patient) {
                 SendBookingConfirmationEmail::dispatch($patient, $appointment);
             }

             DB::commit();

             \Log::info('Payment success - appointment scheduled', [
                 'appointmentId' => $appointment->id,
                 'paymentId' => $paymentRecord->id,
                 'status' => $appointment->status
             ]);

             // Auto-login and redirect
             if ($paymentRecord->created_by && !Auth::check()) {
                 $user = User::find($paymentRecord->created_by);
                    if (!$user) {
                        \Log::warning('User not found for auto-login', ['userId' => $paymentRecord->created_by]);
                    } else {
                        \Log::info('Auto-logging in user', ['userId' => $user->id, 'name' => $user->name]);
                        
                        // Regenerate session before login to prevent session fixation
                        session()->regenerate();
                        
                        // Login the user with remember me
                        Auth::login($user, true);
                        
                        // Explicitly save the session
                        session()->save();
                        
                        \Log::info('Auto-login completed', [
                            'logged_in_user_id' => Auth::id(),
                            'session_id' => session()->getId(),
                            'auth_check' => Auth::check()
                        ]);
                    }
             } else if (Auth::check()) {
                 \Log::info('User already logged in', ['user_id' => Auth::id()]);
             } else {
                 \Log::info('No created_by user for auto-login', ['payment_id' => $paymentRecord->id]);
             }

             // Clear any processing state
             $this->isProcessing = false;
             
             // Ensure session is saved before redirect
             session()->save();
             
             // Small delay to ensure session persistence
             usleep(100000); // 100ms delay
             
             // Redirect to confirmation page
             \Log::info('Redirecting to confirmation page', [
                 'appointmentId' => $appointment->id,
                 'auth_check' => Auth::check(),
                 'user_id' => Auth::id()
             ]);
             $confirmationRoute = route('appointment.confirmation', ['id' => $appointment->id]);
             
             // Dispatch event for JavaScript handling
             $this->dispatch('redirect-to-confirmation', $confirmationRoute);
             
             // Also use Livewire redirect as backup
             return $this->redirectRoute('appointment.confirmation', ['id' => $appointment->id]);
         } catch (\Exception $e) {
             DB::rollBack();
             $this->isProcessing = false; // Reset processing flag
             
             \Log::error("Payment success handling failed: {$e->getMessage()}", [
                 'paymentId' => $paymentId ?? null,
                 'orderId'   => $orderId ?? null,
                 'appointmentId' => $incomingApptId ?? $this->appointmentId,
             ]);

             // Try to mark payment failed (leave appointment as pending for retry)
             $appointmentIdForFailed = null;
             if (!empty($orderId)) {
                 $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
                 if ($paymentRecord) {
                     $paymentRecord->update(['status' => 'failed']);
                     $appointmentIdForFailed = $paymentRecord->appointment_id;
                 }
             }
             
             // Fallback: use incoming or component appointment ID
             if (!$appointmentIdForFailed) {
                 $appointmentIdForFailed = $incomingApptId ?? $this->appointmentId;
             }

             session()->flash('error', 'Payment verification failed. Please contact support.');
             
             // Redirect to failed appointment page if we have appointment ID
             if ($appointmentIdForFailed) {
                 \Log::info('Redirecting to failed appointment page', ['appointmentId' => $appointmentIdForFailed]);
                 return $this->redirectRoute('appointment.failed', ['id' => $appointmentIdForFailed]);
             }
             
             // Last resort: Navigate to home with failure marker
             \Log::info('No appointment ID available, redirecting to home with failure marker');
             return $this->redirectRoute('hero', ['payment' => 'failed']);
         }
    }

    #[On('payment-failed')]
    public function handlePaymentFailed(...$args)
    {
        // Accept variadic args (some dispatches send none / different shapes)
        $data = $args[0] ?? ($args[1] ?? []);
        
        if (is_object($data)) $data = json_decode(json_encode($data), true);
        
        // Enhanced logging for debugging
        \Log::info('handlePaymentFailed called - DEBUG', [
            'arg_count' => count($args),
            'raw_args_sample' => is_array($args) ? array_map(fn($a) => is_scalar($a) ? $a : (is_array($a) ? array_slice($a,0,8) : gettype($a)), $args) : gettype($args),
            'processed_data' => $data,
            'current_component_state' => [
                'appointmentId' => $this->appointmentId ?? null,
                'orderId' => $this->orderId ?? null,
                'doctor_id' => $this->doctor_id ?? null,
            ]
        ]);

        // Mark pending payment/appointment as failed
        $orderId = is_array($data) ? ($data['orderId'] ?? $data['order_id'] ?? $data['order'] ?? null) : null;
        $paymentRecord = null;
        $appointmentId = null;
        
        // If no orderId from data, try to use component's orderId
        if (!$orderId && $this->orderId) {
            $orderId = $this->orderId;
            \Log::info('Using component orderId as fallback', ['orderId' => $orderId]);
        }
        
        try {
            if ($orderId) {
                $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
                \Log::info('Payment record lookup result', [
                    'orderId' => $orderId,
                    'payment_found' => !is_null($paymentRecord),
                    'payment_id' => $paymentRecord->id ?? null,
                    'appointment_id' => $paymentRecord->appointment_id ?? null,
                    'current_payment_status' => $paymentRecord->status ?? null,
                    'current_appointment_status' => $paymentRecord ? optional(Appointment::find($paymentRecord->appointment_id))->status : null
                ]);
                
                if ($paymentRecord) {
                    $paymentRecord->update(['status' => 'failed']);
                    $appointmentId = $paymentRecord->appointment_id;
                    
                    \Log::info('Updated payment status to failed, appointment remains pending', [
                        'payment_id' => $paymentRecord->id,
                        'appointment_id' => $appointmentId,
                        'payment_status' => 'failed'
                    ]);
                }
            } else {
                \Log::warning('No orderId found in payment-failed data', [
                    'data_keys' => is_array($data) ? array_keys($data) : 'not_array',
                    'component_orderId' => $this->orderId ?? null,
                    'component_appointmentId' => $this->appointmentId ?? null
                ]);
                
                // Try to find appointment using component's appointmentId if available
                if ($this->appointmentId) {
                    $appointment = Appointment::find($this->appointmentId);
                    if ($appointment && $appointment->status === 'pending') {
                        $appointmentId = $appointment->id;
                        
                        // Only update related payment if exists, leave appointment as pending
                        $payment = Payment::where('appointment_id', $appointment->id)->first();
                        if ($payment && $payment->status === 'pending') {
                            $payment->update(['status' => 'failed']);
                        }
                        
                        \Log::info('Updated payment via component appointmentId, appointment remains pending', [
                            'appointment_id' => $appointment->id,
                            'payment_updated' => !is_null($payment)
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            \Log::error('Failed to mark payment/appointment as failed', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
                'orderId' => $orderId
            ]);
        }

        $message = 'Payment failed: ' . ($data['error'] ?? 'Unknown error');
        session()->flash('error', $message);
        
        // Debug: Check for appointments with pending status and pending payment
        $this->checkAndRedirectPendingAppointments($appointmentId);
        
        // Try to redirect to failed appointment page (no modal, direct redirect)
        if ($paymentRecord && $paymentRecord->appointment_id) {
            \Log::info('REDIRECT ATTEMPT 1 - Using payment record appointment ID', [
                'appointment_id' => $paymentRecord->appointment_id,
                'order_id' => $orderId,
                'route_exists' => \Route::has('appointment.failed')
            ]);
            
            return $this->redirectRoute('appointment.failed', ['id' => $paymentRecord->appointment_id]);
        }
        
        // If no payment record found but we have orderId, try one more time
        if ($orderId && !$paymentRecord) {
            $paymentRecord = Payment::where('razorpay_order_id', $orderId)->first();
            if ($paymentRecord && $paymentRecord->appointment_id) {
                \Log::info('REDIRECT ATTEMPT 2 - Second payment record lookup', [
                    'appointment_id' => $paymentRecord->appointment_id,
                    'order_id' => $orderId
                ]);
                
                return $this->redirectRoute('appointment.failed', ['id' => $paymentRecord->appointment_id]);
            }
        }
        
        // Try using component's appointmentId as fallback
        if ($appointmentId || $this->appointmentId) {
            $finalAppointmentId = $appointmentId ?? $this->appointmentId;
            \Log::info('REDIRECT ATTEMPT 3 - Using component appointmentId', [
                'appointment_id' => $finalAppointmentId
            ]);
            
            return $this->redirectRoute('appointment.failed', ['id' => $finalAppointmentId]);
        }
        
        // Last fallback: Navigate to home with failure marker
        \Log::error('REDIRECT FAILED - Going to home page', [
            'order_id' => $orderId,
            'has_payment_record' => !is_null($paymentRecord),
            'component_appointmentId' => $this->appointmentId ?? null,
            'final_appointmentId' => $appointmentId
        ]);
        
        return $this->redirectRoute('hero', ['payment' => 'failed']);
    }
 
    #[On('retry-payment')]
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
            // Clear the patient form so "Someone else" shows an empty form,
            // and clear related validation errors.
            $this->newPatient = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'gender' => 'male',
            ];
            $this->resetErrorBag(['newPatient.*']);
        }
    }

    // Explicit action callable from Blade to clear patient form immediately
    
   
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
    
    /**
     * Check for appointments with pending status and pending payment status
     * and redirect them to failed page for debugging
     */
    private function checkAndRedirectPendingAppointments($currentAppointmentId = null)
    {
        try {
            // Find appointments with pending status and pending payments
            $pendingAppointments = Appointment::whereHas('payments', function ($query) {
                $query->where('status', 'pending');
            })->where('status', 'pending')->get();
            
            \Log::info('Checking pending appointments', [
                'total_pending_appointments' => $pendingAppointments->count(),
                'current_appointment_id' => $currentAppointmentId,
                'appointments' => $pendingAppointments->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'status' => $appointment->status,
                        'payment_status' => optional($appointment->payments()->first())->status,
                        'created_at' => $appointment->created_at,
                        'updated_at' => $appointment->updated_at
                    ];
                })->toArray()
            ]);
            
            // Update old pending payments to failed (older than 30 minutes), but leave appointments as pending
            $oldPendingAppointments = Appointment::whereHas('payments', function ($query) {
                $query->where('status', 'pending');
            })->where('status', 'pending')
            ->where('created_at', '<', now()->subMinutes(30))
            ->get();
            
            foreach ($oldPendingAppointments as $appointment) {
                // Only update payment status, leave appointment as pending
                $payment = $appointment->payments()->first();
                if ($payment && $payment->status === 'pending') {
                    $payment->update(['status' => 'failed']);
                }
                
                \Log::info('Auto-failed old pending payment, appointment remains pending', [
                    'appointment_id' => $appointment->id,
                    'age_minutes' => now()->diffInMinutes($appointment->created_at),
                    'payment_updated' => !is_null($payment)
                ]);
            }
            
        } catch (\Throwable $th) {
            \Log::error('Error checking pending appointments', [
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString()
            ]);
        }
    }
}