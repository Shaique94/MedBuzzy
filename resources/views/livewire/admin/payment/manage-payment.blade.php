<div class="w-full max-w-7xl mx-auto p-2 sm:p-4 overflow-x-hidden">

    <!-- Stats Cards - Enhanced with better shadows and transitions -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Total Revenue Card -->
        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-900 mt-1">₹{{ number_format($totalRevenue, 0) }}</p>
                </div>
                <div class="bg-blue-100 p-2 sm:p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm">
                <span class="font-medium {{ $totalRevenue > 0 ? 'text-green-600' : 'text-gray-600' }}">
                    {{ $totalRevenue > 0 ? '↑' : '→' }} {{ $totalRevenue > 0 ? round($totalRevenue / 10000) : 0 }}%
                </span>
                <span class="text-gray-500 ml-2">vs last month</span>
            </div>
        </div>

        <!-- Successful Payments Card -->
        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Successful</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-900 mt-1">₹{{ number_format($totalRevenue, 0) }}</p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span class="font-medium text-gray-600">Success rate</span>
                    <span class="font-semibold text-green-600">{{ $successRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-green-500 h-1.5 rounded-full transition-all duration-300" style="width: {{ $successRate }}%"></div>
                </div>
            </div>
        </div>

        <!-- Failed Payments Card -->
        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Failed</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-900 mt-1">₹{{ number_format($failedPayment, 0) }}</p>
                </div>
                <div class="bg-red-100 p-2 sm:p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4">
                <div class="flex justify-between items-center text-xs sm:text-sm">
                    <span class="font-medium text-gray-600">Failure rate</span>
                    <span class="font-semibold text-red-600">{{ 100 - $successRate }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                    <div class="bg-red-500 h-1.5 rounded-full transition-all duration-300" style="width: {{ 100 - $successRate }}%"></div>
                </div>
            </div>
        </div>

        <!-- Average Transaction Card -->
        <div class="bg-white p-4 sm:p-6 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Avg. Transaction</p>
                    <p class="text-xl sm:text-2xl font-semibold text-gray-900 mt-1">
                        ₹{{ $totalRevenue > 0 && $successfulTransactions > 0 ? number_format($totalRevenue / $successfulTransactions, 2) : '0.00' }}
                    </p>
                </div>
                <div class="bg-purple-100 p-2 sm:p-3 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:mt-4 flex items-center text-xs sm:text-sm">
                <span class="font-medium text-gray-600">per transaction</span>
                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-md ml-auto">{{ $successfulTransactions }} transactions</span>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <!-- Tabs Navigation - Improved with smoother transitions -->
        <div class="border-b border-gray-200 ">
            <div class="flex overflow-x-auto -mb-px space-x-2 sm:space-x-0">
                <button wire:click="setActiveTab('all')" class="{{ $activeTab === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 sm:py-4 px-3 sm:px-4 border-b-2 font-medium text-xs sm:text-sm flex items-center transition-colors duration-200">
                    <span>All Payments</span>
                    <span class="ml-2 bg-gray-100 text-gray-800 py-0.5  rounded-full text-xs font-medium">
                        {{ $totalPaymentsCount }}
                    </span>
                </button>
                <button wire:click="setActiveTab('paid')" class="{{ $activeTab === 'paid' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 sm:py-4 px-3 sm:px-4 border-b-2 font-medium text-xs sm:text-sm flex items-center transition-colors duration-200">
                    <span>Successful</span>
                    <span class="ml-2 bg-green-100 text-green-800 py-0.5  rounded-full text-xs font-medium">
                        {{ $successfulPaymentsCount }}
                    </span>
                </button>
                <button wire:click="setActiveTab('failed')" class="{{ $activeTab === 'failed' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 sm:py-4 px-3 sm:px-4 border-b-2 font-medium text-xs sm:text-sm flex items-center transition-colors duration-200">
                    <span>Failed</span>
                    <span class="ml-2 bg-red-100 text-red-800 py-0.5  rounded-full text-xs font-medium">
                        {{ $failedPaymentsCount }}
                    </span>
                </button>
                <button wire:click="setActiveTab('pending')" class="{{ $activeTab === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 sm:py-4 px-3 sm:px-4 border-b-2 font-medium text-xs sm:text-sm flex items-center transition-colors duration-200">
                    <span>Pending</span>
                    <span class="ml-2 bg-yellow-100 text-yellow-800 py-0.5  rounded-full text-xs font-medium">
                        {{ $pendingPaymentsCount }}
                    </span>
                </button>
                <button wire:click="setActiveTab('refunded')" class="{{ $activeTab === 'refunded' ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-3 sm:py-4 px-3 sm:px-4 border-b-2 font-medium text-xs sm:text-sm flex items-center transition-colors duration-200">
                    <span>Refunded</span>
                    <span class="ml-2 bg-purple-100 text-purple-800 py-0.5  rounded-full text-xs font-medium">
                        {{ $refundedPaymentsCount }}
                    </span>
                </button>
            </div>
        </div>

        <!-- Filters Section - Made more responsive with auto widths -->
       <!-- Filters Section - Responsive on mobile -->
<div class="p-4 sm:p-6 border-b border-gray-200">
    <div class="flex flex-wrap gap-3 sm:gap-4">
        
        <!-- Search -->
        <div class="flex-1 min-w-[150px]">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" 
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 
                              3.476l4.817 4.817a1 1 0 01-1.414 
                              1.414l-4.816-4.816A6 6 0 012 8z" 
                              clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="search" 
                       wire:model.live.debounce.300ms="search"
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md 
                              focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                              placeholder-gray-400 text-sm"
                       placeholder="Transaction ID, patient...">
            </div>
        </div>

        <!-- Date Range -->
        <div class="flex-1 min-w-[120px]">
            <label for="dateRange" class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select id="dateRange" 
                    wire:model.live="dateRange"
                    class="block w-full pl-3 pr-8 py-2 text-sm border border-gray-300 
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                           rounded-md">
                <option value="">All Time</option>
                <option value="7days">Last 7 days</option>
                <option value="30days">Last 30 days</option>
                <option value="90days">Last 90 days</option>
                <option value="custom">Custom</option>
            </select>
        </div>

        <!-- Payment Method -->
        <div class="flex-1 min-w-[120px]">
            <label for="methodFilter" class="block text-sm font-medium text-gray-700 mb-1">Method</label>
            <select id="methodFilter" 
                    wire:model.live="methodFilter"
                    class="block w-full pl-3 pr-8 py-2 text-sm border border-gray-300 
                           focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                           rounded-md">
                <option value="">All Methods</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <option value="upi">UPI</option>
                <option value="net_banking">Net Banking</option>
            </select>
        </div>
    </div>
</div>


        <!-- Loading Indicator - Enhanced with better animation and text -->
        <div class="flex justify-center items-center">
            <div wire:loading class="flex justify-center items-center p-8 sm:p-12">
            <div class="flex flex-col items-center">
                <div class="animate-spin rounded-full h-8 w-8 sm:h-12 sm:w-12 border-t-2 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-gray-600 text-sm sm:text-base">Loading payments...</p>
            </div>
        </div>

        </div>
        <!-- Transactions Table - Improved responsiveness and hover effects -->
      <div wire:loading.remove class="overflow-x-auto w-full  max-w-6xl mx-auto p-2 sm:p-4">
    <table class="min-w-full divide-y divide-gray-200 text-xs sm:text-sm md:text-base">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Transaction ID
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Patient
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden sm:table-cell">
                    Date & Time
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Amount
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap hidden md:table-cell">
                    Method
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Status
                </th>
                <th scope="col" class="px-2 sm:px-4 md:px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($payments as $payment)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Transaction ID -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                        {{ $payment->transaction_id ?? 'N/A' }}
                    </td>

                    <!-- Patient Info -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium">
                                    {{ substr($payment->patient->name ?? 'DU', 0, 1) }}
                                </span>
                            </div>
                            <div class="ml-2 sm:ml-3 md:ml-4">
                                <div class="font-medium text-gray-900 truncate max-w-[120px] sm:max-w-[180px] md:max-w-xs">
                                    {{ $payment->patient->name ?? 'Deleted User' }}
                                </div>
                                <div class="text-xs text-gray-500 truncate max-w-[120px] sm:max-w-[180px] md:max-w-xs">
                                    {{ $payment->patient->email ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Date & Time (hidden on xs) -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                        <div class="text-sm text-gray-900">{{ $payment->created_at->format('d M Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $payment->created_at->format('h:i A') }}</div>
                    </td>

                    <!-- Amount -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                        ₹{{ number_format($payment->amount, 2) }}
                    </td>

                    <!-- Method (hidden on small) -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                        @php
                            $methodColors = [
                                'credit_card' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                                'debit_card' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800'],
                                'upi' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                                'net_banking' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-800'],
                            ];
                            $color = $methodColors[$payment->method] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'];
                        @endphp
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $color['bg'] }} {{ $color['text'] }}">
                            {{ ucwords(str_replace('_', ' ', $payment->method)) }}
                        </span>
                    </td>

                    <!-- Status -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap">
                        @php
                            $statusColors = [
                                'paid' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dot' => 'bg-green-400'],
                                'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dot' => 'bg-yellow-400'],
                                'failed' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dot' => 'bg-red-400'],
                                'refunded' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'dot' => 'bg-blue-400'],
                            ];
                            $color = $statusColors[$payment->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'dot' => 'bg-gray-400'];
                        @endphp
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $color['bg'] }} {{ $color['text'] }} inline-flex items-center">
                            <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full {{ $color['dot'] }} mr-1.5"></span>
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-2 sm:px-4 md:px-6 py-4 whitespace-nowrap text-right font-medium">
                        <button wire:click="$dispatch('openModal', { paymentId: {{ $payment->id }} })" 
                                class="text-blue-600 hover:text-blue-900 inline-flex items-center px-2 py-1 rounded-md hover:bg-blue-50 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No payments found</h3>
                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                            <button wire:click="resetFilters" 
                                    class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Reset filters
                            </button>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <livewire:admin.payment.view-payment/>
</div>




        <!-- Pagination - Redesigned for better touch targets and cleaner look -->
        @if ($payments->hasPages())
            <div class="bg-white  py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($payments->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <button wire:click="previousPage" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            Previous
                        </button>
                    @endif

                    @if ($payments->hasMorePages())
                        <button wire:click="nextPage" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                            Next
                        </button>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed">
                            Next
                        </span>
                    @endif
                </div>

                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $payments->firstItem() }}</span> to <span class="font-medium">{{ $payments->lastItem() }}</span> of <span class="font-medium">{{ $payments->total() }}</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            @if ($payments->onFirstPage())
                                <span class="relative inline-flex items-center  py-2 rounded-l-md border border-gray-300 bg-gray-50 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @else
                                <button wire:click="previousPage" class="relative inline-flex items-center  py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                    <span class="sr-only">Previous</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif

                            @foreach ($payments->links()->elements as $element)
                                @if (is_string($element))
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                        {{ $element }}
                                    </span>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $payments->currentPage())
                                            <span aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <button wire:click="gotoPage({{ $page }})" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium transition-colors duration-200">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if ($payments->hasMorePages())
                                <button wire:click="nextPage" class="relative inline-flex items-center  py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @else
                                <span class="relative inline-flex items-center  py-2 rounded-r-md border border-gray-300 bg-gray-50 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
</div>