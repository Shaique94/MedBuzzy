<?php

namespace App\Livewire\Public\Appointment\Components;

use Livewire\Component;

class DoctorCard extends Component
{
    public $doctor;
    public $appointment_date;
    public $appointment_time;

    public function mount($doctor = null, $appointment_date = null, $appointment_time = null)
    {
        $this->doctor = $doctor;
        $this->appointment_date = $appointment_date;
        $this->appointment_time = $appointment_time;
    }

    public function render()
    {
        return view('livewire.public.appointment.components.doctor-card', [
            'doctor' => $this->doctor,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
        ]);
    }
}
