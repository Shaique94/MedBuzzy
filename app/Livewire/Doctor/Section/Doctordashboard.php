<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Cache; 
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Doctor Dashboard')]
class Doctordashboard extends Component
{ 
    public $appointments;
    public $appointments_count;
    public $patient_count;
    public $appointments_completed;
    public $appointments_upcoming;
    public $doctor_name;
    public $search = '';
    public $fromDate;
    public $toDate;
    public $filtersApplied = false;
    public $showPatientModal = false;
    public $selectedPatient = null;
    
    protected $doctorId;

    #[Layout('layouts.doctor')]
    public function mount()
    {
        $this->filtersApplied = false;
        
        // Get the doctor ID with proper caching (1 hour)
        $user = auth()->user();
        $this->doctorId = Cache::remember('doctor_id_' . $user->id, 3600, function () use ($user) {
            return Doctor::where('user_id', $user->id)->value('id');
        });
        
        $this->doctor_name = $user->name;
        
        $this->loadAppointmentsAndCounts();
    }

    public function loadAppointmentsAndCounts()
    {
        $filtersUsed = false;

        // Base query for appointments - only select needed fields
        $query = Appointment::with(['patient:id,name']) // Only load patient id and name
            ->where('doctor_id', $this->doctorId)
            ->whereIn('status', ['scheduled', 'pending']) // Only show upcoming appointments
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc');

        // Apply filters if any
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->whereHas('patient', function ($q2) {
                    $q2->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('notes', 'like', '%' . $this->search . '%');
            });
            $filtersUsed = true;
        }

        if (!empty($this->fromDate)) {
            $query->whereDate('appointment_date', '>=', $this->fromDate);
            $filtersUsed = true;
        }

        if (!empty($this->toDate)) {
            $query->whereDate('appointment_date', '<=', $this->toDate);
            $filtersUsed = true;
        }

        $this->filtersApplied = $filtersUsed;
        
        // Always load appointments when filters are applied or when showing the dashboard
        $this->appointments = $query->get();
        
        // Calculate counts from the appointments
        $this->calculateCountsFromAppointments();
        
        // If no filters are applied, also update the cached counts
        if (!$this->filtersApplied && empty($this->search)) {
            $this->updateCachedCounts(); // Fixed method name
        }
    }

    // Load counts from cache or calculate and cache them
    public function loadCachedCounts()
    {
        // Create a unique cache key for this doctor
        $cacheKey = 'doctor_dashboard_counts_' . $this->doctorId;
        
        // Use Cache::remember to store/retrieve the counts (cache for 1 hour)
        $counts = Cache::remember($cacheKey, 3600, function () {
            // Calculate counts if not in cache - use single optimized query
            return $this->calculateAllCountsFromDatabase();
        });
        
        // Assign the cached values
        $this->appointments_count = $counts['appointments_count'];
        $this->appointments_completed = $counts['appointments_completed'];
        $this->appointments_upcoming = $counts['appointments_upcoming'];
        $this->patient_count = $counts['patient_count'];
    }
    
    // Update cached counts with current data
    public function updateCachedCounts() // Fixed method name (removed extra characters)
    {
        $cacheKey = 'doctor_dashboard_counts_' . $this->doctorId;
        $counts = $this->calculateAllCountsFromDatabase();
        Cache::put($cacheKey, $counts, 3600);
        
        $this->appointments_count = $counts['appointments_count'];
        $this->appointments_completed = $counts['appointments_completed'];
        $this->appointments_upcoming = $counts['appointments_upcoming'];
        $this->patient_count = $counts['patient_count'];
    }

    // Calculate all counts in a single optimized database query
    protected function calculateAllCountsFromDatabase()
    {
        // Single optimized query using conditional aggregation
        $counts = Appointment::where('doctor_id', $this->doctorId)
            ->selectRaw('COUNT(*) as total_count')
            ->selectRaw('SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_count')
            ->selectRaw('SUM(CASE WHEN status IN ("pending", "scheduled") THEN 1 ELSE 0 END) as upcoming_count')
            ->selectRaw('COUNT(DISTINCT patient_id) as unique_patients')
            ->first();

        return [
            'appointments_count' => $counts->total_count,
            'appointments_completed' => $counts->completed_count,
            'appointments_upcoming' => $counts->upcoming_count,
            'patient_count' => $counts->unique_patients,
        ];
    }

    // Calculate counts directly from the appointments collection
    public function calculateCountsFromAppointments()
    {
        $this->appointments_count = $this->appointments->count();
        $this->appointments_completed = $this->appointments->where('status', 'completed')->count();
        $this->appointments_upcoming = $this->appointments->whereIn('status', ['pending', 'scheduled'])->count();
        $this->patient_count = $this->appointments->pluck('patient_id')->unique()->count();
    }

    public function updatedSearch()
    {
        // Use simple debounce without events for reliability
        $this->loadAppointmentsAndCounts();
    }

    public function updatedFromDate()
    {
        // Don't automatically load on date change, wait for apply button
    }

    public function updatedToDate()
    {
        // Don't automatically load on date change, wait for apply button
    }
    
    public function applyFilters()
    {
        $this->loadAppointmentsAndCounts();
    }
    
    public function loadAppointments()
    {
        $this->loadAppointmentsAndCounts();
    }

    public function markAsCompleted($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        if (in_array($appointment->status, ['scheduled', 'pending'])) {
            $appointment->status = 'completed';
            $appointment->save();

            // CLEAR CACHE: Since counts have changed
            $cacheKey = 'doctor_dashboard_counts_' . $this->doctorId;
            Cache::forget($cacheKey);

            // CRITICAL FIX: Remove the completed appointment from the current collection
            $this->appointments = $this->appointments->filter(function ($appt) use ($appointmentId) {
                return $appt->id != $appointmentId;
            });
            
            // Update counts based on the filtered collection
            $this->calculateCountsFromAppointments();
            
            // Also update the cached counts
            $this->updateCachedCounts(); // Fixed method name
            
            session()->flash('message', 'Appointment marked as completed!');
        } else {
            session()->flash('error', 'This appointment cannot be marked as completed.');
        }
    }

    public function render()
    {
        return view('livewire.doctor.section.doctordashboard');
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->fromDate = null;
        $this->toDate = null;
        $this->filtersApplied = false;
        $this->loadAppointmentsAndCounts();
    }
}