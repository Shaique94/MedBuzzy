<?php

namespace App\Livewire\Doctor\Section\Manager;

use App\Models\Manager;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Manager List')]
class CreateManger extends Component
{
    use WithFileUploads, WithPagination;

    protected $listeners = ['refreshManagers' => '$refresh'];
 
    public $showForm = false;
    public $name, $email, $phone, $address, $gender, $dob, $status = 'active', $photo;
    public $manager_id;
    public $isEdit = false;

    // Store doctor ID to avoid repeated queries
    protected $doctorId;

    public function mount()
    {
        // Get doctor ID once
        $this->doctorId = auth()->user()->doctor->id;
    }

    #[Layout('layouts.doctor')]
    public function render()
    {
        $managers = Manager::with(['user:id,name,email']) // Only load needed user fields
            ->where('doctor_id', $this->doctorId)
            ->latest()
            ->paginate(10);

        return view('livewire.doctor.section.manager.manager-list', compact('managers'));
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'phone', 'address', 'gender', 'dob', 'photo', 'manager_id', 'isEdit', 'showForm']);
        $this->status = 'active';
    }
    
    public function delete($id)
    {
        $manager = Manager::with('user')->findOrFail($id);
        
        if ($manager->photo && Storage::disk('public')->exists($manager->photo)) {
            Storage::disk('public')->delete($manager->photo);
        }

        $manager->user->delete();
        $manager->delete();

        session()->flash('error', 'Manager deleted successfully!');
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->delete($id);
    }
}