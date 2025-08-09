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
use App\Traits\DoctorFormTrait;

#[Title('Create Doctor')]
class CreateDoctor extends Component
{
    use WithFileUploads, DoctorFormTrait;

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
    public $gender;
    public $experience;
    public $languages_spoken;
    public $clinic_hospital_name;
    public $registration_number;
    public $professional_bio;
    public $achievements_awards;
    public $verification_documents = [];
    public $social_media_links = [];
    public $social_media_platforms = ['twitter', 'facebook', 'instagram'];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetErrorBag();
        $this->resetForm();
    }

    private function resetForm()
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
            'gender',
            'experience',
            'languages_spoken',
            'clinic_hospital_name',
            'registration_number',
            'professional_bio',
            'achievements_awards',
            'verification_documents',
            'social_media_links',
        ]);

        // Set defaults
        $this->status = 1;
        $this->start_time = '09:00';
        $this->end_time = '17:00';
        $this->slot_duration_minutes = 30;
        $this->patients_per_slot = 1;
        $this->max_booking_days = 7;
        $this->social_media_links = [];
    }

    public function updatedPincode($value)
    {
        if (strlen($value) === 6) {
            $this->validateOnly('pincode');
            $this->fetchPincodeDetails($value);
        } else {
            if (strlen($value) < 6) {
                $this->resetErrorBag('pincode');
            }
            $this->city = '';
            $this->state = '';
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





    private function getValidationRules()
    {
        $rules = $this->getCommonValidationRules();
        
        // Add create-specific rules
        $rules['email'] = 'required|email|max:255|unique:users,email';
        $rules['phone'] = 'required|string|max:15|unique:users,phone';
        $rules['password'] = 'required|string|min:6|confirmed';
        $rules['photo'] = 'nullable|image|max:10240';
        $rules['registration_number'] = 'nullable|string|max:50|unique:doctors,registration_number';

        return $rules;
    }

    private function processArrayFields()
    {
        return [
            'qualifications' => $this->qualification ? 
                array_filter(array_map('trim', explode(',', $this->qualification))) : 
                null,
            'languages' => $this->languages_spoken ? 
                array_filter(array_map('trim', explode(',', $this->languages_spoken))) : 
                null,
            'achievements' => $this->achievements_awards ? 
                array_filter(array_map('trim', explode(',', $this->achievements_awards))) : 
                null,
        ];
    }

    private function processDocuments()
    {
        if (!$this->verification_documents) {
            return null;
        }

        $imageKit = new ImageKitService();
        $documents = [];
        
        foreach ($this->verification_documents as $index => $file) {
            try {
                $response = $imageKit->upload(
                    fopen($file->getRealPath(), 'r'),
                    'document_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension(),
                    'doctor_documents'
                );

                if (!isset($response->result->url)) {
                    throw new \Exception('Document upload failed for file ' . $file->getClientOriginalName());
                }

                $documents[] = $response->result->url;
            } catch (\Exception $e) {
                \Log::error('Document upload failed', [
                    'file' => $file->getClientOriginalName(),
                    'error' => $e->getMessage()
                ]);
                throw $e;
            }
        }

        return $documents;
    }

    private function processSocialMedia()
    {
        if (!$this->social_media_links) {
            return null;
        }

        $socialMedia = [];
        foreach ($this->social_media_links as $link) {
            if (!empty($link['platform']) && !empty($link['url'])) {
                $socialMedia[$link['platform']] = $link['url'];
            }
        }

        return empty($socialMedia) ? null : $socialMedia;
    }

    public function save()
    {
        $this->validate($this->getValidationRules());

        try {
            \DB::beginTransaction();

            $imageUrl = null;
            $imageId = null;

            // Handle photo upload
            if ($this->photo) {
                $imageKit = new ImageKitService();
                $response = $imageKit->upload(
                    fopen($this->photo->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->photo->getClientOriginalExtension(),
                    'doctors'
                );

                if (!isset($response->result->url)) {
                    throw new \Exception('Photo upload failed');
                }

                $imageUrl = $response->result->url;
                $imageId = $response->result->fileId;
            }

            // Process array fields
            $arrayFields = $this->processArrayFields();
            
            // Process documents
            $documents = $this->processDocuments();
            
            // Process social media
            $socialMedia = $this->processSocialMedia();

            $capitalizedName = ucfirst(trim($this->name));

            // Create new user
            $user = User::create([
                'name' => $capitalizedName,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'gender' => $this->gender,
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
                'qualification' => $arrayFields['qualifications'],
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
                'experience' => $this->experience,
                'languages_spoken' => $arrayFields['languages'],
                'clinic_hospital_name' => $this->clinic_hospital_name,
                'registration_number' => $this->registration_number,
                'professional_bio' => $this->professional_bio,
                'achievements_awards' => $arrayFields['achievements'],
                'verification_documents' => $documents,
                'social_media_links' => $socialMedia,
            ]);

            \DB::commit();

            $this->resetForm();
            session()->flash('message', 'Doctor created successfully.');
            $this->dispatch('doctorCreated');
            $this->dispatch('refreshDoctorList');
            $this->closeModal();

        } catch (\Exception $e) {
            \DB::rollBack();
            
            // Clean up uploaded files on error
            if (isset($imageId)) {
                try {
                    $imageKit = new ImageKitService();
                    $imageKit->delete($imageId);
                } catch (\Exception $cleanupError) {
                    \Log::error('Failed to cleanup uploaded image: ' . $cleanupError->getMessage());
                }
            }

            // Clean up user if created
            if (isset($user)) {
                try {
                    $user->delete();
                } catch (\Exception $cleanupError) {
                    \Log::error('Failed to cleanup created user: ' . $cleanupError->getMessage());
                }
            }

            \Log::error('Error creating doctor: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Error creating doctor: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.create-doctor');
    }
}