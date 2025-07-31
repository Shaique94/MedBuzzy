<?php

namespace App\Livewire\Public\Contact;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('Contact Us')]
class ContactUs extends Component
{
    public function render()
    {
        return view('livewire.public.contact.contact-us');
    }
}
