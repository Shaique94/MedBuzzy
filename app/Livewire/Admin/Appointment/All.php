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

    // Modal properties
    public $showViewModal = false;
    public $showPaymentModal = false;
    public $showEditModal = false;
    public $selectedAppointment = null;

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage(); // Reset to page 1 when searching
    }

    public function updatedFromDate()
    {
        $this->resetPage();
    }

    public function updatedToDate()
    {
        $this->resetPage();
    }

    public function updateStatus($id, string $status)
    {
        try {
            $validStatuses = ['pending', 'scheduled', 'completed', 'cancelled', 'checked_in'];
            
            if (!in_array($status, $validStatuses)) {
                $this->dispatch('error', __('Invalid status selected'));
                return;
            }

            $appointment = Appointment::findOrFail($id);
            $oldStatus = $appointment->status;
            
            // Skip update if status is the same
            if ($oldStatus === $status) {
                return;
            }
            
            $appointment->status = $status;
            $appointment->save();

            $this->dispatch('success', __("Status updated from '{$oldStatus}' to '{$status}' successfully"));
            $this->loadAppointments(); // Refresh the list
        } catch (\Exception $e) {
            $this->dispatch('error', __('Failed to update appointment status. Please try again.'));
        }
    }

    public function editAppointment($id)
    {
        $this->dispatch('openEditModal', appointmentId: $id);
    }

  

    public function printReceipt($id)
    {
        $this->dispatch('printReceipt', appointmentId: $id);
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

    public function closeModal()
    {
        $this->showViewModal = false;
        $this->showPaymentModal = false;
        $this->showEditModal = false;
        $this->selectedAppointment = null;
    }

    public function getAppointmentsProperty()
    {
        $query = Appointment::with(['doctor.user', 'patient', 'payment'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc');

        // Date range filter - apply even if only one date is provided
        if ($this->fromDate && $this->toDate) {
            // Both dates provided - filter range
            $query->whereBetween('appointment_date', [
                Carbon::parse($this->fromDate)->startOfDay(),
                Carbon::parse($this->toDate)->endOfDay()
            ]);
        } elseif ($this->fromDate) {
            // Only from date - show appointments from this date onwards
            $query->where('appointment_date', '>=', Carbon::parse($this->fromDate)->startOfDay());
        } elseif ($this->toDate) {
            // Only to date - show appointments up to this date
            $query->where('appointment_date', '<=', Carbon::parse($this->toDate)->endOfDay());
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

        return $query->paginate($this->perPage);
    }
 public function resetFilters()
    {
        $this->search = '';
        $this->fromDate = null;
        $this->toDate = null;
        $this->resetPage();
    }

    public function mount()
    {
        // Don't set default dates - let admin choose the date range
        $this->fromDate = null;
        $this->toDate = null;
    }

    #[On('paymentUpdated')]
    public function refreshList()
    {
        $this->resetPage();
    }

    #[On('appointmentUpdated')]
    public function refreshListAfterEdit()
    {
        $this->resetPage();
    }

    #[On('appointmentCreated')]
    public function handleAppointmentCreated()
    {
        $this->resetPage();
        $this->dispatch('success', __('New appointment has been created successfully!'));
    }
       #[On('appointmentFailed')]
    public function handleAppointmentFailed()
    {
        $this->resetPage();
        $this->dispatch('error', __('Failed to create new appointment. Please try again.'));
    }
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.appointment.all', [
            'appointments' => $this->appointments
        ]);
    }
}
