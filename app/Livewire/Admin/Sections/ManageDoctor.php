<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Services\ImageKitService; 
use App\Services\PincodeService; 

#[Title('Manage Doctors')]
class ManageDoctor extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $departments;
    public $showModal = false;
    public $doctorId = null; // Add this property
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
    public $search = '';
    public $max_booking_days; 
    public $imageUrl; 
    public $imageId;
    public $pincode;
    public $city;
    public $state;  

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function openModal($id = null) // Add method to handle modal opening
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

        if ($id) {
            $doctor = Doctor::with('user')->findOrFail($id);
            $this->doctorId = $doctor->id;
            $this->name = $doctor->user->name;
            $this->email = $doctor->user->email;
            $this->phone = $doctor->user->phone;
            $this->department_id = $doctor->department_id;
            $this->available_days = $doctor->available_days;
            $this->fee = $doctor->fee;
            $this->status = $doctor->status;
            $this->qualification = is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification;
            $this->start_time = $doctor->start_time;
            $this->end_time = $doctor->end_time;
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

    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->fetchPincodeDetails($value);
        } else {
            // Only clear if pincode is not 6 digits - allows manual entry
            if (strlen($value) < 6) {
                $this->resetErrorBag('pincode');
            }
        }
    }

    public function updatedCity($value)
    {
        // Clear pincode error when user manually enters city
        $this->resetErrorBag('pincode');
    }

    public function updatedState($value)
    {
        // Clear pincode error when user manually enters state
        $this->resetErrorBag('pincode');
    }

    public function fetchPincodeDetails($pincode)
    {
        Log::info('ManageDoctor: Fetching pincode details', ['pincode' => $pincode]);
        
        $result = PincodeService::getLocationByPincode($pincode);
        
        Log::info('ManageDoctor: PincodeService result', $result);
        
        if ($result['success']) {
            $this->city = $result['data']['city'];
            $this->state = $result['data']['state'];
            $this->resetErrorBag('pincode');

            Log::info('ManageDoctor: Successfully updated location', [
                'city' => $this->city,
                'state' => $this->state
            ]);
        } else {
            Log::error('ManageDoctor: Failed to fetch pincode details', [
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
            'email' => 'required|email|max:255|unique:users,email,' . ($this->doctorId ? $this->doctorId : null),
            'department_id' => 'required|exists:departments,id',
            'available_days' => 'required|array|min:1',
            'status' => 'required|in:0,1,2',
            'phone' => 'required|string|max:15',
            'fee' => 'required|numeric',
            'qualification' => 'nullable|string|max:255',
            'password' => $this->doctorId ? 'nullable|string|min:6|confirmed' : 'required|string|min:6|confirmed',
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
                if ($this->doctorId && $this->imageId) {
                    $imageKit->delete($this->imageId);
                }
            }

            $qualifications = $this->qualification ? 
                array_filter(array_map('trim', explode(',', $this->qualification))) : 
                null;

            if ($this->doctorId) {
                // Update existing doctor
                $doctor = Doctor::findOrFail($this->doctorId);
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
            } else {
                // Create new doctor
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'phone' => $this->phone,
                    'role' => 'doctor',
                ]);

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
            }

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

            session()->flash('message', 'Doctor ' . ($this->doctorId ? 'updated' : 'saved') . ' successfully.');
        } catch (\Exception $e) {
            if (isset($user) && !$this->doctorId) {
                $user->delete();
            }
            
            if (isset($imageId) && !$this->doctorId) {
                try {
                    $imageKit->delete($imageId);
                } catch (\Exception $deleteException) {
                    // Log this error
                }
            }
            
            session()->flash('error', 'Error saving doctor: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $user = $doctor->user;

            if ($doctor->image_id) {
                $imageKit = new ImageKitService();
                $imageKit->delete($doctor->image_id);
            }

            $doctor->delete();
            $user->delete();

            session()->flash('message', 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting doctor: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $query = Doctor::with(['user', 'department'])->latest();

        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $doctors = $query->paginate(5);

        return view('livewire.admin.sections.manage-doctor', [
            'doctors' => $doctors,
        ]);
    }
}