<div>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Manage Doctors</h1>
            <button wire:click="$set('showModal', true)"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Add New Doctor
            </button>
        </div>

        <div class="p-4">
            <input type="text" placeholder="Search name or email..." wire:model.live="search"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Doctors Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Department</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Availability</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($doctors as $doctor)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            @if ($doctor->image)
                                                <img src="{{ $doctor->image }}" class="h-10 w-10 rounded-full">
                                            @else
                                                <span
                                                    class="text-blue-600 font-medium">{{ substr($doctor->user->name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $doctor->user->name }}
                                            </div>
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
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $doctor->department->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} -
                                        {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        @if (is_array($doctor->available_days))
                                            {{ implode(', ', $doctor->available_days) }}
                                        @else
                                            {{ $doctor->available_days }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $doctor->user->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $doctor->user->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div>
                                        <a wire:click="$dispatch('openModal',{id:{{$doctor->id}}})"
                                            class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                                    </div>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No doctors found. Add your first doctor to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $doctors->links() }}
                </div>
            </div>
        </div>

        <!-- Add Doctor Modal -->
        @if ($showModal)
            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Add
                                        New Doctor</h3>

                                    <!-- Add this near the top of your form -->
                                    @if (session()->has('error'))
                                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                                            <p>{{ session('error') }}</p>
                                        </div>
                                    @endif

                                    @if ($errors->has('saveError'))
                                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                                            <p>{{ $errors->first('saveError') }}</p>
                                        </div>
                                    @endif
                                    <form wire:submit.prevent="save" class="space-y-4">
                                        <!-- Personal Information Section -->
                                        <div class="border-b border-gray-200 pb-4">
                                            <h4 class="text-md font-medium text-gray-700 mb-3">Personal Information</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Full
                                                        Name</label>
                                                    <input type="text" wire:model="name"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('name')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                    <input type="email" wire:model="email"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('email')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone
                                                        Number</label>
                                                    <input type="tel" wire:model="phone"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('phone')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Qualifications</label>
                                                    <input type="text" wire:model="qualification"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                        placeholder="MD, MBBS, PhD (comma separated)">
                                                    <p class="mt-1 text-xs text-gray-500">Separate multiple
                                                        qualifications with commas</p>
                                                    @error('qualification')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Schedule Section -->
                                        <div class="border-b border-gray-200 pb-4">
                                            <h4 class="text-md font-medium text-gray-700 mb-3">Schedule Settings</h4>
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Available
                                                    Days</label>
                                                <div class="flex flex-wrap gap-3">
                                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                        <label class="inline-flex items-center">
                                                            <input type="checkbox"
                                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                                wire:model="available_days"
                                                                value="{{ $day }}">
                                                            <span
                                                                class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                                @error('available_days')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Start
                                                        Time</label>
                                                    <input type="time" wire:model="start_time"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('start_time')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">End
                                                        Time</label>
                                                    <input type="time" wire:model="end_time"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('end_time')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Slot
                                                        Duration</label>
                                                    <select wire:model="slot_duration_minutes"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                        <option value="15">15 minutes</option>
                                                        <option value="30">30 minutes</option>
                                                        <option value="45">45 minutes</option>
                                                        <option value="60">60 minutes</option>
                                                    </select>
                                                    @error('slot_duration_minutes')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Patients
                                                        Per Slot</label>
                                                    <input type="number" min="1" max="10"
                                                        wire:model="patients_per_slot"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('patients_per_slot')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">max_booking_days</label>
                                                    <input type="number" min="1" max="30"
                                                        wire:model="max_booking_days"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    @error('max_booking_days')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Professional Information Section -->
                                        <div class="border-b border-gray-200 pb-4">
                                            <h4 class="text-md font-medium text-gray-700 mb-3">Professional Information
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                                                    <select wire:model="department_id"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">
                                                                {{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 mb-1">Consultation
                                                        Fee</label>
                                                    <div class="relative rounded-md shadow-sm">
                                                        <div
                                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">$</span>
                                                        </div>
                                                        <input type="number" wire:model="fee"
                                                            class="block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="0.00">
                                                    </div>
                                                    @error('fee')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                <select wire:model="status"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                    <option value="">Select Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                    <option value="2">On Leave</option>
                                                </select>
                                                @error('status')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Photo and Security Section -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Photo Section -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Profile
                                                    Photo</label>
                                                <div class="mt-1 flex items-center">
                                                    <span
                                                        class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                                        @if ($photo)
                                                            <img src="{{ $photo->temporaryUrl() }}"
                                                                class="h-full w-full object-cover">
                                                        @elseif($imageUrl)
                                                            <img src="{{ $imageUrl }}"
                                                                class="h-full w-full object-cover">
                                                        @else
                                                            <svg class="h-full w-full text-gray-300"
                                                                fill="currentColor" viewBox="0 0 24 24">
                                                                <path
                                                                    d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                    <input type="file" wire:model="photo"
                                                        class="ml-5 block text-sm text-gray-500">
                                                </div>
                                                @error('photo')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror

                                                @if ($imageUrl)
                                                    <div class="mt-1 text-xs text-gray-500">
                                                        Image URL: {{ \Illuminate\Support\Str::limit($imageUrl, 50) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                                <input type="password" wire:model="password"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                @error('password')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div></div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                                    Password</label>
                                                <input type="password" wire:model="password_confirmation"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                @error('password_confirmation')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-6 flex justify-end space-x-3">
                                            <button type="button" wire:click="$set('showModal', false)"
                                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Save Doctor
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Place this at the bottom, outside the table and modal -->
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

        .border-b {
            border-bottom-width: 1px;
        }
    </style>
</div>
