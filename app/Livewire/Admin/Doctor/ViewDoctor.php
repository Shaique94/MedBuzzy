<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Doctor Details')]
class ViewDoctor extends Component
{
    public $doctor;
    public $showModal = false;

    protected $listeners = ['openViewModal' => 'openModal'];

    public function mount()
    {
        $this->doctor = null;
        $this->showModal = false;
    }

    public function openModal($doctorId)
    {
        try {
            // Validate doctor ID
            if (empty($doctorId) || !is_numeric($doctorId)) {
                throw new \Exception('Invalid doctor ID provided');
            }

            // Load doctor with necessary relationships, counts and averages in a single optimized query
            $this->doctor = Doctor::with([
                'user:id,name,email,phone,gender',
                'department:id,name',
                'appointments' => function ($query) {
                    $query->with(['patient' => function ($q) { $q->select('id', 'name'); }])
                          ->select('id', 'doctor_id', 'patient_id', 'appointment_date', 'appointment_time', 'status', 'created_at')
                          ->latest()
                          ->take(5);
                },
                'reviews' => function ($query) {
                    $query->where('approved', true)
                          ->select('id', 'doctor_id', 'rating', 'comment', 'created_at')
                          ->latest()
                          ->take(5);
                }
            ])
            ->withCount(['appointments', 'reviews as approved_reviews_count' => function ($q) { $q->where('approved', true); }])
            ->withAvg(['reviews as average_rating' => function ($q) { $q->where('approved', true); }], 'rating')
            ->select([
                'id',
                'user_id',
                'department_id',
                'status',
                'fee',
                'experience',
                'qualification',
                'created_at',
                'start_time',
                'end_time',
                'available_days',
                'slot_duration_minutes',
                'patients_per_slot',
                'max_booking_days',
                'unavailable_from',
                'unavailable_to',
                'image',
                'city',
                'state',
                'pincode',
                'verification_documents',
                'registration_number',
                'clinic_hospital_name',
                'languages_spoken',
                'achievements_awards',
                'professional_bio',
                'social_media_links',
                
                'use_day_specific_schedule',
                'day_specific_schedule'            ])
            ->findOrFail($doctorId);

            // Validate required relationships
            if (!$this->doctor->user) {
                throw new \Exception('Doctor user data not found');
            }

            if (!$this->doctor->department) {
                throw new \Exception('Doctor department data not found');
            }

            // Process available days to capitalize properly
            if ($this->doctor->available_days && is_array($this->doctor->available_days)) {
                $this->doctor->available_days = array_map('ucfirst', $this->doctor->available_days);
            }

            $this->doctor->total_appointments = $this->doctor->appointments_count ?? $this->doctor->appointments()->count();
            $this->doctor->average_rating = $this->doctor->average_rating ? round($this->doctor->average_rating, 1) : 0;
            $this->doctor->total_reviews = $this->doctor->approved_reviews_count ?? ($this->doctor->reviews()->where('approved', true)->count());

            $this->showModal = true;

            \Log::info('Doctor details loaded successfully', [
                'doctor_id' => $doctorId,
                'doctor_name' => $this->doctor->user->name,
                'has_verification_documents' => !empty($this->doctor->verification_documents)
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::warning('Doctor not found', ['doctor_id' => $doctorId]);
            $this->dispatch('error', __('Doctor not found.'));
            $this->showModal = false;
            $this->doctor = null;
        } catch (\Exception $e) {
            \Log::error('Error loading doctor details: ' . $e->getMessage(), [
                'doctor_id' => $doctorId,
                'trace' => $e->getTraceAsString()
            ]);
            $this->dispatch('error', __('An error occurred while loading doctor details. Please try again.'));
            $this->showModal = false;
            $this->doctor = null;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->doctor = null;
        \Log::info('Doctor details modal closed');
    }

    public function getDoctorProperty()
    {
        return $this->doctor;
    }

    public function render()
    {
        return view('livewire.admin.doctor.view-doctor', [
            'doctor' => $this->doctor
        ]);
    }
}