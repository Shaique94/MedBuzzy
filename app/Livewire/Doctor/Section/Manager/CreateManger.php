<?php

namespace App\Livewire\Doctor\Section\Manager;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreateManger extends Component
{

     use WithFileUploads;
 protected $listeners = ['refreshManagers' => '$refresh'];
 
    public $showForm = false;
    public $name, $email, $phone, $address, $gender, $dob, $status = 'active', $photo;
    public $manager_id;
    public $isEdit = false;

    #[Layout('layouts.doctor')]
    public function render()
    {
        $doctor = auth()->user()->doctor;

        $managers = Manager::with('user')
            ->where('doctor_id', $doctor->id)
            ->latest()
            ->paginate(10);

        return view('livewire.doctor.section.manager.manager-list', compact('managers'));
    }


    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->gender = '';
        $this->dob = '';
        $this->status = 'active';
        $this->photo = null;
        $this->manager_id = null;
        $this->isEdit = false;
        $this->showForm = false;
    }

    
    public function delete($id)
    {
        $manager = Manager::findOrFail($id);
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
