<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use App\Models\DoctorReview;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ViewDoctorDetail extends Component
{
    public $doctor;
    public $doctorId;
    public $slug;
    public $averageRating = 0;
    public $countFeedback = 0;
    public $approvedReviews = []; // Add property for approved reviews

    public function mount($slug)
    {
        $this->slug = $slug;

        // Load doctor with detailed review data
        $this->doctor = Doctor::where('slug', $this->slug)
            ->with(['user', 'department', 'reviews' => function($query) {
                $query->where('approved', true)
                      ->with('user')
                      ->latest();
            }])
            ->firstOrFail();

        $this->doctorId = $this->doctor->id;

        // Get approved reviews
        $this->approvedReviews = $this->doctor->reviews()->where('approved', true)
            ->with('user')
            ->latest()
            ->get();

        // Calculate review metrics
        $this->calculateReviewMetrics();
    }

    public function calculateReviewMetrics()
    {
        $reviews = $this->doctor->reviews->where('approved', true);
        
        $this->countFeedback = $reviews->count();
        
        // Calculate average rating
        if ($this->countFeedback > 0) {
            $this->averageRating = $reviews->avg('rating');
        }
    }
    
    public function getListeners()
    {
        return [
            'reviewAdded' => 'refreshReviews',
        ];
    }
    
    public function refreshReviews()
    {
        // Reload doctor reviews when a new review is added
        $this->doctor->load(['reviews' => function($query) {
            $query->where('approved', true)
                  ->with('user')
                  ->latest();
        }]);
        
        // Update the approvedReviews collection
        $this->approvedReviews = $this->doctor->reviews()->where('approved', true)
            ->with('user')
            ->latest()
            ->get();
            
        $this->calculateReviewMetrics();
    }

    #[Layout('layouts.public')]
    #[Title('Doctor Details')]
    public function render()
    {
        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
            'approvedReviews' => $this->approvedReviews,
        ]);
    }
}