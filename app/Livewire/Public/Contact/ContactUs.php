<?php

namespace App\Livewire\Public\Contact;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ContactUs extends Component
{

    #[Layout('layouts.public')]

    public function render()
    {
        return view('livewire.public.contact.contact-us');
    }
}
