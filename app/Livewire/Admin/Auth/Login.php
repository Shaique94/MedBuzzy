<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{ 
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email|max:255',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'The email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'The password is required.',
        'password.min' => 'The password must be at least 8 characters.',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            session()->flash('success', 'Login successful! Welcome back, ' . $user->name . '.');

            return $this->redirectBasedOnRole($user);
        }

        $this->addError('password', 'The provided credentials do not match our records.');
        session()->flash('error', 'Invalid credentials. Please try again.');
    }

    protected function redirectBasedOnRole($user)
    {
        return match($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'manager' => redirect()->route('manager.dashboard'),
            default => redirect()->route('hero')
        };
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}