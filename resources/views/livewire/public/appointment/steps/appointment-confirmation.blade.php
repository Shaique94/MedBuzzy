<div class="space-y-4 md:space-y-6 md:max-w-5xl mx-auto px-2 sm:px-0">
    <!-- Header -->
    <div class="text-center">
        <h2 class="text-xl sm:text-2xl font-bold text-brand-blue-900">Confirm Your Appointment</h2>
        <p class="text-sm sm:text-base text-gray-600 mt-1">Review details before final confirmation</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-brand-blue-200 overflow-hidden transition-all duration-300 hover:shadow-xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-brand-blue-800 to-brand-blue-700 p-4 sm:p-5">
            <h3 class="text-base sm:text-lg md:text-xl font-bold text-white flex items-center">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Appointment Summary
            </h3>
            <p class="text-xs sm:text-sm text-white/80 mt-1">Please review your appointment details</p>
        </div>
        
        <!-- Content -->
        <div class="p-4 sm:p-6">
            <!-- Doctor & Appointment Info Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Doctor Info -->
                <div class="flex space-x-4 p-3 rounded-lg bg-brand-blue-50 border border-brand-blue-100">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-white border-2 border-brand-blue-300 shadow-md">
                            <img src="{{ $appointmentData['selected_doctor']->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($appointmentData['selected_doctor']->user->name) . '&background=random&rounded=true' }}"
                                alt="Dr. {{ $appointmentData['selected_doctor']->user->name }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <span class="text-xs font-medium text-brand-blue-600 uppercase tracking-wider">Your Doctor</span>
                        <h4 class="text-sm sm:text-base md:text-lg font-bold text-brand-blue-900 mt-1">Dr. {{ $appointmentData['selected_doctor']->user->name }}</h4>
                        <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $appointmentData['selected_doctor']->department->name }}</p>
                        <div class="flex items-center mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                ₹{{ $appointmentData['selected_doctor']->fee }} Consultation Fee
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Appointment Details -->
                <div class="p-3 rounded-lg bg-brand-yellow-50 border border-brand-yellow-100">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 text-brand-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs font-medium text-brand-orange-800 uppercase tracking-wider">Date & Time</span>
                    </div>
                    <h4 class="text-sm sm:text-base font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($appointmentData['appointment_date'])->format('l, F j, Y') }}
                    </h4>
                    <p class="mt-1 text-sm font-medium text-brand-orange-700">
                        {{ \Carbon\Carbon::createFromFormat('H:i', $appointmentData['appointment_time'])->format('h:i A') }}
                    </p>
                    <div class="mt-3 flex items-center">
                        <svg class="w-4 h-4 text-brand-orange-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs text-gray-600">Please arrive 15 minutes early</span>
                    </div>
                </div>
            </div>
            
            <!-- Patient Information -->
            <div class="mt-6 p-4 rounded-lg bg-gray-50 border border-gray-200">
                <h4 class="text-sm sm:text-base font-semibold text-gray-700 flex items-center mb-4">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Patient Information
                </h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Full Name</span>
                            <span class="text-sm sm:text-base font-medium text-gray-800">{{ $appointmentData['patient']['name'] }}</span>
                        </div>
                        <div class="h-px bg-gray-200 my-2"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Age & Gender</span>
                            <span class="text-sm font-medium text-gray-800">{{ $appointmentData['patient']['age'] }} yrs, {{ ucfirst($appointmentData['patient']['gender']) }}</span>
                        </div>
                        <div class="h-px bg-gray-200 my-2"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Location</span>
                            <span class="text-sm font-medium text-gray-800">{{ $appointmentData['patient']['district'] ?? 'Not available' }}, {{ $appointmentData['patient']['state'] ?? 'Not available' }}</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Phone</span>
                            <span class="text-sm sm:text-base font-medium text-gray-800">{{ $appointmentData['patient']['phone'] }}</span>
                        </div>
                        <div class="h-px bg-gray-200 my-2"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Email</span>
                            <span class="text-sm font-medium text-gray-800 truncate">{{ $appointmentData['patient']['email'] ?: 'Not provided' }}</span>
                        </div>
                        <div class="h-px bg-gray-200 my-2"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <span class="text-xs text-gray-500">Pincode</span>
                            <span class="text-sm font-medium text-gray-800">{{ $appointmentData['patient']['pincode'] ?? 'Not available' }}</span>
                        </div>
                    </div>
                </div>
                
                @if(!empty($appointmentData['notes']))
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-100 rounded-md">
                    <h5 class="text-xs font-medium text-yellow-800 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Notes
                    </h5>
                    <p class="mt-1 text-xs text-gray-700">{{ $appointmentData['notes'] }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Details Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-brand-blue-100 px-4 py-3">
            <h3 class="text-base sm:text-lg font-semibold text-brand-blue-900">Payment Summary</h3>
        </div>
        <div class="p-4 sm:p-5">
            <!-- Doctor's Fee -->
            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <div>
                    <h4 class="text-sm font-medium text-gray-800">Doctor's Consultation Fee</h4>
                    <p class="text-xs text-gray-500 mt-1">Payable directly to doctor during visit</p>
                </div>
                <span class="text-sm font-semibold">₹{{ $appointmentData['selected_doctor']->fee }}</span>
            </div>

            <!-- Processing Fee -->
            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                <div>
                    <h4 class="text-sm font-medium text-gray-800">Booking Fee</h4>
                    <p class="text-xs text-gray-500 mt-1">Secures your appointment (non-refundable)</p>
                </div>
                <span class="text-sm font-semibold">₹50.00</span>
            </div>

            <!-- Total -->
            <div class="flex justify-between items-center pt-4">
                <span class="text-base font-bold text-gray-800">Total Amount Due Now</span>
                <span class="text-lg font-bold text-brand-blue-600">₹50.00</span>
            </div>
        </div>
    </div>

    <!-- Payment Disclaimer -->
    <div class="text-center px-2 py-2">
        <p class="text-xs text-gray-500">
            <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            The doctor's fee of ₹{{ $appointmentData['selected_doctor']->fee }} will be collected directly by the
            doctor during your appointment. Today's payment is only for the booking fee to secure your slot.
        </p>
    </div>
</div>
