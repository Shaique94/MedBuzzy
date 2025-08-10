<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentReceiptController extends Controller
{
    public function view($appointment)
    {
        $appointment = Appointment::with(['doctor.user', 'doctor.department', 'patient', 'payment'])->findOrFail($appointment);
        
        return view('livewire.public.appointment.receipt', compact('appointment'));
    }

    public function download($appointment)
    {
        $appointment = Appointment::with(['doctor.user', 'doctor.department', 'patient', 'payment'])->findOrFail($appointment);

        $pdf = Pdf::loadView('livewire.public.appointment.receipt', compact('appointment'));

        return $pdf->download('appointment-receipt-' . $appointment->id . '.pdf');
    }
}
