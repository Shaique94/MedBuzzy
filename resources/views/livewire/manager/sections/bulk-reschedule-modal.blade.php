<div>
    <!-- Modal Backdrop -->
    <div x-show="$wire.showModal" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto p-2 sm:p-4">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal Content -->
            <div class="relative inline-block w-full max-w-lg bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-indigo-600"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Reschedule {{ count($selectedAppointments) }} Appointments
                            </h3>
                            <p class="text-sm text-gray-500">Select a new date and time for all selected appointments</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="newDate" class="block text-sm font-medium text-gray-700 mb-2">New Date</label>
                            <input type="date" id="newDate" wire:model="newDate" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5"
                                   min="{{ now()->format('Y-m-d') }}"
                                   wire:change="updatedNewDate">
                            @error('newDate') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label for="newTime" class="block text-sm font-medium text-gray-700 mb-2">New Time</label>
                            <select id="newTime" wire:model="newTime" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2.5"
                                    @if(empty($availableSlots)) disabled @endif>
                                <option value="">
                                    @if(empty($availableSlots) && $newDate)
                                        No available slots for this date
                                    @else
                                        Select a time
                                    @endif
                                </option>
                                @foreach($availableSlots as $slot)
                                    @if(!$slot['disabled'])
                                        <option value="{{ $slot['time_value'] }}">
                                            {{ $slot['start'] }} - {{ $slot['end'] }} ({{ $slot['remaining_capacity'] }} available)
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('newTime') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3">
                    <button wire:click="$set('showModal', false)" 
                            wire:loading.attr="disabled"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm transition-colors">
                        Cancel
                    </button>
                    <button wire:click="rescheduleAll" 
                            wire:loading.attr="disabled"
                            wire:target="rescheduleAll"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2.5 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm transition-colors disabled:opacity-50">
                        <span wire:loading.remove wire:target="rescheduleAll">Confirm Reschedule</span>
                        <span wire:loading wire:target="rescheduleAll" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>