{{-- <!DOCTYPE html>
<html>
<head>
    <title>Appointment Reminder</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Hello, Dr. {{ $doctor->user->name }}</h1>
    <p>Here are your appointments for tomorrow ({{ $appointments->first()->appointment_date->format('F j, Y') }}):</p>
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Time</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>{{ $appointment->notes ?? 'None' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Thank you,</p>
    <p>Your Clinic Team</p>
</body>
</html> --}}


<!DOCTYPE html>
<html>
<head>
    <title>Appointment Reminder</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Hello, Dr. {{ $doctor->user->name }}</h1>
    @if($appointments->isNotEmpty())
        <p>Here are your appointments for tomorrow ({{ $appointments->first()->appointment_date->format('F j, Y') }}):</p>
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    @if($appointment instanceof \App\Models\Appointment)
                        <tr>
                            <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                            <td>{{ $appointment->appointment_time ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') : 'N/A' }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td>{{ $appointment->notes ?? 'None' }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4">Invalid appointment data</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>No appointments scheduled for tomorrow.</p>
    @endif
    <p>Thank you,</p>
    <p>Your Clinic Team</p>
</body>
</html>