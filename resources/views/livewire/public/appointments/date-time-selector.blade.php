<!-- livewire/appointment/date-time-selector.blade.php -->
<div>
    <h3 class="text-xl font-bold mb-4">Select Date & Time</h3>
    <div class="space-y-4">
        <div class="flex overflow-x-auto space-x-4 pb-2">
            @foreach($available_dates as $date)
                <button wire:click="setAppointmentDate('{{ $date['date'] }}')" 
                        class="flex-shrink-0 p-4 border rounded-lg text-center {{ $selected_date === $date['date'] ? 'bg-brand-blue-600 text-white' : 'hover:bg-gray-100' }} min-w-[80px]">
                    <div>{{ $date['dayName'] }}</div>
                    <div class="font-bold">{{ $date['dayNumber'] }}</div>
                    <div>{{ $date['monthName'] }}</div>
                </button>
            @endforeach
        </div>
        <div class="flex space-x-4 mb-4">
            <button wire:click="setActiveTimeTab('morning')" class="{{ $active_time_tab === 'morning' ? 'bg-brand-blue-600 text-white' : 'bg-gray-200' }} px-4 py-2 rounded">Morning</button>
            <button wire:click="setActiveTimeTab('afternoon')" class="{{ $active_time_tab === 'afternoon' ? 'bg-brand-blue-600 text-white' : 'bg-gray-200' }} px-4 py-2 rounded">Afternoon</button>
            <button wire:click="setActiveTimeTab('evening')" class="{{ $active_time_tab === 'evening' ? 'bg-brand-blue-600 text-white' : 'bg-gray-200' }} px-4 py-2 rounded">Evening</button>
        </div>
        <div class="grid grid-cols-3 gap-2">
            @foreach($available_slots as $time => $slot)
                @php
                    $hour = (int) explode(':', $slot['start'])[0];
                    if (strpos($slot['start'], 'PM') !== false && $hour != 12) $hour += 12;
                    $tab = $hour < 12 ? 'morning' : ($hour < 16 ? 'afternoon' : 'evening');
                @endphp
                @if($tab === $active_time_tab)
                    <button wire:click="selectTimeSlot('{{ $time }}')" 
                            @if($slot['disabled']) disabled @endif
                            class="p-3 border rounded-lg flex flex-col items-center justify-center h-20 {{ $selected_time === $time ? 'bg-green-200' : ($slot['disabled'] ? 'bg-gray-100 text-gray-500 cursor-not-allowed' : 'hover:bg-gray-100') }} text-center">
                        <span class="font-bold">{{ $slot['start'] }}</span>
                        <span class="text-sm">to {{ $slot['end'] }}</span>
                        <span class="text-xs">({{ $slot['remaining_capacity'] }} left)</span>
                    </button>
                @endif
            @endforeach
        </div>
    </div>
</div>