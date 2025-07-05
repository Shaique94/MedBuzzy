<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Doctordashboard extends Component
{
 public $appointments;
    public $appointments_count;

    public $patient_count;
    public $appointments_completed;
    public $appointments_upcoming;

    public $doctor_name;

    #[Layout('layouts.doctor')]
    public function mount()
    {
        $this->loadAppointments();
    }

    public function loadAppointments()
    {
        $user = auth()->user();
        $this->doctor_name = $user->name;

        $doctor = Doctor::where('user_id', $user->id)->first();


        $this->appointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->get();

        $this->appointments_count = $this->appointments->count();
        $this->appointments_completed = $this->appointments->where('status', 'completed')->count();
        $this->appointments_upcoming = $this->appointments->where('status', 'pending')->count();
        $this->patient_count = $this->appointments->pluck('patient_id')->unique()->count();
    }

    public function render()
    {
        return view('livewire.doctor.section.doctordashboard');
    }
}
