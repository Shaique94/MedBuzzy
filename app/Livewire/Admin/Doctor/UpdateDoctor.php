<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ImageKitService;
use App\Traits\DoctorFormTrait;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

#[Title('Update Doctor')]
#[Layout('layouts.admin')]
class UpdateDoctor extends Component
{
    use WithFileUploads, DoctorFormTrait;

    public $doctor;
    public $doctorId;
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
    public $image; // For new file uploads
    public $imagePreview;
    public $imageId;
    public $existingImage; // To store the existing image URL
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
    public $new_verification_documents = [];
    public $departments;
    public $department_id; // Added to fix validation error

    public function mount($id)
    {
        $this->doctorId = $id;
        $this->departments = Department::all();
        $this->loadDoctor();
    }

    private function loadDoctor()
    {
        try {
            $this->doctor = Doctor::with(['user', 'department'])->findOrFail($this->doctorId);
            
            $this->name = $this->doctor->user->name;
            $this->email = $this->doctor->user->email;
            $this->phone = $this->doctor->user->phone;
            $this->gender = $this->doctor->user->gender;
            $this->department_id = $this->doctor->department_id;
            $this->experience = $this->doctor->experience ?? 0;
            $this->qualification = is_array($this->doctor->qualification) 
                ? implode(', ', array_filter($this->doctor->qualification)) 
                : $this->doctor->qualification ?? '';
            $this->status = $this->doctor->status;
            $this->fee = $this->doctor->fee;
            $this->start_time = $this->doctor->start_time ? Carbon::parse($this->doctor->start_time)->format('H:i') : '09:00';
            $this->end_time = $this->doctor->end_time ? Carbon::parse($this->doctor->end_time)->format('H:i') : '17:00';
            $this->available_days = is_array($this->doctor->available_days) 
                ? $this->doctor->available_days 
                : [];
            $this->slot_duration_minutes = $this->doctor->slot_duration_minutes ?? 30;
            $this->patients_per_slot = $this->doctor->patients_per_slot ?? 1;
            $this->max_booking_days = $this->doctor->max_booking_days ?? 7;
            $this->existingImage = $this->doctor->image; // Store existing image URL
            $this->image = null; // Initialize as null to avoid validation issues
            $this->imageId = $this->doctor->image_id;
            $this->city = $this->doctor->city;
            $this->state = $this->doctor->state;
            $this->pincode = $this->doctor->pincode;
            $this->clinic_hospital_name = $this->doctor->clinic_hospital_name;
            $this->registration_number = $this->doctor->registration_number;
            $this->languages_spoken = is_array($this->doctor->languages_spoken) 
                ? implode(', ', array_filter($this->doctor->languages_spoken)) 
                : $this->doctor->languages_spoken ?? '';
            $this->professional_bio = $this->doctor->professional_bio;
            $this->achievements_awards = is_array($this->doctor->achievements_awards) 
                ? implode(', ', array_filter($this->doctor->achievements_awards)) 
                : $this->doctor->achievements_awards ?? '';
            $this->verification_documents = is_array($this->doctor->verification_documents) 
                ? $this->doctor->verification_documents 
                : [];
            $this->social_media_links = is_array($this->doctor->social_media_links) && !empty($this->doctor->social_media_links)
                ? array_map(function($platform, $url) {
                    return ['platform' => $platform, 'url' => $url];
                }, array_keys($this->doctor->social_media_links), array_values($this->doctor->social_media_links))
                : [['platform' => '', 'url' => '']];

            // Log image loading for debugging
            Log::info('Doctor image loaded', [
                'doctor_id' => $this->doctorId,
                'existing_image' => $this->existingImage,
                'image_id' => $this->imageId,
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            session()->flash('error', 'Doctor not found.');
            return redirect()->route('admin.doctors.list');
        } catch (\Exception $e) {
            Log::error('Error loading doctor: ' . $e->getMessage());
            session()->flash('error', 'Error loading doctor data.');
            return redirect()->route('admin.doctors.list');
        }
    }

    public function updatedImage()
    {
        if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
            try {
                // Validate image before generating preview
                $this->validate([
                    'image' => 'image|max:10240', // 10MB max
                ]);

                $this->imagePreview = $this->image->temporaryUrl();
                Log::info('Image preview generated', [
                    'doctor_id' => $this->doctor->id ?? null,
                    'preview_url' => $this->imagePreview,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to generate image preview: ' . $e->getMessage());
                $this->imagePreview = null;
                $this->addError('image', 'Unable to generate image preview.');
            }
        } else {
            $this->imagePreview = null;
        }
    }

    public function updatedPassword($value)
    {
        $this->password = trim($value ?? '');
        $autofillPatterns = ['••••••••', '********', '•••••', 'password'];
        if (empty($this->password) || in_array($this->password, $autofillPatterns) || str_repeat('•', strlen($this->password)) === $this->password) {
            $this->password = '';
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
    }

    public function updatedPasswordConfirmation($value)
    {
        $this->password_confirmation = trim($value ?? '');
        if (empty($this->password) && !empty($this->password_confirmation)) {
            $this->password_confirmation = '';
            $this->resetErrorBag(['password', 'password_confirmation']);
        }
    }

    private function getValidationRules()
    {
        $rules = $this->getCommonValidationRules() ?? [];

        $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->doctor->user_id;
        $rules['phone'] = 'required|string|max:15|unique:users,phone,' . $this->doctor->user_id;
        $rules['image'] = ['nullable', function ($attribute, $value, $fail) {
            if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
                if (!in_array($value->getClientMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
                    $fail('The image must be a valid image file (JPEG, PNG, or GIF).');
                }
                if ($value->getSize() > 10240 * 1024) { // 10MB
                    $fail('The image must not be larger than 10MB.');
                }
            }
        }];
        $rules['registration_number'] = 'nullable|string|max:50|unique:doctors,registration_number,' . $this->doctor->id;
        $rules['professional_bio'] = 'nullable|string|max:2000';
        $rules['achievements_awards'] = 'nullable|string|max:500';
        $rules['languages_spoken'] = 'nullable|string|max:255';
        $rules['qualification'] = 'nullable|string|max:255';
        $rules['status'] = 'required|in:0,1';

        unset($rules['password'], $rules['password_confirmation']);

        $trimmedPassword = trim($this->password ?? '');
        if (!empty($trimmedPassword)) {
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required|same:password';
        }

        if ($this->new_verification_documents && count($this->new_verification_documents) > 0) {
            $rules['new_verification_documents.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }

        return $rules;
    }

    private function processDocuments()
    {
        $documents = $this->verification_documents ?? [];
        
        if ($this->new_verification_documents && is_array($this->new_verification_documents)) {
            $imageKit = new ImageKitService();
            foreach ($this->new_verification_documents as $index => $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
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
                        session()->flash('error', 'Document upload failed: ' . $e->getMessage());
                        throw $e;
                    }
                }
            }
        }

        return $documents;
    }

    private function processSocialMedia()
    {
        if (!$this->social_media_links || !is_array($this->social_media_links)) {
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

    private function processArrayFields(): array
    {
        $qualifications = array_values(array_filter(array_map('trim', explode(',', $this->qualification ?? ''))));
        $languages = array_values(array_filter(array_map('trim', explode(',', $this->languages_spoken ?? ''))));
        $achievements = array_values(array_filter(array_map('trim', explode(',', $this->achievements_awards ?? ''))));

        return [
            'qualifications' => $qualifications ?: null,
            'languages' => $languages ?: null,
            'achievements' => $achievements ?: null,
        ];
    }

    public function removeVerificationDocument(int $index)
    {
        if (isset($this->verification_documents[$index])) {
            array_splice($this->verification_documents, $index, 1);
        }
    }

    public function addSocialMediaLink()
    {
        $this->social_media_links[] = ['platform' => '', 'url' => ''];
    }

    public function removeSocialMediaLink(int $index)
    {
        if (isset($this->social_media_links[$index])) {
            array_splice($this->social_media_links, $index, 1);
        }
    }

    public function updateDoctor()
    {
        $this->password = trim($this->password ?? '');
        $this->password_confirmation = trim($this->password_confirmation ?? '');

        if (empty($this->password)) {
            $this->password_confirmation = '';
        }

        $validationRules = $this->getValidationRules();

        try {
            $this->validate($validationRules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            throw $e;
        }

        try {
            DB::beginTransaction();

            $documents = $this->processDocuments();

            $imageToSave = $this->existingImage; // Default to existing image
            $imageIdToSave = $this->imageId;

            if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
                $imageKit = new ImageKitService();
                try {
                    $response = $imageKit->upload(
                        fopen($this->image->getRealPath(), 'r'),
                        'doctor_' . time() . '.' . $this->image->getClientOriginalExtension(),
                        'doctors'
                    );

                    if (!isset($response->result->url) || !isset($response->result->fileId)) {
                        throw new \Exception('Image upload failed: No URL or fileId returned');
                    }

                    $imageToSave = $response->result->url;
                    $imageIdToSave = $response->result->fileId;

                    Log::info('New image uploaded', [
                        'doctor_id' => $this->doctor->id,
                        'image_url' => $imageToSave,
                        'image_id' => $imageIdToSave,
                    ]);

                    if ($this->imageId) {
                        try {
                            $imageKit->delete($this->imageId);
                            Log::info('Old image deleted', [
                                'doctor_id' => $this->doctor->id,
                                'old_image_id' => $this->imageId,
                            ]);
                        } catch (\Exception $deleteEx) {
                            Log::warning('Failed to delete previous image: ' . $deleteEx->getMessage(), [
                                'doctor_id' => $this->doctor->id,
                                'old_image_id' => $this->imageId,
                            ]);
                        }
                    }
                } catch (\Exception $uploadEx) {
                    Log::error('Image upload failed: ' . $uploadEx->getMessage());
                    throw $uploadEx;
                }
            }

            $arrayFields = $this->processArrayFields();
            
            $socialMedia = $this->processSocialMedia();

            $this->doctor->user->update([
                'name' => ucfirst(trim($this->name)),
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
            ]);

            if (!empty($this->password)) {
                $this->doctor->user->update([
                    'password' => Hash::make($this->password)
                ]);
            }

            $this->doctor->update([
                'department_id' => $this->department_id,
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
                'image' => $imageToSave,
                'image_id' => $imageIdToSave,
                'city' => $this->city,
                'state' => $this->state,
                'pincode' => $this->pincode,
                'clinic_hospital_name' => $this->clinic_hospital_name,
                'registration_number' => $this->registration_number,
                'languages_spoken' => $arrayFields['languages'],
                'professional_bio' => $this->professional_bio,
                'achievements_awards' => $arrayFields['achievements'],
                'verification_documents' => $documents,
                'social_media_links' => $socialMedia,
            ]);

            DB::commit();

            session()->flash('success', 'Doctor updated successfully.');
            return redirect()->route('admin.doctors.list');

        } catch (\Exception $e) {
            DB::rollBack();

            if (isset($imageIdToSave) && $imageIdToSave && $imageIdToSave !== $this->imageId) {
                try {
                    $imageKit = new ImageKitService();
                    $imageKit->delete($imageIdToSave);
                    Log::info('Cleaned up failed image upload', ['image_id' => $imageIdToSave]);
                } catch (\Exception $cleanupError) {
                    Log::error('Failed to cleanup uploaded image: ' . $cleanupError->getMessage());
                }
            }

            Log::error('Error updating doctor: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'doctor_id' => $this->doctorId,
            ]);

            session()->flash('error', 'Error updating doctor: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.update-doctor');
    }
}