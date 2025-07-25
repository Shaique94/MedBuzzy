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

    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($data, $this->remember)) {
            $user = Auth::user();

            session()->flash('success', 'Login successful! Welcome back, ' . $user->name . '.');

            // Redirect based on role
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'doctor' => redirect()->route('doctor.dashboard'),
                'manager' => redirect()->route('manager.dashboard'),
                default => redirect()->route('hero') // Redirect regular users to home page
            };
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}