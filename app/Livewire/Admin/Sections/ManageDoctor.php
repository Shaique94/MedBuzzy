<?php

namespace App\Livewire\Admin\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageDoctor extends Component
{

    #[Layout('layouts.admin')]

    public function render()
    {
        return view('livewire.admin.sections.manage-doctor');
    }
}
