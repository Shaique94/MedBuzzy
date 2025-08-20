<div>
    @if($showModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="payment-modal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Payment Management
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Patient Info -->
            @if($appointment)
            <div class="py-4 border-b border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Patient:</span>
                        <span class="text-gray-900">{{ $appointment->patient->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Appointment ID:</span>
                        <span class="text-gray-900">#{{ $appointment->appointment_no }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Doctor:</span>
                        <span class="text-gray-900">{{ $appointment->doctor->user->name }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Date:</span>
                        <span class="text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="py-6 bg-gray-50 rounded-lg my-4">
                <div class="text-center">
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">₹50.00</h4>
                    <p class="text-gray-600">Fixed Appointment Fee</p>
                    
                    @if($paidAmount > 0)
                    <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Payment Status: {{ $paidAmount >= $totalAmount ? 'Fully Paid' : 'Partially Paid (₹' . number_format($paidAmount, 2) . ')' }}
                    </div>
                    @else
                    <div class="mt-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Payment Status: Pending
                    </div>
                    @endif
                </div>
            </div>

            @if($pendingAmount > 0)
            <!-- Payment Form -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="flex items-center justify-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $paymentMethod === 'cash' ? 'border-blue-500 bg-blue-50' : '' }}">
                            <input type="radio" wire:model="paymentMethod" value="cash" class="sr-only">
                            <div class="text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 {{ $paymentMethod === 'cash' ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="text-sm font-medium {{ $paymentMethod === 'cash' ? 'text-blue-600' : 'text-gray-600' }}">Cash</span>
                            </div>
                        </label>

                        <label class="flex items-center justify-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $paymentMethod === 'card' ? 'border-blue-500 bg-blue-50' : '' }}">
                            <input type="radio" wire:model="paymentMethod" value="card" class="sr-only">
                            <div class="text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 {{ $paymentMethod === 'card' ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span class="text-sm font-medium {{ $paymentMethod === 'card' ? 'text-blue-600' : 'text-gray-600' }}">Card</span>
                            </div>
                        </label>

                        <label class="flex items-center justify-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 {{ $paymentMethod === 'upi' ? 'border-blue-500 bg-blue-50' : '' }}">
                            <input type="radio" wire:model="paymentMethod" value="upi" class="sr-only">
                            <div class="text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 {{ $paymentMethod === 'upi' ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm font-medium {{ $paymentMethod === 'upi' ? 'text-blue-600' : 'text-gray-600' }}">UPI</span>
                            </div>
                        </label>
                    </div>
                    @error('paymentMethod') 
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-6">
                <button wire:click="closeModal" 
                        class="px-6 py-2 text-gray-600 hover:text-gray-800 font-medium rounded-lg border border-gray-300 hover:bg-gray-50">
                    Cancel
                </button>
                
                <button wire:click="processPayment" 
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition flex items-center"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="processPayment">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        {{ $paymentMethod === 'upi' ? 'Pay ₹50 Online' : 'Mark as Settled' }}
                    </span>
                    <span wire:loading wire:target="processPayment" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                </button>
            </div>
            @else
            <div class="text-center py-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Payment Completed</h3>
                <p class="text-gray-600">This appointment has been fully paid.</p>
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openRazorpay', (data) => {
                var options = {
                    "key": "{{ config('services.razorpay.key') }}",
                    "amount": data[0].amount,
                    "currency": data[0].currency,
                    "name": data[0].name,
                    "description": data[0].description,
                    "order_id": data[0].orderId,
                    "prefill": data[0].prefill,
                    "theme": {
                        "color": "#2563eb"
                    },
                    "handler": function (response) {
                        @this.call('handleRazorpaySuccess', response);
                    },
                    "modal": {
                        "ondismiss": function(){
                            
                        }
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();
            });
        });
    </script>
    @endif
</div>
