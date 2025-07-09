<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewDoctorDetail extends Component
{
    public $doctor_id;
    #[Layout('layouts.public')]

    public function render()
    {
  $this->doctor = Doctor::with('user', 'department')->findOrFail($this->doctor_id);

        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
        ]);    }
}
