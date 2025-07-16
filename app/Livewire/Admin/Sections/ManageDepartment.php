<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageDepartment extends Component
{
    use WithPagination;
    
    public $showModal = false;
    public $name;
    public $departmentId;

    protected $rules = [
        'name' => 'required|string|max:255|unique:departments,name',
    ];

    public function mount()
    {
        // Initialization if needed
    }

    public function edit($id)
    {
        $this->departmentId = $id;
        $department = Department::findOrFail($this->departmentId);
        $this->name = $department->name;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        $this->dispatch('department-deleted');
    }

    public function save()
    {
        $this->validate();

        Department::updateOrCreate(
            ['id' => $this->departmentId], 
            ['name' => $this->name]        
        );

        $this->reset(['name', 'showModal', 'departmentId']);
        $this->dispatch('department-added');
    }

    #[Layout('layouts.admin')]
    #[On('department-added')]
    public function render()
    {
        return view('livewire.admin.sections.manage-department', [
            'departments' => Department::paginate(5),
        ]);
    }
}