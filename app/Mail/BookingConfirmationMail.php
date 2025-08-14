<?php
namespace App\Mail;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;
    public $appointment;

    public function __construct(Patient $patient, Appointment $appointment)
    {
        $this->patient = $patient;
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->markdown('emails.booking-confirmation')
            ->subject('Your Booking Confirmation')
            ->with([
                'patient' => $this->patient,
                'booking' => $this->appointment,
            ]);
    }
}