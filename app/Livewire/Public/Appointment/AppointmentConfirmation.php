<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AppointmentConfirmation extends Component
{
    public $appointment;

    public function mount($appointment)
    {
        $this->appointment = Appointment::with(['doctor.user', 'patient', 'payment'])->findOrFail($appointment);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.appointment.appointment-confirmation', [
            'appointment' => $this->appointment,
        ]);
    }
}
