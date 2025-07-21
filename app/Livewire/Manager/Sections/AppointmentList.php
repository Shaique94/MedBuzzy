<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use Livewire\WithPagination;  
use App\Models\Appointment;  
use App\Models\Department;  
use App\Models\Doctor;  
use Carbon\Carbon;
use Livewire\Attributes\Layout;


#[Layout('layouts.manager')]  
class AppointmentList extends Component
{

       use WithPagination;

    public $search = '';
    public $departmentFilter = '';
    public $statusFilter = '';
    public $doctorFilter = '';
    public $fromDate = '';
    public $toDate = '';
    public $dateRange = 'today';
    public $showReset = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'doctorFilter' => ['except' => ''],
        'fromDate' => ['except' => ''],
        'toDate' => ['except' => ''],
        'dateRange' => ['except' => 'today']
    ];

    public function updated($property)
    {
        // Show reset button when any filter is active
        $this->showReset = $this->search || $this->departmentFilter || $this->statusFilter || 
                          $this->doctorFilter || $this->fromDate || $this->toDate;
        
        // Reset pagination when filters change
        if (in_array($property, ['search', 'departmentFilter', 'statusFilter', 'doctorFilter', 'fromDate', 'toDate'])) {
            $this->resetPage();
        }
    }

    public function getTodayAppointmentsProperty()
    {
        return Appointment::whereDate('appointment_date', Carbon::today())->count();
    }

    public function getWeekAppointmentsProperty()
    {
        return Appointment::whereBetween('appointment_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    public function getDoctorsCountProperty()
    {
        return Doctor::count(); 
    }

    public function resetFilters()
    {
        $this->reset(['search', 'departmentFilter', 'statusFilter', 'doctorFilter', 'fromDate', 'toDate']);
        $this->showReset = false;
        $this->resetPage();
    }

    public function render()
    {
        $query = Appointment::query()
            ->with(['patient', 'doctor.user', 'doctor.department'])
            ->latest();

        // Apply filters
        $query->when($this->search, fn($q) => $q->whereHas('patient', fn($q) => 
            $q->where('name', 'like', "%{$this->search}%")
              ->orWhere('email', 'like', "%{$this->search}%")
              ->orWhere('phone', 'like', "%{$this->search}%")
        ));

        $query->when($this->departmentFilter, fn($q) => $q->whereHas('doctor.department', fn($q) =>
            $q->where('id', $this->departmentFilter)
        ));

        $query->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter));

        $query->when($this->doctorFilter, fn($q) => $q->where('doctor_id', $this->doctorFilter));

        $query->when($this->fromDate, fn($q) => $q->whereDate('appointment_date', '>=', $this->fromDate));

        $query->when($this->toDate, fn($q) => $q->whereDate('appointment_date', '<=', $this->toDate));

        return view('livewire.manager.sections.appointment-list', [
            'appointments' => $query->paginate(10),
            'departments' => Department::all(),
            'doctors' => Doctor::with('user')->get()
        ]);
    }
}