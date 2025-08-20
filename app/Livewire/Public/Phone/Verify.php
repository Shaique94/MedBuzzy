<?php

namespace App\Livewire\Public\Phone;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Verify extends Component
{
    public $showModal = false;
    public $showVerification = false;
    public $submitFinalForm = false;
    public $phone = '';
    public $email = '';
    public $name = '';
    public $verificationCode = '';
    public $generatedCode = '';
    public $otpSent = false;
    public $countdown = 0;

    protected $listeners = ['open-phone-modal' => 'showPhoneModal'];

    public function showPhoneModal()
    {
        $this->showModal = true;
        $this->reset(['phone', 'verificationCode', 'generatedCode', 'otpSent', 'showVerification', 'submitFinalForm', 'countdown']);
        $this->dispatch('phone-modal-opened');
    }

    public function submitPhone()
    {
        $this->validate([
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/' // Removed 'unique:users,phone'
        ]);

        // Check if phone number already exists
        if (User::where('phone', $this->phone)->exists()) {
            session()->flash('phone', $this->phone); // Store phone in session for login page
            session()->flash('error', 'Phone number already registered. Please log in.'); // Inform user
            return redirect()->route('login'); // Redirect to login page
        }

        // Generate a random 6-digit code
        $this->generatedCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Send OTP via SMS
        $otpSent = $this->sendOtpSms($this->phone, $this->generatedCode);

        if (!$otpSent) {
            $this->addError('phone', 'Failed to send OTP. Please try again.');
            return;
        }

        $this->otpSent = true;
        $this->showVerification = true;
        $this->countdown = 30;
        $this->dispatch('start-countdown');
    }

    public function editPhone()
    {
        $this->reset(['verificationCode', 'generatedCode', 'otpSent', 'showVerification', 'countdown']);
    }

    public function resendOtp()
    {
        if ($this->countdown > 0) {
            return;
        }

        $this->validate([
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/' // Removed 'unique:users,phone'
        ]);

        // Check if phone number already exists
        if (User::where('phone', $this->phone)->exists()) {
            session()->flash('phone', $this->phone); // Store phone in session for login page
            session()->flash('error', 'Phone number already registered. Please log in.'); // Inform user
            return redirect()->route('login'); // Redirect to login page
        }

        // Generate a new 6-digit code
        $this->generatedCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Resend OTP
        $otpSent = $this->sendOtpSms($this->phone, $this->generatedCode);

        if (!$otpSent) {
            $this->addError('phone', 'Failed to resend OTP. Please try again.');
            return;
        }

        $this->otpSent = true;
        $this->countdown = 30;
        $this->dispatch('start-countdown');
    }

    public function verifyCode()
    {
        $this->validate([
            'verificationCode' => 'required|numeric|digits:6'
        ]);

        if ($this->verificationCode === $this->generatedCode) {
            $this->showVerification = false;
            $this->submitFinalForm = true;
        } else {
            $this->addError('verificationCode', 'Invalid verification code');
        }
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phone' // Kept unique rule here
        ]);

        $user = User::create([
            'phone' => $this->phone,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('patient@123'),
            'role' => 'patient'
        ]);

        Auth::login($user);
        \Log::info('User logged in', ['user_id' => $user->id]);
        session()->flash('message', 'Registration successful!');
        $this->dispatch('usercreated');
        return redirect()->route('our-doctors');
    }

    public function ClosePhoneModal()
    {
        $this->reset(['phone', 'verificationCode', 'generatedCode', 'otpSent', 'showVerification', 'submitFinalForm', 'countdown']);
        $this->showModal = false;
    }

    protected function sendOtpSms($phone, $otp)
    {
        try {
            $response = \Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://control.msg91.com/api/v5/otp', [
                'authkey' => env('MSG91_AUTH_KEY', '447174AqwGkJnLZ68a1b309P1'), // Use env variable
                'mobile' => '91' . $phone,
                'otp' => $otp,
                'template_id' => "68a177cd881d123fd120d945",
            ]);

            \Log::info('MSG91 OTP API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return $response->successful() && $response->json('type') === 'success';
        } catch (\Exception $e) {
            \Log::error('MSG91 OTP Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'phone') {
            $this->validateOnly('phone', [
                'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/'
            ]);
        }

        if ($propertyName === 'verificationCode') {
            $this->validateOnly('verificationCode', [
                'verificationCode' => 'required|numeric|digits:6'
            ]);
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.phone.verify');
    }
}