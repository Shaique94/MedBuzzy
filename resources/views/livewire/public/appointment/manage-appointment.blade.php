<div>
    <div class="min-h-screen mt-5 p-1 sm:px-0 lg:px-0 bg-gray-50">
        <div class="w-full max-w-none mx-0">
            <!-- Header -->
            <div class="text-center bg-brand-blue-600 rounded-none py-6 w-full">
                <h1 class="text-3xl font-bold text-white">Book an Appointment</h1>
                <p class="mt-2 text-brand-yellow-300">Schedule your visit with our expert doctors</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white w-full rounded-none border-t border-b border-brand-blue-200">
                <!-- Progress Steps -->
                <div class="bg-brand-blue-50 px-0 py-4 w-full border-b border-brand-blue-100">
                    <div class="flex items-center justify-between max-w-5xl mx-auto
                    flex-nowrap overflow-x-auto scrollbar-hide gap-0 sm:gap-0 px-2 sm:px-0"
                        style="min-width:0;">
                        @php
                            $steps = [
                                1 => ['label' => 'Doctor', 'icon' => 'user-md'],
                                2 => ['label' => 'Date & Time', 'icon' => 'calendar-alt'],
                                3 => ['label' => 'Patient Details', 'icon' => 'user-circle'],
                            ];
                            $maxStep = count($steps);
                        @endphp

                        @foreach ($steps as $stepNumber => $stepInfo)
                            <div class="flex flex-col items-center relative flex-1 min-w-[90px] sm:min-w-0 px-1">
                                <div
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full
                                {{ $step >= $stepNumber ? 'bg-brand-blue-600 text-white' : 'bg-white text-gray-400 border-2 border-gray-300' }}
                                transition-all duration-300 relative z-10 text-base sm:text-lg">
                                    @if ($stepInfo['icon'] === 'user-md')
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    @elseif($stepInfo['icon'] === 'calendar-alt')
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($stepInfo['icon'] === 'user-circle')
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    @if ($step === $stepNumber)
                                        <div
                                            class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 sm:w-3 sm:h-3 bg-brand-blue-600 rounded-full">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="mt-1 text-[11px] sm:text-xs font-medium {{ $step >= $stepNumber ? 'text-brand-blue-800' : 'text-gray-500' }} hidden sm:block text-center leading-tight break-words w-full">
                                    {{ $stepInfo['label'] }}
                                </span>
                                <span
                                    class="mt-1 text-[10px] font-medium {{ $step >= $stepNumber ? 'text-brand-blue-800' : 'text-gray-500' }} sm:hidden text-center leading-tight break-words w-full">
                                    {{ $stepInfo['label'] }}
                                </span>
                                @if ($stepNumber < $maxStep)
                                    <div
                                        class="hidden sm:block absolute top-4 left-2/3 w-full h-1 {{ $step > $stepNumber ? 'bg-brand-blue-600' : 'bg-gray-300' }}">
                                    </div>
                                    <div class="block sm:hidden absolute top-4 left-1/2 w-[80%] h-0.5 {{ $step > $stepNumber ? 'bg-brand-blue-600' : 'bg-gray-300' }}"
                                        style="z-index:1; transform: translateX(10px);">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Step Content -->
                {{-- Replaced inline doctor card with Livewire 3 component --}}

                <div class="p-0 sm:p-0 w-full px-2 md:px-[5%] mx-auto mt-5">
                    <!-- Step 2: Date & Time (1/3 doctor card, 2/3 selector) -->
                    @if ($step === 2)
                        <div class="space-y-6">
                            @if ($selectedDoctor)
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                    <!-- Left: Doctor Summary (1/3) -->
                                    <livewire:public.appointment.components.doctor-card :doctor="$selectedDoctor" :appointment-date="$appointment_date" :appointment-time="$appointment_time" />

                                    <!-- Right: Date selection & Time slots (2/3) -->
                                    <div class="lg:col-span-2 bg-white p-4 rounded-xl border border-gray-200">
                                        <h2 class="text-lg sm:text-xl font-semibold text-brand-blue-900 mb-4 flex items-center">
                                            <svg class="h-5 w-5 inline-block mr-2 text-brand-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Select Appointment Date & Time
                                        </h2>

                                        <!-- Date Navigation Tabs -->
                                        <div class="mb-4">
                                            <div class="flex border-b border-gray-200 overflow-x-auto pb-1 scrollbar-hide">
                                                @php
                                                    // Generate the next 7 available days
                                                    $maxBookingDays = $selectedDoctor->max_booking_days ?? 7;
                                                    $availableDays = is_array($selectedDoctor->available_days)
                                                        ? $selectedDoctor->available_days
                                                        : (is_string($selectedDoctor->available_days)
                                                            ? json_decode($selectedDoctor->available_days, true)
                                                            : []);

                                                    $availableDayNumbers = [];
                                                    $dayNameToNumber = [
                                                        'Sunday' => 0,
                                                        'Monday' => 1,
                                                        'Tuesday' => 2,
                                                        'Wednesday' => 3,
                                                        'Thursday' => 4,
                                                        'Friday' => 5,
                                                        'Saturday' => 6,
                                                    ];

                                                    foreach ($availableDays as $dayName) {
                                                        if (isset($dayNameToNumber[$dayName])) {
                                                            $availableDayNumbers[] = $dayNameToNumber[$dayName];
                                                        }
                                                    }

                                                    $today = \Carbon\Carbon::today();
                                                    $dateTabs = [];
                                                    $currentDate = $today->copy();
                                                    $daysAdded = 0;
                                                    $daysToShow = 10; // Show 10 date tabs

                                                    while (count($dateTabs) < $daysToShow && $daysAdded < 30) {
                                                        $formattedDate = $currentDate->format('Y-m-d');
                                                        $isAvailableDay = in_array(
                                                            $currentDate->dayOfWeek,
                                                            $availableDayNumbers,
                                                        );
                                                        $isOnLeave =
                                                            !empty($onLeaveDates) &&
                                                            is_array($onLeaveDates) &&
                                                            in_array($formattedDate, $onLeaveDates);
                                                        $isBookable =
                                                            $isAvailableDay && !$isOnLeave && !$currentDate->isPast();

                                                        if ($isBookable || $currentDate->isToday()) {
                                                            $dateTabs[] = [
                                                                'date' => $formattedDate,
                                                                'isToday' => $currentDate->isToday(),
                                                                'dayName' => $currentDate->format('D'),
                                                                'dayNumber' => $currentDate->format('j'),
                                                                'monthName' => $currentDate->format('M'),
                                                            ];
                                                        }

                                                        $currentDate->addDay();
                                                        $daysAdded++;
                                                    }
                                                @endphp

                                                @foreach ($dateTabs as $dateTab)
                                                    <button wire:click="setAppointmentDate('{{ $dateTab['date'] }}')"
                                                        class="flex-shrink-0 px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap transition-all duration-200
                                                        {{ $appointment_date === $dateTab['date']
                                                            ? 'border-brand-blue-800 text-brand-blue-800 bg-brand-blue-50 shadow-md rounded-t-lg border-t border-l border-r border-brand-blue-200'
                                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                                                        aria-current="{{ $appointment_date === $dateTab['date'] ? 'page' : 'false' }}">
                                                        <div class="text-center">
                                                            @if ($dateTab['isToday'])
                                                                <span
                                                                    class="block text-xs mb-1 font-semibold text-brand-blue-600">Today</span>
                                                            @elseif (\Carbon\Carbon::parse($dateTab['date'])->isTomorrow())
                                                                <span
                                                                    class="block text-xs mb-1 font-semibold text-brand-blue-600">Tomorrow</span>
                                                            @else
                                                                <span
                                                                    class="block text-xs mb-1 {{ $appointment_date === $dateTab['date'] ? 'font-semibold' : '' }}">{{ $dateTab['dayName'] }}</span>
                                                            @endif
                                                            <span
                                                                class="block text-base {{ $appointment_date === $dateTab['date'] ? 'font-bold' : 'font-medium' }}">{{ $dateTab['dayNumber'] }}</span>
                                                            <span
                                                                class="block text-xs {{ $appointment_date === $dateTab['date'] ? 'font-medium' : '' }}">{{ $dateTab['monthName'] }}</span>
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Time Slots Section -->
                                            <div class="pt-4">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h3 class="text-base font-semibold text-gray-800 flex items-center">
                                                        <svg class="h-5 w-5 mr-2 text-brand-blue-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Available Time Slots for
                                                        {{ \Carbon\Carbon::parse($appointment_date)->format('l, M j') }}
                                                    </h3>
                                                </div>

                                                @php
                                                    $maxSlots = $selectedDoctor->patients_per_slot ?? 4;
                                                    $fillingUpThreshold = max(2, ceil($maxSlots * 0.5));

                                                    // Group slots by time of day
                                                    $morningSlots = [];
                                                    $afternoonSlots = [];
                                                    $eveningSlots = [];

                                                    foreach ($this->availableSlots as $time => $slot) {
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

                                                <!-- Time Slots Tabs -->
                                                <div x-data="{ activeTab: 'morning' }" class="mb-5">
                                                    <div class="border-b border-gray-200">
                                                        <nav class="-mb-px flex space-x-6 overflow-auto"
                                                            aria-label="Tabs">
                                                            <button @click="activeTab = 'morning'"
                                                                :class="activeTab === 'morning' ?
                                                                'border-brand-blue-800 text-brand-blue-800' :
                                                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                                class="py-2 px-1 border-b-2 font-medium text-sm">
                                                                <div class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Morning <span
                                                                        class="ml-1 text-xs text-gray-500">({{ count($morningSlots) }})</span>
                                                                </div>
                                                            </button>
                                                            <button @click="activeTab = 'afternoon'"
                                                                :class="activeTab === 'afternoon' ?
                                                                'border-brand-blue-800 text-brand-blue-800' :
                                                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                                class="py-2 px-1 border-b-2 font-medium text-sm">
                                                                <div class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Afternoon <span
                                                                        class="ml-1 text-xs text-gray-500">({{ count($afternoonSlots) }})</span>
                                                                </div>
                                                            </button>
                                                            <button @click="activeTab = 'evening'"
                                                                :class="activeTab === 'evening' ?
                                                                'border-brand-blue-800 text-brand-blue-800' :
                                                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                                                class="py-2 px-1 border-b-2 font-medium text-sm">
                                                                <div class="flex items-center">
                                                                    <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                        viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd"
                                                                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Evening <span
                                                                        class="ml-1 text-xs text-gray-500">({{ count($eveningSlots) }})</span>
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
                                                                    {{ $appointment_time === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                                                    {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                    {{ !$slot['disabled'] && $appointment_time !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                                                    <div class="text-sm font-medium">
                                                                        {{ date('h:i A', strtotime($slot['start'])) }}
                                                                    </div>
                                                                    <div class="text-xs mt-1">
                                                                        {{ $slot['remaining_capacity'] }} spots left
                                                                    </div>
                                                                </button>
                                                            @empty
                                                                <div
                                                                    class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
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
                                                                    {{ $appointment_time === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                                                    {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                    {{ !$slot['disabled'] && $appointment_time !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                                                    <div class="text-sm font-medium">
                                                                        {{ date('h:i A', strtotime($slot['start'])) }}
                                                                    </div>
                                                                    <div class="text-xs mt-1">
                                                                        {{ $slot['remaining_capacity'] }} spots left
                                                                    </div>
                                                                </button>
                                                            @empty
                                                                <div
                                                                    class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
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
                                                                    {{ $appointment_time === $time ? 'bg-brand-blue-100 text-brand-blue-800 border-brand-blue-800 ring-2 ring-brand-blue-800' : '' }}
                                                                    {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                    {{ !$slot['disabled'] && $appointment_time !== $time ? 'bg-brand-blue-50 border-brand-blue-200 hover:bg-brand-blue-100 text-brand-blue-800' : '' }}">
                                                                    <div class="text-sm font-medium">
                                                                        {{ date('h:i A', strtotime($slot['start'])) }}
                                                                    </div>
                                                                    <div class="text-xs mt-1">
                                                                        {{ $slot['remaining_capacity'] }} spots left
                                                                    </div>
                                                                </button>
                                                            @empty
                                                                <div
                                                                    class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                                    <p class="text-sm text-gray-500">No evening slots available</p>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Slot Legend -->
                                                <div
                                                    class="flex flex-wrap justify-end gap-2 border-t pt-3 text-xs text-gray-600">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-3 h-3 bg-brand-blue-50 border border-brand-blue-200 rounded-full mr-1">
                                                        </div>
                                                        <span>Available</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-3 h-3 bg-gray-100 border border-gray-200 rounded-full mr-1">
                                                        </div>
                                                        <span>Full</span>
                                                    </div>
                                                </div>
                                            </div>
                            @else
                                <div class="text-center py-12 bg-blue-50 rounded-xl border border-blue-200">
                                    <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="text-xl font-medium text-blue-700">Select a Doctor First</h3>
                                    <p class="text-sm text-blue-600 mt-2">Please choose a doctor to view available
                                        dates</p>
                                    <button wire:click="$set('step', 1)"
                                        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        Back to Doctors
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Step 3: Patient Information (1/3 doctor, 2/3 form) -->
                    @if ($step === 3)
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Left: Doctor Summary (1/3) -->
                                <livewire:public.appointment.components.doctor-card :doctor="$selectedDoctor" :appointment-date="$appointment_date" :appointment-time="$appointment_time" />

                                <!-- Right: Patient Form (2/3) -->
                                <div class="lg:col-span-2 space-y-4">
                                    <div class="bg-white p-5 rounded-xl border border-gray-100">
                                        <!-- Booking for: improved segmented radios -->
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Booking for</label>
                                            <div class="flex items-center gap-3">
                                                <div class="grid grid-cols-2 sm:inline-flex gap-3">
                                                    <label class="cursor-pointer">
                                                        <input type="radio" wire:model="booking_for" value="self" class="peer sr-only" />
                                                        <div class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 bg-white
                                                                    hover:bg-gray-50 hover:border-brand-blue-300 transition
                                                                    peer-checked:bg-brand-blue-600 peer-checked:text-white peer-checked:border-brand-blue-600 peer-checked:shadow">
                                                            Self
                                                        </div>
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input type="radio" wire:model="booking_for" value="other" class="peer sr-only" />
                                                        <div class="px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 bg-white
                                                                    hover:bg-gray-50 hover:border-brand-blue-300 transition
                                                                    peer-checked:bg-brand-blue-600 peer-checked:text-white peer-checked:border-brand-blue-600 peer-checked:shadow">
                                                            Someone else
                                                        </div>
                                                    </label>
                                                </div>
                                                @auth
                                                    <button type="button" wire:click="useMyProfile"
                                                        class="ml-auto inline-flex items-center px-3 py-2 bg-brand-blue-600 text-white rounded-md text-sm hover:bg-brand-blue-700 transition">
                                                        Use my profile
                                                    </button>
                                                @endauth
                                            </div>
                                            <div class="text-xs text-gray-500 mt-2">If you choose "Self" and are logged in, click "Use my profile" to autofill.</div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Full name <span class="text-red-500">*</span></label>
                                                <input type="text" wire:model.defer="newPatient.name" class="w-full px-3 py-2 border rounded-md" />
                                                @error('newPatient.name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                                <input type="email" wire:model.defer="newPatient.email" class="w-full px-3 py-2 border rounded-md" />
                                                @error('newPatient.email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Phone <span class="text-red-500">*</span></label>
                                                <input type="tel" wire:model.defer="newPatient.phone" maxlength="10"
                                                       oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,10);"
                                                       class="w-full px-3 py-2 border rounded-md" />
                                                @error('newPatient.phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                            </div>

                                            <!-- Gender: pill radios with icons -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
                                                <div class="flex flex-wrap gap-3 mt-2">
                                                    <label class="cursor-pointer">
                                                        <input type="radio" wire:model.defer="newPatient.gender" value="male" class="peer sr-only" />
                                                        <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-sm text-gray-700 bg-white
                                                                    hover:bg-gray-50 hover:border-brand-blue-300 transition
                                                                    peer-checked:bg-brand-blue-600 peer-checked:text-white peer-checked:border-brand-blue-600 peer-checked:shadow">
                                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6m0 0v6m0-6l-7 7M8 21a5 5 0 100-10 5 5 0 000 10z" />
                                                            </svg>
                                                            Male
                                                        </div>
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input type="radio" wire:model.defer="newPatient.gender" value="female" class="peer sr-only" />
                                                        <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-sm text-gray-700 bg-white
                                                                    hover:bg-gray-50 hover:border-brand-blue-300 transition
                                                                    peer-checked:bg-brand-blue-600 peer-checked:text-white peer-checked:border-brand-blue-600 peer-checked:shadow">
                                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7m0-7a5 5 0 100-10 5 5 0 000 10z" />
                                                            </svg>
                                                            Female
                                                        </div>
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input type="radio" wire:model.defer="newPatient.gender" value="other" class="peer sr-only" />
                                                        <div class="inline-flex items-center px-4 py-2 rounded-full border border-gray-300 text-sm text-gray-700 bg-white
                                                                    hover:bg-gray-50 hover:border-brand-blue-300 transition
                                                                    peer-checked:bg-brand-blue-600 peer-checked:text-white peer-checked:border-brand-blue-600 peer-checked:shadow">
                                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                                                            </svg>
                                                            Other
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('newPatient.gender') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Summary and final action (no notes textarea) -->
                                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                        <div class="bg-brand-blue-100 px-4 py-3">
                                            <h3 class="text-base sm:text-lg font-semibold text-brand-blue-900">Payment Summary</h3>
                                        </div>
                                        <div class="p-4 sm:p-5">
                                            <!-- Doctor's Fee -->
                                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-800">Doctor's Consultation Fee</h4>
                                                    <p class="text-xs text-gray-500 mt-1">Payable directly to doctor during visit</p>
                                                </div>
                                                <span class="text-sm font-semibold">₹{{ $selectedDoctor->fee }}</span>
                                            </div>

                                            <!-- Booking Fee -->
                                            <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-800">Booking Fee</h4>
                                                    <p class="text-xs text-gray-500 mt-1">Secures your appointment (non-refundable)</p>
                                                </div>
                                                <span class="text-sm font-semibold">₹50.00</span>
                                            </div>

                                            <!-- Total -->
                                            <div class="flex justify-between items-center pt-4">
                                                <span class="text-base font-bold text-gray-800">Total Amount Due Now</span>
                                                <span class="text-lg font-bold text-brand-blue-600">₹50.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button wire:click="createOrder" wire:loading.attr="disabled" wire:loading.target="createOrder"
                                            class="px-6 py-3 bg-brand-blue-600 hover:bg-brand-blue-900 text-white font-semibold rounded-lg shadow-md transition-all duration-300 flex items-center gap-3">
                                            <span wire:loading.remove wire:target="createOrder">Confirm & Pay ₹50 Booking Fee</span>
                                            <span wire:loading wire:target="createOrder" class="flex items-center gap-2">
                                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                                </svg>
                                                Processing...
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>



                            <!-- Payment Disclaimer -->
                            <div class="text-center px-2 py-2">
                                <p class="text-xs text-gray-500">
                                    <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    The doctor's fee of ₹{{ $selectedDoctor->fee }} will be collected directly by the
                                    doctor during your appointment.
                                    Today's payment is only for the booking fee to secure your slot.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Fix invalid SVG attributes like width/height="auto" to avoid console errors
    (function () {
        if (window.__svgAutoFixInstalled) return;
        window.__svgAutoFixInstalled = true;
        function fixSvgAutoAttributes(root = document) {
            try {
                const svgs = root.querySelectorAll ? root.querySelectorAll('svg') : [];
                svgs.forEach(svg => {
                    const w = svg.getAttribute('width');
                    const h = svg.getAttribute('height');
                    if (w && String(w).toLowerCase() === 'auto') svg.removeAttribute('width');
                    if (h && String(h).toLowerCase() === 'auto') svg.removeAttribute('height');
                });
            } catch (e) {
                console.debug('SVG auto-attr fix skipped:', e);
            }
        }
        const observer = new MutationObserver(mutations => {
            for (const m of mutations) {
                m.addedNodes.forEach(node => {
                    if (node && node.nodeType === 1) fixSvgAutoAttributes(node);
                });
            }
        });
        function initSvgFix() {
            fixSvgAutoAttributes();
            try { observer.observe(document.documentElement, { childList: true, subtree: true }); } catch (_) {}
        }
        document.addEventListener('DOMContentLoaded', initSvgFix);
        document.addEventListener('livewire:init', fixSvgAutoAttributes);
        document.addEventListener('livewire:navigated', fixSvgAutoAttributes);
    })();
</script>