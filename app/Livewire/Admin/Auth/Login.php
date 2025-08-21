<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;

#[Title('Login')]
class Login extends Component
{
    public $phone;
    public $password;
    public $otp;
    public $remember = false;
    public $showOtpField = false;
    public $otpCooldown = 0;
    public $otpCountdownActive = false;

    protected $rules = [
        'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
    ];

    protected $messages = [
        'phone.required' => 'The mobile number is required.',
        'phone.digits' => 'The mobile number must be 10 digits.',
        'phone.regex' => 'Please enter a valid Indian mobile number.',
        'password.required' => 'The password is required when not using OTP.',
        'password.min' => 'The password must be at least 8 characters.',
        'otp.required' => 'The OTP is required when not using password.',
        'otp.digits' => 'The OTP must be 6 digits.',
    ];

    // Changed: Added mount method to pre-fill phone number from session
  public function mount()
{
    $this->phone = session('phone', ''); // Pre-fill phone from session
    \Log::debug('Login mount: Session phone value', ['phone' => session('phone')]); // Debug session value
    
    if (!empty($this->phone)) {
        session()->flash('message', 'Phone number is pre-filled');
    }
}
    public function updatedShowOtpField($value)
    {
        if ($value) {
            $this->requestOtp();
        } else {
            // Reset OTP-related fields when switching back to password
            $this->otp = null;
            $this->otpCooldown = 0;
            $this->otpCountdownActive = false;
            $this->dispatch('stopOtpCountdown');
        }
    }

    public function login()
    {
        try {
            // Basic validation for phone
            $this->validate([
                'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
            ]);

            $user = \App\Models\User::where('phone', $this->phone)->first();

            if (!$user) {
                $this->addError('phone', 'The provided phone number does not match our records.');
                session()->flash('error', 'Invalid credentials. Please try again.');
                return;
            }

            // If OTP field is shown, validate OTP
            if ($this->showOtpField) {
                $this->validate([
                    'otp' => 'required|digits:6',
                ]);

                // Check if OTP is expired (30 minutes)
                if ($user->otp_generated_at && Carbon::parse($user->otp_generated_at)->addMinutes(30)->isPast()) {
                    $this->addError('otp', 'OTP has expired. Please request a new one.');
                    session()->flash('error', 'OTP has expired. Please request a new one.');
                    return;
                }

                if ($user->otp !== $this->otp) {
                    $this->addError('otp', 'Invalid OTP. Please try again.');
                    session()->flash('error', 'Invalid OTP. Please try again.');
                    return;
                }

                // OTP is valid, log in the user
                Auth::login($user, $this->remember);

                // Clear OTP after successful login
                $user->update([
                    'otp' => null,
                    'otp_generated_at' => null
                ]);

                // Reset countdown
                $this->otpCooldown = 0;
                $this->otpCountdownActive = false;
                $this->dispatch('stopOtpCountdown');

                session()->flash('success', 'Login successful! Welcome back, ' . $user->name . '.');
                return $this->redirectBasedOnRole($user);
            }
            // Otherwise validate password
            else {
                $this->validate([
                    'password' => 'required|min:8',
                ]);

                if (Auth::attempt(['email' => $user->email, 'password' => $this->password], $this->remember)) {
                    session()->flash('success', 'Login successful! Welcome back, ' . $user->name . '.');
                    return $this->redirectBasedOnRole($user);
                }

                $this->addError('password', 'The provided credentials do not match our records.');
                session()->flash('error', 'Invalid credentials. Please try again.');
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'Please check your input and try again.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred during login. Please try again.');
            \Log::error('Login error: ' . $e->getMessage());
        }
    }

    public function requestOtp()
    {
        $this->validate([
            'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
        ]);

        $user = \App\Models\User::where('phone', $this->phone)->first();

        if (!$user) {
            $this->addError('phone', 'The provided phone number does not match our records.');
            session()->flash('error', 'Invalid phone number. Please try again.');
            return;
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $generatedAt = now();

        // Save OTP to user
        $user->update([
            'otp' => $otp,
            'otp_generated_at' => $generatedAt,
        ]);

        // Send OTP via SMS
        $this->sendOtpSms($user->phone, $otp);

        // Start countdown (30 seconds)
        $this->startOtpCountdown();

        $this->showOtpField = true;
        session()->flash('info', 'An OTP has been sent to your phone. It will expire in 30 minutes.');
    }

    protected function sendOtpSms($phone, $otp)
    {
        try {
            $response = \Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://control.msg91.com/api/v5/otp', [
                'authkey' => env('MSG91_AUTH_KEY', '447174AqwGkJnLZ68a1b309P1'), // Changed: Use env variable for security
                'mobile' => '91' . $phone,
                'otp' => $otp,
                'template_id' => '68a177cd881d123fd120d945',
            ]);

            \Log::info('MSG91 OTP API Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful() && $response->json('type') === 'success') {
                return true;
            }

            return false;

        } catch (\Exception $e) {
            \Log::error('MSG91 OTP Exception: ' . $e->getMessage());
            return false;
        }
    }

    protected function startOtpCountdown()
    {
        $this->otpCooldown = 30;
        $this->otpCountdownActive = true;

        // Dispatch event to start client-side countdown
        $this->dispatch('startOtpCountdown');
    }

    public function decrementOtpCountdown()
    {
        if ($this->otpCountdownActive && $this->otpCooldown > 0) {
            $this->otpCooldown--;

            if ($this->otpCooldown <= 0) {
                $this->otpCountdownActive = false;
                $this->dispatch('stopOtpCountdown');
            }
        }
    }

    protected function redirectBasedOnRole($user)
    {
        return match ($user->role) {
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