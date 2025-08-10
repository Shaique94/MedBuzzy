<?php

namespace App\Livewire\Admin\Appointment;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Carbon\Carbon;

class EditModal extends Component
{
    public $showModal = false;
    public $appointmentId;
    public $appointment;
    
    // Patient fields
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $age;
    public $address;
    public $pincode;
    public $state = 'Bihar';
    public $country = 'India';
    
    // Appointment fields
    public $doctor_id;
    public $appointment_date;
    public $appointment_time;
    public $status;
    
    // Doctor availability
    public $doctors = [];
    public $selectedDoctor;
    public $doctorSchedule = [];
    public $availableSlots = [];

    #[On('openEditModal')]
    public function openModal($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $this->appointment = Appointment::with(['patient', 'doctor.user'])->find($appointmentId);
        
        if ($this->appointment) {
            // Load patient data
            $this->name = $this->appointment->patient->name;
            $this->email = $this->appointment->patient->email;
            $this->phone = $this->appointment->patient->phone;
            $this->gender = $this->appointment->patient->gender;
            $this->age = $this->appointment->patient->age;
            $this->address = $this->appointment->patient->address;
            $this->pincode = $this->appointment->patient->pincode;
            $this->state = $this->appointment->patient->state ?? 'Bihar';
            $this->country = $this->appointment->patient->country ?? 'India';
            
            // Load appointment data
            $this->doctor_id = $this->appointment->doctor_id;
            $this->appointment_date = $this->appointment->appointment_date;
            $this->appointment_time = $this->appointment->appointment_time;
            $this->status = $this->appointment->status;
            
            // Load doctors and time slots
            $this->loadDoctors();
            $this->loadDoctorSchedule();
        }
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset([
            'appointmentId', 'appointment', 'name', 'email', 'phone', 'gender', 'age', 
            'address', 'pincode', 'state', 'country', 'doctor_id', 'appointment_date', 
            'appointment_time', 'status', 'doctors', 'selectedDoctor', 'doctorSchedule', 'availableSlots'
        ]);
    }

    public function loadDoctors()
    {
        $this->doctors = Doctor::with(['user', 'department'])->get();
    }

    public function updatedDoctorId()
    {
        $this->loadDoctorSchedule();
    }

    public function updatedAppointmentDate()
    {
        $this->loadAvailableSlots();
    }

    public function loadDoctorSchedule()
    {
        if ($this->doctor_id) {
            $this->selectedDoctor = Doctor::find($this->doctor_id);
            $this->loadAvailableSlots();
        }
    }

    public function loadAvailableSlots()
    {
        if (!$this->doctor_id || !$this->appointment_date) {
            $this->availableSlots = [];
            return;
        }

        $date = Carbon::parse($this->appointment_date);
        $dayOfWeek = $date->format('l'); // Monday, Tuesday, etc.
        
        // Get doctor's working hours (you can customize this based on your doctor schedule table)
        $startTime = '09:00';
        $endTime = '17:00';
        $slotDuration = 30; // minutes
        
        // Get existing appointments for this doctor on this date
        $existingAppointments = Appointment::where('doctor_id', $this->doctor_id)
            ->where('appointment_date', $this->appointment_date)
            ->where('id', '!=', $this->appointmentId) // Exclude current appointment
            ->pluck('appointment_time')
            ->toArray();

        $slots = [];
        $currentTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        while ($currentTime->lt($endTime)) {
            $timeSlot = $currentTime->format('H:i');
            
            // Include slot if it's available or it's the current appointment's time
            if (!in_array($timeSlot, $existingAppointments) || $timeSlot === $this->appointment_time) {
                $slots[] = [
                    'time' => $timeSlot,
                    'formatted' => $currentTime->format('h:i A'),
                    'available' => true
                ];
            }
            
            $currentTime->addMinutes($slotDuration);
        }

        $this->availableSlots = $slots;
    }

    public function updateAppointment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
            'email' => 'nullable|email|max:255',
            'age' => 'nullable|numeric|min:0|max:150',
            'address' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'status' => 'required|in:pending,scheduled,completed,cancelled,checked_in'
        ]);

        try {
            \DB::beginTransaction();

            // Check if appointment slot is still available (exclude current appointment)
            $existingAppointment = Appointment::where('doctor_id', $this->doctor_id)
                ->where('appointment_date', $this->appointment_date)
                ->where('appointment_time', $this->appointment_time)
                ->where('id', '!=', $this->appointmentId)
                ->first();

            if ($existingAppointment) {
                session()->flash('error', 'Selected time slot is no longer available.');
                return;
            }

            // Update or create patient
            $patient = Patient::updateOrCreate(
                ['phone' => $this->phone],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'gender' => $this->gender,
                    'age' => $this->age,
                    'address' => $this->address,
                    'pincode' => $this->pincode,
                    'state' => $this->state,
                    'country' => $this->country,
                ]
            );

            // Create or update user account if email provided
            if (!empty($this->email)) {
                User::updateOrCreate(
                    ['email' => $this->email],
                    [
                        'name' => $this->name,
                        'phone' => $this->phone,
                        'email' => $this->email,
                        'password' => bcrypt('password123'), // Default password
                        'role' => 'patient'
                    ]
                );
            }

            // Update appointment
            $this->appointment->update([
                'patient_id' => $patient->id,
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'status' => $this->status,
            ]);

            \DB::commit();
            session()->flash('message', 'Appointment updated successfully!');
            $this->closeModal();
            $this->dispatch('appointmentUpdated');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Appointment update failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to update appointment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.appointment.edit-modal');
    }
}
