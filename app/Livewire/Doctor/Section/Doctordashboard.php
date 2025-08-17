<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Doctor Dashboard')]
class Doctordashboard extends Component
{ 
   public $appointments;
    public $appointments_count;

    public $patient_count;
    public $appointments_completed;
    public $appointments_upcoming;

    public $doctor_name;
    public $search = '';

    public $fromDate;
public $toDate;
public $filtersApplied = false;

public $showPatientModal = false;
public $selectedPatient = null;

    #[Layout('layouts.doctor')]
    public function mount()
    {
            $this->filtersApplied = false;
        $this->loadAppointments();
    }

    public function updatedSearch()
    {
        $this->loadAppointments();
    }

    public function loadAppointments()
    {
 $filtersUsed = false;
        $user = auth()->user();
        $this->doctor_name = $user->name;

        $doctor = Doctor::where('user_id', $user->id)->first();

        $query = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc');

     if (!empty($this->search)) {
            $query->whereHas('patient', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->fromDate)) {
            $query->whereDate('appointment_date', '>=', $this->fromDate);
              $filtersUsed = true;
        }

        if (!empty($this->toDate)) {
            $query->whereDate('appointment_date', '<=', $this->toDate);
              $filtersUsed = true;
        }

    $this->filtersApplied = $filtersUsed;
        $this->appointments = $query->get();

        $this->appointments_count = $this->appointments->count();
        $this->appointments_completed = $this->appointments->where('status', 'completed')->count();
        $this->appointments_upcoming = $this->appointments->whereIn('status', ['pending', 'scheduled'])->count();
        $this->patient_count = $this->appointments->pluck('patient_id')->unique()->count();
    }

    public function markAsCompleted($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        if ($appointment->status === 'scheduled') {
            $appointment->status = 'completed';
            $appointment->save();
            $this->loadAppointments();
            session()->flash('message', 'Appointment marked as completed!');
        } else {
            session()->flash('error', 'This appointment cannot be marked as completed.');
        }
    }

    public function render()
    {
        return view('livewire.doctor.section.doctordashboard');
    }

        public function resetFilters()
    {
        $this->search = '';
        $this->fromDate = null;
        $this->toDate = null;
        $this->filtersApplied = false;
        $this->loadAppointments();
    }


// public function showPatientDetails($patientId)
// {
//     logger("Opening modal for patient: $patientId");
//     $this->selectedPatient = \App\Models\Patient::find($patientId);
//     $this->showPatientModal = true;
// }


}
