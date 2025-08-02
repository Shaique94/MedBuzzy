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

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load basic counts
        $this->appointmentsCount = Appointment::count();
        $this->patientsCount = Patient::count();
        $this->doctorsCount = Doctor::where('status', 'active')->count();
        $this->totalRevenue = Payment::where('status', 'paid')->sum('amount');

        // Load weekly appointments data for chart
        $this->loadWeeklyAppointments();
        
        // Load monthly revenue data for chart
        $this->loadMonthlyRevenue();
        
        // Load recent appointments
        $this->loadRecentAppointments();
    }

    public function loadWeeklyAppointments()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $this->weeklyAppointments = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $count = Appointment::whereDate('appointment_date', $date)->count();
            $this->weeklyAppointments[] = [
                'day' => $date->format('D'),
                'count' => $count
            ];
        }
    }

    public function loadMonthlyRevenue()
    {
        $this->monthlyRevenue = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Payment::where('status', 'paid')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
            
            $this->monthlyRevenue[] = [
                'month' => $month->format('M'),
                'revenue' => $revenue
            ];
        }
    }

    public function loadRecentAppointments()
    {
        $this->appointments = Appointment::with(['patient', 'doctor.user'])
            ->whereDate('appointment_date', '>=', Carbon::today())
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->take(5)
            ->get();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.dashboard');
    }
}
