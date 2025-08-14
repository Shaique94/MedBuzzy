@component('mail::message')
# Booking Confirmation

Dear {{ $patient->name }},

Your appointment has been confirmed for {{ $booking->appointment_date }} at {{ $booking->appointment_time }}.

@component('mail::button', ['url' => route('appointment.confirmation', $booking->id)])
View Appointment
@endcomponent   

Thanks,
{{ config('app.name') }}
@endcomponent