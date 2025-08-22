<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

#[Title('MedBuzzy - Healthcare Management')]
class LandingPage extends Component
{
    public $doctors;
    public $departments;

    public $totalDoctors;
    public $totalPatients;
    public $generatedCode;
    public $showVerification;
    
    public function mount()
    {
        $this->loadDoctors();
        $this->departments = Cache::remember('departments', now()->addHours(24), function() {
            return Department::where('status', true)->get();
        });
    }

    protected function loadDoctors()
    {
       $this->doctors = Cache::remember('featured_doctors', now()->addMinutes(30), function () { 
            return Doctor::with([
            'user:id,name',
            "department:id,slug,name"
        ])->select("id","fee","qualification","image","slug","user_id","department_id","languages_spoken","city","review_avg")
            ->where('status', 1)
            ->inRandomOrder()
            ->limit(4)
            ->get();
           });
            }

    public function submitPhone()
    {
        $this->validate([
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/'
        ]);

        // Generate a random 4-digit code
        $this->generatedCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // In a real app, you would send this code via SMS here
        // For now, we'll just store it in session
        
        $this->showVerification = true;
    }

    #[On('refreshDoctors')]
    public function refreshDoctors()
    {
        $this->loadDoctors();
    }

    #[On('doctor-review-updated')]
    public function handleDoctorReviewUpdated($doctorId)
    {
        // Refresh the entire doctors list to ensure updated averages are shown
        $this->loadDoctors();
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.landing-page');
    }
}