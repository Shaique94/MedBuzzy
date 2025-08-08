<div>
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4" 
         x-data 
         x-trap.inert.noscroll="true"
         wire:click.self="closeModal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-100 opacity-100"
             @click.stop>
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                    <button wire:click="closeModal" 
                            class="text-gray-400 hover:text-gray-500 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <!-- Warning Icon -->
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-red-100 rounded-full">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                
                <!-- Content -->
                <div class="text-center mb-6">
                    <h4 class="text-base font-medium text-gray-900 mb-2">
                        @if($itemName)
                            Delete "{{ $itemName }}"?
                        @else
                            Delete this {{ $itemType }}?
                        @endif
                    </h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $message }}
                    </p>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-3">
                    <button wire:click="closeModal"
                            class="w-full sm:w-auto px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-all duration-200 hover:shadow-md transform hover:-translate-y-0.5">
                        {{ $cancelText }}
                    </button>
                    <button wire:click="confirmDelete"
                            class="w-full sm:w-auto px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-200 hover:shadow-md transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <style>
    /* Enhanced animations */
    .scale-100 {
        animation: modalIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    
    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    /* Button hover effects */
    button:hover {
        transform: translateY(-1px);
    }
    
    /* Focus states for accessibility */
    button:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }
</style>
</div>


