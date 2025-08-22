@component('mail::message')
# appointment Confirmation

Dear {{ $patient->name }},

Your appointment has been confirmed for {{ $appointment->appointment_date }} at {{ $appointment->appointment_time }}.

@component('mail::button', ['url' => route('appointment.confirmation', $appointment->id)])
View Appointment
@endcomponent   

Thanks,
{{ config('app.name') }}
@endcomponent


{{-- @component('mail::message')
<style>
    body { font-family: Arial, sans-serif; color: #333; background-color: #f5f5f5; margin: 0; padding: 0; }
    .container { max-width: 600px; margin: 20px auto; background: #ffffff; border: 1px solid #ddd; border-radius: 6px; }
    .header { background: #4a90e2; color: #ffffff; padding: 15px; text-align: center; border-top-left-radius: 6px; border-top-right-radius: 6px; }
    .header h1 { margin: 0; font-size: 22px; }
    .content { padding: 20px; }
    .content table { width: 100%; border-collapse: collapse; }
    .content th, .content td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
    .content th { background: #f7f7f7; color: #555; font-weight: bold; }
    .content p { margin: 15px 0; line-height: 1.5; }
    .button { display: inline-block; padding: 10px 20px; background: #4a90e2; color: #ffffff !important; text-decoration: none; border-radius: 4px; font-weight: bold; }
    .storage-notice { background: #e8f0fe; padding: 10px; border-left: 4px solid #4a90e2; margin: 15px 0; }
    .footer { text-align: center; padding: 15px; font-size: 12px; color: #777; border-top: 1px solid #eee; }
</style>

<div class="container">
    <div class="header">
        <h1>Booking Confirmation</h1>
    </div>
    <div class="content">
        <p>Dear {{ $patient->name }},</p>
        <p>Your appointment has been successfully confirmed. Please find the details below:</p>

        <table>
            <tr>
                <th>Date</th>
                <td>{{ $booking->appointment_date }}</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>{{ $booking->appointment_time }}</td>
            </tr>
        </table>

        <p>Please arrive 10 minutes early to complete any necessary paperwork. If you need to reschedule or cancel, contact us at least 24 hours in advance.</p>

        <div class="storage-notice">
            <p><strong>Storage Information:</strong> Your appointment details are securely stored in our system. You can access or manage your booking anytime via your account.</p>
        </div>

        <p>We look forward to seeing you!</p>

        @component('mail::button', ['url' => route('appointment.confirmation', $booking->id), 'color' => 'primary'])
        View Appointment
        @endcomponent
    </div>
    <div class="footer">
        <p>Thank you for choosing {{ config('app.name') }}.</p>
        <p>Contact us at support@{{ config('app.name') }}.com for any questions.</p>
    </div>
</div>
@endcomponent --}}