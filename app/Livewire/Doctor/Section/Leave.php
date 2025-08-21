<?php

namespace App\Livewire\Doctor\Section;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Leave Management')]
class Leave extends Component
{
    public $from_date;
    public $to_date;
    public $doctor;

    public function mount()
    {
        $this->loadDoctor();
        $this->from_date = $this->doctor->unavailable_from ?? null;
        $this->to_date = $this->doctor->unavailable_to ?? null;
    }

    public function save()
    {
        $this->validate([
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);
        
        $this->doctor->update([
            'unavailable_from' => $this->from_date,
            'unavailable_to' => $this->to_date,
        ]);

        session()->flash('success', 'Leave updated successfully.');

        // Just reset the form fields, don't call mount() again
        $this->reset(['from_date', 'to_date']);
        
        // Reload the doctor data to reflect changes
        $this->loadDoctor();
    }

    #[Layout('layouts.doctor')]
    public function render()
    {
        return view('livewire.doctor.section.leave');
    }

    protected function loadDoctor()
    {
        // Load doctor only once and reuse
        if (!$this->doctor) {
            $this->doctor = Doctor::where('user_id', Auth::id())->first();
        }
        return $this->doctor;
    }
}