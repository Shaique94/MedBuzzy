<?php

namespace App\Livewire\Public;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Enquiry;
use App\Models\PhoneVerification; // Add this
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('MedBuzzy - Healthcare Management')]
class LandingPage extends Component
{
    public $doctors;
    public $departments;
    public $showModal = false;
    public $phone = '';
    public $verificationCode = '';
    public $showVerification = false;
    public $generatedCode = '';

    public function mount()
    {
        $this->loadDoctors();
        $this->departments = Department::where('status', true)->get();
    }

    protected function loadDoctors()
    {
        $this->doctors = Doctor::withCount(['reviews' => function($query) {
                $query->where('approved', true);
            }])
            ->withAvg(['reviews' => function($query) {
                $query->where('approved', true);
            }], 'rating')
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function showPhoneModal()
    {
        $this->showModal = true;
        // Notify the frontend via Livewire event (bridged to a DOM event in blade)
        $this->dispatch('phone-modal-opened');
    }

    public function ClosePhoneModal(){
        $this->showModal=false;
    }

    public function submitPhone()
    {
        $this->validate([
            'phone' => 'required|numeric|digits:10|regex:/^[6-9]\d{9}$/'
        ]);

        // Generate a random 4-digit code
        $this->generatedCode = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // In a real app, you would send this code via SMS here
        // For now, we'll just store it in session
        
        $this->showVerification = true;
    }

    public function verifyCode()
    {
        $this->validate([
            'verificationCode' => 'required|numeric|digits:4'
        ]);

        if ($this->verificationCode === $this->generatedCode) {
            // Store the phone verification
            Enquiry::create([
                'phone' => $this->phone,
                'is_verified' => true
            ]);

            // Redirect to doctors page (use Laravel redirect helper)
            return redirect()->route('our-doctors');
        } else {
            $this->addError('verificationCode', 'Invalid verification code');
        }
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.landing-page');
    }
}