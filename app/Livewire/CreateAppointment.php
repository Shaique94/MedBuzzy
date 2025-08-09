<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Patient;
use Carbon\Carbon;

class CreateAppointment extends Component
{
    public $doctor_id;
    public $patient_id;
    public $appointment_date;
    public $appointment_time;
    public $notes;
    public $available_slots = [];

    public function updatedDoctorId($value)
    {
        $this->appointment_date = null;
        $this->appointment_time = null;
        $this->available_slots = [];

        if ($value) {
            $doctor = Doctor::find($value);
            if ($doctor) {
                $this->available_slots = $doctor->generateTimeSlots(Carbon::tomorrow('Asia/Kolkata')->toDateString());
            }
        }
    }

    public function updatedAppointmentDate($value)
    {
        $this->appointment_time = null;
        if ($this->doctor_id && $value) {
            $doctor = Doctor::find($this->doctor_id);
            $this->available_slots = $doctor->generateTimeSlots($value);
        }
    }

    public function save()
    {
        $this->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        $doctor = Doctor::find($this->doctor_id);
        $appointmentDate = Carbon::parse($this->appointment_date, 'Asia/Kolkata');

        // Validate doctor availability
        if (!$doctor->isAvailableOn($appointmentDate->dayOfWeekIso) || $doctor->isOnLeave($appointmentDate)) {
            $this->addError('appointment_date', 'Doctor is unavailable on this date.');
            return;
        }

        // Validate time slot
        $slots = $doctor->generateTimeSlots($this->appointment_date);
        $selectedSlot = collect($slots)->firstWhere('time_value', $this->appointment_time);
        if (!$selectedSlot || $selectedSlot['disabled']) {
            $this->addError('appointment_time', 'Invalid or unavailable time slot.');
            return;
        }

        \App\Models\Appointment::create([
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'status' => 'scheduled',
            'notes' => $this->notes,
            'created_by' => auth()->id(),
        ]);

        session()->flash('message', 'Appointment booked successfully.');
        $this->reset(['doctor_id', 'patient_id', 'appointment_date', 'appointment_time', 'notes']);
    }

    public function render()
    {
        return view('livewire.create-appointment', [
            'doctors' => Doctor::where('status', 1)->with('user')->get(),
            'patients' => Patient::all(),
        ]);
    }

}
