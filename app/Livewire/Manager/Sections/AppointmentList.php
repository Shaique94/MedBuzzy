<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

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
        $this->showReset = $this->search || $this->departmentFilter || $this->statusFilter || 
                          $this->doctorFilter || $this->fromDate || $this->toDate;
        
        if (in_array($property, ['search', 'departmentFilter', 'statusFilter', 'doctorFilter', 'fromDate', 'toDate'])) {
            $this->resetPage();
        }
    }

    public function getTodayAppointmentsProperty()
    {
        return $this->baseQuery()
            ->whereDate('appointment_date', Carbon::today())
            ->count();
    }

    public function getWeekAppointmentsProperty()
    {
        return $this->baseQuery()
            ->whereBetween('appointment_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();
    }

public function applyFilters()
{
    // This just resets the page - filters are already applied automatically
    $this->resetPage();
}

    public function getDoctorsCountProperty()
    {
        return Doctor::whereHas('managers', function($query) {
            $query->where('user_id', Auth::id());
        })->count(); // Removed ->active()
    }

    public function resetFilters()
    {
        $this->reset(['search', 'departmentFilter', 'statusFilter', 'doctorFilter', 'fromDate', 'toDate']);
        $this->showReset = false;
        $this->resetPage();
    }

    protected function baseQuery()
    {
        return Appointment::query()
            ->whereHas('doctor.managers', function($query) {
                $query->where('user_id', Auth::id());
            });
    }

    public function render()
    {
        $query = $this->baseQuery()
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

  $query->when($this->doctorFilter, function($q) {
    return $q->where('doctor_id', $this->doctorFilter)
             ->whereHas('doctor.managers', function($query) {
                 $query->where('user_id', Auth::id());
             });
});

        $query->when($this->fromDate, fn($q) => $q->whereDate('appointment_date', '>=', $this->fromDate));

        $query->when($this->toDate, fn($q) => $q->whereDate('appointment_date', '<=', $this->toDate));

        $managedDepartments = Department::whereHas('doctors.managers', function($query) {
            $query->where('user_id', Auth::id());
        })->get();

        $managedDoctors = Doctor::whereHas('managers', function($query) {
            $query->where('user_id', Auth::id());
        })->with('user')->get();

        return view('livewire.manager.sections.appointment-list', [
            'appointments' => $query->paginate(10),
            'departments' => $managedDepartments,
            'doctors' => $managedDoctors
        ]);
    }
}