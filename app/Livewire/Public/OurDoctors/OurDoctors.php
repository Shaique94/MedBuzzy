<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OurDoctors extends Component
{
    public $departments;
    public $doctors;
    public $department_id = null;

    public function mount()
    {
        $this->departments = Department::all();
        $this->doctors = Doctor::with('user', 'department')->get();
    }

    public function updatedDepartmentId()
    {
        
        if ($this->department_id) {
            $this->doctors = Doctor::where('department_id', $this->department_id)
                ->with('user', 'department')
                ->get();
        } else {
            $this->doctors = Doctor::with('user', 'department')->get();
        }
    }


    #[Layout('layouts.public')]

    public function render()
    {
        return view('livewire.public.our-doctors.our-doctors');
    }
}
