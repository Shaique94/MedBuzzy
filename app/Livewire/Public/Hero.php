<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Hero extends Component
{
    public $location = ''; 
    public $selectedDepartment = '';
    public $searchQuery = '';
    public $departments;
    public $doctors;

    public function mount($doctors = NULL, $departments = NULL)
    {
        $this->doctors = $doctors;
        $this->departments = $departments;

    }

public function updatedSelectedDepartment($slug)
{
    if ($slug) {
        return redirect()->to(route('our-doctors', ['department' => $slug]));
    } else {
        return redirect()->to(route('hero'));
    }
}

    public function search()
    {
      
    $params = [];
    
    if ($this->searchQuery) {
        $params['search'] = $this->searchQuery;
    }
    
    if ($this->selectedDepartment) {
        $params['department'] = $this->selectedDepartment;
    }

    return redirect()->route('our-doctors', $params);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.hero');
    }
}