<?php

namespace App\Livewire\Public\Signup;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Session;

#[Title('Create Account')]
class Register extends Component
{
    #[Rule('required|min:3|max:255')]
    public $name = '';

    #[Rule('required|email|unique:users,email')]
    public $email = '';

    #[Rule('required|min:6')]
    public $password = '';

    #[Rule('required|same:password')]
    public $password_confirmation = '';

    #[Rule('nullable|string|max:20')]
    public $phone = '';

    #[Rule('nullable|string|in:male,female,other')]
    public $gender = '';


    public function mount()
    {
        // Retrieve doctor_slug from session or query parameter if available
        $this->doctor_slug = Session::get('doctor_slug');
    }
    public function register()
    {
        $validated = $this->validate();

        try {
            // Create the user
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'password' => Hash::make($this->password),
            ]);


            // Log in the user
            auth()->login($user);

            // Reset form fields
            $this->reset(['name', 'email', 'phone', 'gender', 'password']);
            // Redirect to appointment page if doctor_slug is available, otherwise to hero
            if ($this->doctor_slug) {
                return $this->redirect(route('appointment', ['doctor_slug' => $this->doctor_slug]), navigate: true);
            }
            $this->redirect(
                route('hero'),
                navigate:true
            );

        } catch (\Exception $e) {
            $this->addError('registration', 'Registration failed. Please try again.');
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.signup.register');
    }
}