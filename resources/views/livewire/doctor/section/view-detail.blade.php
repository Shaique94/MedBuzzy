<div>
@if ($showPatientModal)
<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- Modal container -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <!-- Header with MedBuzzy branding -->
            <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center bg-white rounded-full w-10 h-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">MedBuzzy</h2>
                </div>
                <button wire:click="$set('showPatientModal', false)" class="text-white hover:text-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content Area -->
            <div class="bg-white px-6 py-5">
                @if($selectedPatient)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Patient Information Column -->
                    <div class="border-r border-gray-200 pr-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Patient Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Name</dt>
                                <dd class="col-span-3 text-gray-800">{{ $selectedPatient->name }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Patient ID</dt>
                                <dd class="col-span-3 text-gray-800">#{{ $selectedPatient->id }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Gender</dt>
                                <dd class="col-span-3 text-gray-800">{{ ucfirst($selectedPatient->gender) }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Age</dt>
                                <dd class="col-span-3 text-gray-800">{{ $selectedPatient->age }}</dd>
                            </div>

                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Contact</dt>
                                <dd class="col-span-3 text-gray-800">{{ $selectedPatient->phone }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Email</dt>
                                <dd class="col-span-3 text-gray-800">{{ $selectedPatient->email ?? 'N/A' }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Pincode</dt>
                                <dd class="col-span-3 text-gray-800">{{ $selectedPatient->pincode ?? 'N/A' }}</dd>
                            </div>
                            
                            <div class="grid grid-cols-4 gap-2">
                                <dt class="col-span-1 text-sm font-medium text-gray-500">Address</dt>
                                <dd class="col-span-3 text-gray-800">
                                    {{ $selectedPatient->address }}<br>
                                    {{ $selectedPatient->district }}, {{ $selectedPatient->state }}, {{ $selectedPatient->country }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Details Column -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            Appointment Details
                        </h3>
                        
                        @if($selectedPatient->appointments && $selectedPatient->appointments->count() > 0)
                            @foreach($selectedPatient->appointments as $appointment)
                            <div class="space-y-4 mb-6 pb-6 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Doctor</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->doctor->user->name ?? 'N/A' }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Department</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->doctor->department->name ?? 'N/A' }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Fee</dt>
                                    <dd class="col-span-3 text-gray-800">₹{{ number_format($appointment->doctor->fee ?? 0, 2) }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Date & Time</dt>
                                    <dd class="col-span-3 text-gray-800">
                                        <div class="flex items-center space-x-2">
                                            <span>{{ Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</span>
                                            <span class="text-sm text-gray-500">({{ Carbon\Carbon::parse($appointment->appointment_date)->format('l') }})</span>
                                        </div>
                                        <span class="inline-block mt-1 px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs">
                                            {{ Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Queue No.</dt>
                                    <dd class="col-span-3 text-gray-800">
                                        <span class="inline-block px-2 py-1 rounded bg-gray-200 text-gray-800 text-xs">
                                            #{{ str_pad($appointment->queue_number ?? 1, 3, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="col-span-3 text-gray-800">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'confirmed' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                                'completed' => 'bg-blue-100 text-blue-800',
                                            ];
                                            $statusClass = $statusClasses[strtolower($appointment->status)] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-block px-2 py-1 rounded text-xs {{ $statusClass }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->notes ?? 'N/A' }}</dd>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 py-4">No appointment records found.</p>
                        @endif
                    </div>
                </div>
                @else
                <p class="text-red-500 py-4">No patient selected.</p>
                @endif
            </div>

            <!-- Footer with action buttons -->
            <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6">
                <button wire:click="$set('showPatientModal', false)" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
                @if($selectedPatient && $selectedPatient->appointments && $selectedPatient->appointments->count() > 0)
                <a href="{{ route('appointment.receipt', ['appointment' => $selectedPatient->appointments->first()->id]) }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Print Details
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
</div>