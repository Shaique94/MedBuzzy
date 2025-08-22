<?php

namespace App\Livewire\Doctor;

use App\Models\Doctor;
use Livewire\Component;

class Sidebar extends Component
{
    public $doctorName;
    public $departmentName;
    public $doctorImage;
    public $doctorId;
    
    public function mount()
    {
        $user = auth()->user();
        
        // Single query with eager loading
        $doctor = Doctor::with(['user:id,name', 'department:id,name'])
              ->where('user_id', $user->id)
              ->first(['id', 'user_id', 'department_id', 'image']);
        
        // Store as simple properties, not relationships
        $this->doctorName = $doctor->user->name ?? 'No Name';
        $this->departmentName = $doctor->department->name ?? 'No Department';
        $this->doctorImage = $doctor->image;
        $this->doctorId = $doctor->id;
    }
    
    public function render()
    {
        return view('livewire.doctor.sidebar');
    }
}