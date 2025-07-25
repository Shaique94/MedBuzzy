<?php

namespace App\Livewire\Public\Review;




use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Review extends Component
{
    public $doctor;
    public $rating = 5;
    public $comment;

    public $showModal = false;


    public $doctor_id=8;
    public $showLoginMessage = false;

    #[On('reviewModal')] 
    public function reviewDetails(){

        $this->showModal=true;

    }

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|min:10',
    ];

    public function setRating($rating)
    {
        $this->rating = $rating;
    }
    // public function mount($doctor)
    // {
    //     $this->doctor = $doctor;
    // }

    public function submitReview()
    {
        // if (!Auth::check()) {
        //     $this->showLoginMessage = true;
        //     return;
        // }

        $this->validate();
          
        \App\Models\Review::create([
            'doctor_id' => $this->doctor_id, // Add this line
            // 'user_id' => Auth::id(),
            'user_id'=>2,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'approved' => false // Needs admin approval
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('message', 'Review submitted for admin approval!');
    }
    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.review.review');
    }
}
