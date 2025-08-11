<div class="min-h-screen bg-gradient-to-br from-teal-50 via-blue-50 to-indigo-50 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-teal-100">
            <!-- Header with icon -->
            <div class="text-center mb-8">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-teal-50 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-teal-800 mt-4">Appointment Confirmed!</h2>
                <p class="mt-2 text-gray-600 text-sm sm:text-base">Your appointment has been successfully booked</p>
            </div>

            <!-- Appointment card -->
            <div
                class="bg-gradient-to-br from-teal-50 to-blue-50 p-4 sm:p-6 rounded-xl mb-6 sm:mb-8 border border-teal-50 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
                    <h3 class="font-bold text-lg sm:text-xl text-teal-900">Appointment Summary</h3>
                    <span
                        class="px-3 py-1 bg-teal-100 text-teal-800 text-sm rounded-full font-medium w-fit">Confirmed</span>
                </div>

                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-start space-x-3 sm:space-x-4">
                        <div
                            class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-teal-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-teal-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Doctor</p>
                            <p class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                {{ $appointment->doctor->user->name ?? '' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 sm:space-x-4">
                        <div
                            class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Date & Time</p>
                            <div class="text-base sm:text-lg font-semibold text-gray-900">
                                <p>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
                                <p class="text-sm sm:text-base text-teal-600">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 sm:space-x-4">
                        <div
                            class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Patient</p>
                            <p class="text-base sm:text-lg font-semibold text-gray-900 truncate">
                                {{ $appointment->patient->name }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $appointment->patient->phone }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 sm:space-x-4">
                        <div
                            class="flex-shrink-0 h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-gray-500">Payment</p>
                            <p class="text-base sm:text-lg font-semibold text-gray-900">
                                {{ $appointment->payment->method ?? 'N/A' }} •
                                ₹{{ $appointment->payment->amount ?? '0' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 mb-6">
                <a href="{{ route('appointment.receipt.download', ['appointment' => $appointment->id]) }}"
                    target="_blank"
                    class="w-full sm:w-auto px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 active:bg-teal-800 transition-all duration-200 flex items-center justify-center font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download Receipt
                </a>

                <a wire:navigate href="{{route('hero')}}"
                    class="w-full sm:w-auto px-6 py-3 border-2 border-teal-600 text-teal-600 rounded-lg hover:bg-teal-50 active:bg-teal-100 transition-all duration-200 flex items-center justify-center font-medium transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <!-- Help text -->
            <div class="text-center text-xs sm:text-sm text-gray-500 space-y-2">
                <p>Need to make changes? Contact our support at <a href="mailto:infomedbuzzy@gmail.com"
                        class="text-teal-600 hover:text-teal-700 hover:underline transition-colors">infomedbuzzy@gmail.com</a>
                </p>
                <p>Your appointment ID: <span
                        class="font-mono font-medium text-gray-700 bg-gray-100 px-2 py-1 rounded text-xs">{{ $appointment->id }}</span>
                </p>
            </div>
        </div>
    </div>
</div>