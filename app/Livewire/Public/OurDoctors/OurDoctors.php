<?php

namespace App\Livewire\Public\OurDoctors;

use Livewire\Attributes\Layout;
use Livewire\Component;

class OurDoctors extends Component
{
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.our-doctors.our-doctors');
    }
}
