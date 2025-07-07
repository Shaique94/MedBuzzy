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

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
            } elseif ($user->role === 'manager') {
                return redirect()->route('manager.dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['role' => 'Unauthorized role']);
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
