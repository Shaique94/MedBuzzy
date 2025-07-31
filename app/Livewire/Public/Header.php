<?php

namespace App\Livewire\Public;

use App\Services\ContactService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Header extends Component
{

    public function render()
    {
        return view('livewire.public.header', [
            'contactDetails' => ContactService::getContactDetails()
        ]);
    }
}
