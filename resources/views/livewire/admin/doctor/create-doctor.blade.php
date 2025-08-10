<div>
    <!-- Enhanced Create Doctor Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/80 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity duration-300 ease-in-out"
            aria-labelledby="modal-title" role="dialog" aria-modal="true"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <!-- Modal Container -->
            <div class="bg-white rounded-2xl shadow-xl max-w-4xl w-full transform transition-all duration-300 ease-out scale-95 max-h-[90vh] overflow-y-auto"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Modal Header -->
                <div class="sticky top-0 z-10 bg-white px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            Create New Doctor
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Fill in the details to add a new doctor</p>
                    </div>
                    <button wire:click="closeModal"
                        class="text-gray-400 hover:text-gray-500 p-1 rounded-full hover:bg-gray-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="px-6 py-4 sm:px-8 sm:py-6">
                    <!-- Success/Error Messages -->
                    @if (session()->has('message'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-start animate-fade-in">
                            <svg class="h-5 w-5 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div class="text-sm text-green-700">{{ session('message') }}</div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg flex items-start animate-fade-in">
                            <svg class="h-5 w-5 text-red-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-red-700">{{ session('error') }}</div>
                        </div>
                    @endif

                    <form wire:submit.prevent="save" class="space-y-6">
                        <!-- Personal Information Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Personal Information</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name -->
                                <div class="relative">
                                    <input type="text" id="name" wire:model="name"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Full Name">
                                    <label for="name"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Full Name *
                                    </label>
                                    @error('name')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="relative">
                                    <input type="email" id="email" wire:model="email"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Email Address">
                                    <label for="email"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Email Address *
                                    </label>
                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="relative">
                                    <input type="tel" id="phone" wire:model="phone"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Phone Number">
                                    <label for="phone"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Phone Number *
                                    </label>
                                    @error('phone')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Qualification -->
                                <div class="relative">
                                    <input type="text" id="qualification" wire:model="qualification"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Qualifications">
                                    <label for="qualification"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Qualifications
                                    </label>
                                    @error('qualification')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="relative">
                                    <select id="gender" wire:model="gender"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none bg-white">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <label for="gender"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Gender *
                                    </label>
                                    @error('gender')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Experience -->
                                <div class="relative">
                                    <input type="number" id="experience" wire:model="experience" min="0" max="50"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Experience (Years)">
                                    <label for="experience"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Experience (Years) *
                                    </label>
                                    @error('experience')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Location Information</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Pincode -->
                                <div class="relative">
                                    <input type="text" id="pincode" wire:model.live.debounce.500ms="pincode" maxlength="6"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Pincode" {{ $isProcessing ? 'disabled' : '' }}>
                                    <label for="pincode"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Pincode *
                                        @if ($isProcessing)
                                            <span class="text-blue-500 text-xs">(verifying...)</span>
                                        @endif
                                    </label>
                                    @if ($isProcessing)
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    @error('pincode')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="relative">
                                    <input type="text" id="city" wire:model="city"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="City" {{ $isProcessing ? 'disabled' : '' }}>
                                    <label for="city"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        City *
                                    </label>
                                    @error('city')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="relative">
                                    <input type="text" id="state" wire:model="state"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="State" {{ $isProcessing ? 'disabled' : '' }}>
                                    <label for="state"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        State *
                                    </label>
                                    @error('state')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Professional Information</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Department -->
                                <div class="relative">
                                    <select id="department_id" wire:model="department_id"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none bg-white">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="department_id"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Department *
                                    </label>
                                    @error('department_id')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fee -->
                                <div class="relative">
                                    <div class="flex items-center">
                                        <span class="absolute left-3 text-gray-400">₹</span>
                                        <input type="number" id="fee" wire:model="fee" min="0" step="0.01"
                                            class="peer w-full pl-8 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                            placeholder="Consultation Fee">
                                        <label for="fee"
                                            class="absolute left-8 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                            Consultation Fee *
                                        </label>
                                    </div>
                                    @error('fee')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="relative">
                                    <select id="status" wire:model="status"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 appearance-none bg-white">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        <option value="2">On Leave</option>
                                    </select>
                                    <label for="status"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Status *
                                    </label>
                                    @error('status')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                    <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Schedule & Availability</h4>
                            </div>

                            <!-- Available Days -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Available Days *</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2">
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <label class="flex items-center space-x-2 p-2 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 cursor-pointer has-[:checked]:bg-blue-50 has-[:checked]:border-blue-500">
                                            <input type="checkbox" wire:model="available_days" value="{{ $day }}"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="text-sm font-medium text-gray-700">{{ substr($day, 0, 3) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('available_days')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                                <!-- Start Time -->
                                <div class="relative">
                                    <input type="time" id="start_time" wire:model="start_time"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <label for="start_time"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Start Time *
                                    </label>
                                    @error('start_time')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- End Time -->
                                <div class="relative">
                                    <input type="time" id="end_time" wire:model="end_time"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    <label for="end_time"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        End Time *
                                    </label>
                                    @error('end_time')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slot Duration -->
                                <div class="relative">
                                    <input type="number" id="slot_duration_minutes" wire:model="slot_duration_minutes" min="5" max="120"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Slot Duration (minutes)">
                                    <label for="slot_duration_minutes"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Slot Duration (minutes) *
                                    </label>
                                    @error('slot_duration_minutes')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Patients Per Slot -->
                                <div class="relative">
                                    <input type="number" id="patients_per_slot" wire:model="patients_per_slot" min="1" max="10"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Patients Per Slot">
                                    <label for="patients_per_slot"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Patients Per Slot *
                                    </label>
                                    @error('patients_per_slot')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Max Booking Days -->
                                <div class="relative">
                                    <input type="number" id="max_booking_days" wire:model="max_booking_days" min="1" max="30"
                                        class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                        placeholder="Max Booking Days">
                                    <label for="max_booking_days"
                                        class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                        Max Booking Days *
                                    </label>
                                    @error('max_booking_days')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Photo and Security Section -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center mb-4">
                                <div class="bg-red-100 p-2 rounded-lg mr-3">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-800">Photo & Security</h4>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Photo Upload -->
                                <div class="lg:col-span-1">
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                                    <div class="flex items-center space-x-4">
                                        @if ($photo)
                                            <img src="{{ $photo->temporaryUrl() }}"
                                                class="h-24 w-24 rounded-full object-cover border-4 border-blue-100 shadow-md">
                                        @else
                                            <div class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center shadow-md">
                                                <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <input type="file" id="photo" wire:model="photo" accept="image/*"
                                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200">
                                            <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF (Max 2MB)</p>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Fields -->
                                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Password -->
                                    <div class="relative">
                                        <input type="password" id="password" wire:model="password"
                                            class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                            placeholder="Password">
                                        <label for="password"
                                            class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                            Password *
                                        </label>
                                        @error('password')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="relative">
                                        <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                            class="peer w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-transparent"
                                            placeholder="Confirm Password">
                                        <label for="password_confirmation"
                                            class="absolute left-3 -top-2.5 text-xs text-gray-500 bg-white px-1 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-sm peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-blue-600">
                                            Confirm Password *
                                        </label>
                                        @error('password_confirmation')
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                            <button type="button" wire:click="closeModal"
                                class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Cancel
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-medium flex items-center justify-center transition-all duration-200 shadow-sm hover:shadow-md hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="save">Create Doctor</span>
                                <span wire:loading wire:target="save">Creating...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <style>
        /* Custom Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }

        /* Custom Scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f3f5;
            border-radius: 12px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 12px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* Time Picker Styling */
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(0.6);
            cursor: pointer;
            transition: filter 0.2s;
        }

        input[type="time"]::-webkit-calendar-picker-indicator:hover {
            filter: invert(0.4);
        }

        /* Select Dropdown Arrow */
        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em;
        }

        /* Responsive Typography */
        @media (max-width: 640px) {
            .text-sm { font-size: 0.875rem; }
            .text-xl { font-size: 1.25rem; }
            .text-2xl { font-size: 1.5rem; }
        }
    </style>
</div>