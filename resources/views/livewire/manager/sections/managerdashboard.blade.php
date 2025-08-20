<div class="min-h-screen w-[388px] md:w-full mt-4 ">
    <!-- Main Content Section -->
    <div class="p-2">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Dashboard Header -->
            <div class="mb-8">
                {{-- <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1> --}}
                <p class="text-gray-600 mt-2">Welcome back! Here's what's happening today.</p>
                <div class="mt-4 border-b border-gray-200"></div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Appointments Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Appointments</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900">{{ $appointmentsCount }}</p>
                                <div class="mt-3 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{-- {{ $this->getWeeklyAppointmentGrowth() }}% this week --}}
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a wire:navigate href="{{route('manager.appointments')}}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all<span aria-hidden="true"> →</span></a>
                    </div>
                </div>

                <!-- Active Doctors Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Active Doctors</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900">{{ $doctorsCount }}</p>
                                <div class="mt-3 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{-- {{ $this->getQuarterlyDoctorGrowth() }}% this quarter --}}
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a wire:navigate href="{{ route('manager.manage.doctors') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500">View all<span aria-hidden="true"> →</span></a>
                    </div>
                </div>

                <!-- Total Patients Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Patients</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900">{{ $patientsCount }}</p>
                                <div class="mt-3 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="-ml-0.5 mr-1 h-3 w-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{-- {{ $this->getMonthlyPatientGrowth() }}% this month --}}
                                    </span>
                                </div>
                            </div>
                            <div class="p-3 rounded-lg bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a wire:navigate href="{{route('manager.appointments')}}" class="text-sm font-medium text-green-600 hover:text-green-500">View all<span aria-hidden="true"> →</span></a>
                    </div>
                </div>

                <!-- Today's Payments Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Today's Payments</p>
                                <p class="mt-2 text-3xl font-bold text-gray-900">₹ {{ number_format($todaysPaymentsTotal, 2) }}</p>
                            </div>
                            <div class="p-3 rounded-lg bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-3">
                        <a wire:navigate href="#" class="text-sm font-medium text-green-600 hover:text-green-500">View payments<span aria-hidden="true"> →</span></a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Bulk Actions Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">Upcoming Appointments</h2>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="select-all" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                   @change="toggleSelectAll">
                            <label for="select-all" class="ml-2 text-sm text-gray-700">Select All</label>
                        </div>
                        
                        <button id="bulkRescheduleBtn"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 
                                       disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                            Reschedule Selected
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th></th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($appointments as $appointment)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <!-- Checkbox Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" 
                                               class="appointment-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                               value="{{ $appointment->id }}"
                                               data-doctor-id="{{ $appointment->doctor_id }}"
                                               @change="updateBulkRescheduleBtn">
                                    </td>
                                    
                                    <!-- Patient Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover" 
                                                     src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80" 
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{$appointment->patient->name}}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $appointment->patient->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Doctor Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$appointment->doctor->user->name}}</div>
                                        <div class="text-sm text-gray-500">{{$appointment->doctor->department->name}}</div>
                                    </td>
                                    
                                    <!-- Date & Time Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                            @if(\Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Today</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- Status Column -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(\Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Today
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Upcoming
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- Actions Column -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2 items-center">
                                            @if($appointment->canBeRescheduled())
                                            <button 
                                                id="rescheduleBtn-{{ $appointment->id }}"
                                                class="text-purple-600 hover:text-purple-900 p-1 rounded-md hover:bg-purple-50 transition-colors
                                                       hover:underline underline-offset-4 decoration-2"
                                                data-appointment-id="{{ $appointment->id }}"
                                                data-doctor-id="{{ $appointment->doctor_id }}"
                                                data-current-date="{{ $appointment->appointment_date->format('Y-m-d') }}"
                                                title="Reschedule"
                                            >Reschedule
                                            </button>
                                            @endif
                                            <a wire:navigate href="{{ route('doctor.patients.view', $appointment->patient->id) }}" 
                                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors
                                                      hover:underline underline-offset-4 decoration-2"
                                               title="View Patient">
                                               View Patient
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No appointments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Modal (for single appointment) -->
    <div class="fixed inset-0 overflow-y-auto z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="rescheduleModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Reschedule Appointment</h3>
                    
                    <div class="mb-4">
                        <label for="newAppointmentDate" class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input type="date" id="newAppointmentDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" min="{{ now()->addDay()->format('Y-m-d') }}">
                    </div>
                    
                    <div id="availableSlots" class="grid grid-cols-3 gap-2 mt-4"></div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmReschedule" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm Reschedule
                    </button>
                    <button type="button" id="cancelReschedule" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Reschedule Modal -->
    <div class="fixed inset-0 overflow-y-auto z-50 hidden" aria-labelledby="bulk-modal-title" role="dialog" aria-modal="true" id="bulkRescheduleModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true"></span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="bulk-modal-title">Reschedule Selected Appointments</h3>
                    
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-2">You are rescheduling <span id="selectedCount" class="font-semibold">0</span> appointments.</p>
                        <label for="bulkNewAppointmentDate" class="block text-sm font-medium text-gray-700">Select New Date</label>
                        <input type="date" id="bulkNewAppointmentDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" min="{{ now()->addDay()->format('Y-m-d') }}">
                    </div>
                    
                    <div id="bulkAvailableSlots" class="grid grid-cols-3 gap-2 mt-4"></div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="confirmBulkReschedule" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm Reschedule
                    </button>
                    <button type="button" id="cancelBulkReschedule" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="rescheduleLoading" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500 mx-auto"></div>
            <p class="mt-4 text-gray-700">Processing...</p>
        </div>
    </div>

    <!-- Success/Error Message -->
    <div id="rescheduleMessage" class="hidden fixed bottom-4 right-4 z-50">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-4">
                <div class="flex items-start">
                    <div id="messageIcon" class="flex-shrink-0"></div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p id="messageText" class="text-sm font-medium text-gray-900"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button id="closeMessage" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commented out Livewire Modal to avoid conflicts -->
    {{-- 
    <div>
        <div x-show="$wire.showModal" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Reschedule {{ count($selectedAppointments) }} Appointments
                        </h3>
                        <div class="mb-4">
                            <label for="newDate" class="block text-sm font-medium text-gray-700">New Date</label>
                            <input type="date" id="newDate" wire:model="newDate" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   min="{{ now()->format('Y-m-d') }}"
                                   wire:change="updatedNewDate">
                            @error('newDate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="newTime" class="block text-sm font-medium text-gray-700">New Time</label>
                            <select id="newTime" wire:model="newTime" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    @if(empty($availableSlots)) disabled @endif>
                                <option value="">Select a time</option>
                                @foreach($availableSlots as $slot)
                                    @if(!$slot['disabled'])
                                        <option value="{{ $slot['time_value'] }}">
                                            {{ $slot['start'] }} - {{ $slot['end'] }} ({{ $slot['remaining_capacity'] }} available)
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('newTime') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="rescheduleAll" 
                                wire:loading.attr="disabled"
                                wire:target="rescheduleAll"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <span wire:loading.remove wire:target="rescheduleAll">Confirm Reschedule</span>
                            <span wire:loading wire:target="rescheduleAll">
                                Processing...
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                        <button wire:click="$set('showModal', false)" 
                                wire:loading.attr="disabled"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}
</div>

<script>
// Update bulk button state function
function updateBulkRescheduleBtn() {
    const selectedCount = document.querySelectorAll('.appointment-checkbox:checked').length;
    const bulkBtn = document.getElementById('bulkRescheduleBtn');
    
    bulkBtn.disabled = selectedCount === 0;
    bulkBtn.textContent = selectedCount > 0 
        ? `Reschedule Selected (${selectedCount})` 
        : 'Reschedule Selected';
}

// Helper function to show messages
function showMessage(type, text) {
    const messageEl = document.getElementById('rescheduleMessage');
    const iconEl = document.getElementById('messageIcon');
    const textEl = document.getElementById('messageText');
    
    messageEl.classList.remove('hidden');
    
    messageEl.querySelector('div').classList.remove(
        'bg-green-50', 'text-green-800', 
        'bg-red-50', 'text-red-800',
        'bg-yellow-50', 'text-yellow-800'
    );
    
    if (type === 'success') {
        iconEl.innerHTML = `
            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        `;
        messageEl.querySelector('div').classList.add('bg-green-50', 'text-green-800');
    } else if (type === 'error') {
        iconEl.innerHTML = `
            <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        `;
        messageEl.querySelector('div').classList.add('bg-red-50', 'text-red-800');
    } else {
        iconEl.innerHTML = `
            <svg class="h-6 w-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        `;
        messageEl.querySelector('div').classList.add('bg-yellow-50', 'text-yellow-800');
    }
    
    textEl.textContent = text;
    
    setTimeout(() => {
        messageEl.classList.add('hidden');
    }, 5000);
}

// Single Appointment Rescheduling
document.querySelectorAll('[id^="rescheduleBtn-"]').forEach(btn => {
    btn.addEventListener('click', function() {
        const appointmentId = this.dataset.appointmentId;
        const doctorId = this.dataset.doctorId;
        const currentDate = this.dataset.currentDate;
        
        document.getElementById('rescheduleModal').dataset.appointmentId = appointmentId;
        document.getElementById('rescheduleModal').dataset.doctorId = doctorId;
        document.getElementById('rescheduleModal').dataset.currentDate = currentDate;
        
        document.getElementById('rescheduleModal').classList.remove('hidden');
        
        document.getElementById('newAppointmentDate').value = '';
        document.getElementById('availableSlots').innerHTML = '';
    });
});

// Date change handler for single rescheduling
document.getElementById('newAppointmentDate').addEventListener('change', function() {
    const doctorId = document.getElementById('rescheduleModal').dataset.doctorId;
    const date = this.value;
    const slotsContainer = document.getElementById('availableSlots');
    
    if (!date) return;
    
    const displayDate = new Date(date).toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric'
    }).replace(/\//g, '/');
    
    slotsContainer.innerHTML = `
        <div class="col-span-3 py-4 text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500 mx-auto"></div>
            <p class="mt-2 text-sm text-gray-500">Checking doctor's availability...</p>
        </div>
    `;
    
    fetch(`/manager/doctors/${doctorId}/slots?date=${date}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Server returned ${response.status} status`);
            }
            return response.json();
        })
        .then(data => {
            if (data.status !== 'success') {
                throw new Error(data.message || 'Error checking availability');
            }
            
            const slots = data.slots || [];
            
            if (slots.length === 0) {
                slotsContainer.innerHTML = `
                    <div class="col-span-3 py-4 text-center">
                        <svg class="mx-auto h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-700">No available slots</p>
                        <p class="mt-1 text-sm text-gray-500">The doctor may be fully booked or unavailable on ${displayDate}</p>
                        <p class="mt-2 text-sm text-gray-500">Please try another date</p>
                    </div>
                `;
                return;
            }
            
            const availableSlots = slots.filter(slot => !slot.disabled);
            
            if (availableSlots.length === 0) {
                slotsContainer.innerHTML = `
                    <div class="col-span-3 py-4 text-center">
                        <svg class="mx-auto h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-700">No available slots</p>
                        <p class="mt-1 text-sm text-gray-500">The doctor is fully booked on ${displayDate}</p>
                        <p class="mt-2 text-sm text-gray-500">Please try another date</p>
                    </div>
                `;
                return;
            }
            
            slotsContainer.innerHTML = `
                <div class="col-span-3 mb-2">
                    <p class="text-sm font-medium text-gray-700">Available time slots for ${displayDate}</p>
                    <p class="text-xs text-gray-500">Select a time slot</p>
                </div>
                ${availableSlots.map(slot => 
                    `<button class="slot-btn py-2 px-3 border rounded-md text-sm font-medium transition-colors
                      hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-300 mb-2"
                      data-time="${slot.time_value}">
                      ${slot.start} - ${slot.end} (${slot.remaining_capacity} available)
                    </button>`
                ).join('')}
            `;
            
            document.querySelectorAll('.slot-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.slot-btn').forEach(b => 
                        b.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-700')
                    );
                    this.classList.add('bg-indigo-600', 'text-white', 'border-indigo-700');
                });
            });
        })
        .catch(error => {
            console.error('Error:', error);
            slotsContainer.innerHTML = `
                <div class="col-span-3 py-4 text-center">
                    <svg class="mx-auto h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <p class="mt-2 text-sm font-medium text-gray-700">Error checking availability</p>
                    <p class="mt-1 text-sm text-gray-500">${error.message || 'Please try again later'}</p>
                </div>
            `;
        });
});

