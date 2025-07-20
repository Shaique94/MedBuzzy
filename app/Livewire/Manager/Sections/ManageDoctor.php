<?php

namespace App\Livewire\Manager\Sections;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Livewire\WithPagination;

class ManageDoctor extends Component
{
  use WithPagination;

    public $search = '';
    public $departmentFilter = '';
    public $departments;
    public $showReset = false;

    #[Layout('layouts.manager')]  
    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updated($property)
    {
        // Show reset button when either search or department filter is active
        $this->showReset = !empty($this->search) || !empty($this->departmentFilter);
        
        // Reset pagination when filters change
        if (in_array($property, ['search', 'departmentFilter'])) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->departmentFilter = '';
        $this->showReset = false;
        $this->resetPage();
    }

    public function render()
    {
        $query = Doctor::with(['user', 'department'])
                      ->latest();

        // Search filter
        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Department filter
        if (!empty($this->departmentFilter)) {
            $query->where('department_id', $this->departmentFilter);
        }

        $doctors = $query->paginate(10);

        return view('livewire.manager.sections.manage-doctor', [
            'doctors' => $doctors,
        ]);
    }
}