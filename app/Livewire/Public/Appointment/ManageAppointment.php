<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageAppointment extends Component
{
    public $doctors;
    public int $step = 1;

    public $pincode;

    public $doctor_id;
    public $appointment_date;
    public $appointment_time;
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
    public $available_payment_methods = [];
    public $slot_enabled;

    public function mount()
    {
        $this->doctors = Doctor::with('user')->get();
        $this->available_payment_methods = ['cash', 'card', 'upi'];

        if (request()->has('doctor_id')) {
            $this->doctor_id = request()->query('doctor_id');
            $this->doctors = $this->doctors->filter(fn($doctor) => $doctor->id == $this->doctor_id);
            if ($this->doctors->count() === 1) {
                $this->step = 2;
            }
        }
    }

    public function updatedDoctorId()
    {
        $this->appointment_date = null;
        $this->appointment_time = null;
    }

    public function updatedAppointmentDate()
    {
        $this->appointment_time = null;
        $this->generateAvailableSlots();
    }

    //  Integrate pincode API when pincode changes
    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->fetchPincodeDetails($value);
        } else {
            $this->newPatient['district'] = '';
            $this->newPatient['state'] = '';
        }
    }

    public function fetchPincodeDetails($pincode)
    {
        try {
            $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
            $data = $response->json();

            if ($data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->newPatient['district'] = $postOffice['District'] ?? '';
                $this->newPatient['state'] = $postOffice['State'] ?? '';
            } else {
                $this->newPatient['district'] = '';
                $this->newPatient['state'] = '';
            }
        } catch (\Exception $e) {
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
        if ($this->step > 1) {
            $this->step--;
        }
    }


    protected function validateStep($step)
    {
        if ($step === 1) {
            
            $this->validate(['doctor_id' => 'required|exists:doctors,id']);
        }

        if ($step === 2) {
            $this->validate([
                'newPatient.name' => 'required|string',
                'newPatient.phone' => 'required|string',
                'newPatient.age' => 'required|integer|min:0',
                'newPatient.gender' => 'required|string|in:male,female,other',
                'newPatient.address' => 'required|string',
                'newPatient.email' => 'nullable|email',
                'newPatient.pincode' => 'nullable|digits:6',
            ]);
        }

        if ($step === 3) {
            $this->validate([
                'payment_method' => 'required|in:' . implode(',', $this->available_payment_methods),
                'notes' => 'nullable|string',
            ]);
        }
    }

    public function submit()
    {
        $this->validateStep(4);

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
        $amount = $doctor && isset($doctor->fee) ? $doctor->fee : 0;

        Payment::create([
            'appointment_id' => $appointment->id,
            'patient_id' => $patient->id,
            'amount' => $amount,
            'method' => $this->payment_method,
            'status' => 'paid',
            'transaction_id' => null,
        ]);

        // Redirect to confirmation page with appointment id
        return redirect()->route('appointment.confirmation', ['appointment' => $appointment->id]);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.appointment.manage-appointment');
    }
}
