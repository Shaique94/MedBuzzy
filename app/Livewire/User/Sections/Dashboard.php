<?php

namespace App\Livewire\User\Sections;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
class Dashboard extends Component
{
     public $upcomingAppointments;
    public $pastAppointments;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadAppointments();
    }

    public function loadAppointments()
    {
        $this->upcomingAppointments = Appointment::where('patient_id', $this->user->id)
            ->whereDate('appointment_date', '>=', now())
            ->with('doctor.user', 'doctor.department')
            ->orderBy('appointment_date')
            ->get();

        $this->pastAppointments = Appointment::where('patient_id', $this->user->id)
            ->whereDate('appointment_date', '<', now())
            ->with('doctor.user', 'doctor.department')
            ->orderByDesc('appointment_date')
            ->limit(5)
            ->get();
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => 'cancelled']);
        $this->loadAppointments();
        $this->dispatch('notify', 'Appointment cancelled successfully!');
    }

        public function render()
    {
        return view('livewire.user.sections.dashboard')
         ->layout('layouts.user');
    }

}