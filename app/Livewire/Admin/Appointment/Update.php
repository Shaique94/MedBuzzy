<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $address;
    public $pincode;
    public $state = "Bihar";
    public $country = "India";
    public $doctor_id;
    public $appointment_date;
    public $appointment_time;
    public $payment_method = "cash";
    public $notes;
    public $doctors;
    public $appointment_id;
    public $age;
    public $status; // Added status field

    public function mount($id)
    {
        $this->doctors = Doctor::all();
        $appointment = Appointment::findOrFail($id);
        
        $this->appointment_id = $appointment->id;
        $this->name = $appointment->patient->name;
        $this->email = $appointment->patient->email;
        $this->phone = $appointment->patient->phone;
        $this->gender = $appointment->patient->gender;
        $this->age = $appointment->patient->age;
        $this->address = $appointment->patient->address;
        $this->pincode = $appointment->patient->pincode;
        $this->state = $appointment->patient->state ?? 'Bihar';
        $this->country = $appointment->patient->country ?? 'India';
        $this->doctor_id = $appointment->doctor_id;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_time = $appointment->appointment_time;
        $this->payment_method = $appointment->payment_method;
        $this->notes = $appointment->notes;
        $this->status = $appointment->status; // Set initial status
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|numeric|min:0',
            'address' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:cash,card,upi',
            'status' => 'required|in:pending,scheduled,completed,cancelled,checked_in', // Added status validation
        ]);

        try {
            $appointment = Appointment::findOrFail($this->appointment_id);

            // Update patient info
            $patient = $appointment->patient;
            $patient->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'age' => $this->age,
                'address' => $this->address,
                'pincode' => $this->pincode,
                'state' => $this->state,
                'country' => $this->country,
            ]);

            // Update appointment info
            $appointment->update([
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'payment_method' => $this->payment_method,
                'notes' => $this->notes,
                'status' => $this->status, // Update status
            ]);

            session()->flash('success', 'Appointment updated successfully!');
            return $this->redirect(route('admin.appointment'), navigate: true);

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating appointment: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.update');
    }
}