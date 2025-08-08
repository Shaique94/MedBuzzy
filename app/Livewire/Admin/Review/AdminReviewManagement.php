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
            ->with(['doctor', 'user'])
            ->latest()
            ->get();

            $this->approvedReviews = Review::where('approved', true)
            ->with(['doctor', 'user'])
            ->latest()
            ->get();

    }

    public function approve($reviewId){
        $review=Review::findOrFail($reviewId);
          $review->update(['approved' => true]);
           $this->loadReviews();
        $this->dispatch('notify', message: 'Review approved successfully!');
    }

     public function reject($reviewId)
    {
        Review::findOrFail($reviewId)->delete();
        $this->loadReviews();
        $this->dispatch('notify', message: 'Review rejected and deleted.');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.review.admin-review-management');
    }
}
