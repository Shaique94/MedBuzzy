<?php

namespace App\Livewire\User\Sections;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $upcomingAppointments;
    public $pastAppointments;
    public $user;
    public $stats = [];
    public $loading = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $this->loading = true;
        
        $patient = $this->user->patients()->first();

        if (!$patient) {
            $this->setEmptyData();
            $this->loading = false;
            return;
        }

        // Single optimized method to load everything
        $this->loadAllData($patient->id);
        $this->loading = false;
    }

    protected function loadAllData($patientId)
    {
        $now = now()->timezone('Asia/Kolkata');
        $nowDate = $now->toDateString();
        $nowTime = $now->format('H:i:s');

        // Single query to get all appointments with proper eager loading
        $allAppointments = Appointment::with([
                'doctor.user', 
                'doctor.department'
            ])
            ->where('patient_id', $patientId)
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

          // Filter in memory (much faster than multiple DB queries)
        $this->upcomingAppointments = $allAppointments->filter(function ($appointment) use ($nowDate, $nowTime) {
            return ($appointment->status === 'scheduled' || $appointment->status === 'confirmed') && 
                   ($appointment->appointment_date > $nowDate || 
                   ($appointment->appointment_date == $nowDate && 
                    $appointment->appointment_time >= $nowTime));
        })->take(3);

        // Only show completed appointments that are in the past
        $this->pastAppointments = $allAppointments->filter(function ($appointment) use ($nowDate, $nowTime) {
            return $appointment->status === 'completed' && 
                   ($appointment->appointment_date < $nowDate || 
                   ($appointment->appointment_date == $nowDate && 
                    $appointment->appointment_time < $nowTime));
        })->sortByDesc('appointment_date')
          ->sortByDesc('appointment_time')
          ->take(3);

        // Calculate stats from the already loaded data
        $this->calculateStatsFromCollection($allAppointments, $nowDate, $nowTime);
    }

    protected function calculateStatsFromCollection($appointments, $nowDate, $nowTime)
    {
        $upcomingCount = $appointments->filter(function ($appointment) use ($nowDate, $nowTime) {
            return $appointment->appointment_date > $nowDate || 
                   ($appointment->appointment_date == $nowDate && 
                    $appointment->appointment_time >= $nowTime);
        })->count();

        $uniqueDoctors = $appointments->pluck('doctor_id')->unique()->count();
        $uniqueDepartments = $appointments->pluck('doctor.department_id')->unique()->count();

        $this->stats = [
            'total_appointments' => $appointments->count(),
            'upcoming' => $upcomingCount,
            'doctors' => $uniqueDoctors,
            'departments' => $uniqueDepartments
        ];
    }

    protected function setEmptyData()
    {
        $this->upcomingAppointments = collect();
        $this->pastAppointments = collect();
        $this->stats = [
            'total_appointments' => 0,
            'upcoming' => 0,
            'doctors' => 0,
            'departments' => 0
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