<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
  public  $appointments;
    public $appointmentsCount;
    public $patientsCount;
    public $doctorsCount;

    #[Layout('layouts.admin')]
    public function render()

    {
        $this->appointmentsCount = Appointment::count();
        $this->patientsCount = Patient::count();
        $this->doctorsCount = Doctor::count();
        $this->loadAppointments();


        return view('livewire.admin.sections.dashboard');
    }


    public function loadAppointments(){
          $query = Appointment::all();
          $this->appointments = $query;
    }
}
