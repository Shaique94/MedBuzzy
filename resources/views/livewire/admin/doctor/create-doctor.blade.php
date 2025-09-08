<div class="min-h-screen bg-gray-50 py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6 bg-white rounded-lg p-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center mb-2">
                        <svg class="w-7 h-7 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Create New Doctor
                    </h1>
                    <p class="text-gray-600">Add a new doctor to your medical practice</p>
                </div>
                <a href="{{ route('admin.doctors.list') }}"
                    class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start animate-fade-in">
                <svg class="h-5 w-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start animate-fade-in">
                <svg class="h-5 w-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
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
                        @if($isProcessing)
                            <p class="text-sm text-blue-600 flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Fetching location...
                            </p>
                        @endif
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
                            <option value="2">On Leave</option>
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
                    <h2 class="text-xl font-semibold text-gray-900">Working Hours</h2>
                </div>

                <!-- Working Hours List -->
                <div class="space-y-4">
                    @if(count($working_hours) > 0)
                        @foreach($working_hours as $index => $schedule)
                            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4">
                                        <div class="text-sm font-medium text-gray-900 min-w-[120px]">
                                            @if(count($schedule['days']) === 7)
                                                Every day
                                            @elseif(count($schedule['days']) === 6 && !in_array('Sunday', $schedule['days']))
                                                Monday to Saturday
                                            @elseif(count($schedule['days']) === 5 && !in_array('Saturday', $schedule['days']) && !in_array('Sunday', $schedule['days']))
                                                Monday to Friday
                                            @else
                                                {{ implode(', ', array_map(function($day) { return substr($day, 0, 3); }, $schedule['days'])) }}
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            @if(isset($schedule['closed']) && $schedule['closed'])
                                                Closed
                                            @elseif(isset($schedule['open_24_hours']) && $schedule['open_24_hours'])
                                                Open 24 hours
                                            @else
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $schedule['start_time'])->format('g:i A') }} – 
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $schedule['end_time'])->format('g:i A') }}
                                            @endif
                                        </div>
                                        @if(!isset($schedule['closed']) || !$schedule['closed'])
                                            <div class="text-sm text-gray-500">
                                                {{ $schedule['patients_per_slot'] }} patient{{ $schedule['patients_per_slot'] > 1 ? 's' : '' }} per slot
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button type="button" wire:click="editWorkingHours({{ $index }})"
                                        class="p-2 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <button type="button" wire:click="removeWorkingHours({{ $index }})"
                                        class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Remove">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm">No working hours added yet</p>
                            <p class="text-xs text-gray-400 mt-1">Add your first working hours schedule</p>
                        </div>
                    @endif
                </div>

                <!-- Add Working Hours Button -->
                <div class="mt-4">
                    <button type="button" wire:click="openAddHoursModal" 
                        class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 bg-white hover:bg-blue-50 rounded-lg font-medium text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add working hours
                    </button>
                </div>

                @error('working_hours')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Common Settings -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Settings</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"><!-- Photo Upload -->
                    <div class="lg:col-span-1">
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Profile Photo</label>
                        <div class="flex items-center space-x-4">
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}"
                                    class="h-24 w-24 rounded-full object-cover border-4 border-blue-100 shadow-md">
                            @else
                                <div class="h-24 w-24 rounded-full bg-gray-100 flex items-center justify-center shadow-md">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" wire:model="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-300 @enderror"
                                placeholder="Enter password">
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password_confirmation') border-red-300 @enderror"
                                placeholder="Confirm password">
                            @error('password_confirmation')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Verification Documents -->
                    <div class="mt-4">
                        <label for="verification_documents"
                            class="block text-sm font-medium text-gray-700 mb-2">Verification Documents</label>
                        <input type="file" id="verification_documents" wire:model="verification_documents" multiple
                            accept=".pdf,.jpg,.png,.jpeg"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('verification_documents.*')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                        @if ($verification_documents)
                            <div class="mt-2">
                                @foreach ($verification_documents as $index => $file)
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-600">{{ $file->getClientOriginalName() }}</span>
                                        <button type="button" wire:click="removeVerificationDocument({{ $index }})"
                                            class="text-red-500 hover:text-red-700">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Social Media Links -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Social Media Links</label>
                        <div class="space-y-2">
                            @foreach ($social_media_links as $index => $link)
                                <div class="flex items-center space-x-2">
                                    <select wire:model="social_media_links.{{ $index }}.platform"
                                        class="w-1/3 px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Platform</option>
                                        <option value="twitter">Twitter</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                    </select>
                                    <input type="url" wire:model="social_media_links.{{ $index }}.url"
                                        class="w-2/3 px-4 py-3 border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        placeholder="https://platform.com/username">
                                    <button type="button" wire:click="removeSocialMediaLink({{ $index }})"
                                        class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                @error('social_media_links.' . $index . '.platform')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                                @error('social_media_links.' . $index . '.url')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            @endforeach
                            <button type="button" wire:click="addSocialMediaLink"
                                class="mt-2 px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-semibold hover:bg-blue-100">
                                Add Social Media Link
                            </button>
                        </div>
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
                <span wire:loading.remove>Create Doctor</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Creating...
                </span>
            </button>
        </div>
    </div>
    </form>

    <!-- Add/Edit Working Hours Modal -->
    @if($show_hours_modal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeHoursModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $editing_hours_index !== null ? 'Edit Working Hours' : 'Add Working Hours' }}</h3>
                            <button type="button" wire:click="closeHoursModal" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Day Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Select days and time</label>
                            <div class="grid grid-cols-7 gap-2 mb-4">
                                @php
                                    $dayLabels = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
                                    $fullDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                    $dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                                @endphp
                                @foreach($fullDays as $index => $day)
                                    <div class="flex flex-col items-center">
                                        <button type="button" wire:click="toggleModalDay('{{ $day }}')"
                                            class="w-12 h-12 sm:w-14 sm:h-14 rounded-full text-sm font-medium transition-colors
                                                {{ in_array($day, $modal_selected_days) 
                                                    ? 'bg-blue-600 text-white' 
                                                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                            {{ $dayLabels[$index] }}
                                        </button>
                                        <span class="text-xs text-gray-600 mt-1 hidden sm:block">{{ $dayNames[$index] }}</span>
                                    </div>
                                @endforeach
                            </div>
                            @error('modal_selected_days')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Time Selection -->
                        <div class="mb-6">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="open_24_hours" wire:model="modal_open_24_hours"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="open_24_hours" class="ml-2 text-sm text-gray-700">Open 24 hours</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="closed" wire:model="modal_closed"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="closed" class="ml-2 text-sm text-gray-700">Closed</label>
                                </div>
                            </div>

                            @if(!$modal_open_24_hours && !$modal_closed)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Open time</label>
                                        <div class="relative">
                                            <input type="time" wire:model="modal_start_time"
                                                class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('modal_start_time')
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Close time</label>
                                        <div class="relative">
                                            <input type="time" wire:model="modal_end_time"
                                                class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('modal_end_time')
                                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Patients per Slot (only if not closed) -->
                        @if(!$modal_closed)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Patients per Slot</label>
                                <input type="number" wire:model="modal_patients_per_slot" min="1" max="10"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                @error('modal_patients_per_slot')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" wire:click="saveWorkingHours"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $editing_hours_index !== null ? 'Update' : 'Save' }}
                        </button>
                        <button type="button" wire:click="closeHoursModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
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