<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

class OurDoctors extends Component
{
    public $departments;
    public $doctors;

    #[Url(as: 'department_id')]
    public $department_id = null;

    #[Url(as: 'search')]
    public $searchQuery = '';

   

    #[Url(as: 'sort')]
    public $sortBy = 'name'; // Default sort by name

    public function mount()
    {
        $this->departments = Department::all();
        $this->loadDoctors();
    }

    public function updated($property)
    {
        // Update doctors when any filter or search query changes
        if (in_array($property, ['department_id', 'searchQuery', 'sortBy'])) {
            $this->loadDoctors();
        }
    }

    public function loadDoctors()
    {
        $query = Doctor::query()
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->with('user', 'department')
            ->select('doctors.*', 'users.email', 'users.name'); // Explicitly select needed columns

        if (!empty($this->department_id)) {
            $query->where('doctors.department_id', $this->department_id);
        }

        if (!empty($this->searchQuery)) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('users.email', 'like', '%' . $this->searchQuery . '%')
                  ->orWhereJsonContains('doctors.qualification', $this->searchQuery); // Handle JSON array search
            });
        }

       

        // Apply sorting
        switch ($this->sortBy) {
            case 'availability':
                $query->orderBy('doctors.available_days', 'asc'); // Assumes available_days can be sorted
                break;
            default:
                $query->orderBy('users.name', 'asc'); // Default sort by user's name
                break;
        }

        $this->doctors = $query->get();
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.our-doctors.our-doctors');
    }
}