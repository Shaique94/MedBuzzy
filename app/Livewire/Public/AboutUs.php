<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About MedBuzzy')]
class AboutUs extends Component
{

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.about-us');
    }
}