// Confirm single reschedule
document.getElementById('confirmReschedule').addEventListener('click', function() {
    const appointmentId = document.getElementById('rescheduleModal').dataset.appointmentId;
    const selectedSlot = document.querySelector('.slot-btn.bg-indigo-600')?.dataset.time;
    const newDate = document.getElementById('newAppointmentDate').value;
    
    if (!newDate) {
        showMessage('error', 'Please select a date');
        return;
    }
    
    if (!selectedSlot) {
        showMessage('error', 'Please select a time slot');
        return;
    }
    
    document.getElementById('rescheduleLoading').classList.remove('hidden');
    
    const url = `/manager/appointments/${appointmentId}/reschedule`;
    const data = {
        new_date: newDate,
        new_time: selectedSlot.split(':').slice(0, 2).join(':'),
        _token: document.querySelector('meta[name="csrf-token"]').content
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Failed to reschedule appointment');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'error') {
            throw new Error(data.message);
        }
        
        showMessage('success', data.message || 'Appointment rescheduled successfully');
        setTimeout(() => window.location.reload(), 1500);
    })
    .catch(error => {
        console.error('Error:', error);
        showMessage('error', error.message || 'An error occurred while rescheduling');
    })
    .finally(() => {
        document.getElementById('rescheduleLoading').classList.add('hidden');
        document.getElementById('rescheduleModal').classList.add('hidden');
    });
});

