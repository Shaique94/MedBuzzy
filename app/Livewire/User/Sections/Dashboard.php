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
    $this->user = Auth::user();
    $now = now()->timezone('Asia/Kolkata');

    
    $patient = $this->user->patients()->first();
    
    if (!$patient) {
        
        $this->upcomingAppointments = collect();
        $this->pastAppointments = collect();
        $this->stats = [
            'total_appointments' => 0,
            'upcoming' => 0,
            'doctors' => 0,
            'departments' => 0
        ];
        return;
    }

    
    $this->upcomingAppointments = Appointment::where('patient_id', $patient->id)
        ->where(function ($query) use ($now) {
            $query->where('appointment_date', '>', $now->toDateString())
                  ->orWhere(function ($q) use ($now) {
                      $q->where('appointment_date', $now->toDateString())
                        ->where('appointment_time', '>=', $now->format('H:i:s'));
                  });
        })
        ->where('status', '!=', 'cancelled')
        ->with('doctor.user', 'doctor.department')
        ->orderBy('appointment_date')
        ->orderBy('appointment_time')
        ->limit(5)
        ->get();

    
 $this->pastAppointments = Appointment::where('patient_id', $patient->id)
    ->where(function ($query) use ($now) {
        $query->where('appointment_date', '<', $now->toDateString())
              ->orWhere(function ($q) use ($now) {
                  $q->where('appointment_date', $now->toDateString())
                    ->where('appointment_time', '<', $now->format('H:i:s'));
              });
    })
    ->with([
        'doctor.user', 
        'doctor.department',
       
    ])
    ->orderByDesc('appointment_date')
    ->orderByDesc('appointment_time')
    ->limit(5)
    ->get();

    
    $this->stats = [
        'total_appointments' => Appointment::where('patient_id', $patient->id)->count(),
        'upcoming' => $this->upcomingAppointments->count(),
        'doctors' => Appointment::where('patient_id', $patient->id)
                        ->distinct('doctor_id')
                        ->count('doctor_id'),
        'departments' => Appointment::where('patient_id', $patient->id)
                            ->with('doctor.department')
                            ->get()
                            ->groupBy('doctor.department_id')
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