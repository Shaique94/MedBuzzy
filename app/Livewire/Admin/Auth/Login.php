<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember = false;

    public function login()
    {
        $data = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        //     return redirect()->route('admin.dashboard');
        // } else {
        //     session()->flash('error', 'Invalid email or password.');
        // }
        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard');
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
