<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LandingPage extends Component
{
    public $doctors;
    public $departments;



    #[Layout('layouts.public')]
    public function render()
    {
        $this->doctors = Doctor::inRandomOrder()->limit(4)->get();
        $this->departments = Department::where('status', true)->get();
        return view('livewire.public.landing-page');
    }
}
