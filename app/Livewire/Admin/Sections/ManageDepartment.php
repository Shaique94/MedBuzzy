<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manage Departments')]
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

    public function toggleStatus($departmentId)
    {
        try {
            $department = Department::findOrFail($departmentId);
            $department->status = $department->status ? 0 : 1;
            $department->save();

            session()->flash('message', 'Department status updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating department status: ' . $e->getMessage());
        }
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