<div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-xl border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200">Edit Profile</h2>

    @if (session()->has('message'))
        <div class="mb-6 p-4 text-green-700 bg-green-50 rounded-lg border border-green-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- Profile Update Form --}}
    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <!-- Profile Photo -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
            <div class="flex items-center">
                <div class="relative">
                    @if ($newImage)
                        <img src="{{ $newImage->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border-2 border-white shadow">
                    @elseif($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" class="w-20 h-20 rounded-full object-cover border-2 border-white shadow">
                    @else
                        <div class="w-20 h-20 bg-gray-200 rounded-full border-2 border-white shadow flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="ml-4">
                    <label class="cursor-pointer bg-white px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Change Photo
                        <input type="file" wire:model="newImage" class="sr-only">
                    </label>
                </div>
            </div>
        </div>

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" wire:model.defer="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
            @error('name') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Email (readonly) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="text" value="{{ $doctor->user->email }}" readonly class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm sm:text-sm cursor-not-allowed" />
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="text" wire:model.defer="phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
            @error('phone') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Fee -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">$</span>
                </div>
                <input type="number" wire:model.defer="fee" class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
            </div>
            @error('fee') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Slot / Qualification -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Qualification -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Qualifications</label>
                <input type="text" wire:model.defer="qualification" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="MBBS, MD, etc." />
                @error('qualification') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Slot Duration -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slot Duration (minutes)</label>
                <input type="number" wire:model.defer="slot_duration_minutes" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                @error('slot_duration_minutes') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

 <!-- Available Days -->
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700">Available Days</label>
            <div class="flex flex-wrap gap-4 mt-2">
                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="available_days" value="{{ $day }}" class="text-blue-600 rounded" />
                        <span>{{ $day }}</span>
                    </label>
                @endforeach
            </div>
        </div> --}}

            <!-- Start Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                <input type="time" wire:model.defer="start_time" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                @error('start_time') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- End Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                <input type="time" wire:model.defer="end_time" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                @error('end_time') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Patients Per Slot -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Patients Per Slot</label>
                <input type="number" wire:model.defer="patients_per_slot" min="1" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
                @error('patients_per_slot') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Save Changes
            </button>
        </div>
    </form>

    <hr class="my-10 border-t border-gray-200" />

    {{-- Password Update Form --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">Change Password</h2>

    <form wire:submit.prevent="updatePassword" class="space-y-6 max-w-lg">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
            <input type="password" wire:model.defer="current_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            @error('current_password') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input type="password" wire:model.defer="new_password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            @error('new_password') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
            <input type="password" wire:model.defer="new_password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
        </div>

        <div class="pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Password
            </button>
        </div>
    </form>
</div>








 