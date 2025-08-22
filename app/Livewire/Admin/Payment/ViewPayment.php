<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ViewPayment extends Component
{
    public $showModal = false;
    public $payment;
    public $appointmentId;
    public $patientDetails;
    public $amount;

    protected $listeners = ['openModal' => 'showModal'];

    public function mount($paymentId = null)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Load payment if ID is provided
        if ($paymentId) {
            $this->payment = Payment::with('patient', 'appointment')->findOrFail($paymentId);
            $this->appointmentId = $this->payment->appointment_id;
            $this->patientDetails = $this->payment->patient->details ?? 'No details available';
            $this->amount = number_format($this->payment->amount, 2);
        }
    }

    public function showModal($paymentId)
    {
        $this->payment = Payment::with('patient', 'appointment')->findOrFail($paymentId);
        $this->appointmentId = $this->payment->appointment_id;
        $this->patientDetails = $this->payment->patient->details ?? 'No details available';
        $this->amount = number_format($this->payment->amount, 2);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['payment', 'appointmentId', 'patientDetails', 'amount']);
    }

    public function processPayment()
    {
        // Implement payment processing logic here
        // This is a placeholder for actual payment processing
        $this->payment->update([
            'status' => 'paid',
            'settlement' => true,
            'transaction_id' => 'TXN_' . time(),
        ]);

        session()->flash('message', 'Payment processed successfully');
        $this->closeModal();
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.payment.view-payment');
    }
}