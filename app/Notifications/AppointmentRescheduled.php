<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentRescheduled extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The new appointment date
     * 
     * @var string
     */
    protected $newDate;

    /**
     * The original appointment date
     * 
     * @var string|null
     */
    protected $originalDate;

    /**
     * Create a new notification instance.
     *
     * @param string $newDate
     * @param string|null $originalDate
     */
    public function __construct($newDate, $originalDate = null)
    {
        $this->newDate = $newDate;
        $this->originalDate = $originalDate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage)
            ->subject('Appointment Rescheduled Notification')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your appointment has been rescheduled.');

        if ($this->originalDate) {
            $mailMessage->line('Originally scheduled for: ' . $this->originalDate);
        }

        return $mailMessage
            ->line('New appointment date: ' . $this->newDate)
            ->action('View Appointment Details', url('/appointments'))
            ->line('Please contact us if you need to make any changes.')
            ->salutation('Regards, Your Healthcare Team');
    }

    /**
     * Get the array representation of the notification (for database storage).
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'appointment_rescheduled',
            'message' => 'Your appointment has been rescheduled to ' . $this->newDate,
            'original_date' => $this->originalDate,
            'new_date' => $this->newDate,
            'action_url' => '/appointments',
        ];
    }
}