<?php

namespace App\Livewire\Doctor;

use App\Models\Doctor;
use Livewire\Component;

class Sidebar extends Component
{
    public $doctor;
    public function mount(){
        $user = auth()->user();
        $this->doctor = Doctor::where('user_id', $user->id)->first();

        // dd($this->doctor);
    }
    public function render()
    {
        return view('livewire.doctor.sidebar');
    }
}
