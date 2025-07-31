<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Doctor Profile')]
class ViewDoctorDetail extends Component
{
    public $doctor_id;
    public $doctor;
    public $approvedReviews;
    public $countFeedback;
    public $averageRating;

    #[Layout('layouts.public')]
    public function mount($doctor_id)
    {
        $this->doctor_id = $doctor_id;
        $this->loadDoctorAndReviews();
    }

    public function loadDoctorAndReviews()
    {
        // Load doctor with relationships
        $this->doctor = Doctor::with(['user', 'department'])->findOrFail($this->doctor_id);
        
        // Load approved reviews for this specific doctor
        $this->approvedReviews = Review::where('doctor_id', $this->doctor_id)
            ->where('approved', true)
            ->with(['user'])
            ->latest()
            ->get();
            
        // Count feedback for this doctor only
        $this->countFeedback = $this->approvedReviews->count();
        
        // Calculate average rating
        $this->averageRating = $this->approvedReviews->avg('rating') ?? 0;
    }

    public function render()
    {
        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
            'approvedReviews' => $this->approvedReviews,
            'countFeedback' => $this->countFeedback,
            'averageRating' => round($this->averageRating, 1)
        ]);
    }
}