<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Razorpay\Api\Api;

class AppointmentWizard extends Component
{
    public $currentStep = 1;
    public $totalSteps = 4;
    public $doctorSlug = null;
    public $appointmentData = [];
    public $amount = 5000; // Fixed ₹50 (5000 paise)
    public $doctorConfirmed = false; // New property to track doctor confirmation

    protected $listeners = ['validateAndProceed', 'doctor-confirmed'];

    public function mount($doctor_slug = null)
    {
        $this->doctorSlug = $doctor_slug;
        if ($doctor_slug) {
            $doctor = Doctor::with(['user', 'department'])->where('slug', $doctor_slug)->first();
            if ($doctor) {
                $this->appointmentData['doctor_id'] = $doctor->id;
                $this->appointmentData['selected_doctor'] = $doctor;
            } else {
                session()->flash('error', 'Invalid doctor selected. Please choose a doctor.');
            }
        }
    }

    #[On('doctor-confirmed')]
    public function updateDoctorConfirmed($data)
    {
        $this->doctorConfirmed = $data['confirmed'];
    }

    public function validateAndProceed()
    {
        $this->dispatch('validateAndProceed');
    }

    #[On('step-validated')]
    public function nextStep($data = [])
    {
        logger('nextStep called', ['currentStep' => $this->currentStep, 'data' => $data, 'doctorConfirmed' => $this->doctorConfirmed]);
        if ($this->currentStep === 1 && !isset($data['doctor_id'])) {
            session()->flash('error', 'Doctor selection is required.');
            return;
        }
        $this->appointmentData = array_merge($this->appointmentData, $data);
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            $this->doctorConfirmed = false; // Reset for next steps
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->doctorConfirmed = $this->currentStep === 1 && isset($this->appointmentData['doctor_id']);
        }
    }

    public function submitAppointment()
    {
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $order = $api->order->create([
                'receipt' => 'temp_appointment_' . now()->timestamp,
                'amount' => $this->amount,
                'currency' => 'INR',
                'payment_capture' => 1,
            ]);

            $this->appointmentData['order_id'] = $order['id'];
            $this->dispatch('razorpay:open', [
                'key' => config('services.razorpay.key'),
                'orderId' => $order['id'],
                'amount' => $this->amount,
                'patientData' => $this->appointmentData['patient'],
                'appointmentData' => [
                    'doctor_id' => $this->appointmentData['doctor_id'],
                    'appointment_date' => $this->appointmentData['appointment_date'],
                    'appointment_time' => $this->appointmentData['appointment_time'],
                    'notes' => $this->appointmentData['notes'] ?? null,
                ]
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }

    #[On('payment-success')]
    public function handlePaymentSuccess($paymentId, $allData)
    {
        DB::beginTransaction();
        try {
            $paymentDetails = $allData[0];
            $patientInfo = $allData[0]['patientData'];
            $appointmentInfo = $allData[0]['appointmentData'];

            if (!isset($appointmentInfo['doctor_id'], $appointmentInfo['appointment_date'], $appointmentInfo['appointment_time'])) {
                throw new \Exception('Invalid appointment data.');
            }

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
                'amount' => $paymentDetails['amount'] / 100,
                'transaction_id' => $paymentId,
                'status' => 'paid',
                'method' => 'upi',
            ]);

            DB::commit();
            Auth::login($user);
            return redirect()->route('appointment.confirmation', $appointment->id)
                ->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }

    #[On('payment-failed')]
    public function handlePaymentFailed($data)
    {
        session()->flash('error', 'Payment failed: ' . $data['error']);
    }

    #[Layout('layouts.public')]
    #[Title('Book Appointment')]
    public function render()
    {
        return view('livewire.public.appointment.appointment-wizard');
    }
}