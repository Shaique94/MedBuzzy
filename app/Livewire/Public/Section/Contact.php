<?php

namespace App\Livewire\Public\Section;

use App\Models\Enquiry;
use App\Services\ContactService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.public')]
#[Title('Contact Us')]
class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    public function submit()
    {
        // Validate form data
        $validated = $this->validate([
            'name' => 'nullable|min:3',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|min:10',
        ]);

        // Save to database
        Enquiry::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message
        ]);

        // Clear form fields
        $this->reset([
            'name',
            'email',
            'phone',
            'message'
        ]);

        // Show success message
        session()->flash('success', 'Your enquiry has been submitted successfully! We will get back to you soon.');
    }

    public function render()
    {
        return view('livewire.public.section.contact', [
            'contactDetails' => ContactService::getContactDetails(),
        ]);
    }
}