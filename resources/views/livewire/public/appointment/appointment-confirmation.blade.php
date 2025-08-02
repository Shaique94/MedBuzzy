<div class="max-w-2xl mx-auto mt-4 mx-2 bg-white p-8 rounded-xl  border border-teal-100">
    <!-- Header with icon -->
    <div class="text-center mb-8">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-teal-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-teal-800 mt-4">Appointment Confirmed!</h2>
        <p class="mt-2 text-gray-600">Your appointment has been successfully booked</p>
    </div>

    <!-- Appointment card -->
    <div class="bg-gradient-to-br from-teal-50 to-blue-50 p-6 rounded-xl mb-8 border border-teal-50 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-xl text-teal-900">Appointment Summary</h3>
            <span class="px-3 py-1 bg-teal-100 text-teal-800 text-sm rounded-full font-medium">Confirmed</span>
        </div>
        
        <div class="space-y-4">
            <div class="flex items-start">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Doctor</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $appointment->doctor->user->name ?? '' }}</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Date & Time</p>
                    <p class="text-lg font-semibold text-gray-900">
                                                                    {{ \Carbon\Carbon::parse( $appointment->appointment_date)->format('l, F j, Y') }}</p>
                                                                    Time : {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                    </p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Patient</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $appointment->patient->name }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $appointment->patient->phone }}</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Payment</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $appointment->payment->method ?? 'N/A' }} • ₹{{ $appointment->payment->amount ?? '0' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('appointment.receipt', ['appointment' => $appointment->id]) }}" 
           class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center justify-center font-medium shadow-md hover:shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download Receipt
        </a>
        
        <a wire:navigate href="{{route('hero')}}" 
           class="px-6 py-3 border border-teal-600 text-teal-600 rounded-lg hover:bg-teal-50 transition flex items-center justify-center font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
            Back to Home
        </a>
    </div>

    <!-- Help text -->
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Need to make changes? Contact our support at <a href="mailto:support@example.com" class="text-teal-600 hover:underline">support@example.com</a></p>
        <p class="mt-1">Your appointment ID: <span class="font-mono font-medium">{{ $appointment->id }}</span></p>
    </div>
</div>