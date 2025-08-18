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
    public $stats = [];

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load appointments
        $this->upcomingAppointments = Appointment::where('patient_id', $this->user->id)
            ->whereDate('appointment_date', '>=', now())
            ->with('doctor.user', 'doctor.department')
            ->orderBy('appointment_date')
            ->limit(5)
            ->get();

        $this->pastAppointments = Appointment::where('patient_id', $this->user->id)
            ->whereDate('appointment_date', '<', now())
            ->with('doctor.user', 'doctor.department')
            ->orderByDesc('appointment_date')
            ->limit(5)
            ->get();

        // Calculate stats
        $this->stats = [
            'total_appointments' => Appointment::where('patient_id', $this->user->id)->count(),
            'upcoming' => $this->upcomingAppointments->count(),
            'doctors' => Appointment::where('patient_id', $this->user->id)
                            ->distinct('doctor_id')
                            ->count(),
            'departments' => Appointment::where('patient_id', $this->user->id)
                                ->with('doctor.department')
                                ->get()
                                ->unique('doctor.department_id')
                                ->count()
        ];
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update(['status' => 'cancelled']);
        $this->loadDashboardData();
        $this->dispatch('notify', 'Appointment cancelled successfully!');
    }

    public function render()
    {
        return view('livewire.user.sections.dashboard')
            ->layout('layouts.user');
    }
}