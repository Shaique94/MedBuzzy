<?php

namespace App\Livewire\Public\Appointment;

use App\Models\Appointment;
use App\Models\Payment;
use App\Services\ContactService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Payment Failed')]
#[Layout('layouts.public')]
class FailedAppointment extends Component
{
    public Appointment $appointment;
    public $formattedTime;
    public $contactDetails;
    public $orderId;

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

        // Get contact details using ContactService
        $this->contactDetails = ContactService::getContactDetails();
        
        // Get order ID from the latest payment if available
        $latestPayment = $this->appointment->payments()->latest()->first();
        $this->orderId = $latestPayment ? $latestPayment->order_id : null;
    }

    public function retryPayment()
    {
        // Redirect back to payment page for retry
        return redirect()->route('appointment.payment', ['appointment' => $this->appointment->id]);
    }

    public function cancelAndGoHome()
    {
        // Update appointment status to cancelled when user explicitly cancels
        $this->appointment->update(['status' => 'cancelled']);
        
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
