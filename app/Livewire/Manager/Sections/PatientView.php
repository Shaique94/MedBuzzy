<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Component;
use App\Models\Patient;
use Livewire\Attributes\Layout;

#[Layout('layouts.manager')]
class PatientView extends Component
{
     public $patient;
    public $appointments;
public $latestAppointment;

    public function mount($id)
    {
        $this->patient = Patient::with(['appointments' => function($query) {
            $query->orderBy('appointment_date', 'desc')
               ->orderBy('appointment_time', 'desc')
                  ->with('doctor');
        }])->findOrFail($id);
        
        $this->appointments = $this->patient->appointments;
            $this->latestAppointment = $this->appointments->first();
    }

    public function render()
    {
        return view('livewire.manager.sections.patient-view');
    }
}