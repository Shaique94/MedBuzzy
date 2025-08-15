<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Title('Login')]
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
        try {
            $this->validate();

            $credentials = [
                'email' => $this->email,
                'password' => $this->password,
            ];

            if (Auth::attempt($credentials, $this->remember)) {
                $user = Auth::user();

                session()->flash('success', 'Login successful! Welcome back, ' . $user->name . '.');
                // Check if there's a stored doctor_slug to redirect to appointment
                $doctorSlug = Session::get('doctor_slug');
                if ($doctorSlug) {
                    Session::forget('doctor_slug'); // Clear after use
                    return $this->redirect(route('appointment', ['doctor_slug' => $doctorSlug]), navigate: true);
                }

                return $this->redirectBasedOnRole($user);
            }

            $this->addError('password', 'The provided credentials do not match our records.');
            session()->flash('error', 'Invalid credentials. Please try again.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors gracefully
            session()->flash('error', 'Please check your input and try again.');
        } catch (\Exception $e) {
            // Handle any other exceptions
            session()->flash('error', 'An error occurred during login. Please try again.');
            \Log::error('Login error: ' . $e->getMessage());
        }
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