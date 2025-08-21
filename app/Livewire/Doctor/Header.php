<?php

namespace App\Livewire\Doctor;

use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public $doctorImage;
    public $userInitial;
    public $userId;
    
 public function mount()
{
    $user = auth()->user();
    $this->userId = $user->id;
    
    $result = User::join('doctors', 'users.id', '=', 'doctors.user_id')
                ->where('users.id', $user->id)
                ->select('users.name', 'doctors.image')
                ->first();
    
    $this->doctorImage = $result->image ?? null;
    $this->userInitial = $result ? substr($result->name, 0, 1) : 'U'; // Default to 'U' if no user
}
    
    public function render()
    {
        return view('livewire.doctor.header');
    }
}