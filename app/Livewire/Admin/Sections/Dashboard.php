<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Admin Dashboard')]
class Dashboard extends Component
{
  public  $appointments;
    public $appointmentsCount;
    public $patientsCount;
    public $doctorsCount;

   public $totalRevenue;

public function totalPayment()
{
    $this->totalRevenue = Payment::where('status', 'paid')->sum('amount');
}
public function mount()
{
    $this->totalPayment();
}


    #[Layout('layouts.admin')]
    public function render()

    {
      
        $this->appointmentsCount = Appointment::count();
        $this->patientsCount = Patient::count();
        $this->doctorsCount = Doctor::count();
        $this->loadAppointments();


        return view('livewire.admin.sections.dashboard');
    }


   public function loadAppointments()
{
    $this->appointments = Appointment::latest()->take(4)->get();
}

}
