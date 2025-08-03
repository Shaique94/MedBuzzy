<div>
    @if ($showModal && $appointment)
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
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center bg-white rounded-full w-10 h-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">MedBuzzy</h2>
                    </div>
                    <button wire:click="closeModal" class="text-white hover:text-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content Area -->
                <div class="bg-white px-6 py-5">
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
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->patient->name }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Patient ID</dt>
                                    <dd class="col-span-3 text-gray-800">#{{ $appointment->patient->id }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Gender</dt>
                                    <dd class="col-span-3 text-gray-800">{{ ucfirst($appointment->patient->gender) }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Contact</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->patient->phone }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->notes }}</dd>
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
                            
                            <div class="space-y-4">
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Doctor</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->doctor->user->name }}</dd>
                                </div>
                                
                                <div class="grid grid-cols-4 gap-2">
                                    <dt class="col-span-1 text-sm font-medium text-gray-500">Department</dt>
                                    <dd class="col-span-3 text-gray-800">{{ $appointment->doctor->department->name }}</dd>
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
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer with action buttons -->
                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" wire:click="closeModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                    <a wire:navigate href="{{ route('appointment.receipt', ['appointment' => $appointment->id]) }}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Print Details
                    </a>
                   
                </div>
            </div>
        </div>
    </div>
    @endif
</div>