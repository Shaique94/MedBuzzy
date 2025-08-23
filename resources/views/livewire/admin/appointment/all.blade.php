<div>
    <div class="bg-white m-2 sm:m-4 rounded-xl overflow-hidden shadow-lg">
        <!-- Header Section: Enhanced styling -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-4 sm:px-6 lg:px-8 py-4 md:py-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="bg-white/20 p-2 sm:p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-calendar-check text-xl sm:text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Appointment Management</h1>
                        <p class="text-blue-100 text-sm sm:text-base">Manage patient appointments efficiently</p>
                    </div>
                </div>
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="bg-white hover:bg-blue-50 text-blue-600 px-4 py-2 sm:px-6 sm:py-3 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 font-medium text-sm sm:text-base shadow-md hover:shadow-lg">
                    <i class="fas fa-plus"></i>
                    <span>New Appointment</span>
                </a>
            </div>
        </div>

        <!-- Filters Section: Added Today/Tomorrow buttons -->
        <div class="p-4 sm:p-6 border-b border-gray-100 bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <!-- Search -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">Search Appointments</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Search by doctor, patient or ID..."
                            class="w-full pl-10 pr-4 py-2 sm:py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm text-sm sm:text-base">
                    </div>
                </div>

                <!-- Date Range -->
                <div class="sm:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">From Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-calendar text-gray-400"></i>
                            </div>
                            <input type="date" wire:model.live="fromDate"
                                class="w-full pl-10 pr-4 py-2 sm:py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm text-sm sm:text-base">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 sm:mb-2">To Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-calendar text-gray-400"></i>
                            </div>
                            <input type="date" wire:model.live="toDate"
                                class="w-full pl-10 pr-4 py-2 sm:py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm text-sm sm:text-base">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Per Page Selector and Action Buttons: Added Today/Tomorrow buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4 sm:mt-6">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium text-gray-700">Show:</label>
                    <select wire:model.live="perPage"
                        class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-600">appointments per page</span>
                </div>

                <div class="flex flex-wrap gap-2 sm:gap-3">
                    <!-- New Today/Tomorrow Buttons -->
                    <button wire:click="applyDateFilter('today')"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm hover:shadow-md text-sm sm:text-base {{ $dateFilter === 'today' ? 'bg-blue-200' : '' }}">
                        <i class="fas fa-calendar-day"></i>
                        <span>Today</span>
                    </button>
                    <button wire:click="applyDateFilter('tomorrow')"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm hover:shadow-md text-sm sm:text-base {{ $dateFilter === 'tomorrow' ? 'bg-blue-200' : '' }}">
                        <i class="fas fa-calendar-day"></i>
                        <span>Tomorrow</span>
                    </button>
                    <button wire:click="resetFilters"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm hover:shadow-md text-sm sm:text-base">
                        <i class="fas fa-sync-alt"></i>
                        <span>Reset</span>
                    </button>
                    <button wire:click="refreshAppointments"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition flex items-center gap-2 shadow-md hover:shadow-lg text-sm sm:text-base">
                        <i class="fas fa-refresh"></i>
                        <span>Refresh Data</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Messages: Improved styling -->
        @if (session()->has('message'))
            <div class="mx-4 sm:mx-6 lg:mx-8 my-4 p-4 bg-green-50 text-green-700 rounded-lg text-sm shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mx-4 sm:mx-6 lg:mx-8 my-4 p-4 bg-red-50 text-red-700 rounded-lg text-sm shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <div class="lg:hidden">
                <!-- Mobile View: Display as Cards -->
                @forelse ($appointments as $appointment)
                    <div class="m-4 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300 hover:shadow-lg">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-b border-gray-200">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $appointment->patient->name ?? 'N/A' }}</h3>
                                    <p class="text-gray-600 text-sm mt-1">Appointment ID: #{{ $appointment->id }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-lg">
                                    <i class="fas fa-user-md text-blue-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs text-gray-500">Doctor</p>
                                    <p class="text-sm font-medium text-gray-800">{{ $appointment->doctor->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-5">
                                <div class="flex items-center">
                                    <div class="bg-purple-100 p-2 rounded-lg">
                                        <i class="fas fa-calendar-day text-purple-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-xs text-gray-500">Date</p>
                                        <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div class="bg-amber-100 p-2 rounded-lg">
                                        <i class="fas fa-clock text-amber-600"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-xs text-gray-500">Time</p>
                                        <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status and Actions -->
                            <div class="flex justify-between items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $appointment->status == 'scheduled' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $appointment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $appointment->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $appointment->status == 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                    <span class="w-2 h-2 rounded-full mr-2 
                                        {{ $appointment->status == 'scheduled' ? 'bg-green-500' : '' }}
                                        {{ $appointment->status == 'pending' ? 'bg-yellow-500' : '' }}
                                        {{ $appointment->status == 'cancelled' ? 'bg-red-500' : '' }}
                                        {{ $appointment->status == 'completed' ? 'bg-blue-500' : '' }}"></span>
                                    {{ ucfirst($appointment->status) }}
                                </span>

                                <div class="flex gap-2">
                                    <button wire:click="viewAppointment({{ $appointment->id }})"
                                        class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition"
                                        title="View Details">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>
                                    <a href="{{ route('appointment.receipt.download', ['appointment' => $appointment->id]) }}"
                                        class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition"
                                        title="Download Receipt" download>
                                        <i class="fas fa-download text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.update.appointment', ['id' => $appointment->id]) }}"
                                        class="text-orange-600 hover:text-orange-800 p-2 rounded-lg hover:bg-orange-50 transition"
                                        title="Update Appointment">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">No appointments found.</div>
                @endforelse
            </div>

            <!-- Desktop View: Table -->
            <table class="hidden lg:block min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Doctor
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Patient
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Date & Time
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Payment
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($appointments as $index => $appointment)
                        <tr wire:key="appointment-{{ $appointment->id }}"
                            class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-blue-50 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-md text-blue-500 text-sm sm:text-base"></i>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-semibold text-gray-900 truncate max-w-[150px] md:max-w-none">
                                            {{ $appointment->doctor->user->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500 truncate max-w-[150px] md:max-w-none">
                                            {{ $appointment->doctor->department->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-purple-50 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-injured text-purple-500 text-sm sm:text-base"></i>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-semibold text-gray-900 truncate max-w-[150px] md:max-w-none">
                                            {{ $appointment->patient->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            ID: {{ $appointment->patient->id ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                    class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1 px-2 pr-6 sm:py-1.5 sm:px-3 sm:pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm cursor-pointer">
                                    @foreach (['pending', 'scheduled', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" @selected($appointment->status === $status)>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                @if ($appointment->payment?->status === 'paid')
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Paid
                                    </span>
                                @elseif ($appointment->payment?->status === 'failed')
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Failed
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button wire:click="viewAppointment({{ $appointment->id }})"
                                        class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition"
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('appointment.receipt.download', ['appointment' => $appointment->id]) }}"
                                        class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition"
                                        title="Download Receipt" download>
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="{{ route('admin.update.appointment', ['id' => $appointment->id]) }}"
                                        class="text-orange-600 hover:text-orange-800 p-2 rounded-lg hover:bg-orange-50 transition"
                                        title="Update Appointment">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400 py-4 sm:py-8">
                                    <i class="fas fa-calendar-times text-4xl sm:text-5xl mb-3 sm:mb-4"></i>
                                    <h3 class="text-base sm:text-lg font-medium text-gray-600 mb-1">No appointments found</h3>
                                    <p class="text-xs sm:text-sm max-w-md px-4">Try adjusting your search filters or create a new appointment to get started</p>
                                    <a wire:navigate href="{{ route('our-doctors') }}"
                                        class="mt-3 sm:mt-4 text-blue-500 hover:text-blue-600 font-medium flex items-center text-sm sm:text-base">
                                        <i class="fas fa-plus mr-2"></i> Create New Appointment
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination: Improved styling -->
        @if ($appointments->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

    <!-- View Details Component -->
    @livewire('admin.appointment.view-details')
</div>