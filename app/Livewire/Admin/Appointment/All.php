<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

#[Title('All Appointments')]
class All extends Component
{
    use WithPagination;

    public $search = '';
    public $fromDate;
    public $toDate;
    public $perPage = 10;
    public $dateFilter = ''; // New property for Today/Tomorrow filter

    // Modal properties
    public $showViewModal = false;
    public $selectedAppointment = null;

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFromDate()
    {
        $this->resetPage();
        $this->dateFilter = ''; // Reset date filter when custom date is changed
    }

    public function updatedToDate()
    {
        $this->resetPage();
        $this->dateFilter = ''; // Reset date filter when custom date is changed
    }

    public function updateStatus($id, string $status)
    {
        try {
            $validStatuses = ['pending', 'scheduled', 'completed', 'cancelled'];

            if (!in_array($status, $validStatuses)) {
                $this->dispatch('error', __('Invalid status selected'));
                return;
            }

            $appointment = Appointment::findOrFail($id);
            $oldStatus = $appointment->status;

            if ($oldStatus === $status) {
                return;
            }

            $appointment->status = $status;
            $appointment->save();

            $this->dispatch('success', __("Status updated from '{$oldStatus}' to '{$status}' successfully"));
        } catch (\Exception $e) {
            $this->dispatch('error', __('Failed to update appointment status. Please try again.'));
        }
    }

    // New method for Today/Tomorrow filter
    public function applyDateFilter($filter)
    {
        $this->dateFilter = $filter;
        if ($filter === 'today') {
            $this->fromDate = Carbon::today()->toDateString();
            $this->toDate = Carbon::today()->toDateString();
        } elseif ($filter === 'tomorrow') {
            $this->fromDate = Carbon::tomorrow()->toDateString();
            $this->toDate = Carbon::tomorrow()->toDateString();
        }
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->fromDate = null;
        $this->toDate = null;
        $this->dateFilter = ''; // Reset date filter
        $this->resetPage();
    }

    public function refreshAppointments()
    {
        $this->resetPage();
        $this->dispatch('success', __('Appointments refreshed successfully.'));
    }

    public function viewAppointment($id)
    {
        $this->dispatch('openModal', id: $id);
    }

    public function getAppointmentsProperty()
    {
        $query = Appointment::with(['doctor.user', 'patient', 'payment'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc');

        // Date range filter
        if ($this->fromDate && $this->toDate) {
            $query->whereBetween('appointment_date', [
                Carbon::parse($this->fromDate)->startOfDay(),
                Carbon::parse($this->toDate)->endOfDay()
            ]);
        } elseif ($this->fromDate) {
            $query->where('appointment_date', '>=', Carbon::parse($this->fromDate)->startOfDay());
        } elseif ($this->toDate) {
            $query->where('appointment_date', '<=', Carbon::parse($this->toDate)->endOfDay());
        }

        // Search functionality
        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('doctor.user', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('email', 'like', $searchTerm);
                })
                ->orWhereHas('patient', function ($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('email', 'like', $searchTerm);
                });
            });
        }

        return $query->paginate($this->perPage);
    }

    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->dateFilter = '';
    }

    #[On('appointmentUpdated')]
    public function refreshListAfterEdit()
    {
        $this->resetPage();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.all', [
            'appointments' => $this->appointments
        ]);
    }
}