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

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load basic counts
        $this->appointmentsCount = Cache::remember('appointments_Count', 3600, function () {
            return Appointment::count();
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
        $endOfWeek = Carbon::now()->endOfWeek();

        // Fetch all appointments of the week in ONE query
        $appointments = Appointment::selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->whereBetween('appointment_date', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->pluck('count', 'date'); // returns [ '2025-08-18' => 5, '2025-08-19' => 2, ... ]

        $this->weeklyAppointments = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i)->toDateString();
            $this->weeklyAppointments[] = [
                'day' => Carbon::parse($date)->format('D'),
                'count' => $appointments[$date] ?? 0, // use 0 if no records
            ];
        }
    }

    public function loadMonthlyRevenue()
    {
        $this->monthlyRevenue = [];

        $startMonth = Carbon::now()->subMonths(5)->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();

        // Get all revenues in one query
        $revenues = Payment::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->where('status', 'paid')
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->groupBy('year', 'month')
            ->pluck('total', 'month');

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthNumber = (int) $month->format('m');

            $this->monthlyRevenue[] = [
                'month' => $month->format('M'),
                'revenue' => $revenues[$monthNumber] ?? 0
            ];
        }
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

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.dashboard');
    }
}
