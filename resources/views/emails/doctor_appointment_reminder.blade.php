{{-- @component('mail::message')
# Hello Dr. {{ $doctor->user->name }},

Here's a reminder of your appointments for tomorrow:

**Total Appointments:** {{ $appointments->count() }}

@component('mail::button', ['url' => route('doctor.dashboard')])
View Appointments
@endcomponent

A detailed schedule is attached as a PDF.

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Doctor Appointment Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Hello Dr. {{ $doctor->user->name }},</h2>

    <p>Here's a reminder of your appointments for tomorrow:</p>

    <p><strong>Total Appointments:</strong> {{ $appointments->count() }}</p>

    <p>
        <a href="{{ route('doctor.dashboard') }}" 
           style="display: inline-block; padding: 10px 20px; background: #3490dc; 
                  color: #fff; text-decoration: none; border-radius: 5px;">
           View Appointments
        </a>
    </p>

    <p>A detailed schedule is attached as a PDF.</p>

    <p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>
