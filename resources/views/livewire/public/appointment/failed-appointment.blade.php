<div class="min-h-screen  py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-8 p-6 bg-white rounded-xl border-l-4 border-red-500 ">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Payment Failed</h1>
                    <p class="text-red-600 font-medium flex items-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Your payment could not be processed
                    </p>
                </div>
                <div class="bg-gradient-to-r from-red-100 to-orange-100 px-4 py-3 rounded-xl border border-red-200">
                    <span class="text-red-700 text-sm font-medium">Appointment ID:</span>
                    <span class="font-bold text-red-800 text-lg">APT-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('error'))
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg ">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column - Doctor Card (lg:4 columns) -->
            <div class="lg:col-span-4">
                <!-- Doctor Card -->
                @include('livewire.public.appointment.components.doctor-card', [
                    'doctor' => $appointment->doctor,
                    'appointment_date' => $appointment->appointment_date->format('Y-m-d'),
                    'appointment_time' => $appointment->appointment_time
                ])

                <!-- Payment Status Card -->
                <div class="mt-6 bg-white rounded-xl overflow-hidden border border-red-200">
                    <div class="bg-gradient-to-r from-red-500 to-orange-500 p-4">
                        <h3 class="text-lg font-bold text-white flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Payment Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Status:</span>
                                <span class="px-3 py-1 text-sm font-bold rounded-full bg-red-100 text-red-800 border border-red-300">Failed</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Amount:</span>
                                <span class="text-lg font-bold text-gray-900">₹{{ $appointment->payment->amount ?? '50' }}</span>
                            </div>
                            @if($orderId)
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 font-medium">Order ID:</span>
                                    <span class="text-xs font-mono bg-gray-100 px-3 py-2 rounded-lg border">{{ $orderId }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 font-medium">Time:</span>
                                <span class="text-sm text-gray-700">{{ now()->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <!-- Right Column - Appointment Details and Actions (lg:8 columns) -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Appointment Details
                        </h2>
                        <p class="text-gray-600 mt-2">Review your appointment information and choose your next action</p>
                    </div>

                    <div class="p-8 space-y-8">
                        <!-- Appointment Information Section -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold text-gray-800 border-b-2 border-blue-200 pb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Appointment Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $appointment->appointment_date->format('l, F j, Y') }}</p>
                                        <p class="text-sm text-gray-600">Appointment Date</p>
                                    </div>
                                </div>

                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $formattedTime }}</p>
                                        <p class="text-sm text-gray-600">Appointment Time</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Information Section -->
                        <div class="space-y-6">
                            <h3 class="text-xl font-bold text-gray-800 border-b-2 border-green-200 pb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Patient Information
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $appointment->patient->name }}</p>
                                        <p class="text-sm text-gray-600">Patient Name</p>
                                    </div>
                                </div>

                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $appointment->patient->user->phone ?? 'Not provided' }}</p>
                                        <p class="text-sm text-gray-600">Phone Number</p>
                                    </div>
                                </div>

                                @if($appointment->patient->email)
                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ $appointment->patient->email }}</p>
                                        <p class="text-sm text-gray-600">Email Address</p>
                                    </div>
                                </div>
                                @endif

                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg">{{ ucfirst($appointment->patient->gender) }}</p>
                                        <p class="text-sm text-gray-600">Gender</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes if any -->
                        @if($appointment->notes)
                            <div class="border-t-2 border-gray-200 pt-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Additional Notes
                                </h3>
                                <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-xl border border-gray-200">
                                    <p class="text-gray-700 leading-relaxed">{{ $appointment->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="px-6 pb-6 flex justify-end ">
                        <!-- Cancel Button -->
                        <button 
                            wire:click="cancelAndGoHome"
                            class="flex-1 sm:flex-initial bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-bold py-4 px-8 rounded-xl transition-all duration-300 flex items-center justify-center border-2 border-gray-300 hover:border-gray-400 transform hover:scale-105"
                        >
                            
                            <span class="text-lg">Cancel</span>
                        </button>
                    </div>
             
                </div>
       <!-- Help Section -->
                <div class="mt-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                    <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Contact Information
                    </h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 mt-0.5 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-blue-700">{{ $contactDetails['address'] ?? 'Address not available' }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ $contactDetails['phone'] ?? '' }}" class="text-blue-700 hover:text-blue-900">{{ $contactDetails['phone'] ?? 'Phone not available' }}</a>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ $contactDetails['email'] ?? '' }}" class="text-blue-700 hover:text-blue-900">{{ $contactDetails['email'] ?? 'Email not available' }}</a>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-blue-700">{{ $contactDetails['working_hours'] ?? 'Working hours not available' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   </div>