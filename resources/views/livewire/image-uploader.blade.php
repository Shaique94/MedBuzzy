<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(!$uploadedImageUrl)
        <input type="file" wire:model="image">
        <button wire:click="uploadImage" wire:loading.attr="disabled">
            Upload Image
        </button>
        @error('image') <span class="error">{{ $message }}</span> @enderror
    @else
        <div>
            <img src="{{ $uploadedImageUrl }}" style="max-width: 300px;">
            <button wire:click="deleteImage" wire:loading.attr="disabled">
                Delete Image
            </button>
        </div>
    @endif
</div>