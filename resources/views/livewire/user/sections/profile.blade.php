<main class="flex-1 p-6 flex justify-center">
    <div class="max-w-4xl w-full p-6 sm:p-10 bg-white shadow-lg rounded-xl border border-gray-100">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b border-gray-200 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        Edit Profile
    </h2>

    @if (session('profile_message'))
        <div class="mb-6 p-4 text-green-700 bg-green-50 rounded-lg border border-green-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('profile_message') }}
        </div>
    @endif

    @if (session('profile_error'))
        <div class="mb-6 p-4 text-red-700 bg-red-50 rounded-lg border border-red-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            {{ session('profile_error') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <!-- Profile Photo -->
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
            <div class="flex items-center">
                <div class="relative">
                    @if ($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" 
                             class="w-20 h-20 rounded-full object-cover border-2 border-white shadow">
                    @elseif($user->profile_photo_path)
                        <img src="{{ Storage::url($user->profile_photo_path) }}" 
                             class="w-20 h-20 rounded-full object-cover border-2 border-white shadow">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-full border-2 border-white shadow flex items-center justify-center">
                            <span class="text-xl font-semibold text-gray-600">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="ml-4 space-x-2">
                    <label class="cursor-pointer bg-white px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Change Photo
                        <input type="file" wire:model="newImage" class="sr-only" accept="image/*">
                    </label>
                    @if($user->profile_photo_path)
                    <button type="button" wire:click="removeProfilePhoto" class="px-4 py-2 bg-red-50 text-red-600 rounded-md text-sm font-medium hover:bg-red-100">
                        Remove
                    </button>
                    @endif
                </div>
            </div>
            @error('newImage') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div> --}}

        <!-- Personal Information Section -->
        <div class="bg-gray-50 p-6 rounded-lg">
            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Personal Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" wire:model="name" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="John Doe">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" wire:model="email" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100"
                           placeholder="john@example.com" readonly>
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                    <input type="tel" wire:model="phone" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="+91 9876543210">
                    @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                    <select wire:model="gender" 
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                    @error('gender') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Date of Birth -->
                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" wire:model="date_of_birth" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('date_of_birth') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div> --}}

                <!-- Blood Group -->
                {{-- <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
                    <select wire:model="blood_group" 
                            class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    @error('blood_group') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div> --}}
            </div>
        </div>

        <!-- Address Information Section -->
        <div class="bg-blue-50 p-6 rounded-lg">
            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Address Information
            </h4>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Address -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                    <input type="text" wire:model="address" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="123 Main Street">
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">District *</label>
                    <input type="text" wire:model="district" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Mumbai">
                    @error('district') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- State -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                    <input type="text" wire:model="state" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Maharashtra">
                    @error('state') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                    <input type="text" wire:model="country" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="India">
                    @error('country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Pincode -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pincode *</label>
                    <input type="text" wire:model="pincode" 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="400001">
                    @error('pincode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            {{-- <button type="button" wire:click="$emit('closeModal')" 
                    class="px-6 py-2 text-gray-600 hover:text-gray-800 font-medium rounded-lg border border-gray-300 hover:bg-gray-50">
                Cancel
            </button> --}}
            
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition flex items-center"
                    wire:loading.attr="disabled">
                <svg wire:loading wire:target="updateProfile" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opadistrict-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opadistrict-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="updateProfile">
                    <svg class="w-4 h-4 mr-1 -ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </span>
                <span wire:loading wire:target="updateProfile">Saving...</span>
            </button>
        </div>
    </form>

    <hr class="my-8 border-t border-gray-200" />

    {{-- Password Update Form --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        Change Password
    </h2>

    @if (session('password_message'))
        <div class="mb-6 p-4 text-green-700 bg-green-50 rounded-lg border border-green-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('password_message') }}
        </div>
    @endif

    <form wire:submit.prevent="updatePassword" class="space-y-6 max-w-lg">
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Password *</label>
            <input type="password" wire:model.defer="current_password" 
                   class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Enter your current password"
                   autocomplete="current-password">
            <button type="button" 
                    class="absolute right-3 top-8 text-gray-500 hover:text-gray-700"
                    onclick="togglePasswordVisibility(this, 'current_password')">
                <i class="far fa-eye"></i>
            </button>
            @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password *</label>
            <input type="password" wire:model.defer="new_password" 
                   class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Enter new password"
                   autocomplete="new-password">
            <button type="button" 
                    class="absolute right-3 top-8 text-gray-500 hover:text-gray-700"
                    onclick="togglePasswordVisibility(this, 'new_password')">
                <i class="far fa-eye"></i>
            </button>
            @error('new_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password *</label>
            <input type="password" wire:model.defer="new_password_confirmation" 
                   class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   placeholder="Confirm new password"
                   autocomplete="new-password">
            <button type="button" 
                    class="absolute right-3 top-8 text-gray-500 hover:text-gray-700"
                    onclick="togglePasswordVisibility(this, 'new_password_confirmation')">
                <i class="far fa-eye"></i>
            </button>
        </div>

        <div class="pt-2">
            <button type="submit" 
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition flex items-center"
                    wire:loading.attr="disabled">
                <svg wire:loading wire:target="updatePassword" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opadistrict-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opadistrict-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="updatePassword">Update Password</span>
                <span wire:loading wire:target="updatePassword">Updating...</span>
            </button>
        </div>
    </form>
</div>
</main>

<script>
    function togglePasswordVisibility(button, fieldName) {
        const input = document.querySelector(`input[wire\\:model="` + fieldName + `"]`);
        const icon = button.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>