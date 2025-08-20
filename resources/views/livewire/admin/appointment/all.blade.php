<div>
    <div class="bg-white m-2 sm:m-4 rounded-xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-blue-500 px-4 sm:px-2 lg:px-8 py-4 md:py-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-6">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="bg-white/20 p-2 sm:p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-calendar-check text-xl sm:text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-lg sm:text-xl md:text-2xl font-bold">Appointment Management</h1>
                        <p class="text-blue-100 text-sm sm:text-base">Manage patient appointments efficiently</p>
                    </div>
                </div>
                <a wire:navigate href="{{ route('admin.add.appointment') }}"
                    class="bg-white hover:bg-blue-50 text-blue-600 px-4 py-2 sm:px-6 sm:py-3 rounded-lg transition-all duration-300 flex items-center justify-center gap-2 font-medium text-sm sm:text-base">
                    <i class="fas fa-plus"></i>
                    <span>New Appointment</span>
                </a>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="p-4 sm:p-6 border-b border-gray-100">
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

            <!-- Per Page Selector and Action Buttons -->
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
                    <button wire:click="resetPage"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition flex items-center gap-2 shadow-md hover:shadow-lg text-sm sm:text-base">
                        <i class="fas fa-filter"></i>
                        <span>Apply Filters</span>
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

        <!-- Messages -->
        @if (session()->has('message'))
            <div class="mx-4 sm:mx-6 lg:mx-8 mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mx-4 sm:mx-6 lg:mx-8 mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <div class="sm:hidden">
                <!-- Mobile View: Display as Cards -->
                @forelse ($appointments as $appointment)
                    <div class="bg-white rounded-lg shadow-md p-4 mb-4 border border-gray-200">
                        <h4 class="font-semibold text-gray-800">
                            {{ $appointment->patient->name }}
                        </h4>
                        <p class="text-gray-600 text-sm">
                            Dr. {{ $appointment->doctor->user->name }}
                        </p>
                        <p class="text-gray-500 text-xs">
                           {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }} at
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                        </p>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $appointment->status }}
                            </span>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button wire:click="viewAppointment({{ $appointment->id }})"
                                class="text-blue-600 hover:text-blue-800 text-sm">View</button>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">No appointments found.</div>
                @endforelse
            </div>

            <table class="hidden sm:table min-w-full divide-y divide-gray-200">
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
                        <tr wire:key="appointment-{{ $appointment->id }}" class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-blue-50 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-md text-blue-500 text-sm sm:text-base"></i>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div class="text-sm font-semibold text-gray-900 truncate max-w-[100px] sm:max-w-[150px] md:max-w-none">
                                            {{ $appointment->doctor->user->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500 truncate max-w-[100px] sm:max-w-[150px] md:max-w-none">
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
                                        <div class="text-sm font-semibold text-gray-900 truncate max-w-[100px] sm:max-w-[150px] md:max-w-none">
                                            {{ $appointment->patient->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            ID: {{ $appointment->patient->id ?? '' }}
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
                                @if ($appointment->status === 'checked_in')
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Checked In
                                    </span>
                                @else
                                    <select wire:change="updateStatus({{ $appointment->id }}, $event.target.value)"
                                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1 px-2 pr-6 sm:py-1.5 sm:px-3 sm:pr-8 rounded-md leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm cursor-pointer">
                                        @foreach (['pending', 'scheduled', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" @selected($appointment->status === $status)>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                @if ($appointment->payment?->status === 'paid')
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Paid
                                    </span>
                                @elseif ($appointment->payment?->status === 'due')
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i> Due
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i> N/A
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-1 sm:space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50"
                                        wire:click="viewAppointment({{ $appointment->id }})"
                                        onclick="console.log('View clicked for {{ $appointment->id }}')"
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="printReceipt({{ $appointment->id }})"
                                        class="text-gray-500 hover:text-gray-700 p-1 sm:p-2 rounded-lg hover:bg-gray-50 transition"
                                        title="Print Receipt">
                                        <i class="fas fa-print text-sm sm:text-base"></i>
                                    </button>
                                    <a href="{{ route('appointment.receipt.download', ['appointment' => $appointment->id]) }}"
                                        class="text-green-500 hover:text-green-700 p-1 sm:p-2 rounded-lg hover:bg-green-50 transition"
                                        title="Download Receipt" download>
                                        <i class="fas fa-download text-sm sm:text-base"></i>
                                    </a>
                                    <button class="text-orange-500 hover:text-orange-700 p-1 sm:p-2 rounded-lg hover:bg-orange-50 transition"
                                        wire:click="editAppointment({{ $appointment->id }})"
                                        onclick="console.log('Edit clicked for {{ $appointment->id }}')"
                                        title="Update Appointment">
                                        <i class="fas fa-edit text-sm sm:text-base"></i>
                                    </button>
                                    <button class="text-purple-500 hover:text-purple-700 p-1 sm:p-2 rounded-lg hover:bg-purple-50 transition"
                                        wire:click="managePayment({{ $appointment->id }})"
                                        onclick="console.log('Payment clicked for {{ $appointment->id }}')"
                                        title="Manage Payment">
                                        <i class="fas fa-credit-card text-sm sm:text-base"></i>
                                    </button>
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
                                    <a wire:navigate href="{{ route('admin.add.appointment') }}"
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

        <!-- Pagination -->
        @if ($appointments->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-100">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

    <!-- Edit Modal Component -->
    @livewire('admin.appointment.edit-modal')
    
    <!-- Payment Modal Component -->
    @livewire('admin.appointment.payment-modal')

    <!-- View Details Component -->
    @livewire('admin.appointment.view-details')

    <script>
        function printReceipt(appointmentId) {
            
            const printUrl = `/appointment/receipt/${appointmentId}`;
            const printWindow = window.open(printUrl, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
            
            if (printWindow) {
                printWindow.onload = function() {
                    setTimeout(() => {
                        printWindow.print();
                        printWindow.focus();
                    }, 500);
                };
            } else {
                alert('Pop-up blocked! Please allow pop-ups for this site to print receipts.');
            }
        }

        // Debug action buttons
        document.addEventListener('livewire:init', () => {
            
        });
    </script>
</div>