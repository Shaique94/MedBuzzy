<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.public')]
#[Title('About Us')]
class About extends Component
{
    public function render()
    {
        return view('livewire.public.section.about');
    }
}
