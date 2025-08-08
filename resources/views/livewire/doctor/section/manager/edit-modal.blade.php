<div>
    @if($show)
        <div class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-md md:max-w-2xl rounded-lg relative mx-auto overflow-y-auto max-h-[90vh]">
                <!-- Error Message -->
                @error('updateError')
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <!-- Close Button -->
                <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Modal Content -->
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4">Edit Manager</h2>

                    <form wire:submit.prevent="updateManager">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <!-- Name -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Email -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="text" wire:model="phone" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Address -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <input type="text" wire:model="address" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Gender -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                <select wire:model="gender" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                                <input type="date" wire:model="dob" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                @error('dob') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Status -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select wire:model="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 text-sm md:text-base">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                            </div>

                            <!-- Photo -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                                <input type="file" wire:model="photo" class="w-full text-sm text-gray-500
                                    file:mr-3 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-medium
                                    file:bg-teal-50 file:text-teal-700
                                    hover:file:bg-teal-100">
                                @error('photo') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror

                                @if ($tempPhoto)
                                    <div class="mt-2 flex items-center">
                                        <span class="block text-xs text-gray-600 mr-2">Current Photo:</span>
                                        <img src="{{ $tempPhoto }}" alt="Current Photo" class="w-12 h-12 md:w-16 md:h-16 rounded-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Form buttons -->
                        <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 text-sm md:text-base">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm md:text-base">
                                Update Manager
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>