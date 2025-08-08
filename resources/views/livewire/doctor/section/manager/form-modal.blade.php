<div>
    @if($show)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-2xl mx-auto rounded-lg shadow-xl relative max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="sticky top-0 bg-white p-6 pb-0 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Create New Manager</h2>
                        <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6">
                    <form wire:submit.prevent="saveManager">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Name -->
                            <div class="col-span-1 sm:col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" wire:model="name" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-1 sm:col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="email" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="text" wire:model="phone" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <input type="text" wire:model="address" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <select wire:model="gender" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Date of Birth -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                <input type="date" wire:model="dob" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                @error('dob') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model="status" 
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Photo -->
                            <div class="col-span-1 sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                
                                <!-- Show image preview if available -->
                                @if($photo)
                                    <div class="mb-2 flex items-center space-x-4">
                                        <img src="{{ $photo->temporaryUrl() }}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                                        <div wire:loading wire:target="photo" class="text-sm text-gray-500">
                                            Processing image...
                                        </div>
                                    </div>
                                @endif
                                
                                <input 
                                    type="file" 
                                    wire:model="photo" 
                                    accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
                                >
                                
                                @error('photo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                                
                                @if($imageUrl)
                                    <div class="mt-2 text-xs text-gray-500 truncate">
                                        Image URL: {{ $imageUrl }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Form buttons -->
                        <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                            <button type="button" wire:click="closeModal" 
                                class="px-4 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                                Cancel
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 flex items-center justify-center">
                                <span wire:loading.remove wire:target="saveManager">Create Manager</span>
                                <span wire:loading wire:target="saveManager" class="flex items-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @script
    <script>
        Livewire.on('open-manager-modal', () => {
            @this.openModal();
        });

        // Close modal when pressing escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                @this.closeModal();
            }
        });
    </script>
    @endscript
</div>