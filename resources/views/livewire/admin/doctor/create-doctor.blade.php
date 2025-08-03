<div>
    <!-- Enhanced Create Doctor Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-2 sm:p-4"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div
                class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full transform transition-all duration-300 max-h-[95vh] overflow-y-auto">
                <div class="px-4 py-4 sm:px-6 sm:py-5 lg:px-8 lg:py-6">
                    <div class="flex justify-between items-center mb-4 lg:mb-6">
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900">
                                <i class="fas fa-user-plus text-blue-500 mr-2"></i>
                                Create New Doctor
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">Add a new doctor to your medical practice</p>
                        </div>
                        <button wire:click="closeModal"
                            class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Success/Error Messages -->
                    @if (session()->has('message'))
                        <div
                            class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div
                            class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start">
                            <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <form wire:submit.prevent="save" class="space-y-4 lg:space-y-6">
                        <!-- Personal Information Section -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 lg:p-6 border border-blue-100">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-4">
                                <!-- Name -->
                                <div>
                                    <label for="name"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Full Name
                                        *</label>
                                    <input type="text" id="name" wire:model="name"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base"
                                        placeholder="Enter doctor's full name">
                                    @error('name')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Email Address
                                        *</label>
                                    <input type="email" id="email" wire:model="email"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base"
                                        placeholder="doctor@example.com">
                                    @error('email')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Phone Number
                                        *</label>
                                    <input type="tel" id="phone" wire:model="phone"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base"
                                        placeholder="+1 (555) 123-4567">
                                    @error('phone')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Qualification -->
                                <div>
                                    <label for="qualification"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Qualifications</label>
                                    <input type="text" id="qualification" wire:model="qualification"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base"
                                        placeholder="MBBS, MD (comma separated)">
                                    @error('qualification')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Gender *</label>
                                    <select id="gender" wire:model="gender"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="experience"
                                        class="block responsive-text-sm font-medium text-gray-700 mb-2">Experience
                                        (Years) *</label>
                                    <input type="number" id="experience" wire:model="experience" min="0"
                                        max="50"
                                        class="form-input w-full px-3 py-2 lg:px-4 lg:py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 responsive-text-base"
                                        placeholder="Years of experience">
                                    @error('experience')
                                        <span class="text-red-500 responsive-text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location Information Section -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Pincode -->
                                <div>
                                    <label for="pincode" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pincode *
                                        @if ($isProcessing)
                                            <span class="text-blue-500 text-xs">(verifying...)</span>
                                        @endif
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="pincode" wire:model.live.debounce.500ms="pincode"
                                            maxlength="6"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="123456" {{ $isProcessing ? 'disabled' : '' }}>
                                        @if ($isProcessing)
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                <svg class="animate-spin h-5 w-5 text-blue-500"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    @error('pincode')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City
                                        *</label>
                                    <input type="text" id="city" wire:model="city"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="City name" {{ $isProcessing ? 'disabled' : '' }}>
                                    @error('city')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State
                                        *</label>
                                    <input type="text" id="state" wire:model="state"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="State name" {{ $isProcessing ? 'disabled' : '' }}>
                                    @error('state')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information Section -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6" />
                                </svg>
                                Professional Information
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Department -->
                                <div>
                                    <label for="department_id"
                                        class="block text-sm font-medium text-gray-700 mb-2">Department *</label>
                                    <select id="department_id" wire:model="department_id"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Fee -->
                                <div>
                                    <label for="fee"
                                        class="block text-sm font-medium text-gray-700 mb-2">Consultation Fee *</label>
                                    <input type="number" id="fee" wire:model="fee" min="0"
                                        step="0.01"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="500.00">
                                    @error('fee')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status
                                        *</label>
                                    <select id="status" wire:model="status"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                        <option value="2">On Leave</option>
                                    </select>
                                    @error('status')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Schedule & Availability
                            </h4>

                            <!-- Available Days -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Available Days *</label>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-2">
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <label
                                            class="flex items-center space-x-2 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors duration-200 cursor-pointer">
                                            <input type="checkbox" wire:model="available_days"
                                                value="{{ $day }}"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="text-sm font-medium text-gray-700">{{ $day }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('available_days')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                                <!-- Start Time -->
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start
                                        Time *</label>
                                    <input type="time" id="start_time" wire:model="start_time"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('start_time')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- End Time -->
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">End
                                        Time *</label>
                                    <input type="time" id="end_time" wire:model="end_time"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('end_time')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slot Duration -->
                                <div>
                                    <label for="slot_duration_minutes"
                                        class="block text-sm font-medium text-gray-700 mb-2">Slot Duration (minutes)
                                        *</label>
                                    <input type="number" id="slot_duration_minutes"
                                        wire:model="slot_duration_minutes" min="5" max="120"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('slot_duration_minutes')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Patients Per Slot -->
                                <div>
                                    <label for="patients_per_slot"
                                        class="block text-sm font-medium text-gray-700 mb-2">Patients Per Slot
                                        *</label>
                                    <input type="number" id="patients_per_slot" wire:model="patients_per_slot"
                                        min="1" max="10"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('patients_per_slot')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Max Booking Days -->
                                <div>
                                    <label for="max_booking_days"
                                        class="block text-sm font-medium text-gray-700 mb-2">Max Booking Days *</label>
                                    <input type="number" id="max_booking_days" wire:model="max_booking_days"
                                        min="1" max="30"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('max_booking_days')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Photo and Security Section -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Photo & Security
                            </h4>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Photo Upload -->
                                <div class="lg:col-span-1">
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile
                                        Photo</label>
                                    <div class="flex items-center space-x-4">
                                        @if ($photo)
                                            <img src="{{ $photo->temporaryUrl() }}"
                                                class="h-20 w-20 rounded-full object-cover border-4 border-blue-100">
                                        @else
                                            <div
                                                class="h-20 w-20 rounded-full bg-gray-100 flex items-center justify-center">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <input type="file" id="photo" wire:model="photo" accept="image/*"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    </div>
                                    @error('photo')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Fields -->
                                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Password -->
                                    <div>
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                        <input type="password" id="password" wire:model="password"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="Enter password">
                                        @error('password')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 mb-2">Confirm Password
                                            *</label>
                                        <input type="password" id="password_confirmation"
                                            wire:model="password_confirmation"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="Confirm password">
                                        @error('password_confirmation')
                                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Form Actions -->
                        <div
                            class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 lg:pt-6 border-t border-gray-200">
                            <button type="button" wire:click="closeModal"
                                class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium responsive-text-base">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                            <button type="submit"
                                class="w-full sm:w-auto btn-primary px-6 py-3 rounded-xl font-medium flex items-center justify-center responsive-text-base text-white shadow-lg">
                                <svg wire:loading wire:target="save"
                                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span wire:loading.remove wire:target="save">
                                    <i class="fas fa-plus mr-2"></i>Create Doctor
                                </span>
                                <span wire:loading wire:target="save">Creating...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <style>
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(0.5);
            cursor: pointer;
        }

        input[type="time"]::-webkit-calendar-picker-indicator:hover {
            filter: invert(0.3);
        }

        /* Custom scrollbar for modal */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</div>
