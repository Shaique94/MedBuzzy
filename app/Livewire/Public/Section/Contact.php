<?php

namespace App\Livewire\Public\Section;

use Livewire\Component;
use Livewire\Attributes\Layout;
 #[Layout('layouts.public')]
class Contact extends Component
{
    public function render()
    {
        return view('livewire.public.section.contact');
    }
}
