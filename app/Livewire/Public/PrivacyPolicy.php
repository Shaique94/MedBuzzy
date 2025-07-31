<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Privacy Policy')]
class PrivacyPolicy extends Component
{
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.privacy-policy');
    }
}
