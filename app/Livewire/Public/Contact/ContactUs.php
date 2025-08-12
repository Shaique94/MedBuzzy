<?php

namespace App\Livewire\Public\Contact;

use App\Models\Enquiry;
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
    public $message = '';

   public function submit()
{
    // Validate form data
    $validated = $this->validate([
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'message' => 'nullable|min:10',
    ]);

    // Save to database
    Enquiry::create($validated);

    // Clear form
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
