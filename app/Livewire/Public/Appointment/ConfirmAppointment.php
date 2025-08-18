<?php

namespace App\Livewire\Public\Appointment;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;  

use Carbon\Carbon;
#[Title('Appointment Confirmation')]
   #[Layout('layouts.public')]
class ConfirmAppointment extends Component
{  public Appointment $appointment;
    public $formattedTime;

    public function mount($id)
    {
        $this->appointment = Appointment::with(['doctor.user', 'doctor.department', 'patient', 'payment'])
            ->findOrFail($id);
            
        // Format the time properly
        $this->formattedTime = Carbon::createFromFormat(
            'H:i:s', 
            $this->appointment->appointment_time
        )->format('h:i A');
    }

    public function render()
    {
        return view('livewire.public.appointment.confirm-appointment');
    }
}
