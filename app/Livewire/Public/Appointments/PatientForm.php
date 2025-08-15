<?php

namespace App\Livewire\Public\Appointments;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]

class PatientForm extends Component
{
 public $patient_type = 'myself';
    public $patient_name;
    public $patient_email;
    public $patient_phone;
    public $patient_gender = 'male';

    public function mount()
    {
        if (Auth::check() && $this->patient_type === 'myself') {
            $this->loadUserPatientData();
        }
    }

    public function loadUserPatientData()
    {
        $user = Auth::user();
        if ($user) {
            $patient = $user->patients()->first();
            if ($patient) {
                $this->patient_name = $patient->name;
                $this->patient_email = $patient->email;
                $this->patient_phone = $user->phone;
                $this->patient_gender = $patient->gender;
            } else {
                $this->patient_name = $user->name;
                $this->patient_email = $user->email;
                $this->patient_phone = $user->phone;
                $this->patient_gender = $user->gender ?? 'male';
            }
        }
    }

    public function updatedPatientType()
    {
        if ($this->patient_type === 'myself') {
            $this->loadUserPatientData();
        } else {
            $this->patient_name = null;
            $this->patient_email = null;
            $this->patient_gender = 'male';
            $this->patient_phone = Auth::user()->phone ?? null;
        }
    }
    public function render()
    {
        return view('livewire.public.appointments.patient-form');
    }
}
