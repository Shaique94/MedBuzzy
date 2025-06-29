<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;


class ManageDoctor extends Component
{
    public $departments;
    public $doctors;
    public $showModal = false;
    public $name;
    public $email;
    public $department_id;
    public $phone;
    public $fees;
    public function mount()
    {
        $this->doctors = Doctor::all();
        $this->departments = Department::all();
    }

    public function save() {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'department_id' => 'required|exists:departments,id',
            'phone' => 'required|string|max:15',
            'fees' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'phone' => $this->phone,
        ]);
        
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'department_id' => $this->department_id,
            'fees' => $this->fees,
            'status' => 1, 
            'image' => null, 
            'qualification' => null,
            'slug' => Str::Slug($this->name),
        ]);
       
        $this->reset(['name', 'email', 'phone', 'fees', 'department_id', 'showModal']);
        $this->doctors = Doctor::all(); // Refresh the list of doctors
        session()->flash('message', 'Doctor saved successfully.');
    }
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.manage-doctor');
    }
}
