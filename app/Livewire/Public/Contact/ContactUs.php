<?php

namespace App\Livewire\Public\Contact;

use App\Services\ContactService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.public')]
#[Title('Contact Us')]
class ContactUs extends Component
{

 public $name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';

    public function submit()
    {
        // Validate the form data
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'subject' => 'required',
            'message' => 'required|min:10',
        ]);
        
        // Clear form after submission
        $this->reset();
        
        // Show success message
        session()->flash('message', 'Your message has been sent successfully!');
    }

    public function render()
    {
        return view('livewire.public.contact.contact-us', [
            'contactDetails' => ContactService::getContactDetails()
        ]);
    }
}
