<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Hero extends Component
{
    public $selectedDepartment = '';
    public $searchQuery = '';
    public $departments;
    public $doctors;

     public $totalDoctors;
    public $totalPatients;

    public function mount()
    {
        $this->departments = Department::all();
        $this->doctors = Doctor::all();
         $this->totalDoctors = Doctor::count();
        $this->totalPatients = Patient::count();
    }

    public function search()
    {
        // Redirect to our-doctors route with search parameters
        return redirect()->route('our-doctors', [
            'search' => $this->searchQuery,
            'department_id' => $this->selectedDepartment,
        ]);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.hero');
    }
}