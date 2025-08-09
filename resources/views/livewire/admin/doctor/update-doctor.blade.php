<div>
    @if ($showModal && $doctor && isset($doctor->id) && $doctor->user && $doctor->department)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-1 sm:p-2 lg:p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true" tabindex="-1">
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-2xl max-w-6xl w-full mx-1 sm:mx-2 lg:mx-0 transform transition-all duration-300 max-h-[98vh] sm:max-h-[95vh] overflow-y-auto print-content modal-enter" id="doctor-modal-content" tabindex="0">
                <div class="px-3 py-3 sm:px-4 sm:py-4 lg:px-8 lg:py-6">
                    <!-- Enhanced Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 mb-6">
                        <div class="flex items-center space-x-3 sm:space-x-4 w-full sm:w-auto">
                            <div class="flex-shrink-0 h-14 w-14 sm:h-16 sm:w-16 lg:h-20 lg:w-20 bg-blue-200 rounded-full flex items-center justify-center shadow-lg">
                                @if ($imagePreview || $doctor->image)
                                    <img src="{{ $imagePreview ?? $doctor->image }}" class="h-14 w-14 sm:h-16 sm:w-16 lg:h-20 lg:w-20 rounded-full object-cover ring-4 ring-blue-200" alt="{{ $doctor->user->name ?? 'Doctor' }}'s profile picture">
                                @else
                                    <span class="text-blue-600 font-bold text-xl sm:text-2xl lg:text-3xl">{{ isset($doctor->user->name) ? substr($doctor->user->name, 0, 1) : 'D' }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 truncate" id="modal-title">{{ $doctor->user->name ?? 'Unknown Doctor' }}</h3>
                                <p class="text-sm sm:text-base lg:text-lg text-gray-600 truncate">{{ $doctor->department->name ?? 'No Department' }}</p>
                            </div>
                        </div>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100 no-print self-start sm:self-center flex-shrink-0 touch-target" aria-label="Close modal">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Success/Error Messages -->
                    @if (session()->has('success'))
                        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start">
                            <svg class="h-5 w-5 text-red-500 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 16.5c-.77 .833 .192 2.5 1.732 2.5z" />
                            </svg>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Enhanced Content Grid -->
                    <form wire:submit.prevent="updateDoctor" class="space-y-6">
                        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6 grid-responsive">
                            <!-- Left Column - Personal & Professional Info -->
                            <div class="xl:col-span-2 space-y-4 lg:space-y-6">
                                <!-- Personal Information -->
                                <div class="bg-blue-50 rounded-xl p-4 lg:p-6 border border-blue-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Personal Information
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4 grid-responsive">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 responsive-text-sm">Full Name</label>
                                            <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" required>
                                            @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 responsive-text-sm">Email</label>
                                            <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" required>
                                            @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 responsive-text-sm">Phone</label>
                                            <input wire:model="phone" type="text" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="password" class="block text-sm font-medium text-gray-700 responsive-text-sm">Password (Leave blank to keep unchanged)</label>
                                            <input wire:model.lazy="password" type="password" id="password" name="new-password" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" placeholder="Leave blank to keep current password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 responsive-text-sm">Confirm Password</label>
                                            <input wire:model.lazy="password_confirmation" type="password" id="password_confirmation" name="new-password-confirm" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" placeholder="Confirm new password if changing" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('password_confirmation') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="gender" class="block text-sm font-medium text-gray-700 responsive-text-sm">Gender</label>
                                            <select wire:model="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" required>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('gender') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="department_id" class="block text-sm font-medium text-gray-700 responsive-text-sm">Department</label>
                                            <select wire:model="department_id" id="department_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" required>
                                                <option value="">Select Department</option>
                                                @foreach($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 responsive-text-sm">Status</label>
                                            <select wire:model="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                                <option value="2">On Leave</option>
                                            </select>
                                            @error('status') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Professional Details -->
                                <div class="bg-purple-50 rounded-xl p-4 lg:p-6 border border-purple-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6" />
                                        </svg>
                                        Professional Details
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4 grid-responsive">
                                        <div>
                                            <label for="experience" class="block text-sm font-medium text-gray-700 responsive-text-sm">Experience (Years)</label>
                                            <input wire:model="experience" type="number" id="experience" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" min="0">
                                            @error('experience') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="qualification" class="block text-sm font-medium text-gray-700 responsive-text-sm">Qualifications (Comma-separated)</label>
                                            <input wire:model="qualification" type="text" id="qualification" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('qualification') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="clinic_hospital_name" class="block text-sm font-medium text-gray-700 responsive-text-sm">Clinic/Hospital Name</label>
                                            <input wire:model="clinic_hospital_name" type="text" id="clinic_hospital_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('clinic_hospital_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="registration_number" class="block text-sm font-medium text-gray-700 responsive-text-sm">Registration Number</label>
                                            <input wire:model="registration_number" type="text" id="registration_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('registration_number') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="languages_spoken" class="block text-sm font-medium text-gray-700 responsive-text-sm">Languages Spoken (Comma-separated)</label>
                                            <input wire:model="languages_spoken" type="text" id="languages_spoken" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('languages_spoken') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="achievements_awards" class="block text-sm font-medium text-gray-700 responsive-text-sm">Achievements & Awards (Comma-separated)</label>
                                            <input wire:model="achievements_awards" type="text" id="achievements_awards" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('achievements_awards') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="professional_bio" class="block text-sm font-medium text-gray-700 responsive-text-sm">Professional Bio</label>
                                            <textarea wire:model="professional_bio" id="professional_bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base p-3"></textarea>
                                            @error('professional_bio') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Social Media Links</label>
                                            <div class="space-y-2 mt-1">
                                                @foreach($social_media_links as $index => $link)
                                                    <div class="flex items-center space-x-2">
                                                        <select wire:model="social_media_links.{{ $index }}.platform" class="block w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                                            <option value="">Select Platform</option>
                                                            @foreach(['twitter', 'facebook', 'instagram'] as $platform)
                                                                <option value="{{ $platform }}">{{ ucfirst($platform) }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input wire:model="social_media_links.{{ $index }}.url" type="url" class="flex-1 block rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" placeholder="https://example.com">
                                                        <button wire:click="removeSocialMediaLink({{ $index }})" type="button" class="text-red-600 hover:text-red-800 touch-target" aria-label="Remove social media link">
                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    @error('social_media_links.' . $index . '.platform') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                                    @error('social_media_links.' . $index . '.url') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                                @endforeach
                                                <button wire:click="addSocialMediaLink" type="button" class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center touch-target" aria-label="Add social media link">
                                                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Add Social Media Link
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Information -->
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Location
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 lg:gap-4 grid-responsive">
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700 responsive-text-sm">City</label>
                                            <input wire:model="city" type="text" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('city') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="state" class="block text-sm font-medium text-gray-700 responsive-text-sm">State</label>
                                            <input wire:model="state" type="text" id="state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('state') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="pincode" class="block text-sm font-medium text-gray-700 responsive-text-sm">Pincode</label>
                                            <input wire:model.lazy="pincode" type="text" id="pincode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" maxlength="6">
                                            @error('pincode') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Verification Documents -->
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Verification Documents
                                    </h4>
                                    <div class="space-y-2">
                                        @if($verification_documents && is_array($verification_documents) && count($verification_documents) > 0)
                                            @foreach($verification_documents as $index => $doc)
                                                <div class="flex items-center justify-between">
                                                    <a href="{{ $doc }}" target="_blank" class="text-sm text-blue-600 hover:underline responsive-text-sm" aria-label="View verification document {{ $index + 1 }}">{{ basename($doc) }}</a>
                                                    <button wire:click="removeDocument({{ $index }})" class="text-red-600 hover:text-red-800 text-sm responsive-text-sm touch-target" aria-label="Remove document {{ $index + 1 }}">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-500 responsive-text-sm">No documents uploaded</p>
                                        @endif
                                        <div class="mt-4">
                                            <label for="new_verification_documents" class="block text-sm font-medium text-gray-700 responsive-text-sm">Upload New Documents</label>
                                            <input wire:model="new_verification_documents" type="file" id="new_verification_documents" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 px-3 py-2" accept=".pdf,.jpg,.jpeg,.png">
                                            @error('new_verification_documents.*') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule Information -->
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Schedule & Availability
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4 grid-responsive">
                                        <div>
                                            <label for="start_time" class="block text-sm font-medium text-gray-700 responsive-text-sm">Start Time</label>
                                            <input wire:model="start_time" type="time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('start_time') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="end_time" class="block text-sm font-medium text-gray-700 responsive-text-sm">End Time</label>
                                            <input wire:model="end_time" type="time" id="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2">
                                            @error('end_time') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Available Days</label>
                                            <div class="mt-2 grid grid-cols-2 sm:grid-cols-4 gap-2">
                                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                    <div class="flex items-center">
                                                        <input wire:model="available_days" type="checkbox" id="available_days_{{ $day }}" value="{{ $day }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        <label for="available_days_{{ $day }}" class="ml-2 text-sm text-gray-700 responsive-text-sm">{{ $day }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('available_days') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="slot_duration_minutes" class="block text-sm font-medium text-gray-700 responsive-text-sm">Slot Duration (Minutes)</label>
                                            <input wire:model="slot_duration_minutes" type="number" id="slot_duration_minutes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" min="5">
                                            @error('slot_duration_minutes') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="patients_per_slot" class="block text-sm font-medium text-gray-700 responsive-text-sm">Patients Per Slot</label>
                                            <input wire:model="patients_per_slot" type="number" id="patients_per_slot" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" min="1">
                                            @error('patients_per_slot') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="max_booking_days" class="block text-sm font-medium text-gray-700 responsive-text-sm">Max Booking Days</label>
                                            <input wire:model="max_booking_days" type="number" id="max_booking_days" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" min="1">
                                            @error('max_booking_days') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label for="fee" class="block text-sm font-medium text-gray-700 responsive-text-sm">Consultation Fee (₹)</label>
                                            <input wire:model="fee" type="number" id="fee" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm responsive-text-base px-3 py-2" min="0" step="0.01">
                                            @error('fee') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column - Image Upload -->
                            <div class="space-y-4 lg:space-y-6">
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Profile Image
                                    </h4>
                                    <div class="mt-4">
                                        @if($imagePreview)
                                            <img src="{{ $imagePreview }}" class="h-32 w-32 rounded-full object-cover mx-auto" alt="Profile image preview">
                                        @elseif($doctor->image)
                                            <img src="{{ $doctor->image }}" class="h-32 w-32 rounded-full object-cover mx-auto" alt="Current profile image">
                                        @else
                                            <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                                                <span class="text-gray-500 text-2xl">{{ substr($doctor->user->name ?? 'D', 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <input wire:model="image" type="file" id="image" class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 px-3 py-2" accept="image/*">
                                        @error('image') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Footer Actions -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 lg:pt-6 border-t border-gray-200 mt-6 no-print">
                            <button wire:click="closeModal" type="button" class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 font-medium responsive-text-base min-h-[44px] touch-target" aria-label="Cancel update">
                                Cancel
                            </button>
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 font-medium responsive-text-base min-h-[44px] touch-target" aria-label="Save doctor details">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($showModal)
        <!-- Error fallback when doctor data is incomplete -->
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4" aria-labelledby="error-modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 modal-enter">
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 16.5c-.77 .833 .192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2" id="error-modal-title">Error Loading Doctor Details</h3>
                    <p class="text-gray-600 mb-6">The doctor information could not be loaded. This might be due to missing data or a temporary issue. Please try again.</p>
                    <button wire:click="closeModal" class="w-full px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-colors duration-200 font-medium touch-target" aria-label="Close error modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Styles -->
    <style>
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

        /* Print styles */
        @media print {
            body * {
                visibility: hidden;
            }
            #doctor-modal-content, #doctor-modal-content * {
                visibility: visible;
            }
            #doctor-modal-content {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 20px !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                max-height: none !important;
                overflow: visible !important;
            }
            .no-print {
                display: none !important;
            }
            .bg-blue-50, .bg-gray-50, .bg-purple-50 {
                background-color: #f8f9fa !important;
                border: 1px solid #dee2e6 !important;
            }
            .rounded-xl, .rounded-2xl {
                border-radius: 0.5rem !important;
            }
            .shadow-lg, .shadow-2xl, .shadow-sm {
                box-shadow: none !important;
            }
            .section {
                break-inside: avoid;
                margin-bottom: 20px;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 640px) {
            .print-content {
                margin: 0.25rem;
                max-height: 98vh;
                padding: 0.75rem;
            }
            .modal-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .responsive-text-xs { font-size: 0.75rem; }
            .responsive-text-sm { font-size: 0.875rem; }
            .responsive-text-base { font-size: 0.9rem; }
            .responsive-text-lg { font-size: 1rem; }
            .grid-responsive {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            .xl\:col-span-2 {
                grid-column: span 1;
            }
        }

        @media (min-width: 641px) and (max-width: 1023px) {
            .grid-responsive {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            .responsive-text-base { font-size: 1rem; }
            .responsive-text-lg { font-size: 1.125rem; }
        }

        @media (min-width: 1024px) {
            .responsive-text-base { font-size: 1rem; }
            .responsive-text-lg { font-size: 1.25rem; }
        }

        /* Animation for modal entrance */
        .modal-enter {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Touch targets for mobile */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Force clear password fields when modal opens
            Livewire.on('modalOpened', function () {
                const passwordField = document.getElementById('password');
                const confirmField = document.getElementById('password_confirmation');
                if (passwordField) passwordField.value = '';
                if (confirmField) confirmField.value = '';
            });
            
            // Close modal on Escape key press
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    const modal = document.querySelector('#doctor-modal-content');
                    if (modal) {
                        window.Livewire.emit('closeModal');
                    }
                }
            });

            // Focus trap for modal accessibility
            const modal = document.querySelector('#doctor-modal-content');
            if (modal) {
                modal.focus();
                const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                const firstFocusable = focusableElements[0];
                const lastFocusable = focusableElements[focusableElements.length - 1];

                modal.addEventListener('keydown', function (event) {
                    if (event.key === 'Tab') {
                        if (event.shiftKey) {
                            if (document.activeElement === firstFocusable) {
                                event.preventDefault();
                                lastFocusable.focus();
                            }
                        } else {
                            if (document.activeElement === lastFocusable) {
                                event.preventDefault();
                                firstFocusable.focus();
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>