<?php

namespace App\Livewire\User\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

#[Title('My Profile')]
#[Layout('layouts.user')]
class Profile extends Component
{
    use WithFileUploads;

    // Password fields
    public $current_password, $new_password, $new_password_confirmation;
    
    // User fields
    public $user;
    public $name, $email, $phone, $gender, $date_of_birth, $blood_group;
    public $address, $district, $state, $country, $pincode;
    
    // Image handling
    public $newImage;
    public $imageTimestamp;


// In your mount() method:
public function mount()
{
    $this->user = User::with('patients')->findOrFail(Auth::id());
    
    // Personal Info
    $this->name = $this->user->name;
    $this->email = $this->user->email;
    $this->phone = $this->user->phone ?? '';
    $this->gender = $this->user->gender ?? '';
    $this->date_of_birth = $this->user->date_of_birth ?? '';
    $this->blood_group = $this->user->blood_group ?? '';

    // Get the first patient record or create empty defaults
    $patient = $this->user->patients->first();
    
    // Address Info
    $this->address = $patient->address ?? '';
    $this->district = $patient->district ?? '';
    $this->state = $patient->state ?? '';
    $this->country = $patient->country ?? 'India'; // Default to India
    $this->pincode = $patient->pincode ?? '';
}

   public function updateProfile()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'gender' => 'required|in:male,female,other,prefer-not-to-say',
        'date_of_birth' => 'nullable|date',
        'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'address' => 'required|string|max:255',
        'district' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'country' => 'required|string|max:100',
        'pincode' => 'required|string|max:10',
        'newImage' => 'nullable|image|max:10240',
    ]);

    try {
        // Handle image upload
        if ($this->newImage) {
            if ($this->user->profile_photo_path) {
                Storage::delete($this->user->profile_photo_path);
            }
            $path = $this->newImage->store('profile-photos');
            $this->user->profile_photo_path = $path;
        }

        // Update user data
        $this->user->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'blood_group' => $this->blood_group,
        ]);

        // Update or create patient record
        $patientData = [
              'name' => $this->name, 
            'address' => $this->address,
            'district' => $this->district,
            'state' => $this->state,
            'country' => $this->country,
            'pincode' => $this->pincode,
               'gender' => $this->gender,
        ];

        if ($this->user->patients()->exists()) {
            $this->user->patients()->first()->update($patientData);
        } else {
            $this->user->patients()->create(array_merge(
                    ['name' => $this->name, 'email' => $this->email, 'gender' => $this->gender],
                $patientData
            ));
        }

        $this->reset('newImage');
        $this->imageTimestamp = time();
        
        session()->flash('profile_message', 'Profile updated successfully.');
        
    } catch (\Exception $e) {
        session()->flash('profile_error', 'Error updating profile: ' . $e->getMessage());
    }
}

    public function removeProfilePhoto()
    {
        if ($this->user->profile_photo_path) {
            Storage::delete($this->user->profile_photo_path);
            $this->user->profile_photo_path = null;
            $this->user->save();
            $this->imageTimestamp = time();
            session()->flash('profile_message', 'Profile photo removed successfully.');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|same:new_password_confirmation',
        ], [
            'new_password.same' => 'The new passwords do not match.',
            'new_password.different' => 'New password must be different from current password.'
        ]);

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        $this->user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_message', 'Password updated successfully.');
    }
    

    public function render()
    {
        return view('livewire.user.sections.profile');
    }
}