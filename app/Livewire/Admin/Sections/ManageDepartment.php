<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageDepartment extends Component
{
    public $showModal = false;
    public $name;
    public $departments;
    public $departmentId;

    protected $rules = [
        'name' => 'required|string|max:255|unique:departments,name',
    ];

    public function mount(){
    }
    public function edit($id){

        $this->departmentId = $id;
        $department = Department::findOrFail($this->departmentId);
        $this->name = $department->name;
        $this->showModal = true;
    }
    public function delete($id){
        $department = Department::findOrFail($id);
        $department->delete();
        $this->dispatch('department-deleted');
    }
    public function save(){

        $this->validate();

        Department::updateOrCreate(
            ['id' => $this->departmentId], 
            ['name' => $this->name]        
        );

        $this->reset(['name', 'showModal']);
        $this->dispatch('department-added');
    }
    #[Layout('layouts.admin')]
    #[On('department-added')]
    public function render()
    {
        $this->departments = Department::all();
        return view('livewire.admin.sections.manage-department', [
            'departments' => $this->departments,
        ]);
    }
}
