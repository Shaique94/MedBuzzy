<?php

namespace App\Livewire\Public\Appointments;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use Livewire\Attributes\Layout;

#[Layout('layouts.public')]

class BookAppointment extends Component
{
    public $doctor;
    public $doctor_slug;
    public $selected_date;
    public $selected_time;
    public $patient_type = 'myself';
    public $patient_name;
    public $patient_email;
    public $patient_phone;
    public $patient_gender = 'male';
    public $booking_fee = 50;

    protected $rules = [
        'selected_date' => 'required|date|after_or_equal:today',
        'selected_time' => 'required',
        'patient_type' => 'required|in:myself,someone',
        'patient_name' => 'required|string|max:255',
        'patient_phone' => 'required|string|max:15',
        'patient_gender' => 'required|in:male,female,other',
    ];

    protected $listeners = ['initAppointmentPayment' => 'handlePaymentData', 'paymentSuccess' => 'handlePaymentSuccess'];

    public function mount($doctor_slug)
    {
        if (!Auth::check()) {
            Session::put('doctor_slug', $doctor_slug);
            return redirect()->route('login');
        }

        $this->doctor = Doctor::where('slug', $doctor_slug)->firstOrFail();
        $this->doctor_slug = $doctor_slug;

        if (Auth::check() && $this->patient_type === 'myself') {
            $this->loadUserPatientData();
        }
    }

    public function updateDate($date)
    {
        $this->selected_date = $date;
    }

    public function updateTime($time)
    {
        $this->selected_time = $time;
    }

    public function loadUserPatientData()
    {
        $user = Auth::user();
        if ($user) {
            $patient = $user->patients()->first();
            if ($patient) {
                $this->patient_name = $patient->name;
                $this->patient_email = $patient->email;
                $this->patient_phone = $user->phone;
                $this->patient_gender = $patient->gender;
            } else {
                $this->patient_name = $user->name;
                $this->patient_email = $user->email;
                $this->patient_phone = $user->phone;
                $this->patient_gender = $user->gender ?? 'male';
            }
        }
    }

    public function updated($property)
    {
        if (in_array($property, ['patient_type', 'patient_name', 'patient_email', 'patient_phone', 'patient_gender'])) {
            $this->validateOnly($property);
        }
    }

    public function confirmAndPay()
    {
        // dd('tetestings');
        $this->validate();

        // try {
            $receipt = 'APPT_' . time();
            Log::info('Appointment payment initiation started', ['receipt' => $receipt]);

            $user = Auth::user();
            $patient = Patient::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $this->patient_type === 'myself' ? $user->name : $this->patient_name,
                    'email' => $this->patient_email,
                    'gender' => $this->patient_gender,
                ]
            );

            $appointment = Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $this->doctor->id,
                'status' => 'pending',
                'appointment_date' => Carbon::parse($this->selected_date),
                'appointment_time' => $this->selected_time,
                'created_by' => $user->id,
            ]);

            $payment = Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'created_by' => $user->id,
                'amount' => $this->booking_fee,
                'total_amount' => $this->booking_fee,
                'method' => 'razorpay',
                'status' => 'pending',
                'payment_status' => 'initiated',
                'receipt_no' => $receipt,
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year,
            ]);

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $orderData = [
                'amount' => $this->booking_fee * 100,
                'currency' => 'INR',
                'receipt' => $receipt,
                'payment_capture' => 1,
            ];

            $razorpayOrder = $api->order->create($orderData);
            $payment->update(['order_id' => $razorpayOrder->id]);

            if (empty(config('services.razorpay.key'))) {
                throw new \Exception('Razorpay key not configured');
            }

            $data = [
                'key' => config('services.razorpay.key'),
                'amount' => $this->booking_fee * 100,
                'currency' => 'INR',
                'name' => 'Appointment Booking',
                'description' => 'Booking fee for Dr. ' . $this->doctor->user->name,
                'order_id' => $razorpayOrder->id,
                'payment_id' => $payment->id,
                'prefill' => [
                    'name' => $this->patient_name,
                    'email' => $this->patient_email,
                    'contact' => $this->patient_phone,
                ],
                'theme' => ['color' => '#14b8a6'],
            ];

            Log::info('Dispatching payment data', $data);
            $this->dispatch('initAppointmentPayment', [$data]);

        // } catch (\Exception $e) {
        //     Log::error('Payment initiation error', ['error' => $e->getMessage()]);
        //     session()->flash('error', 'Failed to initiate payment: ' . $e->getMessage());
        // }
    }

    public function handlePaymentData($data)
    {
        if (!isset($data[0][0]) || !is_array($data[0][0])) {
            Log::error('Invalid payment data', ['data' => $data]);
            return;
        }

        $paymentData = $data[0][0];
        Log::info('Handling payment data', $paymentData);
        $this->dispatchBrowserEvent('open-razorpay', $paymentData);
    }

    public function handlePaymentSuccess($response)
    {
        try {
            $payment = Payment::where('order_id', $response['razorpay_order_id'])->first();

            if (!$payment) {
                session()->flash('error', 'Payment record not found');
                return;
            }

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $attributes = [
                'razorpay_signature' => $response['razorpay_signature'],
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id'],
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $payment->update([
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'status' => 'captured',
                'payment_status' => 'completed',
                'payment_date' => now(),
            ]);

            $appointment = Appointment::find($payment->appointment_id);
            $appointment->status = 'confirmed';
            $appointment->save();

            $user = Auth::user();
            if ($user->role !== 'patient') {
                $user->update(['role' => 'patient']);
            }

            session()->flash('success', 'Payment successful!');
            return redirect()->route('appointment.confirmation', ['appointment' => $appointment->id]);

        } catch (\Exception $e) {
            Log::error('Payment verification error', ['error' => $e->getMessage()]);
            session()->flash('error', 'Payment verification failed');
        }
    }

    public function render()
    {
        return view('livewire.public.appointments.book-appointment');
    }
}