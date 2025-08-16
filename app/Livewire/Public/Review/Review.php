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
{
    public $doctor;
    public $doctor_id;
    public $rating = 5;
    public $comment;
    public $showModal = false;
    public $showLoginMessage = false;

    public function mount($doctor_id = null)
    {
        if ($doctor_id) {
            $this->doctor = Doctor::find($doctor_id);
        }
    }

    #[On('openReviewModal')] 
public function openReviewModal($doctorId)
{
    // Handle both array and direct ID cases
    $id = is_array($doctorId) ? $doctorId['doctorId'] : $doctorId;
    
    $this->doctor = Doctor::find($id);
    
    if ($this->doctor) {
        $this->showModal = true;
    } else {
        session()->flash('error', 'Doctor not found.');
    }
}

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
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

        $this->reset(['rating', 'comment', 'showModal']);
        session()->flash('message', 'Review submitted for admin approval!');
    }

    public function closeModal()
    {
        $this->reset(['showModal', 'showLoginMessage']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.review.review');
    }
}