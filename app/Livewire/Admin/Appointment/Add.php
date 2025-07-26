<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Add extends Component
{
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $address;
    public $pincode;
    public $district;
    public $state = "Bihar";
    public $country = "India";
    public $age;
    public $doctor_id;
    public $appointment_date;
    public $appointment_time;
    public $payment_method = "cash";
    public $notes;
    public $doctors;

    public function mount()
    {
        $this->doctors = Doctor::all();
    }

     //  Integrate pincode API when pincode changes
    public function updatedPincode($value) 
    {
        if (strlen($value) === 6) {
            $this->fetchPincodeDetails($value);
        } else {
            $this->district = '';
            $this->state = '';
        }
    }

    //fetchpincodeDetials;

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
        }
    } catch (\Exception $e) {
        $this->district = '';
        $this->state = '';
    }
}


    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'pincode' => 'nullable|digits:6',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string|max:500',
            'age' => 'nullable|integer|min:0|max:150',
        ]);

        $patient = Patient::firstOrCreate(
      [
            'phone' => $this->phone,
            'name' => $this->name,
            'email' => $this->email
        ],
            [
                'gender' => $this->gender,
                'address' => $this->address,
                'pincode' => $this->pincode,
                'state' => $this->state,
                'country' => $this->country,
                'age' => $this->age,
            ]
        );

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $this->doctor_id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'status' => 'pending',
            'payment_method' => $this->payment_method,
            'notes' => $this->notes,


        ]);
        $this->resetForm();
        session()->flash('success', 'Appointment booked successfully.');
        return redirect()->route('admin.appointment');
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'phone',
            'gender',
            'address',
            'pincode',
            'state',
            'country',
            'age',
            'doctor_id',
            'appointment_date',
            'appointment_time',
            'payment_method',
            'notes'
        ]);
        $this->state = "Bihar";
        $this->country = "India";
        $this->payment_method = "cash";
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.add');
    }
}
