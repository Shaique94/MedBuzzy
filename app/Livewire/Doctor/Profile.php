<?php

namespace App\Livewire\Doctor;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
public $current_password, $new_password, $new_password_confirmation;

     use WithFileUploads;

    public $doctor;
    public $name, $phone, $qualification, $fee, $start_time, $end_time, $slot_duration_minutes, $patients_per_slot,  $image, $newImage;

    #[Layout('layouts.doctor')]
    public function mount()
    {
       $this->doctor = Doctor::with('user')->where('user_id', Auth::id())->firstOrFail();


        $this->name = $this->doctor->user->name;
        $this->phone = $this->doctor->user->phone ?? '';
        $this->qualification = $this->doctor->qualification ;
        $this->fee = $this->doctor->fee;
        $this->start_time = $this->doctor->start_time;
        $this->end_time = $this->doctor->end_time;
        $this->slot_duration_minutes = $this->doctor->slot_duration_minutes;
        $this->patients_per_slot = $this->doctor->patients_per_slot;
        // $this->available_days = $this->doctor->available_days ? explode(',', $this->doctor->available_days) : [];
    }

    public function updateProfile()
    {
        // dd($this->name, $this->phone, $this->doctor->user);
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'fee' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_duration_minutes' => 'required|numeric|min:1',
            'patients_per_slot' => 'required|numeric|min:1',
            'qualification' => 'nullable|string|max:255',
            // 'available_days' => 'string',
            'newImage' => 'nullable|image|max:1024',
        ]);

        if ($this->newImage) {
            $imagePath = $this->newImage->store('doctors', 'public');
            $this->doctor->image = $imagePath;
        }

        $this->doctor->update([
            'qualification' => $this->qualification,
            'fee' => $this->fee,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'slot_duration_minutes' => $this->slot_duration_minutes,
            'patients_per_slot' => $this->patients_per_slot,
            // 'available_days' => implode(',', $this->available_days),
            'image' => $this->doctor->image,
        ]);

 $this->doctor->user()->update([
    'name' => $this->name,
    'phone' => $this->phone,
]);


        session()->flash('message', 'Profile updated successfully.');
    }

   public function render()
    {
        return view('livewire.doctor.profile');
    }

   public function updatePassword()
{
    $this->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|same:new_password_confirmation',
    ], [
        'new_password.same' => 'Passwords do not match.'
    ]);

    $user = $this->doctor->user;

    if (!\Hash::check($this->current_password, $user->password)) {
        $this->addError('current_password', 'Current password is incorrect.');
        return;
    }

    $user->update([
        'password' => bcrypt($this->new_password)
    ]);

    $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    session()->flash('message', 'Password updated successfully.');
}

}


