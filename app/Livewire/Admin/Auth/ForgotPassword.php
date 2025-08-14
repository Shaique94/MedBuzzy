<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email;
    public $emailSent = false;
    public $status;

    protected $rules = [
        'email' => 'required|email|exists:users,email'
    ];
    
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.admin.auth.forgot-password');
    }

    public function sendResetLink()
    {
        $this->validate();

       $status = Password::sendResetLink(
            ['email' => $this->email]
           
        );


        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSent = true;
            $this->error = null;
        } else {
            $this->error = __($status);
        }
    }
}