<div class="min-h-screen bg-gray-50 py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6 bg-white rounded-lg p-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center mb-2">
                        <svg class="w-7 h-7 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd" />
                        </svg>
                        Update Doctor
                    </h1>
                    <p class="text-gray-600">Update doctor information and settings</p>
                </div>
                <a href="{{ route('admin.doctors.list') }}"
                    class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('success'))
            <div
                class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start animate-fade-in">
                <svg class="h-5 w-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if (session()->has('error'))
            <div
                class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start animate-fade-in">
                <svg class="h-5 w-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="font-medium mb-2">Please correct the following errors:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="updateDoctor" class="space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Personal Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" wire:model="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-300 @enderror"
                            placeholder="Enter doctor's full name">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" wire:model="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-300 @enderror"
                            placeholder="doctor@example.com">
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="space-y-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="phone" wire:model="phone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('phone') border-red-300 @enderror"
                            placeholder="9876543210">
                        @error('phone')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="space-y-2">
                        <label for="gender" class="block text-sm font-medium text-gray-700">
                            Gender <span class="text-red-500">*</span>
                        </label>
                        <select id="gender" wire:model="gender"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('gender') border-red-300 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Location Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Pincode -->
                    <div class="space-y-2">
                        <label for="pincode" class="block text-sm font-medium text-gray-700">
                            Pincode <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="pincode" wire:model.lazy="pincode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('pincode') border-red-300 @enderror"
                            placeholder="123456" maxlength="6">
                        @error('pincode')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="space-y-2">
                        <label for="city" class="block text-sm font-medium text-gray-700">
                            City <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="city" wire:model="city"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('city') border-red-300 @enderror"
                            placeholder="City name">
                        @error('city')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="space-y-2">
                        <label for="state" class="block text-sm font-medium text-gray-700">
                            State <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="state" wire:model="state"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('state') border-red-300 @enderror"
                            placeholder="State name">
                        @error('state')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Professional Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Department -->
                    <div class="space-y-2">
                        <label for="department_id" class="block text-sm font-medium text-gray-700">
                            Department <span class="text-red-500">*</span>
                        </label>
                        <select id="department_id" wire:model="department_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('department_id') border-red-300 @enderror">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div class="space-y-2">
                        <label for="experience" class="block text-sm font-medium text-gray-700">
                            Experience (Years) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="experience" wire:model="experience" min="0" max="50"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('experience') border-red-300 @enderror"
                            placeholder="5">
                        @error('experience')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Qualification -->
                    <div class="space-y-2">
                        <label for="qualification" class="block text-sm font-medium text-gray-700">
                            Qualifications
                        </label>
                        <input type="text" id="qualification" wire:model="qualification"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('qualification') border-red-300 @enderror"
                            placeholder="MBBS, MD (separated by commas)">
                        @error('qualification')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Consultation Fee -->
                    <div class="space-y-2">
                        <label for="fee" class="block text-sm font-medium text-gray-700">
                            Consultation Fee (₹) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="fee" wire:model="fee" min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('fee') border-red-300 @enderror"
                            placeholder="500">
                        @error('fee')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Languages -->
                    <div class="space-y-2">
                        <label for="languages_spoken" class="block text-sm font-medium text-gray-700">
                            Languages Spoken
                        </label>
                        <input type="text" id="languages_spoken" wire:model="languages_spoken"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('languages_spoken') border-red-300 @enderror"
                            placeholder="English, Hindi, Bengali (separated by commas)">
                        @error('languages_spoken')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Registration Number -->
                    <div class="space-y-2">
                        <label for="registration_number" class="block text-sm font-medium text-gray-700">
                            Medical Registration Number
                        </label>
                        <input type="text" id="registration_number" wire:model="registration_number"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('registration_number') border-red-300 @enderror"
                            placeholder="MCI/SMC Registration Number">
                        @error('registration_number')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Clinic/Hospital Name -->
                    <div class="space-y-2">
                        <label for="clinic_hospital_name" class="block text-sm font-medium text-gray-700">
                            Clinic/Hospital Name
                        </label>
                        <input type="text" id="clinic_hospital_name" wire:model="clinic_hospital_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('clinic_hospital_name') border-red-300 @enderror"
                            placeholder="Primary practice location">
                        @error('clinic_hospital_name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" wire:model="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('status') border-red-300 @enderror">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Professional Bio -->
                <div class="mt-6 space-y-2">
                    <label for="professional_bio" class="block text-sm font-medium text-gray-700">
                        Professional Bio
                    </label>
                    <textarea id="professional_bio" wire:model="professional_bio" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('professional_bio') border-red-300 @enderror"
                        placeholder="Brief professional background and expertise..."></textarea>
                    @error('professional_bio')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Achievements -->
                <div class="mt-6 space-y-2">
                    <label for="achievements_awards" class="block text-sm font-medium text-gray-700">
                        Achievements & Awards
                    </label>
                    <input type="text" id="achievements_awards" wire:model="achievements_awards"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('achievements_awards') border-red-300 @enderror"
                        placeholder="Awards, recognitions (separated by commas)">
                    @error('achievements_awards')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Schedule & Availability -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Schedule & Availability</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Available Days -->
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Available Days <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2">
                            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <label
                                    class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors duration-200">
                                    <input type="checkbox" wire:model="available_days" value="{{ $day }}"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('available_days')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div class="space-y-2">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">
                            Start Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="start_time" wire:model="start_time"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('start_time') border-red-300 @enderror">
                        @error('start_time')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="space-y-2">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">
                            End Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="end_time" wire:model="end_time"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('end_time') border-red-300 @enderror">
                        @error('end_time')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slot Duration -->
                    <div class="space-y-2">
                        <label for="slot_duration_minutes" class="block text-sm font-medium text-gray-700">
                            Slot Duration (Minutes) <span class="text-red-500">*</span>
                        </label>
                        <select id="slot_duration_minutes" wire:model="slot_duration_minutes"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('slot_duration_minutes') border-red-300 @enderror">
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60">60 minutes</option>
                        </select>
                        @error('slot_duration_minutes')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Patients per Slot -->
                    <div class="space-y-2">
                        <label for="patients_per_slot" class="block text-sm font-medium text-gray-700">
                            Patients per Slot <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="patients_per_slot" wire:model="patients_per_slot" min="1" max="10"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('patients_per_slot') border-red-300 @enderror"
                            placeholder="1">
                        @error('patients_per_slot')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Booking Days -->
                    <div class="space-y-2">
                        <label for="max_booking_days" class="block text-sm font-medium text-gray-700">
                            Max Booking Days <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="max_booking_days" wire:model="max_booking_days" min="1" max="30"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('max_booking_days') border-red-300 @enderror"
                            placeholder="7">
                        @error('max_booking_days')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Photo & Security -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Photo & Security</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Photo Upload -->
                   <!-- Photo Upload -->
<div class="space-y-2">
    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
    <div class="flex items-center space-x-4">
        @if($imagePreview)
            <img src="{{ $imagePreview }}" class="h-32 w-32 rounded-full object-cover mx-auto"
                alt="Profile image preview" onerror="this.src='/images/fallback.png';">
        @elseif($existingImage)
            <img src="{{ $existingImage }}" class="h-32 w-32 rounded-full object-cover mx-auto"
                alt="Current profile image" onerror="this.src='/images/fallback.png';">
        @elseif($doctor->image)
            <img src="{{ $doctor->image }}" class="h-32 w-32 rounded-full object-cover mx-auto"
                alt="Current profile image" onerror="this.src='/images/fallback.png';">
        @else
            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                <span class="text-gray-500 text-2xl">{{ substr($doctor->user->name ?? 'D', 0, 1) }}</span>
            </div>
        @endif
        <input wire:model="image" type="file" id="photo"
            class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200"
            accept="image/*">
        <p class="text-xs text-gray-500 mt-1">Upload any image file (Max 10MB)</p>
        @error('image') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
    </div>
</div>
                    <!-- Password Fields -->
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                New Password (leave blank to keep current)
                            </label>
                            <input type="password" id="password" wire:model="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-300 @enderror"
                                placeholder="Enter new password">
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm New Password
                            </label>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password_confirmation') border-red-300 @enderror"
                                placeholder="Confirm new password">
                            @error('password_confirmation')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Verification Documents -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Verification Documents</h2>
                </div>

                <!-- Existing Documents -->
                @if(isset($verification_documents) && is_array($verification_documents) && count($verification_documents) > 0)
                    <div class="space-y-2 mb-4">
                        <h4 class="text-base font-semibold text-gray-900">Existing Documents</h4>
                        @foreach($verification_documents as $index => $doc)
                            @php
                                $url = is_string($doc) ? $doc : (is_array($doc) ? ($doc['url'] ?? $doc['path'] ?? null) : ($doc->url ?? $doc->path ?? null));
                                $basename = $url ? basename(parse_url($url, PHP_URL_PATH) ?: $url) : 'Document';
                            @endphp
                            <div class="flex items-center space-x-2">
                                @if($url)
                                    <a href="{{ $url }}" target="_blank"
                                        class="text-sm text-blue-600 hover:underline"
                                        aria-label="View verification document {{ $index + 1 }}">{{ $basename }}</a>
                                    <button wire:click="removeVerificationDocument({{ $index }})"
                                        class="text-red-600 hover:text-red-800 text-sm">Remove</button>
                                @else
                                    <span class="text-sm text-gray-700">{{ is_array($doc) ? json_encode($doc) : (string) $doc }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- New Document Upload -->
                <div class="space-y-2">
                    <label for="new_verification_documents" class="block text-sm font-medium text-gray-700">
                        Upload New Documents
                    </label>
                    <input type="file" id="new_verification_documents" wire:model="new_verification_documents"
                        multiple
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all duration-200"
                        accept="image/*,.pdf">
                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 10MB each)</p>
                    @error('new_verification_documents.*') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a8 8 0 00-8 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0018 10c0-4.42-3.58-8-8-8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900">Social Media Links</h2>
                </div>

                <div class="space-y-4">
                    @foreach($social_media_links as $index => $link)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div class="space-y-2">
                                <label for="social_media_links.{{ $index }}.platform"
                                    class="block text-sm font-medium text-gray-700">Platform</label>
                                <select wire:model="social_media_links.{{ $index }}.platform"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">Select Platform</option>
                                    @foreach($social_media_platforms as $platform)
                                        <option value="{{ $platform }}">{{ ucfirst($platform) }}</option>
                                    @endforeach
                                </select>
                                @error("social_media_links.{$index}.platform")
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="social_media_links.{{ $index }}.url"
                                    class="block text-sm font-medium text-gray-700">URL</label>
                                <input type="url" wire:model="social_media_links.{{ $index }}.url"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    placeholder="https://example.com">
                                @error("social_media_links.{$index}.url")
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button wire:click="removeSocialMediaLink({{ $index }})"
                                    class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200">
                                    Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                    <div>
                        <button wire:click="addSocialMediaLink"
                            class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-lg text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                            Add Social Media Link
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('admin.doctors.list') }}"
                        class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" wire:loading.attr="disabled"
                        class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove>Update Doctor</span>
                        <span wire:loading class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Updating...
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Focus styles for better accessibility */
        .focus\:ring-2:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Mobile responsive adjustments */
        @media (max-width: 640px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .sm\:grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</div>