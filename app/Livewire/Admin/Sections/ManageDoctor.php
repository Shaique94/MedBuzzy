<?php

namespace App\Livewire\Admin\Sections;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageDoctor extends Component
{

    public function create(){
        
    }
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.manage-doctor');
    }
}
