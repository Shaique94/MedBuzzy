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
    public $doctor;
    public $approvedReviews;
    public $countFeedback;
    public $averageRating;

    #[Layout('layouts.public')]
    public function mount($slug)
    {
        $this->doctor = Doctor::with(['user', 'department'])->where('slug', $slug)->firstOrFail();
        $this->loadDoctorAndReviews();
    }

    public function loadDoctorAndReviews()
    {
        // Load approved reviews for this specific doctor
        $this->approvedReviews = $this->doctor->reviews()
            ->where('approved', true)
            ->with(['user'])
            ->latest()
            ->get();

        $this->countFeedback = $this->approvedReviews->count();
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