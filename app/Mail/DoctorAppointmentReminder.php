<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Doctor;
use App\Models\Appointment;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DoctorAppointmentReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
   public $doctor;
    public $appointments;

    public function __construct(Doctor $doctor, Collection $appointments)
    {
        $this->doctor = $doctor;
        $this->appointments = $appointments;
    }

//  public function __construct(public int $doctorId, public int $appointmentId)
//     {
//         $this->doctor = Doctor::find($doctorId);
//         // $this->appointments = Appointment::find($appointmentId);
//         $this->appointments = collect([Appointment::find($appointmentId)]);

//     }



  public function build()
    {
        return $this->subject('Your Appointments for Tomorrow')
                    ->view('emails.doctor_appointment_reminder')
                    ->with([
                        'doctor' => $this->doctor,
                        'appointments' => $this->appointments,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Doctor Appointment Reminder',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}



