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
    public $slot_duration_minutes = 30;
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
    public $department_id;
    
    // New working hours system
    public $working_hours = [];
    public $show_hours_modal = false;
    public $editing_hours_index = null;
    
    // Modal properties
    public $modal_selected_days = [];
    public $modal_start_time = '07:00';
    public $modal_end_time = '19:00';
    public $modal_patients_per_slot = 1;
    public $modal_open_24_hours = false;
    public $modal_closed = false;
    
    // Legacy properties for compatibility
    public $use_day_specific_schedule = false;
    public $schedule_mode = 'general';
    public $day_specific_schedule = [];
    public $selected_days = [];

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
            $this->experience = $this->doctor->experience;
            $this->qualification = is_array($this->doctor->qualification) 
                ? implode(', ', $this->doctor->qualification) 
                : ($this->doctor->qualification ?? '');
            $this->gender = $this->doctor->user->gender ?? 'male';
            $this->status = $this->doctor->status;
            $this->fee = $this->doctor->fee;
            $this->slot_duration_minutes = $this->doctor->slot_duration_minutes ?? 30;
            $this->max_booking_days = $this->doctor->max_booking_days ?? 7;
            $this->existingImage = $this->doctor->image;
            $this->imageId = $this->doctor->image_id;
            $this->city = $this->doctor->city;
            $this->state = $this->doctor->state;
            $this->pincode = $this->doctor->pincode;
            $this->clinic_hospital_name = $this->doctor->clinic_hospital_name;
            $this->registration_number = $this->doctor->registration_number;
            $this->languages_spoken = is_array($this->doctor->languages_spoken) 
                ? implode(', ', $this->doctor->languages_spoken) 
                : ($this->doctor->languages_spoken ?? '');
            $this->professional_bio = $this->doctor->professional_bio;
            $this->achievements_awards = is_array($this->doctor->achievements_awards) 
                ? implode(', ', $this->doctor->achievements_awards) 
                : ($this->doctor->achievements_awards ?? '');
            $this->department_id = $this->doctor->department_id;
            
            // Load day-specific scheduling data
            $this->use_day_specific_schedule = $this->doctor->use_day_specific_schedule ?? false;
            $this->schedule_mode = $this->use_day_specific_schedule ? 'day_specific' : 'general';
            
            // Initialize day-specific scheduling
            if ($this->doctor->use_day_specific_schedule && $this->doctor->day_specific_schedule) {
                $this->use_day_specific_schedule = true;
                $this->day_specific_schedule = $this->doctor->day_specific_schedule;
                
                // Initialize selected_days from available_days or day_specific_schedule
                if ($this->doctor->available_days) {
                    $this->selected_days = $this->doctor->available_days;
                } else {
                    // Extract available days from day_specific_schedule
                    $this->selected_days = [];
                    foreach ($this->doctor->day_specific_schedule as $day => $schedule) {
                        if ($schedule['is_available'] ?? false) {
                            $this->selected_days[] = ucfirst($day);
                        }
                    }
                }
                
                // Determine timing mode - check if all selected days have the same timing
                $this->timing_mode = $this->detectTimingMode();
                
                if ($this->timing_mode === 'same' && !empty($this->selected_days)) {
                    $firstDay = strtolower($this->selected_days[0]);
                    $firstDaySchedule = $this->day_specific_schedule[$firstDay] ?? [];
                    $this->same_timing_start = $firstDaySchedule['start_time'] ?? '09:00';
                    $this->same_timing_end = $firstDaySchedule['end_time'] ?? '17:00';
                    $this->same_timing_patients = $firstDaySchedule['patients_per_slot'] ?? 1;
                }
            } else {
                $this->day_specific_schedule = $this->initializeDaySpecificSchedule();
                $this->selected_days = $this->doctor->available_days ?? [];
                $this->use_day_specific_schedule = false;
            }

            // Load social media and verification documents
            if ($this->doctor->social_media_links && is_array($this->doctor->social_media_links)) {
                $this->social_media_links = [];
                foreach ($this->doctor->social_media_links as $platform => $url) {
                    $this->social_media_links[] = ['platform' => $platform, 'url' => $url];
                }
            } else {
                $this->social_media_links = [['platform' => '', 'url' => '']];
            }

            if ($this->doctor->verification_documents && is_array($this->doctor->verification_documents)) {
                $this->verification_documents = $this->doctor->verification_documents;
            }

            // Convert existing schedule to new working hours format
            $this->convertToWorkingHours();

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

    private function convertToWorkingHours()
    {
        $this->working_hours = [];
        
        if ($this->doctor->use_day_specific_schedule && $this->doctor->day_specific_schedule) {
            // Group days with same schedule
            $scheduleGroups = [];
            
            foreach ($this->doctor->day_specific_schedule as $dayName => $schedule) {
                if (!isset($schedule['is_available']) || !$schedule['is_available']) {
                    continue;
                }
                
                $key = ($schedule['start_time'] ?? '09:00') . '-' . ($schedule['end_time'] ?? '17:00') . '-' . ($schedule['patients_per_slot'] ?? 1);
                
                if (!isset($scheduleGroups[$key])) {
                    $scheduleGroups[$key] = [
                        'days' => [],
                        'start_time' => $schedule['start_time'] ?? '09:00',
                        'end_time' => $schedule['end_time'] ?? '17:00',
                        'patients_per_slot' => $schedule['patients_per_slot'] ?? 1,
                        'open_24_hours' => false,
                        'closed' => false,
                    ];
                }
                
                $scheduleGroups[$key]['days'][] = ucfirst($dayName);
            }
            
            $this->working_hours = array_values($scheduleGroups);
        } else if ($this->doctor->available_days) {
            // Convert simple available_days to working hours
            $this->working_hours = [
                [
                    'days' => $this->doctor->available_days,
                    'start_time' => $this->doctor->start_time ? Carbon::parse($this->doctor->start_time)->format('H:i') : '09:00',
                    'end_time' => $this->doctor->end_time ? Carbon::parse($this->doctor->end_time)->format('H:i') : '17:00',
                    'patients_per_slot' => $this->doctor->patients_per_slot ?? 1,
                    'open_24_hours' => false,
                    'closed' => false,
                ]
            ];
        }
    }

    public function updatedImage()
    {
        if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
            try {
                // Validate file size before generating preview
                $this->validate([
                    'image' => 'max:10240', // 10MB max
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
        // Use custom validation rules instead of trait to avoid conflicts
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->doctor->user_id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $this->doctor->user_id,
            'department_id' => 'required|exists:departments,id',
            'working_hours' => 'required|array|min:1',
            'status' => 'required|in:0,1',
            'fee' => 'required|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|integer|min:0|max:50',
            'languages_spoken' => 'nullable|string|max:255',
            'clinic_hospital_name' => 'nullable|string|max:100',
            'professional_bio' => 'nullable|string|max:2000',
            'achievements_awards' => 'nullable|string|max:255',
            'social_media_links.*.platform' => 'nullable|in:twitter,facebook,instagram',
            'social_media_links.*.url' => 'nullable|url|max:255',
            'registration_number' => 'nullable|string|max:50|unique:doctors,registration_number,' . $this->doctor->id,
        ];

        $rules['image'] = ['nullable', function ($attribute, $value, $fail) {
            if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
                if ($value->getSize() > 10240 * 1024) { // 10MB
                    $fail('The image must not be larger than 10MB.');
                }
            }
        }];

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
                    // Log before upload attempt
                    Log::info('Attempting to upload image', [
                        'original_name' => $this->image->getClientOriginalName(),
                        'mime_type' => $this->image->getMimeType(),
                        'size' => $this->image->getSize()
                    ]);

                    $response = $imageKit->upload(
                        fopen($this->image->getRealPath(), 'r'),
                        'doctor_' . time() . '_' . Str::random(8) . '.' . $this->image->getClientOriginalExtension(),
                        'doctors'
                    );

                    // Log the response
                    Log::info('ImageKit upload response', [
                        'response' => $response
                    ]);

                    if (!isset($response->result->url) || !isset($response->result->fileId)) {
                        Log::error('ImageKit upload failed - missing URL or fileId', [
                            'response' => $response
                        ]);
                        throw new \Exception('Image upload failed: Response missing required data');
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

            // Convert working hours to database format
            $convertedSchedule = $this->convertWorkingHoursToDatabase();

            // Log the update process for debugging
            Log::info('UpdateDoctor: Starting update process', [
                'doctor_id' => $this->doctor->id,
                'original_use_day_specific_schedule' => $this->doctor->use_day_specific_schedule,
                'original_day_specific_schedule' => $this->doctor->day_specific_schedule ? 'NOT NULL' : 'NULL',
                'new_use_day_specific_schedule' => $convertedSchedule['use_day_specific_schedule'],
                'current_working_hours' => $this->working_hours,
                'converted_schedule' => $convertedSchedule
            ]);

            // Update the doctor record
            $doctorUpdateData = [
                'department_id' => $this->department_id,
                'experience' => $this->experience,
                'qualification' => $arrayFields['qualifications'],
                'status' => $this->status,
                'fee' => $this->fee,
                'start_time' => $convertedSchedule['start_time'],
                'end_time' => $convertedSchedule['end_time'],
                'available_days' => $convertedSchedule['available_days'],
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $convertedSchedule['patients_per_slot'],
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
                'use_day_specific_schedule' => $convertedSchedule['use_day_specific_schedule'],
                'day_specific_schedule' => $convertedSchedule['day_specific_schedule'],
            ];

            Log::info('UpdateDoctor: About to update with data', [
                'doctor_id' => $this->doctor->id,
                'update_data_schedule_related' => [
                    'start_time' => $doctorUpdateData['start_time'],
                    'end_time' => $doctorUpdateData['end_time'],
                    'available_days' => $doctorUpdateData['available_days'],
                    'patients_per_slot' => $doctorUpdateData['patients_per_slot'],
                    'use_day_specific_schedule' => $doctorUpdateData['use_day_specific_schedule'],
                    'day_specific_schedule' => $doctorUpdateData['day_specific_schedule'],
                ]
            ]);

            $this->doctor->update($doctorUpdateData);

            Log::info('UpdateDoctor: Successfully updated doctor', [
                'doctor_id' => $this->doctor->id,
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

    /**
     * Switch between general and day-specific scheduling
     */
    public function updatedScheduleMode($value)
    {
        if ($value === 'day_specific') {
            $this->use_day_specific_schedule = true;
            if (empty($this->day_specific_schedule)) {
                $this->day_specific_schedule = $this->initializeDaySpecificSchedule();
            }
        } else {
            $this->use_day_specific_schedule = false;
        }
    }

    /**
     * Handle timing mode changes
     */
    public function updatedTimingMode($value)
    {
        if ($value === 'same') {
            // Apply same timing to all selected days
            $this->applySameTiming();
        } else {
            // Initialize individual day schedule for selected days
            $this->initializeSelectedDaysSchedule();
        }
    }

    /**
     * Update when selected days change
     */
    public function updatedSelectedDays($value)
    {
        $this->use_day_specific_schedule = count($this->selected_days) > 0;
        
        if ($this->timing_mode === 'same') {
            $this->applySameTiming();
        } else {
            $this->initializeSelectedDaysSchedule();
        }
    }

    /**
     * Apply same timing to all selected days
     */
    public function applySameTiming()
    {
        if (!empty($this->selected_days)) {
            foreach ($this->selected_days as $day) {
                $dayLower = strtolower($day);
                $this->day_specific_schedule[$dayLower] = [
                    'start_time' => $this->same_timing_start,
                    'end_time' => $this->same_timing_end,
                    'patients_per_slot' => $this->same_timing_patients,
                    'is_available' => true
                ];
            }
        }
    }

    /**
     * Initialize schedule for selected days with default values
     */
    public function initializeSelectedDaysSchedule()
    {
        if (!empty($this->selected_days)) {
            foreach ($this->selected_days as $day) {
                $dayLower = strtolower($day);
                if (!isset($this->day_specific_schedule[$dayLower])) {
                    $this->day_specific_schedule[$dayLower] = [
                        'start_time' => '09:00',
                        'end_time' => '17:00',
                        'patients_per_slot' => 1,
                        'is_available' => true
                    ];
                }
            }
        }
    }

    /**
     * Update same timing fields and apply to all selected days
     */
    public function updatedSameTimingStart($value)
    {
        if ($this->timing_mode === 'same') {
            $this->applySameTiming();
        }
    }

    public function updatedSameTimingEnd($value)
    {
        if ($this->timing_mode === 'same') {
            $this->applySameTiming();
        }
    }

    public function updatedSameTimingPatients($value)
    {
        if ($this->timing_mode === 'same') {
            $this->applySameTiming();
        }
    }

    /**
     * Detect if all selected days have the same timing
     */
    private function detectTimingMode()
    {
        if (empty($this->selected_days) || count($this->selected_days) <= 1) {
            return 'same';
        }
        
        $firstDay = strtolower($this->selected_days[0]);
        $firstSchedule = $this->day_specific_schedule[$firstDay] ?? [];
        $referenceStart = $firstSchedule['start_time'] ?? null;
        $referenceEnd = $firstSchedule['end_time'] ?? null;
        $referencePatients = $firstSchedule['patients_per_slot'] ?? null;
        
        foreach ($this->selected_days as $day) {
            $dayLower = strtolower($day);
            $schedule = $this->day_specific_schedule[$dayLower] ?? [];
            
            if (($schedule['start_time'] ?? null) !== $referenceStart ||
                ($schedule['end_time'] ?? null) !== $referenceEnd ||
                ($schedule['patients_per_slot'] ?? null) !== $referencePatients) {
                return 'different';
            }
        }
        
        return 'same';
    }

    /**
     * Apply bulk schedule changes
     */
    public function applyBulkScheduleChanges()
    {
        $scheduleData = [
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'patients_per_slot' => $this->patients_per_slot,
        ];

        $this->applyBulkSchedule($this->bulk_schedule_type, $scheduleData);
        
        session()->flash('message', 'Bulk schedule changes applied successfully!');
    }

    /**
     * Set schedule for all days with default values
     */
    public function setAllDaysSchedule()
    {
        $scheduleData = [
            'start_time' => $this->start_time ?: '09:00',
            'end_time' => $this->end_time ?: '17:00',
            'patients_per_slot' => $this->patients_per_slot ?: 1,
            'is_available' => true
        ];

        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day) {
            $this->day_specific_schedule[$day] = $scheduleData;
        }
        
        $this->dispatch('success', __('Applied schedule to all days'));
    }

    /**
     * Set schedule for Monday to Saturday with default values
     */
    public function setMonToSatSchedule()
    {
        $scheduleData = [
            'start_time' => $this->start_time ?: '09:00',
            'end_time' => $this->end_time ?: '17:00',
            'patients_per_slot' => $this->patients_per_slot ?: 1,
            'is_available' => true
        ];

        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'] as $day) {
            $this->day_specific_schedule[$day] = $scheduleData;
        }
        
        $this->dispatch('success', __('Applied schedule to Monday-Saturday'));
    }

    /**
     * Set special schedule for Sunday
     */
    public function setSundaySchedule()
    {
        $this->day_specific_schedule['sunday'] = [
            'start_time' => '12:00',
            'end_time' => '18:00',
            'patients_per_slot' => 2,
            'is_available' => true
        ];
        
        $this->dispatch('success', __('Applied Sunday schedule'));
    }

    /**
     * Update individual day schedule
     */
    public function updateDaySchedule($day, $field, $value)
    {
        if (!isset($this->day_specific_schedule[$day])) {
            $this->day_specific_schedule[$day] = [
                'start_time' => '09:00',
                'end_time' => '17:00',
                'patients_per_slot' => 1,
                'is_available' => false
            ];
        }

        $this->day_specific_schedule[$day][$field] = $value;
    }

    // Working hours modal methods
    public function openAddHoursModal()
    {
        $this->resetModalProperties();
        $this->show_hours_modal = true;
    }

    public function editWorkingHours($index)
    {
        if (isset($this->working_hours[$index])) {
            $schedule = $this->working_hours[$index];
            $this->editing_hours_index = $index;
            $this->modal_selected_days = $schedule['days'];
            $this->modal_start_time = $schedule['start_time'] ?? '07:00';
            $this->modal_end_time = $schedule['end_time'] ?? '19:00';
            $this->modal_patients_per_slot = $schedule['patients_per_slot'] ?? 1;
            $this->modal_open_24_hours = $schedule['open_24_hours'] ?? false;
            $this->modal_closed = $schedule['closed'] ?? false;
            $this->show_hours_modal = true;
        }
    }

    public function removeWorkingHours($index)
    {
        if (isset($this->working_hours[$index])) {
            array_splice($this->working_hours, $index, 1);
        }
    }

    public function closeHoursModal()
    {
        $this->show_hours_modal = false;
        $this->resetModalProperties();
    }

    private function resetModalProperties()
    {
        $this->editing_hours_index = null;
        $this->modal_selected_days = [];
        $this->modal_start_time = '07:00';
        $this->modal_end_time = '19:00';
        $this->modal_patients_per_slot = 1;
        $this->modal_open_24_hours = false;
        $this->modal_closed = false;
    }

    public function toggleModalDay($day)
    {
        if (in_array($day, $this->modal_selected_days)) {
            $this->modal_selected_days = array_values(array_diff($this->modal_selected_days, [$day]));
        } else {
            $this->modal_selected_days[] = $day;
        }
    }

    public function updatedModalClosed($value)
    {
        if ($value) {
            $this->modal_open_24_hours = false;
        }
    }

    public function updatedModalOpen24Hours($value)
    {
        if ($value) {
            $this->modal_closed = false;
            $this->modal_start_time = '00:00';
            $this->modal_end_time = '23:59';
        }
    }

    public function saveWorkingHours()
    {
        $this->validate([
            'modal_selected_days' => 'required|array|min:1',
            'modal_start_time' => 'required_unless:modal_closed,true|date_format:H:i',
            'modal_end_time' => 'required_unless:modal_closed,true|date_format:H:i|after:modal_start_time',
            'modal_patients_per_slot' => 'required_unless:modal_closed,true|integer|min:1|max:10',
        ]);

        // Check for conflicting days (except when editing existing schedule)
        if ($this->editing_hours_index === null) {
            $existingDays = [];
            foreach ($this->working_hours as $existingSchedule) {
                $existingDays = array_merge($existingDays, $existingSchedule['days'] ?? []);
            }
            
            $conflictingDays = array_intersect($this->modal_selected_days, $existingDays);
            if (!empty($conflictingDays)) {
                $this->addError('modal_selected_days', 'The following days already have working hours set: ' . implode(', ', $conflictingDays));
                return;
            }
        } else {
            // When editing, check conflicts with other schedules (not the one being edited)
            $existingDays = [];
            foreach ($this->working_hours as $index => $existingSchedule) {
                if ($index !== $this->editing_hours_index) {
                    $existingDays = array_merge($existingDays, $existingSchedule['days'] ?? []);
                }
            }
            
            $conflictingDays = array_intersect($this->modal_selected_days, $existingDays);
            if (!empty($conflictingDays)) {
                $this->addError('modal_selected_days', 'The following days already have working hours set: ' . implode(', ', $conflictingDays));
                return;
            }
        }

        $schedule = [
            'days' => $this->modal_selected_days,
            'start_time' => $this->modal_start_time,
            'end_time' => $this->modal_end_time,
            'patients_per_slot' => $this->modal_patients_per_slot,
            'open_24_hours' => $this->modal_open_24_hours,
            'closed' => $this->modal_closed,
        ];

        if ($this->editing_hours_index !== null) {
            $this->working_hours[$this->editing_hours_index] = $schedule;
        } else {
            $this->working_hours[] = $schedule;
        }

        $this->closeHoursModal();
        session()->flash('success', 'Working hours saved successfully!');
    }

    private function convertWorkingHoursToDatabase()
    {
        if (empty($this->working_hours)) {
            return [
                'start_time' => '09:00',
                'end_time' => '17:00',
                'available_days' => [],
                'patients_per_slot' => 1,
                'use_day_specific_schedule' => false,
                'day_specific_schedule' => null,
            ];
        }

        $allDays = [];
        $daySpecificSchedule = [];
        $generalStartTime = '09:00';
        $generalEndTime = '17:00';
        $generalPatientsPerSlot = 1;

        // Initialize all days as not available first
        $allPossibleDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        foreach ($allPossibleDays as $day) {
            $daySpecificSchedule[$day] = [
                'is_available' => false,
                'start_time' => null,
                'end_time' => null,
                'patients_per_slot' => 1,
            ];
        }

        // Check if we need day-specific scheduling
        // We need it if:
        // 1. There are multiple working hour entries with different schedules, OR
        // 2. There are days with different start/end times or patients per slot, OR
        // 3. Some days are closed while others are open, OR 
        // 4. The doctor previously had day-specific scheduling enabled
        $needsDaySpecificScheduling = false;
        
        // If doctor previously had day-specific scheduling, maintain it unless explicitly disabled
        if ($this->doctor->use_day_specific_schedule) {
            $needsDaySpecificScheduling = true;
        }
        
        // Check for multiple different schedules
        if (count($this->working_hours) > 1) {
            $needsDaySpecificScheduling = true;
        }
        
        // Check for closed days or 24-hour days
        foreach ($this->working_hours as $schedule) {
            if ((isset($schedule['closed']) && $schedule['closed']) || 
                (isset($schedule['open_24_hours']) && $schedule['open_24_hours'])) {
                $needsDaySpecificScheduling = true;
                break;
            }
        }

        // Process working hours and update day-specific schedule
        foreach ($this->working_hours as $schedule) {
            foreach ($schedule['days'] as $day) {
                $dayLower = strtolower($day);
                
                if (isset($schedule['closed']) && $schedule['closed']) {
                    $daySpecificSchedule[$dayLower] = [
                        'is_available' => false,
                        'start_time' => null,
                        'end_time' => null,
                        'patients_per_slot' => 1,
                    ];
                } else {
                    $allDays[] = $day; // Only add to available days if not closed
                    $startTime = (isset($schedule['open_24_hours']) && $schedule['open_24_hours']) ? '00:00' : $schedule['start_time'];
                    $endTime = (isset($schedule['open_24_hours']) && $schedule['open_24_hours']) ? '23:59' : $schedule['end_time'];
                    
                    $daySpecificSchedule[$dayLower] = [
                        'is_available' => true,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                        'patients_per_slot' => $schedule['patients_per_slot'],
                    ];

                    // Use first non-closed schedule for general settings
                    if ($generalStartTime === '09:00' && $generalEndTime === '17:00') {
                        $generalStartTime = $startTime;
                        $generalEndTime = $endTime;
                        $generalPatientsPerSlot = $schedule['patients_per_slot'];
                    }
                }
            }
        }

        return [
            'start_time' => $generalStartTime,
            'end_time' => $generalEndTime,
            'available_days' => array_unique($allDays),
            'patients_per_slot' => $generalPatientsPerSlot,
            'use_day_specific_schedule' => $needsDaySpecificScheduling,
            'day_specific_schedule' => $needsDaySpecificScheduling ? $daySpecificSchedule : null,
        ];
    }
}