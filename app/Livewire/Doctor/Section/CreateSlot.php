<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

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

    public function mount()
    {
        // Load existing data if available
        $doctor = Doctor::where('user_id', auth()->id())->first();
        
        if ($doctor) {
             $this->start_time = \Carbon\Carbon::parse($doctor->start_time)->format('H:i');
        $this->end_time = \Carbon\Carbon::parse($doctor->end_time)->format('H:i');
            $this->slot_duration_minutes = $doctor->slot_duration_minutes;
            $this->patients_per_slot = $doctor->patients_per_slot;
            $this->available_days = $doctor->available_days ?? [];
            $this->max_booking_days = $doctor->max_booking_days;

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
            'max_booking_days'=>'required|integer|min:1|max:30'
        ]);

        $doctor = Doctor::where('user_id', auth()->id())->first();

        if ($doctor) {
            $doctor->update([
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'slot_duration_minutes' => $this->slot_duration_minutes,
                'patients_per_slot' => $this->patients_per_slot,
                'available_days' => $this->available_days,
                'max_booking_days' => $this->max_booking_days,

            ]);

            session()->flash('success', 'Schedule updated successfully!');
        } else {
            session()->flash('error', 'Doctor record not found!');
        }

        $this->showForm = false;
    }

    #[Layout('layouts.doctor')]
    public function render()
    {
        $doctor = Doctor::where('user_id', auth()->id())->first();
        return view('livewire.doctor.section.create-slot', [
            'doctor' => $doctor,
        ]);
    }
}