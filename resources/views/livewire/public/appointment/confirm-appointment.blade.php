<div class="container mx-auto px-4 py-8 max-w-6xl">
     <div class="mb-6 p-4 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Appointment Confirmed</h1>
                <p class="text-green-600 font-medium flex items-center mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{$appointment->status}}
                </p>
            </div>
            <div class="bg-gray-100 px-3 py-2 rounded-lg">
                <span class="text-gray-500 text-sm">Appointment ID:</span>
                <span class="font-medium">APT-{{ str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>
    </div>
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column - Doctor Card -->
        <div class="lg:w-1/3">
            @include('livewire.public.appointment.components.doctor-card', [
                'doctor' => $appointment->doctor,
                'appointment_date' => $appointment->appointment_date->format('Y-m-d'),
                'appointment_time' => $appointment->appointment_time
            ])

           

             <div class="mt-4 bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                <div class="bg-green-50 p-3 border-b border-green-100">
                    <h3 class="font-medium text-green-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        This appointment is covered under Prime
                    </h3>
                </div>
                <div class="p-4">
                    <h4 class="font-medium text-gray-800 mb-3">Prime benefits</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm text-gray-700">Verified consultation fees of ₹{{ $appointment->payment->amount ?? '50' }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm text-gray-700">Verified Location: 
                                @if($appointment->doctor->clinic_hospital_name)
                                    {{ $appointment->doctor->clinic_hospital_name }}, 
                                @endif
                                @if($appointment->doctor->city)
                                    {{ $appointment->doctor->city }}, 
                                @endif
                                @if($appointment->doctor->state)
                                    {{ $appointment->doctor->state }}
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column - Confirmation Details -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                

                <!-- Appointment Details -->
                <div class="p-6 space-y-5">
                    <!-- Appointment Info -->
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800">Appointment Details</h2>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Date:</span>
                            <span class="font-medium">{{ $appointment->appointment_date->format('M d, Y') }}</span>
                        </div>
                       <div class="flex justify-between">
                            <span class="text-gray-500">Time:</span>
                            <span class="font-medium">{{ $formattedTime }}</span>
                        </div>
                    </div>

                    <!-- Patient Info -->
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800">Patient Details</h2>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Name:</span>
                            <span class="font-medium">{{ $appointment->patient->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Gender:</span>
                            <span class="font-medium capitalize">{{ $appointment->patient->gender }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Contact:</span>
                            <span class="font-medium">{{ $appointment->patient->user->phone }}</span>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="space-y-1">
                        <h2 class="text-lg font-semibold text-gray-800">Payment Details</h2>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status:</span>
                            <span class="font-medium text-green-600 capitalize">{{ $appointment->payment->status ?? 'pending' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Amount:</span>
                            <span class="font-medium">₹{{ $appointment->payment->amount ?? '0' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Method:</span>
                            <span class="font-medium capitalize">{{ $appointment->payment->method ?? 'online' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 pb-6 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <button 
                        class="flex-1 py-2 bg-brand-blue-600 text-white rounded hover:bg-brand-blue-700 transition"
                    >
                        Reschedule
                    </button>
                    <button 
                        class="flex-1 py-2 border border-red-500 text-red-500 rounded hover:bg-red-50 transition"
                    >
                        Cancel
                    </button>
                </div>
            </div>

            <!-- Help Text -->
            <div class="mt-6 text-center text-sm text-gray-500">
                   <!-- SMS Notification -->
            <div class="mt-4 bg-blue-50 rounded-lg p-4 border border-blue-100">
                <p class="text-sm text-blue-700 flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 mr-2 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                    </svg>
                    We have sent you an SMS with the details.Please arrive 10 minutes early.
                </p>
            </div>
               
            </div>
        </div>
    </div>
</div>