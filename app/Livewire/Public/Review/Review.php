<?php

namespace App\Livewire\Public\Review;




use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Write Review')]
class Review extends Component
{ public $doctor;

    public $doctor_id;
    public $rating = 5;
    public $comment;
    public $showModal = false;
    public $showLoginMessage = false;

    public function mount($doctor_id = null)
    {
        if ($doctor_id) {
            $this->doctor = Doctor::findOrFail($doctor_id);
        }
    }

    #[On('reviewModal')] 
    public function reviewDetails($doctor_id)
    {
        $this->doctor = Doctor::findOrFail($doctor_id);
        $this->showModal = true;
    }

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|min:10',
    ];

    public function setRating($rating)
    {
        $this->rating = $rating;
    }
   
    public function submitReview()
    {
        if (!Auth::check()) {
            $this->showLoginMessage = true;
            return;
        }

        $this->validate();

         \App\Models\Review::create([
            'doctor_id' => $this->doctor->id,
            'user_id' => Auth::id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
            'approved' => false // Needs admin approval
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('message', 'Review submitted for admin approval!');
        $this->showModal = false;
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.review.review');
    }
}