<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class ManageDoctor extends Component
{
     use WithFileUploads;

    public $departments;
    public $doctors;
    public $showModal = false;
    public $name;
    public $email;
    public $department_id;
    public $phone;
    public $fees;
    public $qualification;
    public $password;
    public $password_confirmation;
    public $photo; // ➕ Add photo property

    public function mount()
    {
        $this->doctors = Doctor::all();
        $this->departments = Department::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'department_id' => 'required|exists:departments,id',
            'phone' => 'required|string|max:15',
            'fees' => 'required|numeric',
            'qualification' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'nullable|image|max:2048', // ➕ Validate image
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'role' => 'doctor',
        ]);

        // ➕ Handle image upload
        $imagePath = null;
        if ($this->photo) {
            $imagePath = $this->photo->store('doctors', 'public');
        }

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'department_id' => $this->department_id,
            'fees' => $this->fees,
            'qualification' => $this->qualification,
            'status' => 1,
            'image' => $imagePath,
            'slug' => Str::slug($this->name),
        ]);

        $this->reset([
            'name', 'email', 'password', 'password_confirmation',
            'phone', 'fees', 'department_id', 'qualification', 'photo', 'showModal'
        ]);
        $this->doctors = Doctor::all();

        session()->flash('message', 'Doctor saved successfully.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.manage-doctor');
    }
}
