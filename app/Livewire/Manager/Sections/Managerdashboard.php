<?php

namespace App\Livewire\Manager\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Managerdashboard extends Component
{
        #[Layout('layouts.manager')]

    public function render()
    {
        return view('livewire.manager.sections.managerdashboard');
    }
}
