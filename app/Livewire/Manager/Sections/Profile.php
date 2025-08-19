<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageKitService;

#[Title('Manager Profile')]
class Profile extends Component
{
    use WithFileUploads;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    
    public Manager $manager;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $gender;
    public $dob;
    public $status;
    public $newImage;
    public $imageTimestamp;
    public $isUpdatingProfile = false;
    public $isUpdatingPassword = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,',
        'phone' => 'nullable|string|max:20',
        'address' => 'required|string|max:500',
        'gender' => 'required|in:male,female,other',
        'dob' => 'required|date',
        'status' => 'required|in:active,inactive',
        'newImage' => 'nullable|image|max:10240',
    ];

    #[Layout('layouts.manager')]
    public function mount()
    {
        $this->rules['email'] .= Auth::id();
        
        $this->manager = Manager::with(['user' => function($query) {
            $query->select('id', 'name', 'email', 'phone');
        }])->where('user_id', Auth::id())->firstOrFail();

        $this->fill([
            'name' => $this->manager->user->name,
            'email' => $this->manager->user->email,
            'phone' => $this->manager->user->phone ?? '',
            'address' => $this->manager->address ?? '',
            'gender' => $this->manager->gender ?? '',
            'dob' => $this->manager->dob?->format('Y-m-d') ?? '',
            'status' => $this->manager->status ?? 'active',
            'imageTimestamp' => time()
        ]);
    }

    public function getImageUrlProperty()
    {
        return $this->manager->photo ?: asset('images/default-avatar.png');
    }

    public function updateProfile()
    {
        $this->isUpdatingProfile = true;
        $this->validate();

        try {
            $imageUrl = $this->manager->photo;
            $imageId = $this->manager->photo_id;

            if ($this->newImage) {
                $imageKit = new ImageKitService();
                $response = $imageKit->upload(
                    $this->newImage->getRealPath(),
                    'manager_'.Auth::id().'_'.time().'.'.$this->newImage->extension(),
                    'managers'
                );

                if ($response->success) {
                    if ($imageId) {
                        try {
                            $imageKit->delete($imageId);
                        } catch (\Exception $e) {
                            \Log::error("Old image deletion failed: {$e->getMessage()}");
                        }
                    }

                    $imageUrl = $response->result->url;
                    $imageId = $response->result->fileId;
                }
            }

            $this->manager->update([
                'address' => $this->address,
                'gender' => $this->gender,
                'dob' => $this->dob,
                'status' => $this->status,
                'photo' => $imageUrl,
                'photo_id' => $imageId,
            ]);

            $this->manager->user()->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
            ]);

            $this->reset('newImage');
            $this->imageTimestamp = time();
            session()->flash('message', 'Profile updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: '.$e->getMessage());
            \Log::error("Profile update error: {$e->getMessage()}");
        } finally {
            $this->isUpdatingProfile = false;
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