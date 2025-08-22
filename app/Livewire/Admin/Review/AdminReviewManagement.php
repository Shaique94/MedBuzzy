<?php

namespace App\Livewire\Admin\Review;

use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Review Management')]
class AdminReviewManagement extends Component
{
     public $pendingReviews;

     public $approvedReviews;

     public $perPage = 10;

    public function mount()
    {
        $this->loadReviews();
    }

      public function loadReviews()
    {
        $this->pendingReviews = Review::where('approved', false)
            ->with([ 'user:id,name'])
            ->latest()
            ->get();

            $this->approvedReviews = Review::where('approved', true)
            ->with(['user:id,name'])
            ->latest()
            ->get();

    }

    public function approve($reviewId){
        $review = Review::findOrFail($reviewId);
        $review->update(['approved' => true]);
        
        $this->loadReviews();
        $this->dispatch('success', __('Review approved successfully!'));

        // Dispatch global event to refresh all components showing doctor data
        $this->dispatch('doctor-review-updated', doctorId: $review->doctor_id);
    }

     public function reject($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $doctorId = $review->doctor_id;
        $review->delete();
        
        $this->loadReviews();
        $this->dispatch('notify', message: 'Review rejected and deleted.');
        
        // Dispatch global event to refresh all components showing doctor data
        $this->dispatch('doctor-review-updated', doctorId: $doctorId);
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.review.admin-review-management');
    }
}
