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
    public $approvedReviews = []; 
    public $relatedDoctors = []; // Added property for related doctors

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
        
        // Load related doctors
        $this->loadRelatedDoctors();
    }
    
    public function loadRelatedDoctors()
    {
        if (!$this->doctor || !$this->doctor->department_id) {
            return;
        }
        
        $this->relatedDoctors = Doctor::where('department_id', $this->doctor->department_id)
            ->where('id', '!=', $this->doctor->id)
            ->with(['user', 'department'])
            ->withAvg(['reviews' => function($query) {
                $query->where('approved', true);
            }], 'rating')
            ->withCount(['reviews' => function($query) {
                $query->where('approved', true);
            }])
            ->limit(3)
            ->get();
            
        // If not enough related doctors in same department, get more doctors
        if ($this->relatedDoctors->count() < 3) {
            $additionalDoctors = Doctor::where('id', '!=', $this->doctor->id)
                ->whereNotIn('id', $this->relatedDoctors->pluck('id')->toArray())
                ->with(['user', 'department'])
                ->withAvg(['reviews' => function($query) {
                    $query->where('approved', true);
                }], 'rating')
                ->withCount(['reviews' => function($query) {
                    $query->where('approved', true);
                }])
                ->limit(3 - $this->relatedDoctors->count())
                ->get();
                
            $this->relatedDoctors = $this->relatedDoctors->merge($additionalDoctors);
        }
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

      public function getDynamicTitleProperty()
    {
        $qualification = $this->doctor->qualification ?? '';
        if (is_array($qualification)) {
            $qualification = implode(', ', $qualification);
        }
        return $this->doctor && $this->doctor->user ? 'Dr. ' . $this->doctor->user->name . ' | ' . $qualification : 'Doctor';
    }
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.our-doctors.view-doctor-detail', [
            'doctor' => $this->doctor,
            'approvedReviews' => $this->approvedReviews,
            'relatedDoctors' => $this->relatedDoctors
        ])->layoutData(['title' => $this->dynamicTitle]);
    }
}