<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Receipt - MedBuzzy</title>
</head>
<body>
<div>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            padding: 10px;
            font-size: 12px;
            line-height: 1.4;
            background: #f9fafb;
        }

        .box {
            border: 1px solid #0d9488;
            margin: 20px auto;
            max-width: 700px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header {
            padding: 15px;
            border-bottom: 2px solid #0d9488;
            background: #f0fdfa;
            text-align: center;
            position: relative;
        }

        .logo {
            width: 120px;
            height: 120px;
            border: 3px solid #0d9488;
            border-radius: 50%;
            margin: 0 auto 10px;
            object-fit: contain;
            display: block;
            background: white;
            padding: 10px;
        }

        .hospital-title h3 {
            color: #0d9488;
            font-size: 22px;
            font-weight: bold;
            margin: 5px 0;
        }

        .tagline {
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .appointment-status {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #dcfce7;
            color: #15803d;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #bbf7d0;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-cell {
            width: 50%;
            padding: 12px;
            vertical-align: top;
        }

        .border-right {
            border-right: 1px solid #ddd;
        }

        .info-group {
            margin-bottom: 8px;
        }

        .label {
            color: #666;
            font-size: 11px;
        }

        .value {
            font-weight: bold;
            color: #0d9488;
        }

        .footer {
            border-top: 1px solid #ddd;
            padding: 8px 12px;
            background: #f9fafb;
            font-size: 11px;
            text-align: center;
        }

        .instructions {
            border-top: 1px solid #ddd;
            padding: 10px 12px;
        }

        ul {
            margin: 5px 0;
            padding-left: 20px;
        }

        h3 {
            margin: 0 0 8px 0;
            font-size: 16px;
            color: #0d9488;
        }

        .queue-number {
            color: #0d9488;
            font-size: 28px;
            font-weight: bold;
            display: inline-block;
        }

        .action-buttons {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            border: none;
        }

        .btn-back {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-download {
            background: #0d9488;
            color: white;
        }

        .btn-print {
            background: #059669;
            color: white;
        }

        .btn svg {
            width: 16px;
            height: 16px;
            margin-right: 4px;
        }

        @media print {
            .action-buttons {
                display: none;
            }
            body {
                padding: 0;
                background: #fff;
            }
            .box {
                border: none;
                box-shadow: none;
            }
        }
    </style>

    @if ($appointment?->payment?->status == 'paid')
        <div class="watermark" style="position:fixed; top:50%; left:50%; transform:translate(-50%,-50%) rotate(-45deg); opacity:0.1; font-size:60px; color:#0d9488; font-weight:bold; z-index:-1;">PAID</div>
    @endif

    <div class="box">
        <div class="header">
            <div class="action-buttons">
                <a href="javascript:history.back()" class="btn btn-back">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
                <button onclick="window.print()" class="btn btn-print">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </button>
            </div>
            <div class="appointment-status">✓ Confirmed</div>
            <img src="/logo/logo.png" class="logo" alt="MedBuzzy Logo">
            <div class="hospital-title">
                <h3>MedBuzzy</h3>
                <div class="tagline">Your Trusted Healthcare Partner</div>
            </div>
            <div style="font-size:12px; color:#666;">Appointment ID: #{{ $appointment->appointment_no }}</div>
        </div>

        <table class="content-table">
            <tr>
                <td class="content-cell border-right">
                    <h3>Patient Info</h3>
                    <div class="info-group">
                        <div class="label">Full Name</div>
                        <div class="value">{{ $appointment->patient->name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Patient ID</div>
                        <div class="value">#{{ $appointment->patient->id }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Gender</div>
                        <div class="value">{{ ucfirst($appointment->patient->gender) }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Contact</div>
                        <div class="value">{{ $appointment->patient->phone }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Amount Paid</div>
                        <div class="value">₹{{ number_format($appointment->payment->amount ?? 0, 2) }} ({{ $appointment->payment->status ?? 'pending' }})</div>
                    </div>
                </td>
                <td class="content-cell">
                    <h3>Appointment Details</h3>
                    <div class="info-group">
                        <div class="label">Doctor</div>
                        <div class="value">{{ $appointment->doctor->user->name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Department</div>
                        <div class="value">{{ $appointment->doctor->department->name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Consultation Fee</div>
                        <div class="value">₹{{ number_format($appointment->doctor->fee ?? 0, 2) }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Date</div>
                        <div class="value">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Time</div>
                        <div class="value">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</div>
                    </div>
                    <div class="info-group">
                        <div class="label">Queue Number</div>
                        <div class="queue-number">#{{ str_pad($appointment->queue_number ?? 1, 3, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="instructions">
            <h3>Instructions</h3>
            <ul>
                <li>Arrive 15 minutes before your appointment.</li>
                <li>Bring this slip or digital receipt.</li>
                <li>Carry your medical records.</li>
                <li>Contact us 24 hours in advance for changes.</li>
            </ul>
        </div>

        <div class="footer">
            <strong>Contact:</strong> +91 9471659700 |
            <strong>Address:</strong> Hope Chauraha, Rambagh Road, Linebazar, Purnea 854301
        </div>
    </div>
</div>
</body>
</html>
