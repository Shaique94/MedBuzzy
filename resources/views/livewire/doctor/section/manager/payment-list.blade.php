<div>
    <div class="py-4 sm:py-6  ">
        <!-- Mobile: No max-width and less padding, Desktop: Max-width and proper padding -->
        <div class="px-1 sm:max-w-7xl sm:mx-auto sm:px-6 lg:px-8 w-full">
            <!-- Header and Stats - Mobile compact, Desktop expanded -->
            <div class="mb-6 sm:mb-8">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Payment Records</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-4">
                    <!-- Total Payments -->
                    <div class="bg-white p-3 sm:p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Total</p>
                                <p class="text-base sm:text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Paid Payments -->
                    <div class="bg-white p-3 sm:p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Paid</p>
                                <p class="text-base sm:text-2xl font-semibold text-gray-900">{{ $stats['paid'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Payments -->
                    <div class="bg-white p-3 sm:p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Pending</p>
                                <p class="text-base sm:text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Amount -->
                    <div class="bg-white p-3 sm:p-4 rounded-lg shadow">
                        <div class="flex items-center">
                            <div class="p-2 sm:p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-2 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Amount</p>
                                <p class="text-base sm:text-2xl font-semibold text-gray-900">₹{{ number_format($stats['amount'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters - Mobile compact, Desktop expanded -->
            <div class="bg-white shadow-sm rounded-lg p-3 sm:p-4 mb-4 sm:mb-6">
                <div class="space-y-3 sm:space-y-0 sm:grid sm:grid-cols-5 sm:gap-4">
                    <!-- Search -->
                    <div class="relative sm:col-span-2">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search patients, transactions..."
                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-base py-2 sm:py-2.5"
                        >
                        @if($search)
                            <button 
                                wire:click="$set('search', '')"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </div>
                    
                    <!-- Date Range -->
                    <div>
                        <label for="dateFrom" class="block text-xs sm:text-sm font-medium text-gray-700">From</label>
                        <input
                            type="date"
                            wire:model.live="dateFrom"
                            id="dateFrom"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-sm"
                        >
                    </div>
                    
                    <div>
                        <label for="dateTo" class="block text-xs sm:text-sm font-medium text-gray-700">To</label>
                        <input
                            type="date"
                            wire:model.live="dateTo"
                            id="dateTo"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-sm"
                        >
                    </div>
                    
                    <!-- Reset Button -->
                    <div class="flex items-end">
                        @if($hasFilters)
                            <button
                                wire:click="resetFilters"
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 sm:-ml-1 mr-1 sm:mr-2 h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                <span class="hidden sm:inline">Reset All</span>
                                <span class="sm:hidden">Reset</span>
                            </button>
                        @endif
                    </div>
                </div>
                
                <div class="mt-3 sm:mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                    <!-- Status and Method -->
                    <div class="grid grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label for="status" class="block text-xs sm:text-sm font-medium text-gray-700">Status</label>
                            <select
                                wire:model.live="status"
                                id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-sm"
                            >
                                <option value="">All</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="method" class="block text-xs sm:text-sm font-medium text-gray-700">Method</label>
                            <select
                                wire:model.live="method"
                                id="method"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-sm"
                            >
                                <option value="">All</option>
                                @foreach($methods as $method)
                                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="perPage" class="block text-xs sm:text-sm font-medium text-gray-700">Per Page</label>
                        <select
                            wire:model.live="perPage"
                            id="perPage"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm sm:text-sm"
                        >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Payments Table - Mobile compact, Desktop expanded -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div wire:loading.delay class="bg-blue-50 p-3 sm:p-4 text-blue-700 text-xs sm:text-sm">
                    Loading payments...
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date/Time
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Patient
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                    Appointment
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                    Amount
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                    Method
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($payments as $payment)
                                <tr>
                                    <td class="px-3 sm:px-6 py-3 whitespace-nowrap">
                                        <div class="text-xs sm:text-sm text-gray-900">{{ $payment->created_at->format('d M') }}</div>
                                        <div class="text-xs text-gray-500">{{ $payment->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-3">
                                        <div class="text-xs sm:text-sm font-medium text-gray-900 truncate max-w-[100px] sm:max-w-none">
                                            {{ $payment->patient->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $payment->patient->phone }}</div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 whitespace-nowrap text-xs sm:text-sm text-gray-500 hidden sm:table-cell">
                                        @if($payment->appointment && $payment->appointment->appointment_date)
                                            {{ \Carbon\Carbon::parse($payment->appointment->appointment_date)->format('d M Y') }}<br>
                                            <span class="text-xs text-gray-400">{{ $payment->appointment->appointment_time }}</span>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 whitespace-nowrap text-xs sm:text-sm font-medium text-gray-900 hidden sm:table-cell">
                                        ₹{{ number_format($payment->amount, 2) }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 whitespace-nowrap text-xs sm:text-sm text-gray-500 hidden sm:table-cell">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($payment->method) }}
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-3 whitespace-nowrap">
                                        @if($payment->status === 'paid')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Paid
                                            </span>
                                        @elseif($payment->status === 'pending')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Failed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->transaction_id ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        {{-- <button class="text-blue-600 hover:text-blue-900 mr-3">View</button> --}}
                                     <a wire:navigate href="{{ route('appointment.receipt', $payment->appointment_id) }}" 
   target="_blank"
   class="text-green-600 hover:text-green-900">
    Receipt
</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No payments found</h3>
                                        <p class="mt-1 text-xs sm:text-sm text-gray-500">Try adjusting your search or filter criteria</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 border-t border-gray-200">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>