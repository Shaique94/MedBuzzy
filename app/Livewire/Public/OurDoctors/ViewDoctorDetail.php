<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Doctor;
use App\Models\Review;
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
    public $ratingCounts = []; // count per star
    public $ratingPercentages = []; // percentage per star
    public $reviewsLimit = 3; // how many reviews to show initially
    public $showingAllReviews = false;

    public function mount($slug)
    {
        $this->slug = $slug;

        // Load doctor with detailed review data
                 $this->doctor = Doctor::where('slug', $this->slug)
                 ->with(['user:id,name', 'department:id,name,slug'])
                ->select(['id','user_id','department_id','slug','image','fee','review_avg','qualification','city','experience', 'available_days','start_time','end_time','slot_duration_minutes','languages_spoken','clinic_hospital_name','professional_bio','achievements_awards','social_media_links','use_day_specific_schedule','day_specific_schedule'])
            
            ->firstOrFail();

        $this->doctorId = $this->doctor->id;

        $this->approvedReviews = Review::where('doctor_id', $this->doctorId)
            ->where('approved', true)
            ->with('user:id,name')
            ->latest()
            ->limit($this->reviewsLimit)
            ->get();

        // Get total approved reviews count (lightweight scalar query)
        $this->countFeedback = Review::where('doctor_id', $this->doctorId)
            ->where('approved', true)
            ->count();

        // Calculate review metrics using precomputed column and distribution for bars
        $this->calculateReviewMetrics();

        // Compute full rating distribution for bar visualization
        $this->computeRatingDistributionExplicitly();
        
        // Load related doctors
        $this->loadRelatedDoctors();
    }
    
    public function loadRelatedDoctors()
    {
        if (!$this->doctor || !$this->doctor->department_id) {
            return;
        }
        
        // Prefer the precomputed review_avg column and avoid withCount subselects.
        $this->relatedDoctors = Doctor::where('department_id', $this->doctor->department_id)
            ->where('id', '!=', $this->doctor->id)
            ->select('id', 'user_id', 'department_id', 'slug', 'image', 'fee', 'review_avg')
            ->with(['user:id,name', 'department:id,name'])
            ->orderByDesc('review_avg')
            ->limit(3)
            ->get();
            
        // If not enough related doctors in same department, get more doctors ordered by review_avg
        if ($this->relatedDoctors->count() < 3) {
            $additionalDoctors = Doctor::where('id', '!=', $this->doctor->id)
                ->whereNotIn('id', $this->relatedDoctors->pluck('id')->toArray())
                ->select('id', 'user_id', 'department_id', 'slug', 'image', 'fee', 'review_avg')
                ->with(['user:id,name', 'department:id,name'])
                ->orderByDesc('review_avg')
                ->limit(3 - $this->relatedDoctors->count())
                ->get();
                
            $this->relatedDoctors = $this->relatedDoctors->merge($additionalDoctors);
        }
    }

    public function computeRatingDistribution()
    {
        // By default avoid running counts for faster page loads.
        // Use precomputed review_avg only. Leave distribution empty/zero to avoid heavy queries.
        $this->ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $this->ratingPercentages = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    }

    public function calculateReviewMetrics()
    {
        // Use precomputed review_avg column and the loaded total approved reviews count to display metrics
        $this->countFeedback = $this->countFeedback ?? Review::where('doctor_id', $this->doctorId)->where('approved', true)->count();

        // Use DB column review_avg when available, fallback to 0
        $this->averageRating = $this->doctor->review_avg !== null ? (float) $this->doctor->review_avg : 0.0;

        // ratingCounts and ratingPercentages are computed explicitly elsewhere for accuracy
    }
    
    public function getListeners()
    {
        return [
            'reviewAdded' => 'refreshReviews',
        ];
    }
    
    public function loadMoreReviews()
    {
        // Load more reviews (show all approved reviews up to a reasonable cap)
        $this->showingAllReviews = true;
        $this->reviewsLimit = 100; // cap to avoid fetching huge volumes

        $this->approvedReviews = Review::where('doctor_id', $this->doctorId)
            ->where('approved', true)
            ->with('user:id,name')
            ->latest()
            ->limit($this->reviewsLimit)
            ->get();

        // recompute metrics if needed
        $this->calculateReviewMetrics();
    }

    public function collapseReviews()
    {
        $this->showingAllReviews = false;
        $this->reviewsLimit = 3;

        $this->approvedReviews = Review::where('doctor_id', $this->doctorId)
            ->where('approved', true)
            ->with('user:id,name')
            ->latest()
            ->limit($this->reviewsLimit)
            ->get();
    }

    public function refreshReviews()
    {
        // Reload doctor with minimal columns and relations (avoid withCount)
        $this->doctor = Doctor::where('id', $this->doctorId)
            ->select(['id','user_id','department_id','slug','image','fee','review_avg','qualification','city','experience','available_days','start_time','end_time','use_day_specific_schedule','day_specific_schedule'])
            ->with(['user:id,name', 'department:id,name,slug'])
            ->first();
        
        // Reload a limited set of approved reviews for display with minimal user columns
        $this->approvedReviews = Review::where('doctor_id', $this->doctorId)
            ->where('approved', true)
            ->with('user:id,name')
            ->latest()
            ->limit($this->reviewsLimit)
            ->get();

        // Update total approved count
        $this->countFeedback = Review::where('doctor_id', $this->doctorId)->where('approved', true)->count();

        // Recompute distribution for bars
        $this->computeRatingDistributionExplicitly();
            
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
      
      /**
       * Explicitly compute rating distribution (runs a DB grouped query).
       * Call this only if distribution is required (deferred / on-demand) to avoid slowing initial load.
       */
      public function computeRatingDistributionExplicitly()
      {
          $raw = Review::where('doctor_id', $this->doctorId)
              ->where('approved', true)
              ->selectRaw('rating, count(*) as count')
              ->groupBy('rating')
              ->pluck('count', 'rating')
              ->toArray();

          $this->ratingCounts = [];
          $this->ratingPercentages = [];

          $total = array_sum($raw);

          for ($i = 1; $i <= 5; $i++) {
              $count = isset($raw[$i]) ? (int) $raw[$i] : 0;
              $this->ratingCounts[$i] = $count;
              $this->ratingPercentages[$i] = $total > 0 ? ($count / $total) * 100 : 0;
          }
      }
}