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

    protected $listeners = [
        'confirmDeleteDepartment' => 'deleteDepartment'
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

    public function confirmDelete($id)
    {
        $department = Department::findOrFail($id);
        
        $this->dispatch('openDeleteModal', [
            'title' => 'Delete Department',
            'message' => 'Are you sure you want to delete this department? All associated data will be permanently removed.',
            'confirmText' => 'Delete Department',
            'cancelText' => 'Cancel',
            'itemName' => $department->name,
            'itemType' => 'department',
            'deleteAction' => 'confirmDeleteDepartment',
            'itemId' => $id
        ]);
    }

    public function deleteDepartment($id)
    {
        try {
            $department = Department::findOrFail($id);
            $departmentName = $department->name;
            $department->delete();
            
            session()->flash('message', "Department '{$departmentName}' has been successfully deleted.");
            $this->dispatch('department-deleted');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting department: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Keep the old method for backward compatibility or redirect to confirmDelete
        $this->confirmDelete($id);
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
            'departments' => Department::latest()->paginate(5),
        ]);
    }
}