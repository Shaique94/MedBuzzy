<?php

namespace App\Livewire\Public;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LandingPage extends Component
{
    public $doctors;



    #[Layout('layouts.public')]
    public function render()
    {
        $this->doctors = Doctor::inRandomOrder()->limit(4)->get();
        return view('livewire.public.landing-page');
    }
}
