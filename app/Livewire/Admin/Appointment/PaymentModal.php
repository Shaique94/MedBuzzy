<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Payment;
use Livewire\Attributes\On;
use Livewire\Component;

class PaymentModal extends Component
{
    public $showModal = false;
    public $appointment;
    public $totalAmount = 0;
    public $paidAmount = 0;
    public $pendingAmount = 0;
    public $payingAmount = 0;
    public $paymentMethod = 'cash';
    public $razorpayOrderId = null;

    #[On('openPaymentModal')]
    public function openModal($appointmentId)
    {
        $this->appointment = Appointment::with(['doctor', 'patient', 'payment'])->find($appointmentId);
        $this->totalAmount = 50.00; // Fixed amount as requested
        $this->paidAmount = $this->appointment->payment?->amount ?? 0;
        $this->pendingAmount = $this->totalAmount - $this->paidAmount;
        $this->payingAmount = $this->pendingAmount;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['totalAmount', 'paidAmount', 'pendingAmount', 'payingAmount', 'paymentMethod', 'razorpayOrderId']);
    }

    public function markAsSettled()
    {
        $this->validate([
            'paymentMethod' => 'required|in:cash,card,upi'
        ]);

        try {
            if ($this->appointment->payment) {
                // Update existing payment
                $this->appointment->payment->update([
                    'amount' => $this->totalAmount, // Use fixed amount
                    'method' => $this->paymentMethod,
                    'status' => 'paid'
                ]);
            } else {
                // Create new payment record
                Payment::create([
                    'appointment_id' => $this->appointment->id,
                    'amount' => $this->totalAmount, // Use fixed amount
                    'method' => $this->paymentMethod,
                    'status' => 'paid'
                ]);
            }

            $this->dispatch('success', __('Payment settled successfully!'));
            $this->closeModal();
            $this->dispatch('paymentUpdated');
        } catch (\Exception $e) {
            $this->dispatch('error', __('Failed to settle payment: ' . $e->getMessage()));
        }
    }

    public function processPayment()
    {
        $this->validate([
            'paymentMethod' => 'required|in:cash,card,upi'
        ]);

        if ($this->paymentMethod === 'upi') {
            $this->initiateRazorpayPayment();
        } else {
            $this->markAsSettled();
        }
    }

    private function initiateRazorpayPayment()
    {
        // Create Razorpay order
        $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        try {
            $order = $api->order->create([
                'receipt' => 'appointment_' . $this->appointment->id,
                'amount' => $this->totalAmount * 100, // Convert to paisa - fixed ₹50
                'currency' => 'INR',
                'notes' => [
                    'appointment_id' => $this->appointment->id,
                    'patient_name' => $this->appointment->patient->name
                ]
            ]);

            $this->razorpayOrderId = $order['id'];
            
            // Dispatch event to frontend to open Razorpay
            $this->dispatch('openRazorpay', [
                'orderId' => $order['id'],
                'amount' => $this->totalAmount * 100,
                'currency' => 'INR',
                'name' => 'MedBuzzy',
                'description' => 'Appointment Payment - ₹50',
                'prefill' => [
                    'name' => $this->appointment->patient->name,
                    'email' => $this->appointment->patient->email,
                    'contact' => $this->appointment->patient->phone
                ]
            ]);
        } catch (\Exception $e) {
            $this->dispatch('error', __('Failed to initiate online payment: ' . $e->getMessage()));
        }
    }

    #[On('razorpaySuccess')]
    public function handleRazorpaySuccess($paymentData)
    {
        // Verify payment with Razorpay
        $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        
        try {
            $payment = $api->payment->fetch($paymentData['razorpay_payment_id']);
            
            if ($payment->status === 'captured') {
                // Update payment record
                if ($this->appointment->payment) {
                    $this->appointment->payment->update([
                        'amount' => $this->totalAmount,
                        'method' => 'upi',
                        'status' => 'paid',
                        'razorpay_payment_id' => $paymentData['razorpay_payment_id'],
                        'razorpay_order_id' => $paymentData['razorpay_order_id']
                    ]);
                } else {
                    Payment::create([
                        'appointment_id' => $this->appointment->id,
                        'amount' => $this->totalAmount,
                        'method' => 'upi',
                        'status' => 'paid',
                        'razorpay_payment_id' => $paymentData['razorpay_payment_id'],
                        'razorpay_order_id' => $paymentData['razorpay_order_id']
                    ]);
                }

                $this->dispatch('success', __('Online payment successful!'));
                $this->closeModal();
                $this->dispatch('paymentUpdated');
            }
        } catch (\Exception $e) {
            $this->dispatch('error', __('Payment verification failed: ' . $e->getMessage()));
        }
    }

    public function render()
    {
        return view('livewire.admin.appointment.payment-modal');
    }
}
