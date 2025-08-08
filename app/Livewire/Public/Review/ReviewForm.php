<?php

namespace App\Livewire\Public\Review;

use App\Models\DoctorReview;
use Livewire\Component;

class ReviewForm extends Component
{
    public $doctorId;
    public $rating = 0;
    public $comment = '';
    
    protected $listeners = ['openReviewModal'];
    
    protected $rules = [
        'doctorId' => 'required|exists:doctors,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|min:10|max:500',
    ];
    
    protected $messages = [
        'rating.required' => 'Please select a rating.',
        'rating.min' => 'Please select a rating.',
        'comment.required' => 'Please write a review.',
        'comment.min' => 'Your review must be at least 10 characters.',
    ];
    
    public function openReviewModal($data)
    {
        $this->doctorId = $data['doctorId'];
        $this->resetExcept('doctorId');
        $this->resetValidation();
    }
    
    public function saveReview()
    {
        $this->validate();
        
        // Check if user has already reviewed this doctor
        $existingReview = DoctorReview::where('doctor_id', $this->doctorId)
            ->where('user_id', auth()->id())
            ->first();
            
        if ($existingReview) {
            // Update existing review
            $existingReview->update([
                'rating' => $this->rating,
                'comment' => $this->comment,
                'approved' => false, // Set to false to require re-approval
            ]);
            
            $message = 'Your review has been updated and will be visible after approval.';
        } else {
            // Create new review
            DoctorReview::create([
                'doctor_id' => $this->doctorId,
                'user_id' => auth()->id(),
                'rating' => $this->rating,
                'comment' => $this->comment,
                'approved' => false, // Require approval for new reviews
            ]);
            
            $message = 'Thank you for your review! It will be visible after approval.';
        }
        
        $this->dispatch('reviewAdded');
        $this->dispatch('notify', ['type' => 'success', 'message' => $message]);
        
        // Reset form and close modal
        $this->reset(['rating', 'comment']);
        $this->js('document.querySelector(\'[x-data]\')._x_dataStack[0].showModal = false');
    }
    
    public function render()
    {
        return view('livewire.public.review.review-form');
    }
}
