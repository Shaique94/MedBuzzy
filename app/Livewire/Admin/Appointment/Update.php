<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update Appointment')]
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
public $showModel;
    public $doctors;
    public $age;
    public $status;

        #[On('OpenModel')]

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
        $this->showModel=true;
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

           

            $this->dispatch('success', __('Appointment updated successfully!'));
            $this->dispatch('closeModal');
            return $this->redirect(route('admin.appointment'), navigate: true);

        } catch (\Exception $e) {
            \Log::error('Appointment update failed: ' . $e->getMessage());
            $this->dispatch('error', __('Error updating appointment: ' . $e->getMessage()));
        }
    }

    public function closeModal()
    {
        $this->showModel=false;
        return redirect()->route('admin.dashboard');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.update');
    }
}