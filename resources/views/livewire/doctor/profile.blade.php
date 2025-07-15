<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded-xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600 bg-green-100 p-3 rounded">{{ session('message') }}</div>
    @endif

    {{-- Profile Update Form --}}
    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <!-- Profile Photo -->
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Photo</label>
            <div class="flex items-center mt-2">
                @if ($newImage)
                    <img src="{{ $newImage->temporaryUrl() }}" class="w-16 h-16 rounded-full object-cover mr-4">
                @elseif($doctor->image)
                    <img src="{{ asset('storage/' . $doctor->image) }}" class="w-16 h-16 rounded-full object-cover mr-4">
                @else
                    <div class="w-16 h-16 bg-gray-200 rounded-full mr-4"></div>
                @endif
                <input type="file" wire:model="newImage" class="text-sm">
            </div>
        </div>

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model.defer="name" class="mt-1 w-full border rounded px-3 py-2" />
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email (readonly) -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" value="{{ $doctor->user->email }}" readonly class="mt-1 w-full bg-gray-100 border rounded px-3 py-2 cursor-not-allowed" />
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" wire:model.defer="phone" class="mt-1 w-full border rounded px-3 py-2" />
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Fee -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Consultation Fee</label>
            <input type="number" wire:model.defer="fee" class="mt-1 w-full border rounded px-3 py-2" />
            @error('fee') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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

        <!-- Slot / Qualification -->
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Qualification -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Qualification (comma separated)</label>
        <input type="text" wire:model.defer="qualification" class="mt-1 w-full border rounded px-3 py-2" placeholder="MBBS, MD" />
        @error('qualification') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Slot Duration -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Slot Duration (mins)</label>
        <input type="number" wire:model.defer="slot_duration_minutes" class="mt-1 w-full border rounded px-3 py-2" />
        @error('slot_duration_minutes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Start Time -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Start Time</label>
        <input type="time" wire:model.defer="start_time" class="mt-1 w-full border rounded px-3 py-2" />
        @error('"start_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- End Time -->
    <div>
        <label class="block text-sm font-medium text-gray-700">End Time</label>
        <input type="time" wire:model.defer="end_time" class="mt-1 w-full border rounded px-3 py-2" />
        @error('end_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Patients Per Slot -->
    <div>
        <label class="block text-sm font-medium text-gray-700">Patients Per Slot</label>
        <input type="number" wire:model.defer="patients_per_slot" min="1" class="mt-1 w-full border rounded px-3 py-2" />
        @error('patients_per_slot') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>
</div>


        <!-- Submit -->
        <div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
                Save Changes
            </button>
        </div>
    </form>

    <hr class="my-10 border-t" />

    {{-- Password Update Form --}}
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Change Password</h2>

    <form wire:submit.prevent="updatePassword" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" wire:model.defer="current_password" class="mt-1 w-full border rounded px-3 py-2" />
            @error('current_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" wire:model.defer="new_password" class="mt-1 w-full border rounded px-3 py-2" />
            @error('new_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Confirm New Password</label>
          <input type="password" wire:model.defer="new_password_confirmation" class="mt-1 w-full border rounded px-3 py-2" />

        </div>

        <button type="submit" class="bg-indigo-600 text-white font-semibold px-4 py-2 rounded hover:bg-indigo-700">
            Update Password
        </button>
    </form>
</div>
