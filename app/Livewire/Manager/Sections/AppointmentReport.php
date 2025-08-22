<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentReport extends Component
{
    public $appointments;
    public $filterType = 'today';
    public $fromDate;
    public $toDate;

    public function mount()
    {
        $this->fromDate = date('Y-m-d');
        $this->toDate = date('Y-m-d');
        $this->filterAppointments();
    }

    protected function baseQuery()
    {
        return Appointment::query()
            ->whereHas('doctor.managers', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['patient', 'doctor.user'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time');
    }

    public function filterAppointments()
    {
        $query = $this->baseQuery();

        if ($this->filterType === 'all') {
        } else if ($this->filterType === 'today') {
            $query->whereDate('appointment_date', today());
        } else if ($this->filterType === 'tomorrow') {
            $query->whereDate('appointment_date', today()->addDay());
        } else if ($this->filterType === 'date_range') {
            if ($this->fromDate && $this->toDate) {
                $query->whereBetween('appointment_date', [$this->fromDate, $this->toDate]);
            }
        }

        $this->appointments = $query->get();
    }

    public function updatedFilterType()
    {
        $this->filterAppointments();
    }

    public function updatedFromDate()
    {
        if ($this->filterType === 'date_range') {
            $this->filterAppointments();
        }
    }

    public function updatedToDate()
    {
        if ($this->filterType === 'date_range') {
            $this->filterAppointments();
        }
    }

    #[Layout('layouts.manager')]
    public function render()
    {
        return view('livewire.manager.sections.appointment-report');
    }
}