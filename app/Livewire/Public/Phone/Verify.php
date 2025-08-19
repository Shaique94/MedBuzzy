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
    public $countdown = 0; // Start at 0, will be set when OTP is sent

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
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phone'
        ]);

        // Generate a random 6-digit code
        $this->generatedCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Send OTP via SMS
        $otpSent = $this->sendOtpSms($this->phone, $this->generatedCode);
        //  $otpSent = $this->generatedCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);


        if (!$otpSent) {
            $this->addError('phone', 'Failed to send OTP. Please try again.');
            return;
        }

        $this->otpSent = true;
        $this->showVerification = true;
        $this->countdown = 30; 
        $this->dispatch('start-countdown'); // Dispatch event for Alpine.js
    }

    public function editPhone()
    {
        // Reset verification-related properties to allow editing phone number
        $this->reset(['verificationCode', 'generatedCode', 'otpSent', 'showVerification', 'countdown']);
    }

    public function resendOtp()
    {
        if ($this->countdown > 0) {
            return;
        }

        $this->validate([
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phone'
        ]);

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
        $this->dispatch('start-countdown'); // Dispatch event for Alpine.js
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
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/|unique:users,phone'
        ]);

        // Store in database only after final submission
        $user = User::create([
            'phone' => $this->phone,
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('patient@123'),
        ]);

        Auth::login($user);
        \Log::info('User logged in', ['user_id' => $user->id]);
        session()->flash('message', 'Registration successful!');

        return redirect()->route('our-doctors');
    }

    public function ClosePhoneModal()
    {
        $this->reset();
        $this->showModal = false;
    }

    protected function sendOtpSms($phone, $otp)
    {
        try {
            $response = \Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://control.msg91.com/api/v5/otp', [
                        'authkey' => "447174AqwGkJnLZ68a1b309P1",
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
        // Real-time validation for phone and verification code
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