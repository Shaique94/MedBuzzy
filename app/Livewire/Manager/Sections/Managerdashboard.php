<?php

namespace App\Livewire\Manager\Sections;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

class Managerdashboard extends Component
{
    public  $appointments;
    public $appointmentsCount;
    public $patientsCount;
    public $doctorsCount;

        #[Layout('layouts.manager')]

         public function mount()
    {
        $this->loadCounts();
        $this->loadAppointments();
    }

    public function render()
    {
        return view('livewire.manager.sections.managerdashboard');
    }

public function loadCounts()
    {
        $this->appointmentsCount = Appointment::count();
        $this->patientsCount = Patient::count();
        $this->doctorsCount = Doctor::count();
    }

      public function loadAppointments()
    {
        $today = Carbon::today()->toDateString();
        
        $this->appointments = Appointment::with(['patient', 'doctor.user', 'doctor.department'])
            ->whereDate('appointment_date', '>=', $today)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(4)
            ->get();
    }
}