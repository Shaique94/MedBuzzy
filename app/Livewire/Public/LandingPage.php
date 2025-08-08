<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('MedBuzzy - Healthcare Management')]
class LandingPage extends Component
{
    public $doctors;
    public $departments;

    public function mount()
    {
        $this->loadDoctors();
        $this->departments = Department::where('status', true)->get();
    }

    protected function loadDoctors()
    {
        $this->doctors = Doctor::withCount(['reviews' => function($query) {
                $query->where('approved', true);
            }])
            ->withAvg(['reviews' => function($query) {
                $query->where('approved', true);
            }], 'rating')
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.landing-page');
    }
}