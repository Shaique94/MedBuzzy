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
use Livewire\WithPagination;

class ManageDoctor extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $departments;
    public $showModal = false;
    public $name;
    public $email; 
    public $department_id;
    public $available_days = [];
    public $phone;
    public $fees;
    public $status;
    public $qualification;
    public $password;
    public $password_confirmation;
    public $photo;
    public $start_time;
    public $end_time;
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $search = '';

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'department_id' => 'required|exists:departments,id',
            'available_days' => 'required|array|min:1',
            'status' => 'required|in:0,1,2',
            'phone' => 'required|string|max:15',
            'fees' => 'required|numeric',
            'qualification' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'nullable|image|max:2048',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'role' => 'doctor',
        ]);

        $imagePath = null;
        if ($this->photo) {
            $imagePath = $this->photo->store('doctors', 'public');
        }

        Doctor::create([
            'user_id' => $user->id,
            'department_id' => $this->department_id,
            'fees' => $this->fees,
            'status' => $this->status,
            'available_days' => $this->available_days,
            'qualification' => $this->qualification,
            'image' => $imagePath,
            'slug' => Str::slug($this->name),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'slot_duration_minutes' => $this->slot_duration_minutes,
            'patients_per_slot' => $this->patients_per_slot,
        ]);

        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'phone',
            'status',
            'available_days',
            'fees',
            'department_id',
            'qualification',
            'photo',
            'start_time',
            'end_time',
            'slot_duration_minutes',
            'patients_per_slot',
            'showModal'
        ]);

        session()->flash('message', 'Doctor saved successfully.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $query = Doctor::with(['user', 'department'])->latest();

        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $doctors = $query->paginate(5);

        return view('livewire.admin.sections.manage-doctor', [
            'doctors' => $doctors,
        ]);
    }
}