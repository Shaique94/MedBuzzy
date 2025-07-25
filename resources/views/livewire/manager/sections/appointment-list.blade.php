<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
    <!-- Enhanced Header with Quick Stats -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                    <i class="fas fa-calendar-check text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Appointment Dashboard</h1>
                    <div class="flex flex-wrap gap-x-6 gap-y-2 mt-2">
                        <div class="flex items-center text-blue-100">
                            <i class="fas fa-clock mr-2"></i>
                           <span class="text-sm">{{ $this->todayAppointments }} Today</span>
                        </div>
                        <div class="flex items-center text-blue-100">
                            <i class="fas fa-calendar-week mr-2"></i>
                            <span class="text-sm">{{ $this->weekAppointments }} This Week</span>
                        </div>
                        <div class="flex items-center text-blue-100">
                            <i class="fas fa-user-md mr-2"></i>
<span class="text-sm">{{ $this->doctorsCount }} Active Doctors</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="flex flex-col sm:flex-row gap-3">
                <a href=""
                    class="bg-white hover:bg-blue-50 text-blue-600 px-5 py-2.5 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg font-medium">
                    <i class="fas fa-plus"></i>
                    <span>New Appointment</span>
                </a>
                <button class="bg-blue-700 hover:bg-blue-600 text-white px-4 py-2.5 rounded-lg flex items-center gap-2">
                    <i class="fas fa-download"></i>
                    <span>Export</span>
                </button>
            </div> --}}
        </div>
    </div>

    <!-- Advanced Filter Section -->
    <div class="p-6 border-b border-gray-100">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Search -->
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Search Appointments</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Search by patient, doctor, ID or notes..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select wire:model="statusFilter"
                    class="w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm appearance-none bg-white">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Doctor Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Doctor</label>
                <select wire:model="doctorFilter"
                    class="w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm appearance-none bg-white">
                    <option value="">All Doctors</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Date Range and Action Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-calendar text-gray-400"></i>
                        </div>
                        <input type="date" wire:model="fromDate"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-calendar text-gray-400"></i>
                        </div>
                        <input type="date" wire:model="toDate"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition shadow-sm">
                    </div>
                </div>
            </div>
            <div class="flex items-end justify-end gap-3">
                <button wire:click="resetFilters"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg transition flex items-center gap-2 shadow-sm hover:shadow-md">
                    <i class="fas fa-sync-alt"></i>
                    <span>Reset</span>
                </button>
                <button wire:click="applyFilters"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg transition flex items-center gap-2 shadow-md hover:shadow-lg">
                    <i class="fas fa-filter"></i>
                    <span>Apply Filters</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Appointment Table with Enhanced UI -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Patient Details
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Doctor & Department
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date/Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Payment
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($appointments as $appointment)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        #{{ $appointment->id }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-purple-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-injured text-purple-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">{{ $appointment->patient->name }}</div>
                                <div class="text-xs text-gray-500">
                                    <span class="font-medium">ID:</span> {{ $appointment->patient->id }}
                                    @if($appointment->patient->phone)
                                    <span class="mx-1">•</span>
                                    <i class="fas fa-phone-alt text-xs mr-1"></i>{{ $appointment->patient->phone }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-md text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Dr. {{ $appointment->doctor->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $appointment->doctor->department->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D, M j, Y') }}
                        </div>
                        <div class="text-xs text-gray-500 flex items-center mt-1">
                            <i class="far fa-clock mr-1.5"></i>
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                            @if(\Carbon\Carbon::parse($appointment->appointment_date)->isToday())
                            <span class="ml-2 px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Today</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @switch($appointment->status)
                                @case('checked_in')
                                    <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1.5"></i> Checked In
                                    </span>
                                    @break
                                @case('completed')
                                    <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        <i class="fas fa-check-double mr-1.5"></i> Completed
                                    </span>
                                    @break
                                @case('cancelled')
                                    <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1.5"></i> Cancelled
                                    </span>
                                    @break
                                @default
                                    <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1.5 px-3 pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs cursor-pointer">
                                        <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                                        <option value="confirmed" @selected($appointment->status === 'confirmed')>Confirmed</option>
                                        <option value="rescheduled" @selected($appointment->status === 'rescheduled')>Rescheduled</option>
                                    </select>
                            @endswitch
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($appointment->payment)
                            @if($appointment->payment->status === 'paid')
                                <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1.5"></i> Paid ({{ $appointment->payment->amount }})
                                </span>
                            @else
                                <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1.5"></i> Due ({{ $appointment->payment->amount }})
                                </span>
                            @endif
                        @else
                            <span class="px-2.5 py-1 inline-flex items-center text-xs leading-4 font-semibold rounded-full bg-gray-100 text-gray-800">
                                <i class="fas fa-question-circle mr-1.5"></i> Not Set
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <button class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50"
                                wire:click="$dispatch('openModal', {id: {{ $appointment->id }} })"
                                title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            
                            <a href=""
                                class="text-yellow-500 hover:text-yellow-700 p-2 rounded-full hover:bg-yellow-50"
                                title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            
                            <button class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50"
                                wire:click="confirmCancel({{ $appointment->id }})"
                                title="Cancel Appointment">
                                <i class="fas fa-times"></i>
                            </button>
                            
                            <a href="{{ route('appointment.receipt', ['appointment' => $appointment->id]) }}"
                                class="text-gray-500 hover:text-gray-700 p-2 rounded-full hover:bg-gray-50"
                                title="Print Receipt">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                            <i class="fas fa-calendar-times text-5xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-600 mb-2">No appointments found</h3>
                            <p class="text-sm max-w-md px-4 mb-4">Try adjusting your search filters or create a new appointment</p>
                          
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination and Summary -->
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex flex-col sm:flex-row items-center justify-between">
        <div class="text-sm text-gray-500 mb-4 sm:mb-0">
            Showing <span class="font-medium">{{ $appointments->firstItem() }}</span> to <span class="font-medium">{{ $appointments->lastItem() }}</span> of <span class="font-medium">{{ $appointments->total() }}</span> appointments
        </div>
        <div class="flex items-center space-x-1">
            {{ $appointments->links() }}
        </div>
    </div>
</div>