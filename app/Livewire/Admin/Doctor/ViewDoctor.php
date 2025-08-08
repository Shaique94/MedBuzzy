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

            // Load doctor with all necessary relationships
            $this->doctor = Doctor::with([
                'user',
                'department',
                'appointments' => function($query) {
                    $query->with(['patient' => function($q) {
                        $q->select('id', 'name');
                    }])
                    ->select('id', 'doctor_id', 'patient_id', 'appointment_date', 'appointment_time', 'status', 'created_at')
                    ->latest()
                    ->take(5);
                },
                'reviews' => function($query) {
                    $query->where('approved', true)
                          ->select('id', 'doctor_id', 'rating', 'comment', 'created_at')
                          ->latest()
                          ->take(5);
                }
            ])->findOrFail($doctorId);
            
            // Validate that the doctor has required relationships
            if (!$this->doctor) {
                throw new \Exception('Doctor not found');
            }
            
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

            // Calculate additional statistics
            $this->calculateDoctorStats();
            
            $this->showModal = true;
            
            \Log::info('Doctor details loaded successfully', [
                'doctor_id' => $doctorId,
                'doctor_name' => $this->doctor->user->name
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \Log::warning('Doctor not found', ['doctor_id' => $doctorId]);
            session()->flash('error', 'Doctor not found.');
            $this->showModal = false;
            $this->doctor = null;
        } catch (\Exception $e) {
            \Log::error('Error loading doctor details: ' . $e->getMessage(), [
                'doctor_id' => $doctorId,
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'An error occurred while loading doctor details. Please try again.');
            $this->showModal = false;
            $this->doctor = null;
        }
    }

    private function calculateDoctorStats()
    {
        if (!$this->doctor) {
            return;
        }

        try {
            // Calculate total appointments count
            $this->doctor->total_appointments = $this->doctor->appointments()->count();

            // Calculate average rating from approved reviews
            $this->doctor->average_rating = $this->doctor->reviews()
                ->where('approved', true)
                ->avg('rating') ?? 0;

            // Calculate total approved reviews count
            $this->doctor->total_reviews = $this->doctor->reviews()
                ->where('approved', true)
                ->count();

            // Get recent appointments with patient names
            $this->doctor->recent_appointments = $this->doctor->appointments()
                ->with(['patient:id,name'])
                ->latest()
                ->take(3)
                ->get()
                ->map(function($appointment) {
                    return [
                        'patient_name' => $appointment->patient->name ?? 'Unknown Patient',
                        'appointment_date' => $appointment->appointment_date,
                        'appointment_time' => $appointment->appointment_time,
                        'status' => $appointment->status
                    ];
                });

            // Set attributes for backward compatibility
            $this->doctor->setAttribute('rating', $this->doctor->average_rating);
            $this->doctor->setAttribute('review_count', $this->doctor->total_reviews);

        } catch (\Exception $e) {
            \Log::warning('Error calculating doctor stats: ' . $e->getMessage(), [
                'doctor_id' => $this->doctor->id
            ]);
            
            // Set default values on error
            $this->doctor->total_appointments = 0;
            $this->doctor->average_rating = 0;
            $this->doctor->total_reviews = 0;
            $this->doctor->recent_appointments = collect();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->doctor = null;
    }

    public function getDoctorProperty()
    {
        return $this->doctor;
    }

    public function render()
    {
        return view('livewire.admin.doctor.view-doctor');
    }
}
