<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Services\ImageKitService; 

class ManageDoctor extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $departments;
    public $showModal = false;
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

    public function mount()
    {
        $this->departments = Department::all();
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
            'fee' => 'required|numeric',
            'qualification' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
                   'photo' => 'nullable|image|max:10240',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'max_booking_days'=>'required|integer|min:1|max:30'
        ]);

              try {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'role' => 'doctor',
        ]);

            // Handle image upload to ImageKit
            $imageUrl = null;
            $imageId = null;
            
            if ($this->photo) {
                $imageKit = new ImageKitService();
                $response = $imageKit->upload(
                    fopen($this->photo->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->photo->getClientOriginalExtension(),
                    'doctors' // Folder in ImageKit
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
    
        Doctor::create([
            'user_id' => $user->id,
           'manager_id' => auth()->id(),
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
        ]);

        session()->flash('message', 'Doctor saved successfully.');
   } catch (\Exception $e) {
            // Clean up if something went wrong
            if (isset($user)) {
                $user->delete();
            }
            
            // Delete from ImageKit if upload succeeded but something else failed
            if (isset($imageId)) {
                try {
                    $imageKit->delete($imageId);
                } catch (\Exception $deleteException) {
                    // Log this error
                }
            }
            
            session()->flash('error', 'Error saving doctor: ' . $e->getMessage());
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