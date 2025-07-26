<div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header with icon -->
    <div class="flex items-center space-x-3 mb-6">
        <div class="p-2 bg-blue-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Record Payment</h2>
            <p class="text-sm text-gray-500">Patient ID: {{ $patientId }}</p>
        </div>
    </div>

    <!-- Fee Input Section -->
    <div class="mb-6">
        <label for="feeInput" class="block text-sm font-medium text-gray-700 mb-2">Consultation Fee (₹)</label>
        <div class="relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">₹</span>
            </div>
            <input 
                type="number" 
                id="feeInput"
                wire:model="fee"
                class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 py-3 border-gray-300 rounded-md"
                placeholder="0.00"
                step="0.01"
                min="0"
            >
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <button 
                    wire:click="resetToDefaultFee"
                    type="button"
                    class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                    title="Reset to default fee"
                >
                    Reset
                </button>
            </div>
        </div>
        @error('fee') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        
        <div class="mt-2 text-sm text-gray-500">
            <span class="font-medium">Default Fee:</span> ₹{{ number_format($defaultFee, 2) }}
        </div>
    </div>

    <!-- Payment Method Selection -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
        <div class="grid grid-cols-3 gap-3">
            @foreach(['cash' => 'Cash', 'card' => 'Card', 'upi' => 'UPI'] as $value => $label)
                <label class="flex items-center justify-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition
                    {{ $paymentMethod === $value ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}">
                    <input 
                        type="radio" 
                        wire:model="paymentMethod"
                        value="{{ $value }}"
                        class="sr-only"
                    >
                    <span>{{ $label }}</span>
                </label>
            @endforeach
        </div>
        @error('paymentMethod') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
        <button 
            wire:click="closeModal" 
            type="button"
            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium"
        >
            Cancel
        </button>
        <button 
            wire:click="save" 
            type="button"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium shadow-sm transition flex items-center"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Record Payment
        </button>
    </div>
</div>