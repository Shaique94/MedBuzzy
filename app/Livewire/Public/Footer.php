<?php

namespace App\Livewire\Public;

use App\Services\ContactService;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.public.footer', [
            'contactDetails' => ContactService::getContactDetails()
        ]);
    }
}
