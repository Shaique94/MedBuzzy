<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Terms & Conditions')]
class TermsCondition extends Component
{
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.terms-condition');
    }
}
