<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ImageKitService; 

#[Title('Manage Doctors')]
class ListDoctor extends Component
{
    use WithPagination;

    public $search = '';

    #[On('refreshDoctorList')]
    public function refreshList()
    {
        // This will refresh the component
    }

    #[On('doctorCreated')]
    public function handleDoctorCreated()
    {
        $this->dispatch('success', __('Doctor created successfully and added to the list.'));
       
       
    }

    #[On('doctorUpdated')]
    public function handleDoctorUpdated()
    {
        $this->dispatch('success', __('Doctor updated successfully.'));
       
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        return redirect()->route('admin.doctors.create');
    }

    public function openUpdateModal($doctorId)
    {
        return redirect()->route('admin.doctors.edit', $doctorId);
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

            $this->dispatch('success', __('Doctor status updated successfully.'));
            $this->dispatch('refreshDoctorList');
        } catch (\Exception $e) {
            $this->dispatch('error', __('Error updating doctor status: ' . $e->getMessage()));
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
