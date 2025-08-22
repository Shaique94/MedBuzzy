

<div class="bg-white rounded-lg border border-gray-200 mt-6 mx-4 sm:mx-6 lg:mx-8">
    <!-- Header Section -->
    <div class="bg-brand-blue-600 px-4 sm:px-6 lg:px-8 py-6 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-white/10 p-3 rounded-lg">
                    <i class="fas fa-calendar-check text-xl lg:text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-xl lg:text-2xl font-medium">Appointment Management</h1>
                    <p class="text-brand-blue-100 text-sm mt-1">Manage and track all patient appointments</p>
                </div>
            </div>
        </div>
        
        
    </div>

    <!-- Filter Section -->
    <div class="p-4 sm:p-6 lg:p-8 border-b border-gray-200 bg-gray-50">
     
        
        <!-- Search -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Search Appointments</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Search by patient name, doctor, or appointment ID..."
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition text-sm">
            </div>
        </div>

        <!-- Filter Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Status</label>
                <select wire:model.live="statusFilter"
                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition text-sm">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="checked_in">Checked In</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="rescheduled">Rescheduled</option>
                </select>
            </div>

            <!-- Doctor Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Select Doctor</label>
                <select wire:model.live="doctorFilter"
                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition text-sm">
                    <option value="">All Doctors</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Date From -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" wire:model.live="fromDate"
                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition text-sm">
            </div>
            
            <!-- Date To -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" wire:model.live="toDate"
                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition text-sm">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mt-6">
            <button wire:click="resetFilters"
                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-3 rounded-lg transition flex items-center justify-center gap-2 text-sm">
                <i class="fas fa-sync-alt"></i> Reset Filters
            </button>
            <button wire:click="applyFilters"
                class="flex-1 bg-brand-blue-600 hover:bg-brand-blue-700 text-white px-4 py-3 rounded-lg transition flex items-center justify-center gap-2 text-sm">
                <i class="fas fa-filter"></i> Apply Filters
            </button>
        </div>
    </div>

    <!-- Mobile View: Cards -->
    <div class="block lg:hidden">
        @forelse ($appointments as $appointment)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50 transition">
                <!-- Header -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-900">Appointment #{{ $appointment->id }}</span>
                        @if (\Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Today</span>
                        @endif
                    </div>
                    <div class="flex items-center">
                        @switch($appointment->status)
                            @case('checked_in')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i> Checked In
                                </span>
                            @break
                            @case('completed')
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 flex items-center">
                                    <i class="fas fa-check-double mr-1"></i> Completed
                                </span>
                            @break
                            @case('cancelled')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 flex items-center">
                                    <i class="fas fa-times-circle mr-1"></i> Cancelled
                                </span>
                            @break
                            @case('rescheduled')
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i> Rescheduled
                                </span>
                            @break
                            @default
                                <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                    class="bg-gray-100 border border-gray-300 text-gray-700 py-1 px-2 rounded text-xs cursor-pointer">
                                    <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                                    <option value="checked_in" @selected($appointment->status === 'checked_in')>Checked In</option>
                                    <option value="completed" @selected($appointment->status === 'completed')>Completed</option>
                                    <option value="rescheduled" @selected($appointment->status === 'rescheduled')>Rescheduled</option>
                                </select>
                        @endswitch
                    </div>
                </div>

                <!-- Patient Info -->
                <div class="flex items-center mb-3">
                    <div class="h-10 w-10 bg-blue-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</div>
                        <div class="text-xs text-gray-500">
                            Patient ID: {{ $appointment->patient->id }}
                            @if ($appointment->patient->phone)
                                • <i class="fas fa-phone mr-1"></i>{{ $appointment->patient->phone }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Doctor Info -->
                <div class="flex items-center mb-3">
                    <div class="h-10 w-10 bg-green-50 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-md text-green-600"></i>
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">Dr. {{ $appointment->doctor->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $appointment->doctor->department->name }}</div>
                    </div>
                </div>

                <!-- Date, Time, Payment -->
                <div class="grid grid-cols-2 gap-3 mb-4 text-xs">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-gray-600 mb-1">Appointment Date</div>
                        <div class="text-gray-900 font-medium">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y') }}
                        </div>
                        <div class="text-gray-600 mt-1">
                            <i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                        </div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="text-gray-600 mb-1">Consultation Fee</div>
                        <span class="text-gray-900 font-medium text-lg">₹{{ $appointment->doctor->fee ?? 'N/A' }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2 pt-3 border-t border-gray-200">
                    <a wire:navigate href="{{ route('doctor.patients.view', $appointment->patient->id) }}" 
                        class="flex-1 text-center bg-brand-blue-50 text-brand-blue-600 py-2 px-3 rounded-lg text-sm hover:bg-brand-blue-100 transition">
                        <i class="fas fa-user-circle mr-1"></i> View Patient
                    </a>
                    {{-- <button onclick="window.print()" 
                        class="flex-1 text-center bg-green-50 text-green-600 py-2 px-3 rounded-lg text-sm hover:bg-green-100 transition">
                        <i class="fas fa-print mr-1"></i> Print Receipt
                    </button> --}}
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="flex flex-col items-center text-gray-400">
                    <i class="fas fa-calendar-times text-5xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No Appointments Found</h3>
                    <p class="text-sm text-gray-500 mb-4">We couldn't find any appointments matching your criteria.</p>
                   <div class="flex flex-col items-center text-gray-400">
                                <i class="fas fa-calendar-times text-6xl mb-4"></i>
                                <h3 class="text-xl font-medium text-gray-600 mb-3">No Appointments Found</h3>
                                
                                <button wire:click="resetFilters" 
                                    class="mt-4 bg-brand-blue-600 hover:bg-brand-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                                    <i class="fas fa-sync-alt mr-2"></i> Reset All Filters
                                </button>
                            </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Desktop View: Table -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Appointment ID</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Patient Details</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Doctor Information</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Fee Amount</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $appointment->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-blue-50 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</div>
                                    <div class="text-xs text-gray-500">
                                        ID: {{ $appointment->patient->id }}
                                        @if ($appointment->patient->phone)
                                            • <i class="fas fa-phone mr-1"></i>{{ $appointment->patient->phone }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-green-50 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-md text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Dr. {{ $appointment->doctor->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $appointment->doctor->department->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M j, Y') }}
                            </div>
                            <div class="text-xs text-gray-500 flex items-center mt-1">
                                <i class="far fa-clock mr-2"></i>
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                @if (\Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                                    <span class="ml-2 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">Today</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @switch($appointment->status)
                                @case('checked_in')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 flex items-center w-fit">
                                        <i class="fas fa-check-circle mr-2"></i> Checked In
                                    </span>
                                @break
                                @case('completed')
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 flex items-center w-fit">
                                        <i class="fas fa-check-double mr-2"></i> Completed
                                    </span>
                                @break
                                @case('cancelled')
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 flex items-center w-fit">
                                        <i class="fas fa-times-circle mr-2"></i> Cancelled
                                    </span>
                                @break
                                @case('rescheduled')
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 flex items-center w-fit">
                                        <i class="fas fa-calendar-alt mr-2"></i> Rescheduled
                                    </span>
                                @break
                                @default
                                    <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                        class="bg-gray-100 border border-gray-300 text-gray-700 py-2 px-3 rounded text-xs cursor-pointer">
                                        <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                                        <option value="checked_in" @selected($appointment->status === 'checked_in')>Checked In</option>
                                        <option value="completed" @selected($appointment->status === 'completed')>Completed</option>
                                        <option value="rescheduled" @selected($appointment->status === 'rescheduled')>Rescheduled</option>
                                    </select>
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-900">₹{{ $appointment->doctor->fee ?? 'N/A' }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <a wire:navigate href="{{ route('doctor.patients.view', $appointment->patient->id) }}" 
                                    class="text-brand-blue-600 hover:text-brand-blue-800 font-medium transition-colors text-sm"
                                    title="View Patient Details">
                                    <i class="fas fa-user-circle mr-1"></i> View Patient
                                </a>
                                {{-- <button onclick="window.print()" 
                                    class="text-green-600 hover:text-green-800 font-medium transition-colors text-sm"
                                    title="Print Appointment Receipt">
                                    <i class="fas fa-print mr-1"></i> Print
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center text-gray-400">
                                <i class="fas fa-calendar-times text-6xl mb-4"></i>
                                <h3 class="text-xl font-medium text-gray-600 mb-3">No Appointments Found</h3>
                                
                                <button wire:click="resetFilters" 
                                    class="mt-4 bg-brand-blue-600 hover:bg-brand-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                                    <i class="fas fa-sync-alt mr-2"></i> Reset All Filters
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 sm:px-6 lg:px-8 py-6 border-t border-gray-200 bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-sm text-gray-600">
            @if ($appointments->total() > 0)
                Showing <span class="font-medium">{{ $appointments->firstItem() }}</span> to 
                <span class="font-medium">{{ $appointments->lastItem() }}</span> of 
                <span class="font-medium">{{ $appointments->total() }}</span> total appointments
            @else
                <span class="text-gray-500">No appointments to display</span>
            @endif
        </div>
        <div>
            {{ $appointments->links() }}
        </div>
    </div>
</div>

{{-- <script>
// Custom print function for appointment receipts
function printAppointmentReceipt(appointmentId) {
    // You can customize this to open a specific receipt URL or format
    window.open(`/appointment/${appointmentId}/receipt`, '_blank');
}
</script> --}}