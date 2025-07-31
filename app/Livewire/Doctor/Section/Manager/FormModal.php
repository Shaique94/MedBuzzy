<?php

namespace App\Livewire\Doctor\Section\Manager;

use Livewire\Component;
use App\Models\User;
use App\Models\Manager;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageKitService;

#[Title('Add Manager')]
class FormModal extends Component
{
    use WithFileUploads;

    public $show = false;
    public $name = '', $email = '', $phone = '', $address = '', $gender = '', $dob = '', $status = 'active', $photo;
    public $imageUrl; 
    public $imageId;

    public function openModal()
    {
        $this->resetForm();
        $this->show = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->show = false;
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
            'photo' => 'nullable|image|max:10240',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        if ($this->photo) {
            $imageKit = new ImageKitService();
            $response = $imageKit->upload(
                fopen($this->photo->getRealPath(), 'r'),
                'manager_' . time() . '.' . $this->photo->getClientOriginalExtension(),
                'managers'
            );

            if (isset($response->result->url) && isset($response->result->fileId)) {
                $this->imageUrl = $response->result->url;
                $this->imageId = $response->result->fileId;
            }
        }

        Manager::create([
            'user_id' => $user->id,
            'doctor_id' => auth()->user()->doctor->id,
            'address' => $this->address,
            'photo' => $this->imageUrl,
            'photo_id' => $this->imageId,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
        ]);

       return redirect()->route('doctor.manager.list')->with('success', 'Manager created successfully!');
    }

    private function resetForm()
    {
        $this->reset(['name', 'email', 'phone', 'address', 'gender', 'dob', 'status', 'photo']);
        $this->status = 'active';
    }

    public function render()
    {
        return view('livewire.doctor.section.manager.form-modal');
    }
}