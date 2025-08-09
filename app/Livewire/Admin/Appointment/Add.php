<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\On;

#[Title('Book New Appointment')]
class Add extends Component
{
    public $step = 1;
    public $doctors;
    public $selected_doctor_id;
    public $available_dates = [];
    public $time_slots = [];
    public $active_time_tab = 'morning';
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $address;
    public $pincode;
    public $district;
    public $state = 'Bihar';
    public $country = 'India';
    public $age;
    public $appointment_date;
    public $appointment_time;
    public $payment_method = 'pay_later';
    public $notes;
    public $pincode_loading = false;
    public $booking_fee = 50; // ₹50 booking fee
    public $doctor_fee = 0;
    public $razorpay_order_id;

    public function mount()
    {
        $this->doctors = Doctor::with(['user', 'department'])->get();
        date_default_timezone_set('Asia/Kolkata');
    }

    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->pincode_loading = true;
            $this->fetchPincodeDetails($value);
        } else {
            $this->district = '';
            $this->state = '';
            $this->pincode_loading = false;
        }
    }

    public function fetchPincodeDetails($pincode)
    {
        try {
            $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
            $data = $response->json();

            if ($data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->district = $postOffice['District'] ?? '';
                $this->state = $postOffice['State'] ?? '';
            } else {
                $this->district = '';
                $this->state = '';
                $this->addError('pincode', 'Invalid PIN code.');
            }
        } catch (\Exception $e) {
            $this->district = '';
            $this->state = '';
            $this->addError('pincode', 'Failed to fetch PIN code details.');
        } finally {
            $this->pincode_loading = false;
        }
    }

    public function selectDoctor($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        if (!$doctor) {
            $this->addError('selected_doctor_id', 'Invalid doctor selected.');
            return;
        }
        $this->selected_doctor_id = $doctor_id;
        $this->doctor_fee = $doctor->fee ?? 0;
        $this->prepareAvailableDates();
        $this->step = 2;
    }

    public function prepareAvailableDates()
    {
        $doctor = Doctor::find($this->selected_doctor_id);
        if (!$doctor) {
            $this->addError('selected_doctor_id', 'Doctor not found.');
            $this->step = 1;
            return;
        }

        $this->available_dates = [];
        $max_booking_days = 10; // Limit to 10 days
        $current_date = Carbon::today('Asia/Kolkata');
        Log::info('Preparing available dates for doctor ID: ' . $this->selected_doctor_id . ', Start Date: ' . $current_date->toDateString());

        for ($i = 0; $i < $max_booking_days; $i++) {
            $date = $current_date->copy()->addDays($i);
            $dayOfWeek = $date->dayOfWeek; // 0 (Sunday) to 6 (Saturday)
            $isAvailable = $doctor->isAvailableOn($dayOfWeek);
            $isOnLeave = $doctor->isOnLeave($date);
            Log::info("Date: {$date->toDateString()}, Day: {$dayOfWeek}, Available: " . ($isAvailable ? 'Yes' : 'No') . ", On Leave: " . ($isOnLeave ? 'Yes' : 'No'));

            if ($isAvailable && !$isOnLeave) {
                $this->available_dates[] = [
                    'date' => $date->toDateString(),
                    'day' => $date->format('l'),
                    'formatted' => $date->format('d M Y'),
                ];
            }
        }
        Log::info('Available dates count: ' . count($this->available_dates));
    }

    public function setAppointmentDate($date)
    {
        $this->appointment_date = $date;
        $this->generateTimeSlots();
        $this->appointment_time = null;
    }

    public function generateTimeSlots()
    {
        $doctor = Doctor::find($this->selected_doctor_id);
        if (!$doctor || !$this->appointment_date) {
            $this->time_slots = [];
            Log::warning('No doctor or appointment date set for time slots.');
            return;
        }

        $this->time_slots = $doctor->generateTimeSlots($this->appointment_date);
        $current_time = Carbon::now('Asia/Kolkata');
        $is_today = $this->appointment_date === $current_time->toDateString();
        Log::info('Generating time slots for date: ' . $this->appointment_date . ', Is today: ' . ($is_today ? 'Yes' : 'No') . ', Current time: ' . $current_time->toTimeString());

        foreach ($this->time_slots as &$slot) {
            if ($is_today && Carbon::parse($slot['time_value'])->lt($current_time->copy()->addMinutes(30))) {
                $slot['disabled'] = true;
                Log::info("Slot disabled: {$slot['start']} - {$slot['end']} (past time)");
            }
        }

        $has_morning = collect($this->time_slots)->where('period', 'morning')->where('disabled', false)->count() > 0;
        $has_afternoon = collect($this->time_slots)->where('period', 'afternoon')->where('disabled', false)->count() > 0;
        $has_evening = collect($this->time_slots)->where('period', 'evening')->where('disabled', false)->count() > 0;

        if ($is_today) {
            $current_hour = $current_time->hour;
            if ($current_hour >= 16 && $has_evening) {
                $this->active_time_tab = 'evening';
            } elseif ($current_hour >= 12 && $has_afternoon) {
                $this->active_time_tab = 'afternoon';
            } elseif ($has_morning) {
                $this->active_time_tab = 'morning';
            }
        } else {
            if ($has_morning) {
                $this->active_time_tab = 'morning';
            } elseif ($has_afternoon) {
                $this->active_time_tab = 'afternoon';
            } elseif ($has_evening) {
                $this->active_time_tab = 'evening';
            }
        }
        Log::info('Time slots count: ' . count($this->time_slots) . ', Active tab: ' . $this->active_time_tab);
    }

    public function selectTimeSlot($time)
    {
        $slot = collect($this->time_slots)->firstWhere('time_value', $time);
        if ($slot && !$slot['disabled']) {
            $this->appointment_time = $time;
            $this->step = 3;
        }
    }

    public function nextStep()
    {
        if ($this->step == 1) {
            $this->validate(['selected_doctor_id' => 'required|exists:doctors,id']);
        } elseif ($this->step == 2) {
            $this->validate([
                'appointment_date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required',
            ]);
        } elseif ($this->step == 3) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20',
                'gender' => 'nullable|in:male,female,other',
                'address' => 'nullable|string|max:500',
                'pincode' => 'nullable|digits:6',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'age' => 'nullable|integer|min:0|max:150',
            ]);
            $this->step = 4;
        }
    }

    public function previousStep()
    {
        $this->step--;
        if ($this->step == 2) {
            $this->generateTimeSlots();
        }
    }

    public function createOrder()
    {
        $this->validate([
            'selected_doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,card,upi,pay_later',
            'notes' => 'nullable|string|max:500',
        ]);

        $doctor = Doctor::find($this->selected_doctor_id);
        $slot_available = $doctor->isSlotAvailable($this->appointment_date, $this->appointment_time);

        if (!$slot_available) {
            $this->addError('appointment_time', 'This time slot is no longer available.');
            $this->step = 2;
            $this->generateTimeSlots();
            return;
        }

        if ($this->payment_method === 'upi') {
            try {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $order = $api->order->create([
                    'amount' => ($this->booking_fee + $this->doctor_fee) * 100, // in paise
                    'currency' => 'INR',
                    'payment_capture' => 1,
                ]);
                $this->razorpay_order_id = $order['id'];
                $this->dispatch('razorpay:open', [
                    'order_id' => $this->razorpay_order_id,
                    'amount' => ($this->booking_fee + $this->doctor_fee) * 100,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                ]);
            } catch (\Exception $e) {
                $this->addError('general', 'Failed to create payment order.');
            }
        } else {
            $this->save();
        }
    }

    #[On('payment-success')]
    public function handlePaymentSuccess($payment_id)
    {
        \DB::beginTransaction();
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $payment = $api->payment->fetch($payment_id);
            if ($payment->status !== 'authorized' && $payment->status !== 'captured') {
                throw new \Exception('Payment not authorized.');
            }

            $patient = Patient::firstOrCreate(
                [
                    'phone' => $this->phone,
                    'name' => $this->name,
                    'email' => $this->email,
                ],
                [
                    'gender' => $this->gender,
                    'address' => $this->address,
                    'pincode' => $this->pincode,
                    'district' => $this->district,
                    'state' => $this->state,
                    'country' => $this->country,
                    'age' => $this->age,
                ]
            );

            $appointment = Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $this->selected_doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'status' => 'confirmed',
                'payment_method' => $this->payment_method,
                'booking_fee' => $this->booking_fee,
                'doctor_fee' => $this->doctor_fee,
                'notes' => $this->notes,
                'created_by' => auth()->id(),
            ]);

            Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'created_by' => auth()->id(),
                'amount' => $this->booking_fee + $this->doctor_fee,
                'method' => 'upi',
                'status' => 'paid',
                'transaction_id' => $payment_id,
                'settlement' => false,
            ]);

            \DB::commit();
            session()->flash('success', 'Appointment booked successfully.');
            return redirect()->route('admin.appointment');
        } catch (\Exception $e) {
            \DB::rollBack();
            $this->addError('general', 'Payment failed. Please try again.');
        }
    }

    #[On('payment-failed')]
    public function handlePaymentFailed($error)
    {
        $this->addError('general', 'Payment failed: ' . $error);
    }

    public function save()
    {
        $this->validate([
            'selected_doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,card,upi,pay_later',
            'notes' => 'nullable|string|max:500',
        ]);

        $doctor = Doctor::find($this->selected_doctor_id);
        $slot_available = $doctor->isSlotAvailable($this->appointment_date, $this->appointment_time);

        if (!$slot_available) {
            $this->addError('appointment_time', 'This time slot is no longer available.');
            $this->step = 2;
            $this->generateTimeSlots();
            return;
        }

        \DB::beginTransaction();
        try {
            $patient = Patient::firstOrCreate(
                [
                    'phone' => $this->phone,
                    'name' => $this->name,
                    'email' => $this->email,
                ],
                [
                    'gender' => $this->gender,
                    'address' => $this->address,
                    'pincode' => $this->pincode,
                    'district' => $this->district,
                    'state' => $this->state,
                    'country' => $this->country,
                    'age' => $this->age,
                ]
            );

            $appointment = Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $this->selected_doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'status' => $this->payment_method === 'pay_later' ? 'pending' : 'confirmed',
                'payment_method' => $this->payment_method,
                'booking_fee' => $this->booking_fee,
                'doctor_fee' => $this->doctor_fee,
                'notes' => $this->notes,
                'created_by' => auth()->id(),
            ]);

            Payment::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $patient->id,
                'created_by' => auth()->id(),
                'amount' => $this->booking_fee + $this->doctor_fee,
                'method' => $this->payment_method,
                'status' => $this->payment_method === 'pay_later' ? 'pending' : 'paid',
                'transaction_id' => null,
                'settlement' => $this->payment_method === 'pay_later' ? false : true,
            ]);

            \DB::commit();
            session()->flash('success', 'Appointment booked successfully.');
            return redirect()->route('admin.appointment');
        } catch (\Exception $e) {
            \DB::rollBack();
            $this->addError('general', 'Failed to book appointment. Please try again.');
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.add', [
            'selected_doctor' => Doctor::with(['user', 'department'])->find($this->selected_doctor_id),
        ]);
    }
}