// Cancel single reschedule
document.getElementById('cancelReschedule').addEventListener('click', function() {
    document.getElementById('rescheduleModal').classList.add('hidden');
});

// DOMContentLoaded event handler
document.addEventListener('DOMContentLoaded', function() {
    // Initialize checkboxes
    const checkboxes = document.querySelectorAll('.appointment-checkbox');
    
    // Add event listeners to all checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkRescheduleBtn);
    });

    // Add event listener to "Select All"
    document.getElementById('select-all').addEventListener('change', function() {
        const checkAll = this.checked;
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAll;
        });
        updateBulkRescheduleBtn();
    });

    // Bulk Reschedule Button Handler
    document.getElementById('bulkRescheduleBtn').addEventListener('click', function() {
        const selectedCheckboxes = document.querySelectorAll('.appointment-checkbox:checked');
        const appointmentIds = Array.from(selectedCheckboxes).map(cb => cb.value);
        const doctorIds = Array.from(selectedCheckboxes).map(cb => cb.dataset.doctorId);
        
        // Check if all selected appointments are for the same doctor
        const uniqueDoctorIds = [...new Set(doctorIds)];
        if (uniqueDoctorIds.length > 1) {
            showMessage('error', 'Please select appointments for the same doctor');
            return;
        }
        
        // Fetch appointment statuses to ensure they are valid
        fetch('/manager/appointments/check-statuses', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ appointment_ids: appointmentIds })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Server returned ${response.status} status`);
            }
            return response.json();
        })
        .then(data => {
            if (data.invalid_appointments && data.invalid_appointments.length > 0) {
                showMessage('error', 'Some selected appointments cannot be rescheduled due to their status');
                return;
            }
            
            const doctorId = uniqueDoctorIds[0];
            document.getElementById('bulkRescheduleModal').dataset.appointmentIds = JSON.stringify(appointmentIds);
            document.getElementById('bulkRescheduleModal').dataset.doctorId = doctorId;
            document.getElementById('selectedCount').textContent = appointmentIds.length;
            document.getElementById('bulkRescheduleModal').classList.remove('hidden');
            document.getElementById('bulkNewAppointmentDate').value = '';
            document.getElementById('bulkAvailableSlots').innerHTML = '';
        })
        .catch(error => {
            console.error('Error checking appointment statuses:', error);
            showMessage('error', 'Failed to verify appointment statuses: ' + error.message);
        });
    });
    
    // Date change handler for bulk rescheduling
    document.getElementById('bulkNewAppointmentDate').addEventListener('change', function() {
        const doctorId = document.getElementById('bulkRescheduleModal').dataset.doctorId;
        const date = this.value;
        const slotsContainer = document.getElementById('bulkAvailableSlots');
        
        if (!date) return;
        
        const displayDate = new Date(date).toLocaleDateString('en-GB', {
            day: 'numeric',
            month: 'numeric',
            year: 'numeric'
        }).replace(/\//g, '/');
        
        slotsContainer.innerHTML = `
            <div class="col-span-3 py-4 text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500 mx-auto"></div>
                <p class="mt-2 text-sm text-gray-500">Checking doctor's availability...</p>
            </div>
        `;
        
        fetch(`/manager/doctors/${doctorId}/slots?date=${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status} status`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status !== 'success') {
                    throw new Error(data.message || 'Error checking availability');
                }
                
                const slots = data.slots || [];
                
                if (slots.length === 0) {
                    slotsContainer.innerHTML = `
                        <div class="col-span-3 py-4 text-center">
                            <svg class="mx-auto h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium text-gray-700">No available slots</p>
                            <p class="mt-1 text-sm text-gray-500">The doctor may be fully booked or unavailable on ${displayDate}</p>
                            <p class="mt-2 text-sm text-gray-500">Please try another date</p>
                        </div>
                    `;
                    return;
                }
                
                const availableSlots = slots.filter(slot => !slot.disabled);
                
                if (availableSlots.length === 0) {
                    slotsContainer.innerHTML = `
                        <div class="col-span-3 py-4 text-center">
                            <svg class="mx-auto h-8 w-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mt-2 text-sm font-medium text-gray-700">No available slots</p>
                            <p class="mt-1 text-sm text-gray-500">The doctor is fully booked on ${displayDate}</p>
                            <p class="mt-2 text-sm text-gray-500">Please try another date</p>
                        </div>
                    `;
                    return;
                }
                
                slotsContainer.innerHTML = `
                    <div class="col-span-3 mb-2">
                        <p class="text-sm font-medium text-gray-700">Available time slots for ${displayDate}</p>
                        <p class="text-xs text-gray-500">Select one time slot for all appointments</p>
                    </div>
                    ${availableSlots.map(slot => 
                        `<button class="bulk-slot-btn py-2 px-3 border rounded-md text-sm font-medium transition-colors
                          hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-300 mb-2"
                          data-time="${slot.time_value}">
                          ${slot.start} - ${slot.end} (${slot.remaining_capacity} available)
                        </button>`
                    ).join('')}
                `;
                
                document.querySelectorAll('.bulk-slot-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.bulk-slot-btn').forEach(b => 
                            b.classList.remove('bg-indigo-600', 'text-white', 'border-indigo-700')
                        );
                        this.classList.add('bg-indigo-600', 'text-white', 'border-indigo-700');
                    });
                });
            })
            .catch(error => {
                console.error('Error:', error);
                slotsContainer.innerHTML = `
                    <div class="col-span-3 py-4 text-center">
                        <svg class="mx-auto h-8 w-8 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-700">Error checking availability</p>
                        <p class="mt-1 text-sm text-gray-500">${error.message || 'Please try again later'}</p>
                    </div>
                `;
            });
    });
    
    // Confirm bulk reschedule
    document.getElementById('confirmBulkReschedule').addEventListener('click', function() {
        const appointmentIds = JSON.parse(document.getElementById('bulkRescheduleModal').dataset.appointmentIds || '[]');
        const selectedSlot = document.querySelector('.bulk-slot-btn.bg-indigo-600')?.dataset.time;
        const newDate = document.getElementById('bulkNewAppointmentDate').value;
        
        console.log('Bulk reschedule request data:', {
            appointmentIds,
            newDate,
            selectedSlot
        });

        if (!newDate) {
            showMessage('error', 'Please select a date');
            return;
        }
        
        if (!selectedSlot) {
            showMessage('error', 'Please select a time slot');
            return;
        }
        
        if (appointmentIds.length === 0) {
            showMessage('error', 'No appointments selected');
            return;
        }
        
        document.getElementById('rescheduleLoading').classList.remove('hidden');
        
        const url = '/manager/appointments/reschedule-all';
        const data = {
            appointment_ids: appointmentIds,
            new_date: newDate,
            new_time: selectedSlot.split(':').slice(0, 2).join(':'),
            _token: document.querySelector('meta[name="csrf-token"]').content
        };
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || `Server error: ${response.status}`);
                });
            }
            return response.json();
        })
        .then(data => {
            
            if (data.status === 'error') {
                throw new Error(data.message);
            }
            
            showMessage('success', data.message || 'Appointments rescheduled successfully');
            setTimeout(() => window.location.reload(), 1500);
        })
        .catch(error => {
            console.error('Bulk reschedule error:', error);
            showMessage('error', error.message || 'An error occurred while rescheduling');
        })
        .finally(() => {
            document.getElementById('rescheduleLoading').classList.add('hidden');
            document.getElementById('bulkRescheduleModal').classList.add('hidden');
        });
    });

    // Cancel bulk reschedule
    document.getElementById('cancelBulkReschedule').addEventListener('click', function() {
        document.getElementById('bulkRescheduleModal').classList.add('hidden');
    });

    // Close message
    document.getElementById('closeMessage').addEventListener('click', function() {
        document.getElementById('rescheduleMessage').classList.add('hidden');
    });

    // Initialize bulk button state
    updateBulkRescheduleBtn();
});
</script>