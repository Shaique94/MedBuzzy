<?php

namespace App\Livewire\Doctor\Section\Manager;

use App\Models\Manager;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class CreateManger extends Component
{
    use WithFileUploads;

    public $showForm = false;
    public $name, $email, $phone, $address, $gender, $dob, $status = 'active', $photo;
    public $manager_id;
    public $isEdit = false;

    #[Layout('layouts.doctor')]
    public function render()
    {
        $managers = Manager::with('user')
            ->where('doctor_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('livewire.doctor.section.manager.create-manger', compact('managers'));
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->gender = '';
        $this->dob = '';
        $this->status = 'active';
        $this->photo = null;
        $this->manager_id = null;
        $this->isEdit = false;
        $this->showForm = false;
    }

    public function saveManager()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|max:1024',
        ]);

        // Create user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make('password'), // Default password
            'role' => 'manager',

        ]);

        $photoPath = $this->photo ? $this->photo->store('manager_photos', 'public') : null;

        // Create manager
        Manager::create([
            'user_id' => $user->id,
            'doctor_id' => auth()->id(),
            'address' => $this->address,
            'photo' => $photoPath,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Manager created successfully!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $manager = Manager::with('user')->findOrFail($id);

        $this->manager_id = $manager->id;
        $this->name = $manager->user->name;
        $this->email = $manager->user->email;
        $this->phone = $manager->user->phone;
        $this->address = $manager->address;
        $this->gender = $manager->gender;
        $this->dob = $manager->dob;
        $this->status = $manager->status;
        $this->isEdit = true;
        $this->showForm = true;
    }

    public function updateManager()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->manager_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|max:1024',
        ]);

        $manager = Manager::findOrFail($this->manager_id);
        $user = $manager->user;

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        if ($this->photo) {
            if ($manager->photo && Storage::disk('public')->exists($manager->photo)) {
                Storage::disk('public')->delete($manager->photo);
            }
            $photoPath = $this->photo->store('manager_photos', 'public');
        } else {
            $photoPath = $manager->photo;
        }

        $manager->update([
            'address' => $this->address,
            'photo' => $photoPath,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
        ]);

        session()->flash('success', 'Manager updated successfully!');
        $this->resetForm();
    }

    public function delete($id)
    {
        $manager = Manager::findOrFail($id);
        if ($manager->photo && Storage::disk('public')->exists($manager->photo)) {
            Storage::disk('public')->delete($manager->photo);
        }

        $manager->user->delete();
        $manager->delete();

        session()->flash('success', 'Manager deleted successfully!');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        // You can implement modal confirmation if needed
        $this->delete($id);
    }
}
