<?php
namespace App\Livewire\Admin\Enquiry;

use App\Models\Enquiry;
use Livewire\Component;
use Livewire\Attributes\On;

class ShowEnquiry extends Component
{
    public $showModel = false;
    public $enquiryId;
    public $enquiry;

    #[On('open-enquiry-modal')]
    public function showModel($enquiryId)
    {
        $this->enquiryId = $enquiryId;
        $this->enquiry = Enquiry::findOrFail($enquiryId); // Fetch enquiry details
        $this->showModel = true;
    }

    public function closeModal()
    {
        $this->showModel = false;
        $this->enquiryId = null;
        $this->enquiry = null;
    }

    public function render()
    {
        return view('livewire.admin.enquiry.show-enquiry');
    }
}