<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ImageKitService;
use App\Traits\DoctorFormTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateDoctor extends Component
{
    use WithFileUploads, DoctorFormTrait;

    public $doctor;
    public $showModal = false;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $experience;
    public $qualification;
    public $gender;
    public $status = 1;
    public $fee;
    public $start_time = '09:00';
    public $end_time = '17:00';
    public $available_days = [];
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $max_booking_days = 7;
    public $image;
    public $imagePreview;
    public $imageUrl;
    public $imageId;
    public $city;
    public $state;
    public $pincode;
    public $clinic_hospital_name;
    public $registration_number;
    public $languages_spoken;
    public $professional_bio;
    public $achievements_awards;
    public $social_media_links = [['platform' => '', 'url' => '']];
    public $social_media_platforms = ['twitter', 'facebook', 'instagram'];
    public $verification_documents = [];
    public $new_verification_documents;
    public $department_id;
    public $departments;
    public $manager_id = 1;

    protected $listeners = ['openUpdateModal' => 'openModal'];

    public function mount()
    {
        $this->departments = Department::all();
        $this->resetForm();
    }

    public function updatedImage()
    {
        if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
            try {
                $this->imagePreview = $this->image->temporaryUrl();
                Log::info('Image preview generated', ['doctor_id' => $this->doctor->id ?? null]);
            } catch (\Exception $e) {
                Log::error('Failed to generate image preview: ' . $e->getMessage());
                $this->imagePreview = null;
                $this->addError('image', 'Unable to generate image preview.');
            }
        } else {
            $this->imagePreview = null;
        }
    }

    private function isPasswordFieldEmpty()
    {
        $password = trim($this->password ?? '');
        
        // Check for common browser autofill patterns
        $autofillPatterns = ['••••••••', '********', '•••••', 'password'];
        
        return empty($password) || 
               strlen($password) === 0 || 
               in_array($password, $autofillPatterns) ||
               str_repeat('•', strlen($password)) === $password;
    }

    public function updatedPassword($value)
    {
        // Trim the value
        $this->password = trim($value ?? '');
        
        // If password is cleared, also clear password confirmation
        if (empty($this->password)) {
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
    }

    public function updatedPasswordConfirmation($value)
    {
        // Trim the value
        $this->password_confirmation = trim($value ?? '');
        
        // If password confirmation is entered but password is empty, clear confirmation
        if (empty($this->password) && !empty($this->password_confirmation)) {
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
    }



    private function getValidationRules()
    {
        $rules = $this->getCommonValidationRules();
        
        // Add update-specific rules
        $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->doctor->user_id;
        $rules['phone'] = 'required|string|max:15|unique:users,phone,' . $this->doctor->user_id;
        $rules['image'] = 'nullable|image|max:10240';
        $rules['registration_number'] = 'nullable|string|max:50|unique:doctors,registration_number,' . $this->doctor->id;
        
        // Remove password validation from common rules first
        unset($rules['password'], $rules['password_confirmation']);
        
        // Only add password validation if user wants to change it
        $trimmedPassword = trim($this->password ?? '');
        $trimmedPasswordConfirmation = trim($this->password_confirmation ?? '');
        
        if (!empty($trimmedPassword) || !empty($trimmedPasswordConfirmation)) {
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required|same:password';
        }
        
        // Only validate new documents if they are uploaded
        if ($this->new_verification_documents && count($this->new_verification_documents) > 0) {
            $rules['new_verification_documents.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }        return $rules;
    }

    private function processDocuments()
    {
        $documents = $this->verification_documents;
        
        if ($this->new_verification_documents) {
            $imageKit = new ImageKitService();
            foreach ($this->new_verification_documents as $index => $file) {
                if ($file) {
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
                        Log::error('Document upload failed', [
                            'file' => $file->getClientOriginalName(),
                            'error' => $e->getMessage()
                        ]);
                        throw $e;
                    }
                }
            }
        }

        return $documents;
    }



    public function openModal($doctorId)
    {
        try {
            if (empty($doctorId) || !is_numeric($doctorId)) {
                throw new \Exception('Invalid doctor ID provided');
            }

            $this->doctor = Doctor::with(['user', 'department'])->findOrFail($doctorId);

            if (!$this->doctor->user || !$this->doctor->department) {
                throw new \Exception('Doctor user or department data not found');
            }

            $this->name = $this->doctor->user->name ?? '';
            $this->email = $this->doctor->user->email ?? '';
            $this->phone = $this->doctor->user->phone ?? '';
            $this->password = ''; // Always start with empty password
            $this->password_confirmation = ''; // Always start with empty password confirmation
            $this->experience = $this->doctor->experience ?? '';
            $this->qualification = is_array($this->doctor->qualification) ? implode(', ', $this->doctor->qualification) : ($this->doctor->qualification ?? '');
            $this->gender = $this->doctor->user->gender ?? '';
            $this->status = $this->doctor->status ?? 1;
            $this->fee = $this->doctor->fee ?? '';
            $this->start_time = $this->doctor->start_time ? Carbon::parse($this->doctor->start_time)->format('H:i') : '09:00';
            $this->end_time = $this->doctor->end_time ? Carbon::parse($this->doctor->end_time)->format('H:i') : '17:00';
            $this->available_days = is_array($this->doctor->available_days) ? $this->doctor->available_days : [];
            $this->slot_duration_minutes = $this->doctor->slot_duration_minutes ?? 30;
            $this->patients_per_slot = $this->doctor->patients_per_slot ?? 1;
            $this->max_booking_days = $this->doctor->max_booking_days ?? 7;
            $this->city = $this->doctor->city ?? '';
            $this->state = $this->doctor->state ?? '';
            $this->pincode = $this->doctor->pincode ?? '';
            $this->clinic_hospital_name = $this->doctor->clinic_hospital_name ?? '';
            $this->registration_number = $this->doctor->registration_number ?? '';
            $this->languages_spoken = is_array($this->doctor->languages_spoken) ? implode(', ', $this->doctor->languages_spoken) : ($this->doctor->languages_spoken ?? '');
            $this->professional_bio = $this->doctor->professional_bio ?? '';
            $this->achievements_awards = is_array($this->doctor->achievements_awards) ? implode(', ', $this->doctor->achievements_awards) : ($this->doctor->achievements_awards ?? '');
            $this->social_media_links = is_array($this->doctor->social_media_links) ? array_map(fn($url, $platform) => ['platform' => $platform, 'url' => $url], array_values($this->doctor->social_media_links), array_keys($this->doctor->social_media_links)) : [['platform' => '', 'url' => '']];
            $this->verification_documents = $this->doctor->verification_documents ?? [];
            $this->department_id = $this->doctor->department_id ?? '';
            $this->imagePreview = $this->doctor->image ?? null;
            $this->imageUrl = $this->doctor->image ?? null;
            $this->imageId = $this->doctor->image_id ?? null;

            // Force clear password fields to prevent validation issues
            $this->password = '';
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);

            $this->showModal = true;
            $this->dispatch('modalOpened');
            
            Log::info('UpdateDoctor modal opened', [
                'doctor_id' => $doctorId,
                'password_cleared' => true,
                'password_value' => $this->password,
                'confirmation_value' => $this->password_confirmation
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Doctor not found', ['doctor_id' => $doctorId]);
            session()->flash('error', 'Doctor not found.');
            $this->showModal = false;
            $this->resetForm();
        } catch (\Exception $e) {
            Log::error('Error loading doctor details: ' . $e->getMessage(), ['doctor_id' => $doctorId]);
            session()->flash('error', 'An error occurred while loading doctor details.');
            $this->showModal = false;
            $this->resetForm();
        }
    }

    public function updateDoctor()
    {
        // Debug: Log password field values
        Log::info('Password fields before processing', [
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'password_length' => strlen($this->password ?? ''),
            'confirmation_length' => strlen($this->password_confirmation ?? '')
        ]);
        
        // Trim password fields to handle whitespace properly
        $this->password = trim($this->password ?? '');
        $this->password_confirmation = trim($this->password_confirmation ?? '');
        
        // Clear password confirmation if password is empty to avoid validation issues
        if (empty($this->password)) {
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
        
        Log::info('Password fields after processing', [
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'password_empty' => empty($this->password),
            'will_validate_password' => !empty($this->password) && strlen($this->password) > 0
        ]);
        
        // Build validation rules dynamically
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->doctor->user_id,
            'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phone,' . $this->doctor->user_id,
            'department_id' => 'required|exists:departments,id',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'status' => 'required|in:0,1,2',
            'fee' => 'required|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|integer|min:0|max:50',
            'languages_spoken' => 'nullable|string|max:255',
            'clinic_hospital_name' => 'nullable|string|max:100',
            'professional_bio' => 'nullable|string|max:65535',
            'achievements_awards' => 'nullable|string|max:255',
            'social_media_links.*.platform' => 'nullable|in:twitter,facebook,instagram',
            'social_media_links.*.url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:10240',
            'registration_number' => 'nullable|string|max:50|unique:doctors,registration_number,' . $this->doctor->id,
        ];
        
        // Only add password validation if user actually wants to change password
        // Use helper method to check if password is really provided
        if (!$this->isPasswordFieldEmpty()) {
            $validationRules['password'] = 'required|min:8';
            $validationRules['password_confirmation'] = 'required|same:password';
        } else {
            // Force clear if it looks like autofill or placeholder
            $this->password = '';
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
        
        // Add document validation if files are uploaded
        if ($this->new_verification_documents && count($this->new_verification_documents) > 0) {
            $validationRules['new_verification_documents.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }
        
        // Validate with dynamic rules
        $this->validate($validationRules);

        try {
            DB::beginTransaction();

            $imageUrl = $this->doctor->image;
            $imageId = $this->doctor->image_id;

            // Handle image upload
            if ($this->image) {
                $imageKit = new ImageKitService();
                
                // Delete old image if exists
                if ($this->doctor->image_id) {
                    try {
                        $imageKit->delete($this->doctor->image_id);
                    } catch (\Exception $e) {
                        Log::error('Failed to delete old image: ' . $e->getMessage());
                    }
                }
                
                $response = $imageKit->upload(
                    fopen($this->image->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->image->getClientOriginalExtension(),
                    'doctors'
                );

                if (!isset($response->result->url)) {
                    throw new \Exception('Image upload failed');
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

            // Update user
            $user = User::find($this->doctor->user_id);
            if (!$user) {
                throw new \Exception('User not found');
            }

            $userData = [
                'name' => ucfirst(trim($this->name)),
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
            ];

            if ($this->password) {
                $userData['password'] = Hash::make($this->password);
            }

            $user->update($userData);

            // Update doctor
            $this->doctor->update([
                'department_id' => $this->department_id,
                'manager_id' => $this->manager_id,
                'experience' => $this->experience,
                'qualification' => $arrayFields['qualifications'],
                'status' => $this->status,
                'fee' => $this->fee,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'available_days' => $this->available_days,
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $this->patients_per_slot,
                'max_booking_days' => $this->max_booking_days,
                'city' => $this->city !== '' ? $this->city : null,
                'state' => $this->state !== '' ? $this->state : null,
                'pincode' => $this->pincode !== '' ? $this->pincode : null,
                'clinic_hospital_name' => $this->clinic_hospital_name !== '' ? $this->clinic_hospital_name : null,
                'registration_number' => $this->registration_number !== null && trim($this->registration_number) !== '' ? $this->registration_number : null,
                'languages_spoken' => $arrayFields['languages'],
                'professional_bio' => $this->professional_bio !== '' ? $this->professional_bio : null,
                'achievements_awards' => $arrayFields['achievements'],
                'social_media_links' => $socialMedia,
                'verification_documents' => $documents,
                'image' => $imageUrl,
                'image_id' => $imageId,
                'slug' => Str::slug($this->name),
            ]);

            DB::commit();

            session()->flash('success', 'Doctor details updated successfully.');
            $this->showModal = false;
            $this->resetForm();
            $this->dispatch('doctorUpdated');
            $this->dispatch('refreshDoctorList');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating doctor: ' . $e->getMessage(), [
                'doctor_id' => $this->doctor->id,
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'An error occurred while updating doctor details: ' . $e->getMessage());
        }
    }

    public function removeDocument($index)
    {
        try {
            if (isset($this->verification_documents[$index])) {
                $imageKit = new ImageKitService();
                $imageKit->delete(basename($this->verification_documents[$index]));
                unset($this->verification_documents[$index]);
                $this->verification_documents = array_values($this->verification_documents);
                $this->doctor->update(['verification_documents' => $this->verification_documents]);
                Log::info('Document removed', ['index' => $index, 'doctor_id' => $this->doctor->id]);
            }
        } catch (\Exception $e) {
            Log::error('Error removing document: ' . $e->getMessage(), ['index' => $index, 'doctor_id' => $this->doctor->id]);
            session()->flash('error', 'An error occurred while removing the document.');
        }
    }



    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        Log::info('UpdateDoctor modal closed');
    }

    private function resetForm()
    {
        $this->reset([
            'name', 'email', 'password', 'password_confirmation', 'phone', 'experience', 'qualification', 'gender',
            'status', 'fee', 'start_time', 'end_time', 'available_days', 'slot_duration_minutes',
            'patients_per_slot', 'max_booking_days', 'image', 'imagePreview', 'imageUrl', 'imageId', 'city',
            'state', 'pincode', 'clinic_hospital_name', 'registration_number', 'languages_spoken',
            'professional_bio', 'achievements_awards', 'social_media_links', 'verification_documents',
            'new_verification_documents', 'department_id'
        ]);
        
        // Explicitly clear password fields
        $this->password = '';
        $this->password_confirmation = '';
        
        $this->status = false;
        $this->start_time = '09:00';
        $this->end_time = '17:00';
        $this->slot_duration_minutes = 30;
        $this->patients_per_slot = 1;
        $this->max_booking_days = 7;
        $this->social_media_links = [['platform' => '', 'url' => '']];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.doctor.update-doctor', [
            'doctor' => $this->doctor,
            'imagePreview' => $this->imagePreview,
            'departments' => $this->departments,
        ]);
    }
}