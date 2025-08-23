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
            
            // Load doctor data into form fields
            $this->name = $this->doctor->user->name;
            $this->email = $this->doctor->user->email;
            $this->phone = $this->doctor->user->phone;
            $this->gender = $this->doctor->user->gender;
            $this->department_id = $this->doctor->department_id;
            $this->experience = $this->doctor->experience ?? 0;
            $this->qualification = is_array($this->doctor->qualification) 
                ? implode(', ', $this->doctor->qualification) 
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
            $this->imageUrl = $this->doctor->image_url;
            $this->imageId = $this->doctor->image_id;
            $this->city = $this->doctor->city;
            $this->state = $this->doctor->state;
            $this->pincode = $this->doctor->pincode;
            $this->clinic_hospital_name = $this->doctor->clinic_hospital_name;
            $this->registration_number = $this->doctor->registration_number;
            $this->languages_spoken = is_array($this->doctor->languages_spoken) 
                ? implode(', ', $this->doctor->languages_spoken) 
                : $this->doctor->languages_spoken ?? '';
            $this->professional_bio = $this->doctor->professional_bio;
            $this->achievements_awards = is_array($this->doctor->achievements_awards) 
                ? implode(', ', $this->doctor->achievements_awards) 
                : $this->doctor->achievements_awards ?? '';
            $this->verification_documents = is_array($this->doctor->verification_documents) 
                ? $this->doctor->verification_documents 
                : [];
            $this->social_media_links = is_array($this->doctor->social_media_links) && !empty($this->doctor->social_media_links)
                ? array_map(function($platform, $url) {
                    return ['platform' => $platform, 'url' => $url];
                }, array_keys($this->doctor->social_media_links), array_values($this->doctor->social_media_links))
                : [['platform' => '', 'url' => '']];

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

    private function processSocialMedia()
    {
        // Prefer structured social_media array (twitter/facebook/instagram)
        if (is_array($this->social_media)) {
            $socialMedia = [];
            foreach (['twitter', 'facebook', 'instagram'] as $platform) {
                $url = trim($this->social_media[$platform] ?? '');
                if (!empty($url)) {
                    $socialMedia[$platform] = $url;
                }
            }
            return empty($socialMedia) ? null : $socialMedia;
        }

        // Fallback to previous format
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

    // Convert comma-separated inputs into arrays for storage
    private function processArrayFields(): array
    {
        $qualifications = array_values(array_filter(array_map('trim', explode(',', $this->qualification ?? ''))));
        $languages = array_values(array_filter(array_map('trim', explode(',', $this->languages_spoken ?? ''))));
        $achievements = array_values(array_filter(array_map('trim', explode(',', $this->achievements_awards ?? ''))));

        return [
            'qualifications' => $qualifications,
            'languages' => $languages,
            'achievements' => $achievements,
        ];
    }
    // Remove a verification document locally (will be excluded when saving)
    public function removeVerificationDocument(int $index)
    {
        if (isset($this->verification_documents[$index])) {
            array_splice($this->verification_documents, $index, 1);
        }
    }

    // Social media link helpers for the UI
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
        // Debug: Log password field values
        Log::info('Password fields before processing', [
            'password_length' => strlen($this->password ?? ''),
            'confirmation_length' => strlen($this->password_confirmation ?? '')
        ]);
        
        // Trim password fields to handle whitespace properly
        $this->password = trim($this->password ?? '');
        $this->password_confirmation = trim($this->password_confirmation ?? '');
        
        // Clear password confirmation if password is empty to avoid validation issues
        if (empty($this->password)) {
            $this->password_confirmation = '';
        }
        
        Log::info('Password fields after processing', [
            'password_length' => strlen($this->password ?? ''),
            'confirmation_length' => strlen($this->password_confirmation ?? ''),
            'will_validate_password' => !empty($this->password) && strlen($this->password) > 0
        ]);
        
        // Build validation rules dynamically
        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->doctor->user_id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $this->doctor->user_id,
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|integer|min:0|max:50',
            'department_id' => 'required|exists:departments,id',
            'fee' => 'required|numeric|min:0',
            'status' => 'required|in:0,1,2',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'available_days' => 'required|array|min:1',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'registration_number' => 'nullable|string|max:50|unique:doctors,registration_number,' . $this->doctor->id,
            'image' => 'nullable|image|max:10240',
        ];
        
        // Only add password validation if user actually wants to change password
        // Use trimmed value and guard against common browser autofill placeholder characters
        $trimmedPassword = trim($this->password ?? '');
        $autofillPatterns = ['••••••••', '********', '•••••', 'password'];
        if ($trimmedPassword !== '' && !in_array($trimmedPassword, $autofillPatterns) && str_repeat('•', strlen($trimmedPassword)) !== $trimmedPassword) {
            $validationRules['password'] = 'required|min:8';
            $validationRules['password_confirmation'] = 'required|same:password';
        } else {
            // Clear password fields to prevent any validation issues when no real password was provided
            $this->password = '';
            $this->password_confirmation = '';
        }
        
        // Add document validation if files are uploaded
        if ($this->new_verification_documents && count($this->new_verification_documents) > 0) {
            $validationRules['new_verification_documents.*'] = 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';
        }
        
        // Validate with dynamic rules
        $this->validate($validationRules);

        try {
            DB::beginTransaction();

            // Handle deletion of documents marked for removal BEFORE processing uploads
            // processDocuments will perform the deletions and return updated array
            $documents = $this->processDocuments();

            // Preserve current image values
            $currentImageUrl = $this->imageUrl;
            $currentImageId = $this->imageId;

            // Variables to hold newly uploaded image info (if any)
            $newImageUrl = null;
            $newImageId = null;

            if ($this->image) {
                // Upload new image first. Only if upload succeeds will we remove old image.
                $imageKit = new ImageKitService();
                $response = $imageKit->upload(
                    fopen($this->image->getRealPath(), 'r'),
                    'doctor_' . time() . '.' . $this->image->getClientOriginalExtension(),
                    'doctors'
                );

                if (!isset($response->result->url) || !isset($response->result->fileId)) {
                    throw new \Exception('Image upload failed');
                }

                $newImageUrl = $response->result->url;
                $newImageId = $response->result->fileId;

                // Attempt to delete old image (best-effort). If deletion fails, log and continue.
                if ($currentImageId) {
                    try {
                        $imageKit->delete($currentImageId);
                    } catch (\Exception $deleteEx) {
                        Log::warning('Failed to delete previous image after successful upload: ' . $deleteEx->getMessage(), [
                            'doctor_id' => $this->doctor->id,
                            'old_image_id' => $currentImageId
                        ]);
                        // do not throw — old image failing to delete shouldn't block the update
                    }
                }

                // Set image values to new ones
                $imageUrl = $newImageUrl;
                $imageId = $newImageId;
            } else {
                // No new image uploaded — keep existing values
                $imageUrl = $currentImageUrl;
                $imageId = $currentImageId;
            }

            // Process array fields
            $arrayFields = $this->processArrayFields();
            
            // Process social media
            $socialMedia = $this->processSocialMedia();

            // Update user
            $this->doctor->user->update([
                'name' => ucfirst(trim($this->name)),
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
            ]);

            // Update password if provided
            if (!empty($this->password)) {
                $this->doctor->user->update([
                    'password' => Hash::make($this->password)
                ]);
            }

            // Update doctor
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
                'image' => $imageUrl,
                'image_id' => $imageId,
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

            
            return redirect()->route('admin.doctors.list');

        } catch (\Exception $e) {
            DB::rollBack();

            // If a new image was uploaded but the transaction failed, attempt to delete the newly uploaded image (cleanup)
            if (isset($newImageId) && $newImageId && $newImageId !== ($this->imageId ?? null)) {
                try {
                    $imageKit = new ImageKitService();
                    $imageKit->delete($newImageId);
                } catch (\Exception $cleanupError) {
                    Log::error('Failed to cleanup uploaded image: ' . $cleanupError->getMessage());
                }
            }

            Log::error('Error updating doctor: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.update-doctor');
    }
}