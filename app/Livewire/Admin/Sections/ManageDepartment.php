<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use App\Models\Doctor;
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
        $this->rules['name'] = "required|string|max:255|unique:departments,name,{$id}";
    }

    public function confirmDelete($id)
    {
        $department = Department::findOrFail($id);
        
        // Check for associated doctors (one-to-many; adjust for many-to-many if needed)
        $doctorCount = Doctor::where('department_id', $id)->count();
        
        if ($doctorCount > 0) {
            $this->dispatch('error', __("Cannot delete department '{$department->name}' because it has {$doctorCount} associated doctor(s)."));
            return;
        }

        $this->dispatch('openDeleteModal', [
            'title' => 'Delete Department',
            'message' => "Are you sure you want to delete '{$department->name}'? This action cannot be undone.",
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

            // Double-check for associated doctors
            $doctorCount = Doctor::where('department_id', $id)->count();
            // For many-to-many, uncomment and adjust table name:
            // $doctorCount = DB::table('department_doctor')->where('department_id', $id)->count();
            
            if ($doctorCount > 0) {
                $this->dispatch('error', __("Cannot delete department '{$departmentName}' because it has {$doctorCount} associated doctor(s)."));
                return;
            }

            $department->delete();
            $this->dispatch('success', __("Department '{$departmentName}' has been successfully deleted."));
            $this->dispatch('department-deleted');
        } catch (\Exception $e) {
            $this->dispatch('error', __('An error occurred while deleting the department: ') . $e->getMessage());
        }
    }

    public function toggleStatus($departmentId)
    {
        try {
            $department = Department::findOrFail($departmentId);
            $department->status = $department->status ? 0 : 1;
            $department->save();

            $status = $department->status ? 'enabled' : 'disabled';
            $this->dispatch('success', __("Department '{$department->name}' has been {$status} successfully."));
        } catch (\Exception $e) {
            $this->dispatch('error', __('An error occurred while updating department status: ') . $e->getMessage());
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $department = Department::updateOrCreate(
                ['id' => $this->departmentId], 
                ['name' => $this->name]        
            );

            $message = $this->departmentId ? __("Department '{$this->name}' updated successfully.") : __("Department '{$this->name}' added successfully.");
            $this->reset(['name', 'showModal', 'departmentId']);
            $this->dispatch('success', $message);
        } catch (\Exception $e) {
            $this->dispatch('error', __('An error occurred while saving the department: ') . $e->getMessage());
        }
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