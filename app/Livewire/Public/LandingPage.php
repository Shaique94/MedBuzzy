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

 public function mount()
    {
        $this->doctors = Doctor::with(['department', 'user'])
            ->whereNotNull('department_id')
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        $this->departments = Department::where('status', true)->get();
    }


    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.landing-page');
    }
}

