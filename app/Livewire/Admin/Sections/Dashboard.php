<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;


#[Title('Admin Dashboard - MedBuzzy')]
class Dashboard extends Component
{
    public $appointments;
    public $appointmentsCount;
    public $patientsCount;
    public $doctorsCount;
    public $totalRevenue;
    public $weeklyAppointments = [];
    public $monthlyRevenue = [];
    public $showViewModal = false;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load basic counts
        $this->appointmentsCount = Cache::remember('appointments_Count', 3600, function () {
            return Appointment::where('status', 'scheduled')->count();
        });
        $this->doctorsCount = Cache::remember('doctors_Count', 3600, function () {
            return Doctor::where('status', true)->count();
        });
        $this->patientsCount = Cache::remember('patients_Count', 3600, function () {
            return Patient::count();
        });

        $this->totalRevenue = Cache::remember('total_Count', 3600, function () {
            return Payment::where('status', 'paid')->sum('amount');
        });


        // Load recent appointments
        $this->loadRecentAppointments();
    }



    public function loadRecentAppointments()
    {
        $this->appointments = Cache::remember('upcoming_appointments', now()->addMinutes(30), function () {
            return Appointment::with([
                'patient.user:id,name',
                'doctor.user:id,name',
                'doctor.department:id,name'
            ])
                ->select('id', 'patient_id', 'doctor_id', 'appointment_date', 'appointment_time', 'status')
                ->whereDate('appointment_date', '>=', Carbon::today())
                ->orderBy('appointment_date', 'asc')
                ->orderBy('appointment_time', 'asc')
                ->limit(5)
                ->get();
        });
    }


    public function viewAppointment($id)
    {
        $this->dispatch('openModal', id: $id);
    }
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.dashboard');
    }
}
