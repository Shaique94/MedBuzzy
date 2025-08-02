<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Doctor Details')]
class ViewDoctor extends Component
{
    public $doctor;
    public $showModal = false;

    protected $listeners = ['openViewModal' => 'openModal'];

    public function openModal($doctorId)
    {
        $this->doctor = Doctor::with(['user', 'department', 'appointments' => function($query) {
            $query->latest()->take(5);
        }, 'reviews' => function($query) {
            $query->where('approved', true)->latest()->take(5);
        }])->findOrFail($doctorId);
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->doctor = null;
    }

    public function render()
    {
        return view('livewire.admin.doctor.view-doctor');
    }
}
