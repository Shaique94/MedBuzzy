<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ImageKitService; 

#[Title('Manage Doctors')]
class ListDoctor extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDelete = false;
    public $doctorIdToDelete = null;

    protected $listeners = [
        'refreshDoctorList' => '$refresh',
        'doctorCreated' => '$refresh',
        'doctorUpdated' => '$refresh'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->doctorIdToDelete = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->doctorIdToDelete = null;
    }

    public function delete()
    {
        if (!$this->doctorIdToDelete) {
            return;
        }

        try {
            $doctor = Doctor::findOrFail($this->doctorIdToDelete);
            $user = $doctor->user;

            // Delete image if exists
            if ($doctor->image_id) {
                $imageKit = new ImageKitService();
                $imageKit->delete($doctor->image_id);
            }

            $doctor->delete();
            $user->delete();

            session()->flash('message', 'Doctor deleted successfully.');
            
            $this->confirmingDelete = false;
            $this->doctorIdToDelete = null;
            
            $this->dispatch('refreshDoctorList');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting doctor: ' . $e->getMessage());
            $this->confirmingDelete = false;
            $this->doctorIdToDelete = null;
        }
    }

    public function openCreateModal()
    {
        $this->dispatch('openCreateModal');
    }

    public function openUpdateModal($doctorId)
    {
        $this->dispatch('openUpdateModal', $doctorId);
    }

    public function openViewModal($doctorId)
    {
        $this->dispatch('openViewModal', $doctorId);
    }

    public function toggleStatus($doctorId)
    {
        try {
            $doctor = Doctor::findOrFail($doctorId);
            $doctor->status = $doctor->status == 1 ? 0 : 1;
            $doctor->save();

            session()->flash('message', 'Doctor status updated successfully.');
            $this->dispatch('refreshDoctorList');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating doctor status: ' . $e->getMessage());
        }
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        $query = Doctor::with(['user', 'department'])->latest();

        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orWhereHas('department', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $doctors = $query->paginate(10);

        return view('livewire.admin.doctor.list-doctor', [
            'doctors' => $doctors,
        ]);
    }
}
