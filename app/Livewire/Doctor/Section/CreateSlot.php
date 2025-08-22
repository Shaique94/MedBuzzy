<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Schedule Management')]
class CreateSlot extends Component
{
    public $showForm = false;
    public $start_time;
    public $end_time;
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $available_days = [];
    public $max_booking_days; 

    // Available days options
    public $daysOfWeek = [
        'Monday', 'Tuesday', 'Wednesday', 
        'Thursday', 'Friday', 'Saturday', 'Sunday'
    ];

    // Store the doctor instance to reuse
    public $doctor; // Changed from protected to public

    public function mount()
    {
        // Load doctor once and reuse
        $this->loadDoctor();
        
        if ($this->doctor) {
            $this->start_time = \Carbon\Carbon::parse($this->doctor->start_time)->format('H:i');
            $this->end_time = \Carbon\Carbon::parse($this->doctor->end_time)->format('H:i');
            $this->slot_duration_minutes = $this->doctor->slot_duration_minutes;
            $this->patients_per_slot = $this->doctor->patients_per_slot;
            $this->available_days = $this->doctor->available_days ?? [];
            $this->max_booking_days = $this->doctor->max_booking_days;
        }
    }

    public function save()
    {
        $this->validate([
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'available_days' => 'required|array|min:1',
            'max_booking_days' => 'required|integer|min:1|max:30'
        ]);

        // Use the already loaded doctor instance
        if ($this->doctor) {
            $this->doctor->update([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $this->patients_per_slot,
                'available_days' => $this->available_days,
                'max_booking_days' => $this->max_booking_days,
            ]);

            // Refresh the doctor data
            $this->doctor->refresh();
            
            session()->flash('success', 'Schedule updated successfully!');
        } else {
            session()->flash('error', 'Doctor record not found!');
        }

        $this->showForm = false;
    }

    #[Layout('layouts.doctor')]
    public function render()
    {
        // Reload doctor data to ensure we have the latest
        $this->loadDoctor();
        
        return view('livewire.doctor.section.create-slot', [
            'doctor' => $this->doctor,
        ]);
    }

    protected function loadDoctor()
    {
        // Load doctor only once
        if (!$this->doctor) {
            $this->doctor = Doctor::where('user_id', auth()->id())->first();
        }
        
        return $this->doctor;
    }
}