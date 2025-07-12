<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Carbon\Carbon;

class All extends Component
{ 
    public $appointments;
    public $search = '';
    public $fromDate;
    public $toDate;

    
    public function updatedSearch()
    {
        $this->loadAppointments();
    }

    public function updatedFromDate()
    {
        $this->loadAppointments();
    }

    public function updatedToDate()
    {
        $this->loadAppointments();
    }

    public function updateStatus($id, string $status)
    {
        $validStatuses = ['pending', 'scheduled', 'completed', 'cancelled', 'checked_in'];
        
        if (!in_array($status, $validStatuses)) {
            session()->flash('error', 'Invalid status selected');
            return;
        }
    
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $status;
        $appointment->save();
        
        session()->flash('message', 'Status updated successfully');
        $this->loadAppointments(); // Refresh the list
    }

    public function loadAppointments()
    {
        $query = Appointment::with(['doctor.user', 'patient'])
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc');

        // Date range filter
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('appointment_date', [
                Carbon::parse($this->fromDate)->startOfDay(),
                Carbon::parse($this->toDate)->endOfDay()
            ]);
        } else {
            // Default to today's appointments
            $query->whereDate('appointment_date', Carbon::today());
        }

        // Search functionality
        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('doctor.user', function($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                      ->orWhere('email', 'like', $searchTerm);
                })
                ->orWhereHas('patient', function($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                      ->orWhere('email', 'like', $searchTerm)
                      ->orWhere('phone', 'like', $searchTerm);
                });
            });
        }

        $this->appointments = $query->get();
    }
 public function resetFilters()
    {
        $this->search = '';
        $this->fromDate = Carbon::today()->toDateString();
        $this->toDate = Carbon::today()->toDateString();
        $this->loadAppointments();
    }

    public function mount()
    {
        $this->fromDate = Carbon::today()->toDateString();
        $this->toDate = Carbon::today()->toDateString();
        $this->loadAppointments();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.all');
    }
}
