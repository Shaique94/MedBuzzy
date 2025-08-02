<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Services\ImageKitService; 
use App\Services\PincodeService; 

#[Title('Create Doctor')]
class CreateDoctor extends Component
{
    use WithFileUploads;

    public $departments;
    public $showModal = false;
    public $name;
    public $email; 
    public $department_id;
    public $available_days = [];
    public $phone;
    public $fee;
    public $status = 1;
    public $qualification;
    public $password;
    public $password_confirmation;
    public $photo;
    public $start_time = '09:00';
    public $end_time = '17:00';
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $max_booking_days = 7; 
    public $imageUrl; 
    public $imageId;
    public $pincode;
    public $city;
    public $state;  

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function openModal()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'phone',
            'status',
            'available_days',
            'fee',
            'department_id',
            'qualification',
            'photo',
            'start_time',
            'end_time',
            'slot_duration_minutes',
            'patients_per_slot',
            'max_booking_days',
            'imageUrl',
            'imageId',
            'pincode',
            'city',
            'state',
        ]);
        
        $this->status = 1;
        $this->start_time = '09:00';
        $this->end_time = '17:00';
        $this->slot_duration_minutes = 30;
        $this->patients_per_slot = 1;
        $this->max_booking_days = 7;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetErrorBag();
    }

    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->fetchPincodeDetails($value);
        } else {
            if (strlen($value) < 6) {
                $this->resetErrorBag('pincode');
            }
        }
    }

    public function updatedCity($value)
    {
        $this->resetErrorBag('pincode');
    }

    public function updatedState($value)
    {
        $this->resetErrorBag('pincode');
    }

    public function fetchPincodeDetails($pincode)
    {
        \Log::info('CreateDoctor: Fetching pincode details', ['pincode' => $pincode]);
        
        $result = PincodeService::getLocationByPincode($pincode);
        
        \Log::info('CreateDoctor: PincodeService result', $result);
        
        if ($result['success']) {
            $this->city = $result['data']['city'];
            $this->state = $result['data']['state'];
            $this->resetErrorBag('pincode');
            
            \Log::info('CreateDoctor: Successfully updated location', [
                'city' => $this->city,
                'state' => $this->state
            ]);
        } else {
            \Log::error('CreateDoctor: Failed to fetch pincode details', [
                'pincode' => $pincode,
                'error' => $result['error']
            ]);
            
            $this->addError('pincode', $result['error']);
            $this->city = '';
            $this->state = '';
        }
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
            'fee' => 'required|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'nullable|image|max:10240',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'pincode' => 'nullable|digits:6',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
        ]);

        try {
            $imageUrl = null;
            $imageId = null;

            if ($this->photo) {
                $imageKit = new ImageKitService();
                $response = $imageKit->upload(
                    fopen($this->photo->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->photo->getClientOriginalExtension(),
                    'doctors'
                );

                if (!isset($response->result->url)) {
                    throw new \Exception('Image upload failed');
                }

                $imageUrl = $response->result->url;
                $imageId = $response->result->fileId;
            }

            $qualifications = $this->qualification ? 
                array_filter(array_map('trim', explode(',', $this->qualification))) : 
                null;

            // Create new user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'role' => 'doctor',
            ]);

            // Create doctor
            Doctor::create([
                'user_id' => $user->id,
                'manager_id' => 1,
                'department_id' => $this->department_id,
                'fee' => $this->fee,
                'status' => $this->status,
                'available_days' => $this->available_days,
                'qualification' => $qualifications,
                'image' => $imageUrl,
                'image_id' => $imageId,
                'slug' => Str::slug($this->name),
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $this->patients_per_slot,
                'max_booking_days' => $this->max_booking_days,
                'pincode' => $this->pincode,
                'city' => $this->city,
                'state' => $this->state,
            ]);

            $this->reset([
                'name',
                'email',
                'password',
                'password_confirmation',
                'phone',
                'status',
                'available_days',
                'fee',
                'department_id',
                'qualification',
                'photo',
                'start_time',
                'end_time',
                'slot_duration_minutes',
                'patients_per_slot',
                'max_booking_days',
                'showModal',
                'imageUrl',
                'imageId',
                'pincode',
                'city',
                'state',
            ]);

            session()->flash('message', 'Doctor created successfully.');
            $this->dispatch('doctorCreated');
            $this->dispatch('refreshDoctorList');
            $this->closeModal();
        } catch (\Exception $e) {
            if (isset($user)) {
                $user->delete();
            }
            
            if (isset($imageId)) {
                try {
                    $imageKit = new ImageKitService();
                    $imageKit->delete($imageId);
                } catch (\Exception $deleteException) {
                    \Log::error('Failed to delete uploaded image: ' . $deleteException->getMessage());
                }
            }
            
            session()->flash('error', 'Error creating doctor: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.create-doctor');
    }
}
