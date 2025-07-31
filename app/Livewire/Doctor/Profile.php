<?php

namespace App\Livewire\Doctor;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageKitService;

#[Title('Doctor Profile')]
class Profile extends Component
{
public $current_password, $new_password, $new_password_confirmation;

     use WithFileUploads;

    public $doctor;
    public $name, $phone, $qualification, $fee, $start_time, $end_time, $slot_duration_minutes, $patients_per_slot,  $image, $newImage;
    public $available_days = [];
       public $imageTimestamp; 

    #[Layout('layouts.doctor')]
    public function mount()
    {
       $this->doctor = Doctor::with('user')->where('user_id', Auth::id())->firstOrFail();


        $this->name = $this->doctor->user->name;
        $this->phone = $this->doctor->user->phone ?? '';
        $this->qualification = $this->doctor->qualification ?? ''; 
        $this->fee = $this->doctor->fee;
        $this->start_time = $this->doctor->start_time;
        $this->end_time = $this->doctor->end_time;
        $this->slot_duration_minutes = $this->doctor->slot_duration_minutes;
        $this->patients_per_slot = $this->doctor->patients_per_slot;
       $this->available_days = $this->doctor->available_days ?? [];
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'fee' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
            'slot_duration_minutes' => 'required|numeric|min:1',
            'patients_per_slot' => 'required|numeric|min:1',
            'qualification' => 'required|string|max:255',
          'available_days' => 'required|array|min:1',
            'newImage' => 'nullable|image|max:10240',
        ]);

          try {
            // Initialize with current image data
            $imageUrl = $this->doctor->image;
            $imageId = $this->doctor->image_id;

            // Handle image upload if new image is provided
            if ($this->newImage) {
                $imageKit = new ImageKitService();
                
                // First delete old image if exists
                if ($imageId) {
                    try {
                        $imageKit->delete($imageId);
                    } catch (\Exception $e) {
                        // Log deletion error but continue with upload
                        \Log::error('Failed to delete old image: ' . $e->getMessage());
                    }
                }

                // Upload new image
                $response = $imageKit->upload(
                    fopen($this->newImage->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->newImage->getClientOriginalExtension(),
                    'doctor-profile'
                );

                if (!isset($response->result)) {
                    throw new \Exception('Image upload failed - invalid response');
                }

                $imageUrl = $response->result->url;
                $imageId = $response->result->fileId;
            }

        
        $this->doctor->update([
            'qualification' => $this->qualification,
            'fee' => $this->fee,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'slot_duration_minutes' => $this->slot_duration_minutes,
            'patients_per_slot' => $this->patients_per_slot,
          'available_days' => $this->available_days,
           'image' => $imageUrl,
                'image_id' => $imageId,
        ]);

 $this->doctor->user()->update([
    'name' => $this->name,
    'phone' => $this->phone,
]);

     $this->reset('newImage');

        session()->flash('message', 'Profile updated successfully.');

     } catch (\Exception $e) {
            session()->flash('error', 'Error updating profile: ' . $e->getMessage());
            \Log::error('Profile update error: ' . $e->getMessage());
        }
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

    // Dispatch events to refresh other components
    $this->dispatch('profile-picture-updated', imageUrl: $imageUrl);
    $this->dispatch('refresh-navigation');

    session()->flash('message', 'Password updated successfully.');
    
}

}


