<?php
namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Patient;
use App\Models\Appointment;

class FeeCollectionModal extends ModalComponent
{
    public $patientId;
    public $appointmentId;
    public $fee;
    public $defaultFee;

public function mount($patientId, $appointmentId)
{
    $this->patientId = $patientId;
    $this->appointmentId = $appointmentId;
    
  
    $patient = Patient::findOrFail($this->patientId);
    $appointment = Appointment::with('doctor')->findOrFail($this->appointmentId);
    
   
    $this->defaultFee = $appointment->doctor->fee;
    
  
    $this->fee = $patient->fee > 0 ? $patient->fee : $this->defaultFee;
}

  public function resetToDefaultFee()
{
    $this->fee = $this->defaultFee;
}

public function save()
{
    $this->validate([
        'fee' => 'required|numeric|min:0',
    ]);

    $patient = Patient::findOrFail($this->patientId);
    $patient->fee = $this->fee;
    $patient->save();

    $this->dispatch('feeUpdated');
    $this->dispatch('notify', message: 'Fee updated successfully!');
    $this->closeModal();
}

    public function render()
    {
        return view('livewire.fee-collection-modal');
    }
}