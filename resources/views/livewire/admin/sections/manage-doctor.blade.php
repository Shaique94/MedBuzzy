<div>
    <div class="container w-[380px] md:w-full mx-auto md:p-4  sm:py-8 md:py-10 max-w-7xl">
    <!-- Header Section -->
    <div class="flex flex-col  sm:flex-row justify-between items-center mb-6 sm:mb-8">
        <h1 class="text-2xl   sm:text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Manage Doctors</h1>
        <button wire:click="$set('showModal', true)" class="mt-4 sm:mt-0 flex items-center bg-blue-500 from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 sm:px-5 sm:py-3 rounded-xl font-medium shadow-md transition-all duration-300 transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Doctor
        </button>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" placeholder="Search by name or email..." wire:model.live="search" class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm">
            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Doctors Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Availability</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contact</th>
                        <th class="px-4 py-3 sm:px-6 sm:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($doctors as $doctor)
                    <tr class="hover:bg-gray-50 transition-all duration-200">
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    @if ($doctor->image)
                                        <img src="{{ $doctor->image }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <span class="text-blue-600 font-medium text-lg">{{ substr($doctor->user->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name }}</div>
                                    <div class="text-xs text-gray-500">
                                        @if (is_array($doctor->qualification))
                                            {{ implode(', ', $doctor->qualification) }}
                                        @else
                                            {{ $doctor->qualification }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                {{ $doctor->department->name }}
                            </span>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                @if (is_array($doctor->available_days))
                                    {{ implode(', ', $doctor->available_days) }}
                                @else
                                    {{ $doctor->available_days }}
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4">
                            <div class="text-sm text-gray-600">{{ $doctor->user->email }}</div>
                            <div class="text-sm text-gray-600">{{ $doctor->user->phone }}</div>
                        </td>
                        <td class="px-4 py-3 sm:px-6 sm:py-4 text-sm font-medium flex space-x-3">
                            <button wire:click="$dispatch('openModal',{id:{{$doctor->id}}})" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                            <button wire:click="delete({{ $doctor->id }})" class="flex items-center text-red-600 hover:text-red-800 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 sm:px-6 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-base sm:text-lg font-medium text-gray-700">No doctors found.</p>
                                <p class="text-sm text-gray-500 mt-1">Add a new doctor to get started</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between border-t border-gray-100">
            <div class="text-sm text-gray-600 mb-3 sm:mb-0">
                Showing <span class="font-medium">{{ $doctors->firstItem() }}</span> to <span class="font-medium">{{ $doctors->lastItem() }}</span> of <span class="font-medium">{{ $doctors->total() }}</span> results
            </div>
            <nav class="flex space-x-1" aria-label="Pagination">
                @if($doctors->onFirstPage())
                <span class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 bg-gray-50 text-gray-400 cursor-not-allowed">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                @else
                <button wire:click="previousPage" class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 bg-white text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                @endif

                @foreach($doctors->links()->elements[0] as $page => $url)
                @if($page == $doctors->currentPage())
                <span class="inline-flex items-center px-4 py-2 rounded-md border border-blue-500 bg-blue-50 text-blue-700 font-medium">
                    {{ $page }}
                </span>
                @else
                <button wire:click="gotoPage({{ $page }})" class="inline-flex items-center px-4 py-2 rounded-md border border-gray-200 bg-white text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    {{ $page }}
                </button>
                @endif
                @endforeach

                @if($doctors->hasMorePages())
                <button wire:click="nextPage" class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 bg-white text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                @else
                <span class="inline-flex items-center px-3 py-2 rounded-md border border-gray-200 bg-gray-50 text-gray-400 cursor-not-allowed">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                @endif
            </nav>
        </div>
    </div>

    <!-- Add/Edit Doctor Modal -->
    @if ($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full transform transition-all duration-300">
            <div class="px-6 py-5 sm:p-8">
                <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 mb-6">
                    {{ $doctorId ? 'Edit Doctor' : 'Add New Doctor' }}
                </h3>

                <!-- Error Messages -->
                @if (session()->has('error'))
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                    <p>{{ session('error') }}</p>
                </div>
                @endif
                @if ($errors->has('saveError'))
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                    <p>{{ $errors->first('saveError') }}</p>
                </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-6">
                    <!-- Personal Information Section -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" wire:model="name" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter full name">
                                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" wire:model="email" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter email">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="tel" wire:model="phone" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter phone number">
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Qualifications</label>
                                <input type="text" wire:model="qualification" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="MD, MBBS, PhD (comma separated)">
                                <p class="mt-1 text-xs text-gray-500">Separate multiple qualifications with commas</p>
                                @error('qualification') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Schedule Section -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Schedule Settings</h4>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Available Days</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-200 text-blue-600 focus:ring-blue-200" wire:model="available_days" value="{{ $day }}">
                                    <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                                </label>
                                @endforeach
                            </div>
                            @error('available_days') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                                <input type="time" wire:model="start_time" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                @error('start_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                                <input type="time" wire:model="end_time" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                @error('end_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Slot Duration</label>
                                <select wire:model="slot_duration_minutes" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="15">15 minutes</option>
                                    <option value="30">30 minutes</option>
                                    <option value="45">45 minutes</option>
                                    <option value="60">60 minutes</option>
                                </select>
                                @error('slot_duration_minutes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Patients Per Slot</label>
                                <input type="number" min="1" max="10" wire:model="patients_per_slot" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                @error('patients_per_slot') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Max Booking Days</label>
                                <input type="number" min="1" max="30" wire:model="max_booking_days" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                @error('max_booking_days') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information Section -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Professional Information</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                                <select wire:model="department_id" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                                    <input type="number" wire:model="fee" class="w-full pl-7 p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="0.00">
                                </div>
                                @error('fee') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model="status" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                <option value="2">On Leave</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Photo and Security Section -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Photo and Security</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                                <div class="flex items-center">
                                    <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                        @if ($photo)
                                            <img src="{{ $photo->temporaryUrl() }}" class="h-full w-full object-cover">
                                        @elseif($imageUrl)
                                            <img src="{{ $imageUrl }}" class="h-full w-full object-cover">
                                        @else
                                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        @endif
                                    </span>
                                    <input type="file" wire:model="photo" class="ml-5 block text-sm text-gray-500">
                                </div>
                                @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                @if ($imageUrl)
                                    <div class="mt-1 text-xs text-gray-500">Image URL: {{ \Illuminate\Support\Str::limit($imageUrl, 50) }}</div>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" wire:model="password" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter password">
                                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div></div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" wire:model="password_confirmation" class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Confirm password">
                                @error('password_confirmation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 font-medium shadow-md">
                            Save Doctor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <livewire:admin.sections.edit-doctor />
</div>

<style>
    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(0.5);
        cursor: pointer;
    }
    input[type="time"]::-webkit-calendar-picker-indicator:hover {
        filter: invert(0.3);
    }
</style>
</div>