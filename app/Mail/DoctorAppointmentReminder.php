<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class DoctorAppointmentReminder extends Mailable
{
   use Queueable, SerializesModels;

    public $doctor;
    public $appointments;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct($doctor, $appointments, $pdf)
    {
        $this->doctor = $doctor;
        $this->appointments = $appointments;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $hasAppointments = $this->appointments->isNotEmpty(); 
        
        $subject = $hasAppointments
            ? "Tomorrow's Appointments - " . now()->format('M j')
            : "No Appointments Scheduled for Tomorrow";

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.doctor_appointment_reminder',
    //         with: [
    //             'doctor' => $this->doctor,
    //             'appointments' => $this->appointments
    //         ]
    //     );
    // }


    public function content(): Content
{
    return new Content(
        view: 'emails.doctor_appointment_reminder',
        with: [
            'doctor' => $this->doctor,
            'appointments' => $this->appointments,
            'clinicName' => config('app.name'),
            'date' => now()->addDay()->format('F j, Y'),
            'generatedAt' => now()->format('M j, Y g:i A'),
        ]
    );
}


    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        if ($this->appointments->isEmpty()) {
            return [];
        }

        return [
            Attachment::fromData(
                fn () => $this->pdf,
                'appointments_'.now()->format('Y-m-d').'.pdf'
            )->withMime('application/pdf'),
        ];
    }
}

