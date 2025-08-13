<div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Select Date and Time</h2>

        <!-- Date Selection Tabs -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Appointment Date</label>
            <div class="flex border-b border-gray-200 overflow-x-auto pb-1 scrollbar-hide">
                @php
                    $daysToShow = 10;
                    $dateTabs = [];
                    $daysAdded = 0;
                    if (isset($availableDates) && is_array($availableDates)) {
                        foreach ($availableDates as $date) {
                            if ($daysAdded >= $daysToShow) break;
                            $dateTabs[] = $date;
                            $daysAdded++;
                        }
                    }
                @endphp
                @foreach ($dateTabs as $dateTab)
                    <button wire:click="setAppointmentDate('{{ $dateTab['date'] }}')"
                        class="flex-shrink-0 px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-200
                            {{ $appointmentDate === $dateTab['date']
                                ? 'border-brand-blue-800 text-brand-blue-800 bg-brand-blue-50 shadow-md rounded-t-lg border-t border-l border-r border-brand-blue-200'
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                        aria-current="{{ $appointmentDate === $dateTab['date'] ? 'page' : 'false' }}">
                        <div class="text-center">
                            @if ($dateTab['isToday'])
                                <span class="block text-xs mb-1 font-semibold text-brand-blue-600">Today</span>
                            @elseif (\Carbon\Carbon::parse($dateTab['date'])->isTomorrow())
                                <span class="block text-xs mb-1 font-semibold text-brand-blue-600">Tomorrow</span>
                            @else
                                <span class="block text-xs mb-1 {{ $appointmentDate === $dateTab['date'] ? 'font-semibold' : '' }}">{{ $dateTab['dayName'] }}</span>
                            @endif
                            <span class="block text-base {{ $appointmentDate === $dateTab['date'] ? 'font-bold' : 'font-medium' }}">{{ $dateTab['dayNumber'] }}</span>
                            <span class="block text-xs {{ $appointmentDate === $dateTab['date'] ? 'font-medium' : '' }}">{{ $dateTab['monthName'] }}</span>
                        </div>
                    </button>
                @endforeach
            </div>
            @error('appointmentDate')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Time Selection Tabs -->
        @if ($appointmentDate)
            @php
                $morningSlots = [];
                $afternoonSlots = [];
                $eveningSlots = [];
                foreach ($availableSlots as $time => $slot) {
                    $hour = (int) date('H', strtotime($slot['start']));
                    if ($hour < 12) {
                        $morningSlots[$time] = $slot;
                    } elseif ($hour < 16) {
                        $afternoonSlots[$time] = $slot;
                    } else {
                        $eveningSlots[$time] = $slot;
                    }
                }
            @endphp
            <div x-data="{ activeTab: '{{ $activeTimeTab ?? 'morning' }}' }">
                <div class="border-b border-gray-200 mb-4">
                    <nav class="-mb-px flex space-x-6 overflow-auto" aria-label="Tabs">
                        <button @click="activeTab = 'morning'"
                            :class="activeTab === 'morning' ? 'border-brand-blue-800 text-brand-blue-800' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-2 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Morning <span class="ml-1 text-xs text-gray-500">({{ count($morningSlots) }})</span>
                            </div>
                        </button>
                        <button @click="activeTab = 'afternoon'"
                            :class="activeTab === 'afternoon' ? 'border-brand-blue-800 text-brand-blue-800' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-2 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Afternoon <span class="ml-1 text-xs text-gray-500">({{ count($afternoonSlots) }})</span>
                            </div>
                        </button>
                        <button @click="activeTab = 'evening'"
                            :class="activeTab === 'evening' ? 'border-brand-blue-800 text-brand-blue-800' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-2 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                        clip-rule="evenodd" />
                                </svg>
                                Evening <span class="ml-1 text-xs text-gray-500">({{ count($eveningSlots) }})</span>
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Morning Tab -->
                <div x-show="activeTab === 'morning'" class="py-4">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @forelse ($morningSlots as $time => $slot)
                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                @if ($slot['disabled']) disabled @endif
                                class="p-3 border rounded-lg text-center transition-all duration-200
                                {{ $appointmentTime === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                {{ !$slot['disabled'] && $appointmentTime !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                <div class="text-sm font-medium">
                                    {{ $slot['start'] }}
                                </div>
                                <div class="text-xs mt-1">
                                    {{ $slot['remaining_capacity'] }} spots left
                                </div>
                            </button>
                        @empty
                            <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-sm text-gray-500">No morning slots available</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Afternoon Tab -->
                <div x-show="activeTab === 'afternoon'" class="py-4">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @forelse ($afternoonSlots as $time => $slot)
                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                @if ($slot['disabled']) disabled @endif
                                class="p-3 border rounded-lg text-center transition-all duration-200
                                {{ $appointmentTime === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                {{ !$slot['disabled'] && $appointmentTime !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                <div class="text-sm font-medium">
                                    {{ $slot['start'] }}
                                </div>
                                <div class="text-xs mt-1">
                                    {{ $slot['remaining_capacity'] }} spots left
                                </div>
                            </button>
                        @empty
                            <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-sm text-gray-500">No afternoon slots available</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Evening Tab -->
                <div x-show="activeTab === 'evening'" class="py-4">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @forelse ($eveningSlots as $time => $slot)
                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                @if ($slot['disabled']) disabled @endif
                                class="p-3 border rounded-lg text-center transition-all duration-200
                                {{ $appointmentTime === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                {{ !$slot['disabled'] && $appointmentTime !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                <div class="text-sm font-medium">
                                    {{ $slot['start'] }}
                                </div>
                                <div class="text-xs mt-1">
                                    {{ $slot['remaining_capacity'] }} spots left
                                </div>
                            </button>
                        @empty
                            <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-sm text-gray-500">No evening slots available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            @error('appointmentTime')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        @else
            <p class="text-gray-500">Please select a date to see available time slots.</p>
        @endif
    </div>
</div>
