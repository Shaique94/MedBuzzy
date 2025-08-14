<?php

namespace App\Livewire\Admin\Enquiry;

use App\Models\Enquiry;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Manage Enquiry')]
class EnquiryApproval extends Component
{
    use WithPagination;

    public $pendingEnquiries;
    public $approvedEnquiries;
    public $perPage = 10;
    public $sortField = 'is_read'; // Default sort by read status
    public $sortDirection = 'asc'; // Unread first

    public function mount()
    {
        $this->loadCounts();
    }

    public function loadCounts()
    {
        $this->pendingEnquiries = Enquiry::where('is_read', false)->count();
        $this->approvedEnquiries = Enquiry::where('is_read', true)->count();
    }

    public function markAsRead($enquiryId)
    {
        $enquiry = Enquiry::findOrFail($enquiryId);
        $enquiry->update(['is_read' => true]);
        $this->loadCounts();
        $this->dispatch('notify', message: 'Enquiry marked as read!');
        $this->dispatch('open-enquiry-modal', enquiryId: $enquiryId); 
        
        // Reset the page to keep the item visible after moving to bottom
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.enquiry.enquiry-approval', [
            'enquiries' => Enquiry::query()
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('created_at', 'desc') // Secondary sort by creation date
                ->paginate($this->perPage)
        ]);
    }
}