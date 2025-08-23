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
    public $allAppointments;

    public function mount()
    {
        $patient = Patient::where('user_id', auth()->id())->first();
        $this->patientId = $patient ? $patient->id : null;
        $this->activeTab = 'upcoming';
        
        // Load all data on mount
        $this->loadAppointments();
    }
    
    protected function loadAppointments()
    {
        if (!$this->patientId) {
            $this->allAppointments = collect();
            return;
        }

        // Single query with proper eager loading
        $this->allAppointments = Appointment::with([
                'doctor.user', 
                'doctor.department'
            ])
            ->where('patient_id', $this->patientId)
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
    }
    
    public function render()
    {
        // Calculate the different appointment types here
        $upcomingAppointments = $this->getUpcomingAppointments();
        $pastAppointments = $this->getPastAppointments();
        $cancelledAppointments = $this->getCancelledAppointments();

        return view('livewire.user.sections.my-appointments', [
            'upcomingAppointments' => $upcomingAppointments,
            'pastAppointments' => $pastAppointments,
            'cancelledAppointments' => $cancelledAppointments,
        ]);
    }

    protected function getUpcomingAppointments()
    {
        if (!$this->allAppointments || $this->allAppointments->isEmpty()) {
            return collect();
        }

        return $this->allAppointments
            ->whereIn('status', ['scheduled', 'confirmed', 'pending'])
            ->where('appointment_date', '>=', now()->toDateString())
            ->sortBy('appointment_date')
            ->sortBy('appointment_time');
    }

    protected function getPastAppointments()
    {
        if (!$this->allAppointments || $this->allAppointments->isEmpty()) {
            return collect();
        }
        
        return $this->allAppointments
            ->where('status', 'completed')
            ->where('appointment_date', '<', now()->toDateString());
    }
    
    protected function getCancelledAppointments()
    {
        if (!$this->allAppointments || $this->allAppointments->isEmpty()) {
            return collect();
        }

        return $this->allAppointments
            ->where('status', 'cancelled');
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => 'cancelled']);
        
        // Reload appointments after cancellation
        $this->loadAppointments();
        
        $this->dispatch('notify', 'Appointment cancelled successfully!');
    }

    public function deleteAppointment($appointmentId)
    {
        $appointment = $this->allAppointments->firstWhere('id', $appointmentId);
        
        if ($appointment && $appointment->patient_id == $this->patientId) {
            $appointment->delete();
            $this->loadAppointments(); 
            $this->dispatch('notify', 'Appointment deleted successfully!');
        }
    }
}