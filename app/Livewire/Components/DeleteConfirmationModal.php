<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class DeleteConfirmationModal extends Component
{
    public $showModal = false;
    public $title = 'Confirm Deletion';
    public $message = 'Are you sure you want to delete this item? This action cannot be undone.';
    public $confirmText = 'Delete';
    public $cancelText = 'Cancel';
    public $itemName = '';
    public $itemType = 'item';
    public $deleteAction = '';
    public $itemId = null;

    protected $listeners = [
        'openDeleteModal' => 'openModal',
        'closeDeleteModal' => 'closeModal'
    ];

    public function openModal($data = [])
    {
        $this->showModal = true;
        
        // Set default values or override with provided data
        $this->title = $data['title'] ?? 'Confirm Deletion';
        $this->message = $data['message'] ?? 'Are you sure you want to delete this item? This action cannot be undone.';
        $this->confirmText = $data['confirmText'] ?? 'Delete';
        $this->cancelText = $data['cancelText'] ?? 'Cancel';
        $this->itemName = $data['itemName'] ?? '';
        $this->itemType = $data['itemType'] ?? 'item';
        $this->deleteAction = $data['deleteAction'] ?? '';
        $this->itemId = $data['itemId'] ?? null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['title', 'message', 'confirmText', 'cancelText', 'itemName', 'itemType', 'deleteAction', 'itemId']);
    }

    public function confirmDelete()
    {
        if ($this->deleteAction && $this->itemId) {
            // Dispatch the delete action to the parent component
            $this->dispatch($this->deleteAction, $this->itemId);
        }
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.components.delete-confirmation-modal');
    }
}
