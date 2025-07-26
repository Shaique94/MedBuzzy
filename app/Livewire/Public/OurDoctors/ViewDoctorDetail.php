<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewDoctorDetail extends Component
{
    public $doctor_id;
    public $countFeadback;
    #[Layout('layouts.public')]

    public function render()
    {
  $this->doctor = Doctor::with('user', 'department')->findOrFail($this->doctor_id);
           $this->countFeadback=Review::count();
        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
        ]);    }
}
