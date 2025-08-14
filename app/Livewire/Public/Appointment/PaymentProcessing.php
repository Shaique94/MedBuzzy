<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Razorpay\Api\Api;

class PaymentProcessing extends Component
{
    public $doctor_id;
    public $selectedDoctor;
    public $appointment_date;
    public $appointment_time;
    public $newPatient;
    public $notes;
    public $amount = 5000;
    public $orderId;
    public $isProcessing = false;

    protected $rules = [
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required',
        'newPatient.name' => 'required|string|min:3|max:255',
        'newPatient.email' => 'nullable|email|max:255',
        'newPatient.phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
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
        'appointment_time.required' => 'Please select an appointment time.',
        'newPatient.name.required' => 'Patient name is required.',
        'newPatient.name.min' => 'Name must be at least 3 characters.',
        'newPatient.phone.required' => 'Phone number is required.',
        'newPatient.phone.digits' => 'Phone number must be exactly 10 digits',
        'newPatient.phone.regex' => 'Phone number must start with 6,7,8 or 9',
        'newPatient.age.required' => 'Age is required.',
        'newPatient.age.min' => 'Age must be at least 1 year.',
        'newPatient.age.max' => 'Age must be less than 120 years.',
        'newPatient.gender.required' => 'Gender is required.',
        'newPatient.pincode.required' => 'Pincode is required.',
        'newPatient.pincode.digits' => 'Pincode must be 6 digits.',
        'newPatient.address.required' => 'Address is required.',
        'newPatient.address.min' => 'Address must be at least 10 characters.',
    ];

    public function mount($doctor_id, $selectedDoctor, $appointment_date, $appointment_time, $newPatient, $notes, $orderId = null)
    {
        $this->doctor_id = $doctor_id;
        $this->selectedDoctor = $selectedDoctor;
        $this->appointment_date = $appointment_date;
        $this->appointment_time = $appointment_time;
        $this->newPatient = $newPatient;
        $this->notes = $notes;
        $this->orderId = $orderId;
    }

    public function createOrder()
    {
        $this->validate();

        try {
            $bookedCount = Appointment::where([
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
            ])->count();

            $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;
            if ($bookedCount >= $maxPatientsPerSlot) {
                throw new \Exception('Selected time slot is no longer available.');
            }

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $order = $api->order->create([
                'receipt' => 'temp_appointment_' . now()->timestamp,
                'amount' => $this->amount,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);

            $this->orderId = $order['id'];

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
    public function handlePaymentSuccess($paymentId, $allData)
    {
        DB::beginTransaction();

        try {
            $paymentDetails = [
                'key' => $allData[0]['key'],
                'orderId' => $allData[0]['orderId'],
                'amount' => $allData[0]['amount'] / 100,
            ];

            $patientInfo = $allData[0]['patientData'];
            $appointmentInfo = $allData[0]['appointmentData'];

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $payment = $api->payment->fetch($paymentId);

            if ($payment->status !== 'authorized') {
                throw new \Exception('Payment not captured');
            }

            $defaultPassword = 'patient@123';
            $user = User::firstOrCreate(
                ['phone' => $patientInfo['phone']],
                [
                    'name' => $patientInfo['name'],
                    'email' => $patientInfo['email'] ?? null,
                    'password' => Hash::make($defaultPassword),
                    'role' => 'patient',
                    'gender' => $patientInfo['gender'],
                ]
            );

            $patient = Patient::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'name' => $patientInfo['name'],
                    'age' => $patientInfo['age'],
                ],
                [
                    'email' => $patientInfo['email'] ?? null,
                    'gender' => $patientInfo['gender'],
                    'pincode' => $patientInfo['pincode'],
                    'address' => $patientInfo['address'],
                    'district' => $patientInfo['district'] ?? null,
                    'state' => $patientInfo['state'] ?? null,
                    'country' => 'India',
                ]
            );

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

            $payment = Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'amount' => $paymentDetails['amount'],
                'transaction_id' => $paymentId,
                'status' => 'paid',
                'method' => 'upi',
            ]);

            DB::commit();
            Auth::login($user);

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

    #[On('payment-failed')]
    public function handlePaymentFailed($data)
    {
        session()->flash('error', 'Payment failed: ' . $data['error']);
    }

    public function previousStep()
    {
        $this->dispatch('previous-step');
    }

    public function render()
    {
        return view('livewire.public.appointment.payment-processing');
    }
}