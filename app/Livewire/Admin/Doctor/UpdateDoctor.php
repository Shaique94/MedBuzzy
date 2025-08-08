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

#[Title('Update Doctor')]
class UpdateDoctor extends Component
{
    use WithFileUploads;

    public $departments;
    public $showModal = false;
    public $doctorId = null;
    public $name;
    public $email; 
    public $department_id;
    public $available_days = [];
    public $phone;
    public $fee;
    public $status;
    public $qualification;
    public $password;
    public $password_confirmation;
    public $photo;
    public $start_time;
    public $end_time;
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $max_booking_days; 
    public $imageUrl; 
    public $imageId;
    public $pincode;
    public $city;
    public $state;  

    protected $listeners = ['openUpdateModal' => 'openModal'];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function openModal($doctorId)
    {
        $this->reset([
            'doctorId',
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

        if ($doctorId) {
            $doctor = Doctor::with('user')->findOrFail($doctorId);
            $this->doctorId = $doctor->id;
            $this->name = $doctor->user->name;
            $this->email = $doctor->user->email;
            $this->phone = $doctor->user->phone;
            $this->department_id = $doctor->department_id;
            $this->available_days = $doctor->available_days;
            $this->fee = $doctor->fee;
            $this->status = $doctor->status;
            $this->qualification = is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification;
            $this->start_time = \Carbon\Carbon::parse($doctor->start_time)->format('H:i');
            $this->end_time = \Carbon\Carbon::parse($doctor->end_time)->format('H:i');
            $this->slot_duration_minutes = $doctor->slot_duration_minutes;
            $this->patients_per_slot = $doctor->patients_per_slot;
            $this->max_booking_days = $doctor->max_booking_days;
            $this->imageUrl = $doctor->image;
            $this->imageId = $doctor->image_id;
            $this->pincode = $doctor->pincode;
            $this->city = $doctor->city;
            $this->state = $doctor->state;
        }

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
        \Log::info('UpdateDoctor: Fetching pincode details', ['pincode' => $pincode]);
        
        $result = PincodeService::getLocationByPincode($pincode);
        
        \Log::info('UpdateDoctor: PincodeService result', $result);
        
        if ($result['success']) {
            $this->city = $result['data']['city'];
            $this->state = $result['data']['state'];
            $this->resetErrorBag('pincode');
            
            \Log::info('UpdateDoctor: Successfully updated location', [
                'city' => $this->city,
                'state' => $this->state
            ]);
        } else {
            \Log::error('UpdateDoctor: Failed to fetch pincode details', [
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
        // Fix validation to use correct user_id instead of doctor_id
        $doctor = Doctor::findOrFail($this->doctorId);
        
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $doctor->user_id,
            'department_id' => 'required|exists:departments,id',
            'available_days' => 'required|array|min:1',
            'status' => 'required|in:0,1,2',
            'phone' => 'required|string|max:15',
            'fee' => 'required|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
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
            $imageUrl = $this->imageUrl;
            $imageId = $this->imageId;

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

                // Delete old image if updating
                if ($this->imageId) {
                    $imageKit->delete($this->imageId);
                }
            }

            $qualifications = $this->qualification ? 
                array_filter(array_map('trim', explode(',', $this->qualification))) : 
                null;

            // Update existing doctor
            $user = $doctor->user;

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password ? Hash::make($this->password) : $user->password,
            ]);

            $doctor->update([
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
                'doctorId',
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

            session()->flash('message', 'Doctor updated successfully.');
            $this->dispatch('doctorUpdated');
            $this->dispatch('refreshDoctorList');
            $this->closeModal();
        } catch (\Exception $e) {
            if (isset($imageId) && $imageId !== $this->imageId) {
                try {
                    $imageKit = new ImageKitService();
                    $imageKit->delete($imageId);
                } catch (\Exception $deleteException) {
                    \Log::error('Failed to delete uploaded image: ' . $deleteException->getMessage());
                }
            }
            
            session()->flash('error', 'Error updating doctor: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.update-doctor');
    }
}
