<!DOCTYPE html>
<html>
<head>
    <title>Tomorrow's Appointments</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; }
        .header { 
            text-align: center; 
            margin-bottom: 30px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 20px;
        }
        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .doctor-info {
            margin: 15px 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-scheduled {
            background-color: #2ecc71;
            color: white;
        }
        .badge-rescheduled {
            background-color: #f39c12;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="clinic-name">{{ $clinicName }}</div>
        <h2>Appointments for {{ $date }}</h2>
        <div class="doctor-info">Dr. {{ $doctor->user->name }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Time</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->patient->name }}</td>
                <td>{{ Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                <td>{{ $appointment->patient->email ?? 'N/A' }}</td>
                <td>
                    <span class="badge badge-{{ $appointment->status }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </td>
                <td>{{ $appointment->notes ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px;">
                    No appointments scheduled for this date
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ $generatedAt }} | {{ $clinicName }}
    </div>
</body>
</html>