<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Services\ImageKitService;

#[Title('Image Upload')]
class ImageUploader extends Component
{
    use WithFileUploads;

    public $image;
    public $uploadedImageUrl;
    public $uploadedImageId;
    public $fieldName; 

    public function uploadImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpg,jpeg,png,gif,webp,bmp,svg|max:10240', // 10MB Max
        ]);

        $imageKit = new ImageKitService();
        $response = $imageKit->upload(
            fopen($this->image->getRealPath(), 'r'),
            'image_' . time() . '.' . $this->image->getClientOriginalExtension()
        );

        $this->uploadedImageUrl = $response->success->url;
        $this->uploadedImageId = $response->success->fileId;
        
          $this->emitUp('imageUploaded', $this->uploadedImageUrl);
        session()->flash('message', 'Image uploaded successfully!');
    }

    public function deleteImage()
    {
        if ($this->uploadedImageId) {
            $imageKit = new ImageKitService();
            $imageKit->delete($this->uploadedImageId);
            
            $this->uploadedImageUrl = null;
            $this->uploadedImageId = null;
            
            session()->flash('message', 'Image deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.image-uploader');
    }
}

