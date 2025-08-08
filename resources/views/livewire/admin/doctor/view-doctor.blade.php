<div>
    <!-- Enhanced Doctor Detail Modal -->
    @if ($showModal && $doctor && isset($doctor->id) && $doctor->user && $doctor->department)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-1 sm:p-2 lg:p-4" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="bg-white rounded-xl sm:rounded-2xl shadow-2xl max-w-6xl w-full mx-1 sm:mx-2 lg:mx-0 transform transition-all duration-300 max-h-[98vh] sm:max-h-[95vh] overflow-y-auto print-content modal-enter" id="doctor-modal-content">
                <div class="px-3 py-3 sm:px-4 sm:py-4 lg:px-8 lg:py-6">
                    <!-- Enhanced Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 mb-6">
                        <div class="flex items-center space-x-3 sm:space-x-4 w-full sm:w-auto">
                            <div class="flex-shrink-0 h-14 w-14 sm:h-16 sm:w-16 lg:h-20 lg:w-20 bg-blue-200 rounded-full flex items-center justify-center shadow-lg">
                                @if (isset($doctor->image) && $doctor->image)
                                    <img src="{{ $doctor->image }}" class="h-14 w-14 sm:h-16 sm:w-16 lg:h-20 lg:w-20 rounded-full object-cover ring-4 ring-blue-200" alt="{{ $doctor->user->name ?? 'Doctor' }}'s profile picture">
                                @else
                                    <span class="text-blue-600 font-bold text-xl sm:text-2xl lg:text-3xl">{{ isset($doctor->user->name) ? substr($doctor->user->name, 0, 1) : 'D' }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 truncate" id="modal-title">{{ $doctor->user->name ?? 'Unknown Doctor' }}</h3>
                                <p class="text-sm sm:text-base lg:text-lg text-gray-600 truncate">{{ $doctor->department->name ?? 'No Department' }}</p>
                                <div class="flex items-center mt-2">
                                    @if(($doctor->status ?? 0) == 1)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 status-badge">
                                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Active
                                        </span>
                                    @elseif(($doctor->status ?? 0) == 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 status-badge">
                                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Inactive
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 status-badge">
                                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            On Leave
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100 no-print self-start sm:self-center flex-shrink-0 touch-target" aria-label="Close modal">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Enhanced Content Grid -->
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
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Full Name</label>
                                        <p class="mt-1 text-base text-gray-900 font-medium responsive-text-base">{{ $doctor->user->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Email</label>
                                        <p class="mt-1 text-base text-gray-900 break-all responsive-text-base">{{ $doctor->user->email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Phone</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->user->phone ?? 'Not provided' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Experience</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->experience ?? 'Not specified' }} years</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Qualifications</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">
                                            @if(isset($doctor->qualification) && is_array($doctor->qualification) && count($doctor->qualification) > 0)
                                                {{ implode(', ', $doctor->qualification) }}
                                            @else
                                                {{ $doctor->qualification ?? 'Not specified' }}
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Registration Date</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ isset($doctor->created_at) ? $doctor->created_at->format('M d, Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Information -->
                            @if(isset($doctor->city) || isset($doctor->state) || isset($doctor->pincode))
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
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">City</label>
                                            <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->city ?? 'Not specified' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">State</label>
                                            <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->state ?? 'Not specified' }}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Pincode</label>
                                            <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->pincode ?? 'Not specified' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Working Hours</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">
                                            {{ isset($doctor->start_time) ? \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') : 'N/A' }} - 
                                            {{ isset($doctor->end_time) ? \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') : 'N/A' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Available Days</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">
                                            @if(isset($doctor->available_days) && is_array($doctor->available_days) && count($doctor->available_days) > 0)
                                                {{ implode(', ', $doctor->available_days) }}
                                            @else
                                                Not specified
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Slot Duration</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->slot_duration_minutes ?? 'N/A' }} minutes</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Patients Per Slot</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->patients_per_slot ?? 'N/A' }} patient(s)</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Max Booking Days</label>
                                        <p class="mt-1 text-base text-gray-900 responsive-text-base">{{ $doctor->max_booking_days ?? 'N/A' }} days in advance</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Consultation Fee</label>
                                        <p class="mt-1 text-base text-gray-900 font-semibold responsive-text-base">₹{{ isset($doctor->fee) ? number_format($doctor->fee, 2) : '0.00' }}</p>
                                    </div>
                                    @if(isset($doctor->unavailable_from) && isset($doctor->unavailable_to) && $doctor->unavailable_from && $doctor->unavailable_to)
                                        <div class="sm:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 responsive-text-sm">Leave Period</label>
                                            <p class="mt-1 text-base text-red-600 font-medium responsive-text-base">
                                                {{ \Carbon\Carbon::parse($doctor->unavailable_from)->format('M d, Y') }} - 
                                                {{ \Carbon\Carbon::parse($doctor->unavailable_to)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Statistics & Recent Activity -->
                        <div class="space-y-4 lg:space-y-6">
                            <!-- Quick Stats -->
                            <div class="bg-purple-50 rounded-xl p-4 lg:p-6 border border-purple-100 section">
                                <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                    <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Quick Stats
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                        <span class="text-sm text-gray-600 responsive-text-sm">Total Appointments</span>
                                        <span class="text-base font-bold text-gray-900 responsive-text-base">{{ isset($doctor->total_appointments) ? $doctor->total_appointments : ($doctor->appointments ? $doctor->appointments->count() : 0) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                        <span class="text-sm text-gray-600 responsive-text-sm">Average Rating</span>
                                        <div class="flex items-center">
                                            <span class="text-base font-bold text-gray-900 responsive-text-base">{{ number_format(isset($doctor->average_rating) ? $doctor->average_rating : ($doctor->rating ?? 0), 1) }}</span>
                                            <svg class="h-4 w-4 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                        <span class="text-sm text-gray-600 responsive-text-sm">Total Reviews</span>
                                        <span class="text-base font-bold text-gray-900 responsive-text-base">{{ isset($doctor->total_reviews) ? $doctor->total_reviews : ($doctor->review_count ?? 0) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg shadow-sm">
                                        <span class="text-sm text-gray-600 responsive-text-sm">Member Since</span>
                                        <span class="text-base font-bold text-gray-900 responsive-text-base">{{ isset($doctor->created_at) ? $doctor->created_at->format('M Y') : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Appointments -->
                            @if(($doctor->appointments && $doctor->appointments->count() > 0) || (isset($doctor->recent_appointments) && $doctor->recent_appointments->count() > 0))
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Recent Appointments
                                    </h4>
                                    <div class="space-y-3">
                                        @php
                                            $recentAppointments = isset($doctor->recent_appointments) && $doctor->recent_appointments->count() > 0 
                                                ? $doctor->recent_appointments 
                                                : ($doctor->appointments ? $doctor->appointments->take(3) : collect());
                                        @endphp
                                        @forelse($recentAppointments as $appointment)
                                            <div class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 responsive-text-sm">
                                                        @if(is_array($appointment))
                                                            {{ $appointment['patient_name'] ?? 'Unknown Patient' }}
                                                        @else
                                                            {{ $appointment->patient->name ?? $appointment->patient_name ?? 'Unknown Patient' }}
                                                        @endif
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        @if(is_array($appointment))
                                                            {{ \Carbon\Carbon::parse($appointment['appointment_date'])->format('M d, Y') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                    @php
                                                        $status = is_array($appointment) ? $appointment['status'] : $appointment->status;
                                                    @endphp
                                                    @if($status == 'confirmed') bg-green-100 text-green-800
                                                    @elseif($status == 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($status == 'completed') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </div>
                                        @empty
                                            <div class="text-center py-4">
                                                <p class="text-sm text-gray-500 responsive-text-sm">No recent appointments found</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endif

                            <!-- Recent Reviews -->
                            @if($doctor->reviews && $doctor->reviews->count() > 0)
                                <div class="bg-gray-50 rounded-xl p-4 lg:p-6 border border-gray-100 section">
                                    <h4 class="text-base lg:text-lg font-semibold text-gray-900 mb-3 lg:mb-4 flex items-center">
                                        <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        Recent Reviews
                                    </h4>
                                    <div class="space-y-3">
                                        @foreach(($doctor->reviews ?? collect())->take(2) as $review)
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
                                                <p class="text-sm text-gray-700 responsive-text-sm">{{ Str::limit($review->comment, 100) }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Enhanced Footer Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4 lg:pt-6 border-t border-gray-200 mt-6 no-print">
                        <button wire:click="closeModal" class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 font-medium responsive-text-base min-h-[44px] touch-target">
                            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Close
                        </button>
                    </div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
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

        /* Status badge styles */
        .status-badge {
            transition: transform 0.2s ease;
        }

        .status-badge:hover {
            transform: scale(1.05);
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Close modal on Escape key press
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    const modal = document.querySelector('#doctor-modal-content');
                    if (modal) {
                        // Trigger Livewire closeModal event
                        window.Livewire.emit('closeModal');
                    }
                }
            });

            // Focus on the modal for accessibility
            const modal = document.querySelector('#doctor-modal-content');
            if (modal) {
                modal.focus();
            }
        });
    </script>
</div>
