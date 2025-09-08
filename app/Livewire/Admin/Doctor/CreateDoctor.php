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
#[Layout('layouts.admin')]
class CreateDoctor extends Component
{
    use WithFileUploads, DoctorFormTrait;

    public $departments;
    public $name;
    public $email;
    public $department_id;
    public $phone;
    public $fee;
    public $status = 1;
    public $qualification;
    public $password;
    public $password_confirmation;
    public $photo;
    public $slot_duration_minutes = 30;
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
    public $isProcessing = false;
    
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

    public function rules()
    {
        return $this->getValidationRules();
    }

    public function mount()
    {
        $this->departments = Department::all();
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'name', 'email', 'department_id', 'phone', 'fee', 'qualification', 
            'password', 'password_confirmation', 'photo', 'imageUrl', 'imageId', 
            'pincode', 'city', 'state', 'gender', 'experience', 'languages_spoken',
            'clinic_hospital_name', 'registration_number', 'professional_bio', 
            'achievements_awards', 'verification_documents', 'social_media_links',
            'working_hours', 'show_hours_modal', 'editing_hours_index',
            'modal_selected_days', 'modal_start_time', 'modal_end_time',
            'modal_patients_per_slot', 'modal_open_24_hours', 'modal_closed',
            'isProcessing',
        ]);

        // Set defaults
        $this->status = 1;
        $this->slot_duration_minutes = 30;
        $this->max_booking_days = 7;
        $this->modal_start_time = '07:00';
        $this->modal_end_time = '19:00';
        $this->modal_patients_per_slot = 1;
        $this->social_media_links = [];
        $this->working_hours = [];
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

    private function getValidationRules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
            'password' => 'required|string|min:6|confirmed',
            'department_id' => 'required|exists:departments,id',
            'working_hours' => 'required|array|min:1',
            'status' => 'required|in:0,1,2',
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
            'professional_bio' => 'nullable|string|max:65535',
            'achievements_awards' => 'nullable|string|max:255',
            'social_media_links.*.platform' => 'nullable|in:twitter,facebook,instagram',
            'social_media_links.*.url' => 'nullable|url|max:255',
            'photo' => 'nullable|image|max:10240',
            'registration_number' => 'nullable|string|max:50|unique:doctors,registration_number,',
        ];
        
        // Allow any type of verification document, size limited
        if ($this->verification_documents && count($this->verification_documents) > 0) {
            foreach ($this->verification_documents as $index => $doc) {
                $rules["verification_documents.{$index}"] = 'nullable|file|max:10240';
            }
        }

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

                if (!isset($response->result->url) || !isset($response->result->fileId)) {
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

            // Convert working hours to the format needed for database storage
            $availableDays = [];
            $daySpecificSchedule = [];
            $generalStartTime = '09:00';
            $generalEndTime = '17:00';
            $generalPatientsPerSlot = 1;
            
            foreach ($this->working_hours as $schedule) {
                foreach ($schedule['days'] as $day) {
                    if (!in_array($day, $availableDays) && (!isset($schedule['closed']) || !$schedule['closed'])) {
                        $availableDays[] = $day;
                    }
                    
                    if (!isset($schedule['closed']) || !$schedule['closed']) {
                        $dayLower = strtolower($day);
                        $daySpecificSchedule[$dayLower] = [
                            'start_time' => $schedule['start_time'],
                            'end_time' => $schedule['end_time'],
                            'patients_per_slot' => $schedule['patients_per_slot'],
                            'is_available' => true,
                        ];
                        
                        // Use first schedule's timing as general timing
                        if (empty($generalStartTime) || $generalStartTime === '09:00') {
                            $generalStartTime = $schedule['start_time'];
                            $generalEndTime = $schedule['end_time'];
                            $generalPatientsPerSlot = $schedule['patients_per_slot'];
                        }
                    }
                }
            }

            // Create doctor
            Doctor::create([
                'user_id' => $user->id,
                'department_id' => $this->department_id,
                'available_days' => $availableDays,
                'fee' => $this->fee,
                'status' => $this->status,
                'image' => $imageUrl,
                'image_id' => $imageId,
                'qualification' => $arrayFields['qualifications'],
                'languages_spoken' => $arrayFields['languages'],
                'clinic_hospital_name' => $this->clinic_hospital_name,
                'registration_number' => $this->registration_number !== null && trim($this->registration_number) !== '' ? $this->registration_number : null,
                'professional_bio' => $this->professional_bio,
                'achievements_awards' => $arrayFields['achievements'],
                'verification_documents' => $documents,
                'social_media_links' => $socialMedia,
                'pincode' => $this->pincode,
                'city' => $this->city,
                'state' => $this->state,
                'experience' => $this->experience,
                'use_day_specific_schedule' => count($daySpecificSchedule) > 0,
                'day_specific_schedule' => $daySpecificSchedule,
                'slug' => Str::slug($this->name),
                'start_time' => $generalStartTime,
                'end_time' => $generalEndTime,
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $generalPatientsPerSlot,
                'max_booking_days' => $this->max_booking_days,
            ]);

            \DB::commit();

            session()->flash('success', 'Doctor created successfully!');
            
            $this->resetForm();

            return redirect()->route('admin.doctors.list');
        } catch (\Exception $e) {
            \DB::rollBack();
            
            // Clean up uploaded files on error
            if (isset($imageId)) { try { $imageKit->delete($imageId); } catch (\Exception $ex) { } }

            // Clean up user if created
            if (isset($user)) { try { $user->delete(); } catch (\Exception $ex) { } }

            \Log::error('Error creating doctor: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            $this->dispatch('error', __('Error creating doctor: ' . $e->getMessage()));
        }
    }

    public function render()
    {
        return view('livewire.admin.doctor.create-doctor');
    }
}