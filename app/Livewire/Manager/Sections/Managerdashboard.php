<?php

namespace App\Livewire\Manager\Sections;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
use App\Models\Payment;

#[Title('Manager Dashboard')]
class Managerdashboard extends Component
{
    public  $appointments;
    public $appointmentsCount;
    public $patientsCount;
    public $doctorsCount;
        public $todaysPaymentsTotal;
    public $todaysAppointmentsCount;
    public $todaysCompletedPayments;

#[Layout('layouts.manager')]  

         public function mount()
    {
        $this->loadCounts();
        $this->loadAppointments();
        $this->loadTodaysPayments();
    }

    public function render()
    {
        return view('livewire.manager.sections.managerdashboard');
    }

   public function loadCounts()
    {
        $managerUserId = Auth::id();

        // Count only appointments for doctors managed by this manager
        $this->appointmentsCount = Appointment::whereHas('doctor', function ($query) use ($managerUserId) {
            $query->whereHas('managers', function ($q) use ($managerUserId) {
                $q->where('user_id', $managerUserId);
            });
        })->count();

        // Count only patients who have appointments with doctors managed by this manager
        $this->patientsCount = Patient::whereHas('appointments', function ($query) use ($managerUserId) {
            $query->whereHas('doctor', function ($q) use ($managerUserId) {
                $q->whereHas('managers', function ($managerQuery) use ($managerUserId) {
                    $managerQuery->where('user_id', $managerUserId);
                });
            });
        })->count();

        // Count only doctors managed by this manager
        $this->doctorsCount = Doctor::whereHas('managers', function ($query) use ($managerUserId) {
            $query->where('user_id', $managerUserId);
        })->count();
    }


     public function loadAppointments()
    {
        $managerUserId = Auth::id();

        $this->appointments = Appointment::with(['patient', 'doctor.user', 'doctor.department'])
            ->whereHas('doctor', function ($query) use ($managerUserId) {
                $query->whereHas('managers', function ($q) use ($managerUserId) {
                    $q->where('user_id', $managerUserId);
                });
            })
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->take(4)
            ->get();
    }

     public function loadTodaysPayments()
    {
        $managerUserId = Auth::id();

        // Today's total payments for managed doctors
        $this->todaysPaymentsTotal = Payment::whereHas('appointment.doctor', function ($query) use ($managerUserId) {
            $query->whereHas('managers', function ($q) use ($managerUserId) {
                $q->where('user_id', $managerUserId);
            });
        })
        ->whereDate('created_at', Carbon::today())
        ->sum('amount');

        // Count of today's appointments for managed doctors
        $this->todaysAppointmentsCount = Appointment::whereHas('doctor', function ($query) use ($managerUserId) {
            $query->whereHas('managers', function ($q) use ($managerUserId) {
                $q->where('user_id', $managerUserId);
            });
        })
        ->whereDate('appointment_date', Carbon::today())
        ->count();

        // Count of today's completed payments for managed doctors
        $this->todaysCompletedPayments = Payment::whereHas('appointment.doctor', function ($query) use ($managerUserId) {
            $query->whereHas('managers', function ($q) use ($managerUserId) {
                $q->where('user_id', $managerUserId);
            });
        })
        ->whereDate('created_at', Carbon::today())
        ->where('status', 'completed')
        ->count();
    }

}