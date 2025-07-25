<?php
namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class FeeCollectionModal extends ModalComponent
{
    public $patientId;
   public $appointmentId = null;
    public $fee;
    public $defaultFee;
    public $paymentMethod = 'cash'; // Default payment method

    public function mount($patientId, $appointmentId = null)
    {
        $this->patientId = $patientId;
        $this->appointmentId = $appointmentId;
        
        $appointment = Appointment::with('doctor')->findOrFail($this->appointmentId);
        $this->defaultFee = $appointment->doctor->fee;
        
        // Check if payment already exists for this appointment
        $existingPayment = Payment::where('appointment_id', $this->appointmentId)->first();
        $this->fee = $existingPayment ? $existingPayment->amount : $this->defaultFee;
    }

    public function resetToDefaultFee()
    {
        $this->fee = $this->defaultFee;
    }

    public function save()
    {
        $this->validate([
            'fee' => 'required|numeric|min:0',
            'paymentMethod' => 'required|in:cash,card,upi',
        ]);

        // Create or update payment record
        Payment::updateOrCreate(
            ['appointment_id' => $this->appointmentId],
            [
                'patient_id' => $this->patientId,
                'amount' => $this->fee,
                'method' => $this->paymentMethod,
                'status' => 'paid',
                'created_by' => Auth::id(),
            ]
        );

        $this->dispatch('feeUpdated');
        $this->dispatch('notify', message: 'Payment recorded successfully!');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.fee-collection-modal');
    }
}
