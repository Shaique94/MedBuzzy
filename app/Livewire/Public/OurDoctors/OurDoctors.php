<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OurDoctors extends Component
{
    public $doctors;
    public function mount()
    {
        $this->doctors = Doctor::with('user', 'department')->get();
    }
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.our-doctors.our-doctors');
    }
}
