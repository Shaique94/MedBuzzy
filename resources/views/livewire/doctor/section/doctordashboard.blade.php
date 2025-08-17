<div>
    <div class="min-h-screen bg-gray-50">
    <!-- Main Content -->
    <div class=" p-2  pt-0 md:p-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="p-2 md:p-4">
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 flex flex-wrap items-center">
                    Welcome back Dr. <span class="text-blue-600 ml-1">{{ $doctor_name ?? 'John Doe' }}</span>
                </h1>
            </div>
            <div class="relative w-full md:w-64 lg:w-96">
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Search by doctor, patient or ID..."
                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor">
                    <path
                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                        stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Appointments Card -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Total Appointments</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ $appointments_count ?? '150' }}</p>
                    </div>
                </div>
            </div>

            <!-- Patients Card -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Total Patients</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ $patient_count ?? '85' }}</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Card -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Upcoming</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ $appointments_upcoming ?? '12' }}</p>
                    </div>
                </div>
            </div>

            <!-- Completed Card -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-amber-50 text-amber-600 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Completed</h3>
                        <p class="text-2xl font-bold text-gray-800">{{ $appointments_completed ?? '138' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 md:p-6 mb-6">
            <div class="border-b border-gray-100 mb-4 pb-4">
                <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-3">Upcoming Appointments</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- From Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="date" wire:model="fromDate"
                                class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- To Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="date" wire:model="toDate"
                                class="w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Apply / Reset Buttons -->
                    <div class="md:col-span-2 flex flex-col sm:flex-row gap-2 items-stretch sm:items-end">
                        <button wire:click="loadAppointments"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            <span>Apply Filters</span>
                        </button>
                        @if ($filtersApplied ?? false)
                        <button wire:click="resetFilters"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Reset</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Table - Mobile View -->
            <div class="md:hidden space-y-4">
                @foreach ($appointments ?? [] as $appointment)
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'scheduled' => 'bg-blue-100 text-blue-800',
                        'completed' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                    ];
                    $statusDisplay = [
                        'pending' => 'Pending',
                        'scheduled' => 'Scheduled',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ];
                @endphp
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 mr-3 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment->patient->name ?? 'John Doe') }}&background=random"
                                    alt="Patient" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $appointment->patient->name ?? 'John Doe' }}</p>
                                <p class="text-xs text-gray-500">#PT-{{ $appointment->patient->id ?? '001' }}</p>
                            </div>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$appointment->status ?? 'pending'] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusDisplay[$appointment->status ?? 'pending'] ?? ucfirst($appointment->status ?? 'Pending') }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                        <div>
                            <p class="text-gray-500">Date</p>
                            <p>{{ \Carbon\Carbon::parse($appointment->appointment_date ?? now())->isToday() ? 'Today' : \Carbon\Carbon::parse($appointment->appointment_date ?? now())->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Time</p>
                            <p>{{ \Carbon\Carbon::parse($appointment->appointment_time ?? now())->format('h:i A') }}</p>
                        </div>
                    </div>
                    
                    <div class="text-sm mb-3">
                        <p class="text-gray-500">Purpose</p>
                        <p class="truncate">{{ $appointment->notes ?? 'General Checkup' }}</p>
                    </div>
                    
                    <div class="flex space-x-2">
                        @if (($appointment->status ?? 'pending') === 'scheduled')
                            <button wire:click="markAsCompleted({{ $appointment->id ?? '1' }})"
                                class="flex-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded text-sm font-medium">Complete</button>
                        @else
                            <button disabled
                                class="flex-1 bg-gray-200 text-gray-500 px-3 py-1.5 rounded text-sm font-medium cursor-not-allowed">Complete</button>
                        @endif
             <button 
    wire:click="$dispatch('show-patient-details', { patientId: {{ $appointment->patient->id }} })"
    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm font-medium">
    View
</button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Table - Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead>
                        <tr class="text-left text-gray-500 text-sm border-b border-gray-200">
                            <th class="pb-3">Patient</th>
                            <th class="pb-3">Time</th>
                            <th class="pb-3">Purpose</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($appointments ?? [] as $appointment)
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'scheduled' => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                            ];
                            $statusDisplay = [
                                'pending' => 'Pending',
                                'scheduled' => 'Scheduled',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ];
                        @endphp
                        <tr>
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 mr-3 overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($appointment->patient->name ?? 'John Doe') }}&background=random"
                                            alt="Patient" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $appointment->patient->name ?? 'John Doe' }}</p>
                                        <p class="text-sm text-gray-500">#PT-{{ $appointment->patient->id ?? '001' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4">
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time ?? now())->format('h:i A') }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date ?? now())->isToday() ? 'Today' : \Carbon\Carbon::parse($appointment->appointment_date ?? now())->format('M d, Y') }}
                                </p>
                            </td>
                            <td class="py-4">
                                {{ $appointment->notes ?? 'General Checkup' }}
                            </td>
                            <td class="py-4">
                                <span
                                    class="px-3 py-1 text-sm rounded-full {{ $statusColors[$appointment->status ?? 'pending'] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusDisplay[$appointment->status ?? 'pending'] ?? ucfirst($appointment->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex space-x-2">
                                    @if (($appointment->status ?? 'pending') === 'scheduled')
                                        <button wire:click="markAsCompleted({{ $appointment->id ?? '1' }})"
                                            class="text-green-600 hover:text-green-900 text-sm font-medium">Complete</button>
                                    @else
                                        <button disabled
                                            class="text-gray-400 cursor-not-allowed text-sm font-medium">Complete</button>
                                    @endif
                          <button 
    wire:click="$dispatch('show-patient-details', { patientId: {{ $appointment->patient->id }} })"
    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
    View
</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if (session()->has('message'))
        <div class="p-3 bg-green-100 text-green-800 rounded-lg mb-4">{{ session('message') ?? 'Operation successful!' }}</div>
        @endif

        @if (session()->has('error'))
        <div class="p-3 bg-red-100 text-red-800 rounded-lg mb-4">{{ session('error') ?? 'An error occurred!' }}</div>
        @endif

    </div>
</div>
<livewire:doctor.section.view-detail />
</div>