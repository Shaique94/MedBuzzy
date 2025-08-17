<?php

namespace App\Livewire\Doctor\Section;

use Livewire\Component;
use App\Models\Patient;
use App\Models\Appointment;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class ViewDetail extends Component
{
    public bool $showPatientModal = false;
    public ?Patient $selectedPatient = null;
    public $patientAppointments = [];

    #[On('show-patient-details')]
    public function loadPatient($patientId)
    {
        try {
            $this->selectedPatient = Patient::with(['appointments' => function($query) {
                $query->with(['doctor.user', 'doctor.department'])
                     ->orderBy('appointment_date', 'desc');
            }])->find($patientId);

            if (!$this->selectedPatient) {
                throw new \Exception("Patient not found");
            }

            $this->patientAppointments = $this->selectedPatient->appointments;
            $this->showPatientModal = true;

        } catch (\Exception $e) {
            Log::error("Error loading patient: " . $e->getMessage());
            $this->dispatch('notify-error', message: 'Failed to load patient details');
            $this->resetModal();
        }
    }

    public function closeModal()
    {
        $this->resetModal();
    }

    protected function resetModal()
    {
        $this->reset(['showPatientModal', 'selectedPatient', 'patientAppointments']);
    }

    public function render()
    {
        return view('livewire.doctor.section.view-detail');
    }
}