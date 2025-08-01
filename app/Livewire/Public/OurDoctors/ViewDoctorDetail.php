<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;

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
        $this->approvedReviews = $this->doctor->reviews()
            ->where('approved', true)
            ->with(['user'])
            ->latest()
            ->get();

        $this->countFeedback = $this->approvedReviews->count();
        $this->averageRating = $this->approvedReviews->avg('rating') ?? 0;
    }

    public function getDynamicTitleProperty()
    {
        return $this->doctor && $this->doctor->user 
            ? 'Dr. ' . $this->doctor->user->name . ' | ' . ($this->doctor->qualification ? implode(', ', $this->doctor->qualification) : '') 
            : 'Doctor';
    }

    public function render()
    {
        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
            'approvedReviews' => $this->approvedReviews,
            'countFeedback' => $this->countFeedback,
            'averageRating' => round($this->averageRating, 1),
        ])->layoutData(['title' => $this->dynamicTitle]);
    }
}