<div class="max-w-4xl mx-auto p-3 sm:p-4 lg:p-6">
    <div class="bg-white rounded-lg lg:rounded-xl shadow-md overflow-hidden p-4 sm:p-5 lg:p-6">
        <!-- Header with Profile Picture -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 lg:mb-8 space-y-4 sm:space-y-0">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manager Profile</h1>
            <div class="relative flex justify-center sm:justify-end">
                @if($newImage)
                    <img src="{{ $newImage->temporaryUrl() }}" 
                         class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-2 border-teal-500">
                @elseif($manager->photo)
                    <img src="{{ $manager->photo }}?{{ $imageTimestamp ?? '' }}" 
                         class="w-16 h-16 sm:w-20 sm:h-20 rounded-full object-cover border-2 border-teal-500">
                @else
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 text-xl sm:text-2xl font-bold">
                        {{ substr($manager->user->name, 0, 1) }}
                    </div>
                @endif
                <label for="image-upload" class="absolute -bottom-1 -right-1 bg-teal-500 text-white p-1.5 sm:p-2 rounded-full cursor-pointer hover:bg-teal-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <input id="image-upload" type="file" wire:model="newImage" class="hidden" accept="image/*">
                </label>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-green-50 text-green-700 rounded-lg text-sm sm:text-base">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-4 sm:mb-6 p-3 sm:p-4 bg-red-50 text-red-700 rounded-lg text-sm sm:text-base">
                {{ session('error') }}
            </div>
        @endif

        <!-- Profile Form -->
        <form wire:submit.prevent="updateProfile">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Personal Information Header -->
                <div class="lg:col-span-2">
                    <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4 pb-2 border-b border-gray-200">Personal Information</h2>
                </div>

                <!-- Form Fields -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Full Name</label>
                    <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Phone</label>
                    <input type="text" wire:model="phone" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                    @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Gender</label>
                    <select wire:model="gender" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                        <option value="">Select Gender</option>
                        <option value="male" @selected($gender == 'male')>Male</option>
                        <option value="female" @selected($gender == 'female')>Female</option>
                        <option value="other" @selected($gender == 'other')>Other</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

             <div>
    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Date of Birth</label>
    <input type="date" 
           wire:model="dob" 
           value="{{ $dob }}" 
           class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
    @error('dob') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
</div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Status</label>
                    <select wire:model="status" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                        <option value="active" @selected($status == 'active')>Active</option>
                        <option value="inactive" @selected($status == 'inactive')>Inactive</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Address</label>
                    <textarea wire:model="address" rows="3" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base"></textarea>
                    @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Password Section -->
                <div class="lg:col-span-2 mt-4 sm:mt-6">
                    <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4 pb-2 border-b border-gray-200">Change Password</h2>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Current Password</label>
                            <input type="password" wire:model="current_password" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                            @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">New Password</label>
                            <input type="password" wire:model="new_password" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                            @error('new_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Confirm New Password</label>
                            <input type="password" wire:model="new_password_confirmation" class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 focus:ring-2 focus:ring-teal-500 text-sm sm:text-base">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" wire:click="updatePassword" class="w-full sm:w-auto px-4 py-2 sm:py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition text-sm sm:text-base">
                            Update Password
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3">
                <button type="button" wire:click="$dispatch('refresh-navigation')" class="w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base">
                    Cancel
                </button>
                <button type="submit" class="w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-2.5 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center justify-center text-sm sm:text-base">
                    <svg wire:loading wire:target="updateProfile" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>