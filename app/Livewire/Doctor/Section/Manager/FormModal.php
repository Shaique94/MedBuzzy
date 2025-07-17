<?php

namespace App\Livewire\Doctor\Section\Manager;

use Livewire\Component;
use App\Models\User;
use App\Models\Manager;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FormModal extends Component
{
    use WithFileUploads;

    public $show = false;

    public $name = '', $email = '', $phone = '', $address = '', $gender = '', $dob = '', $status = 'active', $photo;

    protected $listeners = ['openCreateModal'];

    public function openCreateModal()
    {
        $this->resetForm();
        $this->show = true;
    }

    public function saveManager()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|max:1024',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        $photoPath = $this->photo ? $this->photo->store('manager_photos', 'public') : null;

        Manager::create([
            'user_id' => $user->id,
            'doctor_id' => auth()->user()->doctor->id,
            'address' => $this->address,
            'photo' => $photoPath,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
        ]);

          return redirect()->route('doctor.manager-list')->with('success', 'Manager created successfully!');
        $this->closeModal();
        $this->dispatch('refreshManagers');
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
    }

    public function resetForm()
    {
        $this->reset(['show', 'name', 'email', 'phone', 'address', 'gender', 'dob', 'status', 'photo']);
        $this->status = 'active';
    }

 public function render()
{
    return view('livewire.doctor.section.manager.form-modal');
}

}
