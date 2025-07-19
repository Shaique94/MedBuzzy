<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageKitService;

class Profile extends Component
{
    use WithFileUploads;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    
    public $manager;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $gender;
    public $dob;
    public $status;
    public $newImage;
    public $imageTimestamp;

    #[Layout('layouts.manager')]
    public function mount()
    {
        $this->manager = Manager::with('user')->where('user_id', Auth::id())->firstOrFail();

        $this->name = $this->manager->user->name;
        $this->email = $this->manager->user->email;
        $this->phone = $this->manager->user->phone ?? '';
        $this->address = $this->manager->address ?? '';
        $this->gender = $this->manager->gender ?? '';
        $this->dob = $this->manager->dob ? $this->manager->dob->format('Y-m-d') : '';
        $this->status = $this->manager->status ?? 'active';
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'status' => 'required|in:active,inactive',
            'newImage' => 'nullable|image|max:10240',
        ]);

        try {
            // Initialize with current image data
            $imageUrl = $this->manager->photo;
            $imageId = $this->manager->photo_id;

            // Handle image upload if new image is provided
            if ($this->newImage) {
                $imageKit = new ImageKitService();
                
                // First delete old image if exists
                if ($imageId) {
                    try {
                        $imageKit->delete($imageId);
                    } catch (\Exception $e) {
                        // Log deletion error but continue with upload
                        \Log::error('Failed to delete old manager image: ' . $e->getMessage());
                    }
                }

                // Upload new image
                $response = $imageKit->upload(
                    fopen($this->newImage->getRealPath(), 'r'),
                    'manager_' . time() . '.' . $this->newImage->getClientOriginalExtension(),
                    'managers'
                );

                if (!isset($response->result)) {
                    throw new \Exception('Image upload failed - invalid response');
                }

                $imageUrl = $response->result->url;
                $imageId = $response->result->fileId;
            }

            // Update manager data
            $this->manager->update([
                'address' => $this->address,
                'gender' => $this->gender,
                'dob' => $this->dob,
                'status' => $this->status,
                'photo' => $imageUrl,
                'photo_id' => $imageId,
            ]);

               // Update user data
            $this->manager->user()->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            $this->reset('newImage');
            $this->imageTimestamp = time(); // Refresh image display

            // Dispatch events if needed
            $this->dispatch('profile-picture-updated', imageUrl: $imageUrl);
            $this->dispatch('refresh-navigation');

            session()->flash('message', 'Profile updated successfully.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating profile: ' . $e->getMessage());
            \Log::error('Manager profile update error: ' . $e->getMessage());
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|same:new_password_confirmation',
        ], [
            'new_password.same' => 'Passwords do not match.'
        ]);

        $user = $this->manager->user;

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.manager.sections.profile');
    }
}