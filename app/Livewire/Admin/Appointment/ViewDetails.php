<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Appointment Details')]
class ViewDetails extends Component
{
   public $showModal = false;
    public $appointment;

    #[On('openModal')] 
    public function viewDetails($id)
    {
        $this->appointment = Appointment::with(['doctor.user', 'doctor.department', 'patient', 'payment'])
            ->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        // Optional: clear the appointment data when closing
        // $this->appointment = null;
    }

    public function render()
    {
        return view('livewire.admin.appointment.view-details');
    }
}
