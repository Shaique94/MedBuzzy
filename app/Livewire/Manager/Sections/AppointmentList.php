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
    public $dateRange = 'today';

    protected $queryString = [
        'search' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''], 
        'dateRange' => ['except' => 'today']
    ];


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

    public function render()
   {
    return view('livewire.manager.sections.appointment-list', [
        'appointments' => Appointment::query()
            ->when($this->search, fn($q) => $q->whereHas('patient', fn($q) => 
                $q->where('name', 'like', "%{$this->search}%")
            ))
            ->when($this->departmentFilter, fn($q) => $q->whereHas('doctor.department', fn($q) =>
                $q->where('id', $this->departmentFilter)
            ))
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->with(['patient', 'doctor.user', 'doctor.department'])
            ->paginate(10),
        'departments' => Department::all(),
        'doctors' => Doctor::with('user')->get() // Add this line
    ]);
}

}

