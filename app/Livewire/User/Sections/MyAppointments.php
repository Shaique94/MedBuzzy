<?php

namespace App\Livewire\User\Sections;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Appointment;
use App\Models\Patient;

#[Layout('layouts.user')]
class MyAppointments extends Component
{
    public $activeTab = 'upcoming';
    public $showDetailModal = false;
    public $selectedAppointment = null;
    public $patientId;
    
    public function mount()
    {
       
        $patient = Patient::where('user_id', auth()->id())->first();
        $this->patientId = $patient ? $patient->id : null;
        
       
        $this->activeTab = 'upcoming';
    }
    
    public function render()
    {
        return view('livewire.user.sections.my-appointments', [
            'upcomingAppointments' => $this->upcomingAppointments,
            'pastAppointments' => $this->pastAppointments,
            'cancelledAppointments' => $this->cancelledAppointments,
        ]);
    }

   

    public function getUpcomingAppointmentsProperty()
    {
        if (!$this->patientId) {
            return collect();
        }

        return Appointment::with(['doctor.user']) 
            ->where('patient_id', $this->patientId)
            ->whereIn('status', ['scheduled', 'confirmed', 'pending'])
            ->whereDate('appointment_date', '>=', now())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
               ->limit(3)
            ->get();
    }

    public function getPastAppointmentsProperty()
    {
        if (!$this->patientId) {
            return collect();
        }
        
 return Appointment::with(['doctor.user']) 
            ->where('patient_id', $this->patientId)
            ->where('status', 'completed')
            ->whereDate('appointment_date', '<', now())
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
    }
    
    public function getCancelledAppointmentsProperty()
    {
        if (!$this->patientId) {
            return collect();
        }

        return Appointment::with(['doctor.user']) 
            ->where('patient_id', $this->patientId)
            ->where('status', 'cancelled')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
    }

       public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => 'cancelled']);
        $this->dispatch('notify', 'Appointment cancelled successfully!');
    }

    public function deleteAppointment($appointmentId)
{
    $appointment = Appointment::where('id', $appointmentId)
        ->where('patient_id', $this->patientId) 
        ->firstOrFail();

    $appointment->delete();

    $this->dispatch('notify', 'Appointment deleted successfully!');
}

}