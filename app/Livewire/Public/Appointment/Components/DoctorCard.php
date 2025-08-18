<?php

namespace App\Livewire\Public\Appointment\Components;

use Livewire\Component;
use Carbon\Carbon;

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
        // Provide formatted slot values for the view (safe parsing)
        $formattedDate = $this->appointment_date ? Carbon::parse($this->appointment_date)->format('l, F j, Y') : null;
        $formattedTime = null;
        if ($this->appointment_time) {
            try {
                $formattedTime = Carbon::createFromFormat('H:i', $this->appointment_time)->format('h:i A');
            } catch (\Exception $e) {
                try {
                    $formattedTime = Carbon::createFromFormat('H:i:s', $this->appointment_time)->format('h:i A');
                } catch (\Exception $e) {
                    try {
                        $formattedTime = Carbon::parse($this->appointment_time)->format('h:i A');
                    } catch (\Exception $e) {
                        $formattedTime = $this->appointment_time;
                    }
                }
            }
        }

        return view('livewire.public.appointment.components.doctor-card', [
            'doctor' => $this->doctor,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'formattedDate' => $formattedDate,
            'formattedTime' => $formattedTime,
        ]);
    }
}
