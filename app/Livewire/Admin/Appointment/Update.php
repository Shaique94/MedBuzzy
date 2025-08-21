<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Carbon\Carbon;
#[Title('Update Appointment')]
class Update extends Component
{
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $doctor_id;
    public $doctor_name;
    public $appointment_date;
    public $appointment_date_formatted;
    public $appointment_time;
    public $appointment_time_formatted;
    public $status;
    // public $showModal;
    public $doctors;
    public $appointment_id;

    // #[On('OpenModal')]
    public function mount($id)
    {
        $this->doctors = Doctor::all();
        $appointment = Appointment::findOrFail($id);
        
        $this->appointment_id = $appointment->id;
        $this->name = $appointment->patient->name;
        $this->email = $appointment->patient->email;
        $this->phone = $appointment->patient->phone;
        $this->gender = $appointment->patient->gender;
        $this->doctor_id = $appointment->doctor_id;
        $this->doctor_name = $appointment->doctor->user->name . ' - ' . $appointment->doctor->department->name;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_date_formatted = Carbon::parse($appointment->appointment_date)->format('d M Y');
        $this->appointment_time = $appointment->appointment_time;
        $this->appointment_time_formatted = Carbon::parse($appointment->appointment_time)->format('h:i A');
      
    }

    public function updateAppointment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
        ]);

        try {
            $appointment = Appointment::findOrFail($this->appointment_id);

            // Update patient info
            $patient = $appointment->patient;
            $patient->update([
                'name' => $this->name,
                'gender' => $this->gender,
            ]);

            $this->dispatch('success', __('Appointment updated successfully!'));
            // $this->dispatch('closeModal');
            return $this->redirect(route('admin.appointment'), navigate: true);

        } catch (\Exception $e) {
            \Log::error('Appointment update failed: ' . $e->getMessage());
            $this->dispatch('error', __('Error updating appointment: ' . $e->getMessage()));
        }
    }

    // public function closeModal()
    // {
    //     $this->showModal = false;
    //     return redirect()->route('admin.dashboard');
    // }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.update');
    }
}