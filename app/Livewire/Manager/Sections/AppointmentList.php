<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.manager')]
#[Title('Appointment Management')]
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
        })->count();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'departmentFilter', 'statusFilter', 'doctorFilter', 'fromDate', 'toDate']);
        $this->showReset = false;
        $this->resetPage();
    }

    // Fixed updateStatus method
    public function updateStatus($appointmentId, $status)
    {
        $validStatuses = ['pending', 'scheduled', 'completed', 'completed', 'cancelled', 'rescheduled'];
        
        if (!in_array($status, $validStatuses)) {
            session()->flash('error', 'Invalid status selected.');
            return;
        }

        $appointment = Appointment::find($appointmentId);
        
        if (!$appointment) {
            session()->flash('error', 'Appointment not found.');
            return;
        }

        // Check if the authenticated manager is authorized to update this appointment
        if (!$appointment->doctor->managers->contains(Auth::id())) {
            session()->flash('error', 'You are not authorized to update this appointment.');
            return;
        }

        // Update the appointment status
        $appointment->status = $status;
        $appointment->save();

        // Flash success message
        session()->flash('message', 'Appointment status updated successfully.');

        // No need to reset page, just let Livewire re-render
    }

    public function confirmCancel($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        if ($appointment && $appointment->doctor->managers->contains(Auth::id())) {
            $appointment->update(['status' => 'cancelled']);
            session()->flash('message', 'Appointment cancelled successfully.');
        } else {
            session()->flash('error', 'You are not authorized to cancel this appointment.');
        }
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

        $query->when($this->doctorFilter, fn($q) => $q->where('doctor_id', $this->doctorFilter)
            ->whereHas('doctor.managers', fn($query) => 
                $query->where('user_id', Auth::id())
        ));

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