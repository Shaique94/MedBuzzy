<?php

namespace App\Livewire\Public\Appointment;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Book Appointment Slot')]
class BookSlot extends Component
{
    
    public function render()
    {
        return view('livewire.public.appointment.book-slot');
    }
}
