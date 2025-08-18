<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Payment;
use App\Services\ContactService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Razorpay\Api\Api;
use Razorpay\Api\Utility;

#[Title('Payment Failed')]
#[Layout('layouts.public')]
class FailedAppointment extends Component
{
    public Appointment $appointment;
    public $formattedTime;
    public $orderId;
    public $isProcessing = false;
    public $amount = 5000; // ₹50 in paise
    public $contactDetails;

    public function mount($id)
    {
        // Find appointment with pending status and failed payment, or failed appointment
        $this->appointment = Appointment::with(['doctor.user', 'doctor.department', 'patient.user', 'payments'])
            ->where('id', $id)
            ->where(function($query) {
                // Allow pending appointments with failed payments OR failed appointments
                $query->where('status', 'pending')
                      ->whereHas('payments', function($q) {
                          $q->where('status', 'failed');
                      })
                      ->orWhere('status', 'failed');
            })
            ->firstOrFail();
            
        // Format the time properly
        $this->formattedTime = Carbon::createFromFormat(
            'H:i:s', 
            $this->appointment->appointment_time
        )->format('h:i A');

        // Get the order ID from the most recent payment (could be multiple retries)
        $payment = $this->appointment->payments()->latest()->first();
        $this->orderId = $payment ? $payment->razorpay_order_id : null;

        // Get contact details using ContactService
        $this->contactDetails = ContactService::getContactDetails();
    }
    public function cancelAndGoHome()
    {
        // Only update appointment status to failed when user explicitly cancels
        // This is different from payment failure - user is giving up on the appointment
        $this->appointment->update(['status' => 'pending']);
        
        // Update payment status to failed if exists
        $payment = $this->appointment->payments()->latest()->first();
        if ($payment) {
            $payment->update(['status' => 'failed']);
        }

        session()->flash('message', 'Appointment has been cancelled.');
        
        // Redirect to home page
        return redirect()->route('hero');
    }

    public function render()
    {
        return view('livewire.public.appointment.failed-appointment');
    }
}
