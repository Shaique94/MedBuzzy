<div>
    <!-- Enhanced Doctor Detail Modal -->
    @if ($showModal && $doctor)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-2 sm:p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full transform transition-all duration-300 max-h-[95vh] overflow-y-auto">
            <div class="px-4 py-4 sm:px-6 sm:py-5 lg:px-8 lg:py-6">
                <!-- Enhanced Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 h-16 w-16 lg:h-20 lg:w-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center shadow-lg">
                            @if ($doctor->image)
                                <img src="{{ $doctor->image }}" class="h-16 w-16 lg:h-20 lg:w-20 rounded-full object-cover ring-4 ring-blue-200" alt="{{ $doctor->user->name }}">
                            @else
                                <span class="text-blue-600 font-bold text-2xl lg:text-3xl">{{ substr($doctor->user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-xl lg:text-2xl font-bold text-gray-900">{{ $doctor->user->name }}</h3>
                            <p class="text-base lg:text-lg text-gray-600">{{ $doctor->department->name }}</p>
                            <div class="flex items-center mt-2">
                                @if($doctor->status == 1)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Active
                                    </span>
                                @elseif($doctor->status == 0)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        Inactive
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>
                                        On Leave
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Enhanced Content Grid -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 lg:gap-6">
                    <!-- Left Column - Personal & Professional Info -->
                    <div class="xl:col-span-2 space-y-4 lg:space-y-6">
                        <!-- Personal Information -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 lg:p-6 border border-blue-100">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 lg:gap-4">
                                <div>
                                    <label class="block responsive-text-sm font-medium text-gray-700">Full Name</label>
                                    <p class="mt-1 responsive-text-base text-gray-900 font-medium">{{ $doctor->user->name }}</p>
                                </div>
                                <div>
                                    <label class="block responsive-text-sm font-medium text-gray-700">Email</label>
                                    <p class="mt-1 responsive-text-base text-gray-900 break-all">{{ $doctor->user->email }}</p>
                                </div>
                                <div>
                                    <label class="block responsive-text-sm font-medium text-gray-700">Phone</label>
                                    <p class="mt-1 responsive-text-base text-gray-900">{{ $doctor->user->phone ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block responsive-text-sm font-medium text-gray-700">Qualifications</label>
                                    <p class="mt-1 responsive-text-base text-gray-900">
                                        @if(is_array($doctor->qualification) && count($doctor->qualification) > 0)
                                            {{ implode(', ', $doctor->qualification) }}
                                        @else
                                            {{ $doctor->qualification ?? 'Not specified' }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Location Information -->
                        @if($doctor->city || $doctor->state || $doctor->pincode)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">City</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->city ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">State</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->state ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pincode</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->pincode ?? 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Schedule Information -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Schedule & Availability
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Working Hours</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - 
                                        {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Available Days</label>
                                    <p class="mt-1 text-sm text-gray-900">
                                        @if(is_array($doctor->available_days) && count($doctor->available_days) > 0)
                                            {{ implode(', ', $doctor->available_days) }}
                                        @else
                                            Not specified
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Slot Duration</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->slot_duration_minutes }} minutes</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Patients Per Slot</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->patients_per_slot }} patient(s)</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Max Booking Days</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $doctor->max_booking_days }} days in advance</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Consultation Fee</label>
                                    <p class="mt-1 text-sm text-gray-900 font-semibold">₹{{ number_format($doctor->fee, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Statistics & Recent Activity -->
                    <div class="space-y-4 lg:space-y-6">
                        <!-- Quick Stats -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4 lg:p-6 border border-purple-100">
                            <h4 class="text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Quick Stats
                            </h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                    <span class="responsive-text-sm text-gray-600">Total Appointments</span>
                                    <span class="responsive-text-base font-bold text-gray-900">{{ $doctor->appointments->count() }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                    <span class="responsive-text-sm text-gray-600">Average Rating</span>
                                    <div class="flex items-center">
                                        <span class="responsive-text-base font-bold text-gray-900">{{ number_format($doctor->rating, 1) }}</span>
                                        <svg class="h-4 w-4 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                    <span class="responsive-text-sm text-gray-600">Total Reviews</span>
                                    <span class="responsive-text-base font-bold text-gray-900">{{ $doctor->review_count }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                    <span class="responsive-text-sm text-gray-600">Member Since</span>
                                    <span class="responsive-text-base font-bold text-gray-900">{{ $doctor->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Appointments -->
                        @if($doctor->appointments->count() > 0)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Recent Appointments
                            </h4>
                            <div class="space-y-3">
                                @foreach($doctor->appointments->take(3) as $appointment)
                                <div class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $appointment->patient_name }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Recent Reviews -->
                        @if($doctor->reviews->count() > 0)
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Recent Reviews
                            </h4>
                            <div class="space-y-3">
                                @foreach($doctor->reviews->take(2) as $review)
                                <div class="py-2 border-b border-gray-200 last:border-b-0">
                                    <div class="flex items-center mb-2">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ Str::limit($review->comment, 100) }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced Footer Actions -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 lg:pt-6 border-t border-gray-200 mt-6">
                    <button wire:click="closeModal" class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-all duration-200 font-medium responsive-text-base">
                        <i class="fas fa-times mr-2"></i>Close
                    </button>
                    <button onclick="window.print()" class="w-full sm:w-auto px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-200 font-medium responsive-text-base">
                        <i class="fas fa-print mr-2"></i>Print Details
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

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
    </style>
</div>
