<?php

namespace App\Livewire\Public\Appointment\Steps;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorSelection extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    public $appointmentData = [];
    public $selectedDepartment = null;
    public $searchQuery = '';
    public $viewType = 'grid'; // 'list' or 'grid'
    public $sortBy = 'recommended'; // 'recommended', 'rating', 'price_low', 'price_high', 'experience'
    public $doctorId = null;
    public $departments = [];
    public $isFilterOpen = false;
    
    protected $queryString = [
        'selectedDepartment' => ['except' => null, 'as' => 'dept'],
        'searchQuery' => ['except' => '', 'as' => 'q'],
        'sortBy' => ['except' => 'recommended'],
    ];

    protected $listeners = ['validateAndProceed'];

    public function mount($appointmentData = [])
    {
        $this->appointmentData = $appointmentData;
        if (isset($appointmentData['doctor_id'])) {
            $this->doctorId = $appointmentData['doctor_id'];
        }
        if (isset($appointmentData['department_id'])) {
            $this->selectedDepartment = $appointmentData['department_id'];
        }
        // Cache departments for 24 hours
        $this->departments = cache()->remember('departments', now()->addHours(24), function() {
            return Department::where('status', 1)->orderBy('name')->get();
        });
    }

    public function updatedSelectedDepartment()
    {
        $this->resetPage();
        $this->doctorId = null;
    }
    
    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    
    public function updatedSortBy()
    {
        $this->resetPage();
    }
    
    public function toggleViewType()
    {
        $this->viewType = $this->viewType === 'grid' ? 'list' : 'grid';
    }
    
    public function toggleFilter()
    {
        $this->isFilterOpen = !$this->isFilterOpen;
    }
    
    public function selectDoctor($doctorId)
    {
        $this->doctorId = $doctorId;
        // Do NOT dispatch step-validated here!
    }
    
    public function clearFilters()
    {
        $this->selectedDepartment = null;
        $this->searchQuery = '';
        $this->sortBy = 'recommended';
        $this->resetPage();
    }
    
    public function validateAndProceed()
    {
        $this->validate([
            'doctorId' => 'required|exists:doctors,id',
        ], [
            'doctorId.required' => 'Please select a doctor to continue.',
        ]);
        
        $doctor = Doctor::with(['user', 'department'])->find($this->doctorId);
        
        // Only pass doctor info, NOT appointment_date or appointment_time!
        $this->dispatch('step-validated', [
            'doctor_id' => $this->doctorId,
            'selected_doctor' => $doctor,
            'department_id' => $doctor->department_id,
        ]);
    }

    public function render()
    {
        $doctorsQuery = Doctor::query()
            ->where('status', 1)
            ->with(['user', 'department'])
            ->withAvg('reviews as average_rating', 'rating')
            ->withCount('reviews');
            
        if ($this->selectedDepartment) {
            $doctorsQuery->where('department_id', $this->selectedDepartment);
        }
        
        if ($this->searchQuery) {
            $doctorsQuery->whereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->orWhere(function($query) {
                $query->whereHas('department', function($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->searchQuery . '%');
                });
            });
        }
        
        // Apply sorting
        switch ($this->sortBy) {
            case 'rating':
                $doctorsQuery->orderByDesc('average_rating');
                break;
            case 'price_low':
                $doctorsQuery->orderBy('fee');
                break;
            case 'price_high':
                $doctorsQuery->orderByDesc('fee');
                break;
            case 'experience':
                $doctorsQuery->orderByDesc('experience');
                break;
            default:
                $doctorsQuery->orderByDesc('reviews_count')
                             ->orderByDesc('average_rating');
        }
        
        $doctors = $doctorsQuery->paginate(9);
        
        return view('livewire.public.appointment.steps.doctor-selection', [
            'doctors' => $doctors,
        ]);
    }
}
