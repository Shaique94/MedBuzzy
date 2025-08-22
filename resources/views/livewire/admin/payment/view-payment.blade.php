<div>
    @if (session()->has('message'))
        <div class="fixed top-4 right-4 z-50 bg-green-50 border border-green-300 text-green-800 px-4 py-2 rounded-lg shadow-lg transition-opacity duration-300 ease-in-out" role="alert" aria-live="assertive">
            {{ session('message') }}
        </div>
    @endif

    @if ($showModal)
        <!-- Backdrop -->
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300 ease-out"
             x-data="{ open: true }" 
             x-show="open"
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0" 
             @keydown.escape.window="open = false; $wire.set('showModal', false)">
            <!-- Payment Modal -->
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-5 sm:p-6 transform transition-all duration-300 ease-out"
                 x-show="open"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 role="dialog" 
                 aria-labelledby="modal-title"
                 aria-modal="true">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 id="modal-title" class="text-xl sm:text-2xl font-semibold text-gray-800">Payment Details</h2>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1">View and process payment information</p>
                    </div>
                    <button type="button" 
                            wire:click="closeModal"
                            @click="open = false"
                            class="text-gray-400 hover:text-gray-600 rounded-full p-1.5 hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            aria-label="Close modal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                        <label class="block text-xs font-medium uppercase text-blue-600 tracking-wide">Patient Name</label>
                        <p class="mt-0.5 text-base sm:text-lg font-medium text-gray-900">{{ $payment->patient->name ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <label class="block text-xs font-medium uppercase text-gray-600 tracking-wide">Appointment ID</label>
                        <p class="mt-0.5 text-base sm:text-lg font-medium text-gray-900">{{ $appointmentId ?? 'N/A' }}</p>
                    </div>

                    {{-- <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <label class="block text-xs font-medium uppercase text-gray-600 tracking-wide">Patient Details</label>
                        <p class="mt-0.5 text-sm sm:text-base text-gray-700 line-clamp-2">{{ $patientDetails ?? 'No details available' }}</p>
                    </div> --}}

                    <div class="bg-amber-50 p-3 rounded-lg border border-amber-100">
                        <label class="block text-xs font-medium uppercase text-amber-600 tracking-wide">Amount Due</label>
                        <p class="mt-0.5 text-lg sm:text-xl font-semibold text-amber-700">${{ $amount ?? '0.00' }}</p>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <label class="block text-xs font-medium uppercase text-gray-600 tracking-wide">Payment Method</label>
                        <p class="mt-0.5 text-base sm:text-lg font-medium text-gray-900 capitalize">{{ $payment->method ?? 'N/A' }}</p>
                    </div>

                    <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <label class="block text-xs font-medium uppercase text-gray-600 tracking-wide">Payment Status</label>
                        <p class="mt-0.5 text-base sm:text-lg font-medium text-gray-900 capitalize">{{ $payment->status ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-5 flex justify-end space-x-2">
                    @if($payment->status === 'pending')
                        <button wire:click="processPayment"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                            Process Payment
                        </button>
                    @endif
                    <button wire:click="closeModal"
                            @click="open = false"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm font-medium">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('modal', () => ({
            open: true,
            closeModal() {
                this.open = false;
                @this.set('showModal', false);
            }
        }));
    });
</script>