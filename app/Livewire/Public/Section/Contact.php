<?php

namespace App\Livewire\Public\Section;

use App\Services\ContactService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.public')]
#[Title('Contact Us')]
class Contact extends Component
{
    public function render()
    {
        return view('livewire.public.section.contact', [
            'contactDetails' => ContactService::getContactDetails()
        ]);
    }
}
