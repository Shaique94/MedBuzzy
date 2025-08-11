<div>
    <div class="min-h-screen p-1 sm:px-0 lg:px-0 bg-gray-50">
        <div class="w-full max-w-none mx-0">
            <!-- Header -->
            <div class="text-center bg-teal-600 rounded-none py-6 w-full">
                <h1 class="text-3xl font-bold text-gray-50">Book an Appointment</h1>
                <p class="mt-2 text-gray-200">Schedule your visit with our expert doctors</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white w-full rounded-none border-t border-b border-teal-200">
                <!-- Progress Steps -->
                <div class="bg-brand-teal-50 px-0 py-4 w-full border-b border-teal-100">
                    <div class="flex items-center justify-between max-w-5xl mx-auto
                    flex-nowrap overflow-x-auto scrollbar-hide gap-0 sm:gap-0 px-2 sm:px-0"
                        style="min-width:0;">
                        @foreach ([
        1 => ['label' => 'Doctor', 'icon' => 'user-md'],
        2 => ['label' => 'Date & Time', 'icon' => 'calendar-alt'],
        3 => ['label' => 'Details', 'icon' => 'user-circle'],
        4 => ['label' => 'Confirm', 'icon' => 'check-circle'],
    ] as $stepNumber => $stepInfo)
                            <div class="flex flex-col items-center relative flex-1 min-w-[90px] sm:min-w-0 px-1">
                                <div
                                    class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full
                                {{ $step >= $stepNumber ? 'bg-brand-teal-600 text-white' : 'bg-white text-gray-400 border-2 border-gray-300' }}
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
                                    @elseif($stepInfo['icon'] === 'check-circle')
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    @if ($step === $stepNumber)
                                        <div
                                            class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 sm:w-3 sm:h-3 bg-brand-teal-600 rounded-full">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="mt-1 text-[11px] sm:text-xs font-medium {{ $step >= $stepNumber ? 'text-brand-teal-600' : 'text-gray-500' }} hidden sm:block text-center leading-tight break-words w-full">
                                    {{ $stepInfo['label'] }}
                                </span>
                                <span
                                    class="mt-1 text-[10px] font-medium {{ $step >= $stepNumber ? 'text-brand-teal-600' : 'text-gray-500' }} sm:hidden text-center leading-tight break-words w-full">
                                    {{ $stepInfo['label'] }}
                                </span>
                                @if ($stepNumber < 4)
                                    <div
                                        class="hidden sm:block absolute top-4 left-2/3 w-full h-1 {{ $step > $stepNumber ? 'bg-brand-teal-600' : 'bg-gray-300' }}">
                                    </div>
                                    <div class="block sm:hidden absolute top-4 left-1/2 w-[80%] h-0.5 {{ $step > $stepNumber ? 'bg-brand-teal-600' : 'bg-gray-300' }}"
                                        style="z-index:1; transform: translateX(10px);">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Step Content -->
                <div class="p-0 sm:p-0 w-full max-w-5xl mx-auto mt-5">
                    <!-- Step 1: Select Doctor -->
                    @if ($step === 1)
                        <div class="space-y-6">
                            <!-- Department Filter -->
                            <div
                                class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-5 rounded-xl border border-brand-teal-200">
                                <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Filter by Department
                                </h2>
                                <!-- Department buttons with original design and hover/click behavior -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" wire:click="$set('selectedDepartment', null)"
                                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                {{ !$selectedDepartment ? 'ring-2 ring-brand-teal-500 bg-brand-teal-50 border-brand-teal-200' : 'bg-gradient-to-br from-brand-teal-50 to-brand-orange-50 hover:to-brand-orange-100 hover:shadow-md' }}"
                                        title="Show all specialties">
                                        All Specialties
                                    </button>
                                    @foreach ($departments as $department)
                                        <button type="button"
                                            wire:click="$set('selectedDepartment', {{ $department->id }})"
                                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                    {{ $selectedDepartment === $department->id ? 'ring-2 ring-brand-teal-500 bg-brand-teal-50 border-brand-teal-200' : 'bg-gradient-to-br from-brand-teal-50 to-brand-orange-50 hover:to-brand-orange-100 hover:shadow-md' }}"
                                            title="Filter by {{ $department->name }}">
                                            {{ $department->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Doctors List -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center justify-between">
                                    <span class="flex items-center">
                                        <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="currentColor"
                                            viewBox="0 0 640 512" xmlns="http://www.w3.org/2000/svg">
                                        </svg>
                                        {{ $doctor_id ? 'Selected Doctor' : 'Available Doctors' }}
                                    </span>
                                    @if ($doctor_id)
                                        <button wire:click="$set('doctor_id', null)"
                                            class="text-sm text-brand-teal-600 hover:text-brand-teal-800 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Change
                                        </button>
                                    @endif
                                </h2>

                                @if (count($doctors) > 0)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach ($doctors as $doctor)
                                            <div wire:click="$set('doctor_id', {{ $doctor->id }})"
                                                class="relative flex flex-col h-full border rounded-xl overflow-hidden cursor-pointer transition-all duration-300  hover:shadow-md
                                            {{ $doctor_id == $doctor->id ? 'ring-2 ring-brand-teal-500 bg-brand-teal-50 border-brand-teal-200' : 'border-gray-200 hover:border-brand-teal-200' }}">
                                                <div
                                                    class="bg-gradient-to-br from-brand-teal-50 to-brand-orange-50 p-5 text-center">
                                                    <div class="relative">
                                                        <div
                                                            class="absolute -top-2 -right-2 bg-brand-teal-600 text-white text-xs px-2 py-1 rounded-full shadow-md">
                                                            ₹{{ $doctor->fee }}
                                                        </div>
                                                        <div
                                                            class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-white mx-auto border-4 border-white shadow-md">
                                                            <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                                                alt="Dr. {{ $doctor->user->name }}"
                                                                class="w-full h-full object-cover">
                                                        </div>
                                                    </div>
                                                    <h3 class="text-gray-900 font-bold mt-3 text-lg">
                                                        Dr. {{ $doctor->user->name }}
                                                    </h3>
                                                    <p class="text-brand-teal-600 text-sm font-medium mb-2">
                                                        {{ $doctor->department->name ?? 'General' }}
                                                    </p>
                                                    <div class="mt-3 flex flex-wrap justify-center gap-1">
                                                        @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $index => $day)
                                                            @php
                                                                $weekdays = [
                                                                    'Sunday',
                                                                    'Monday',
                                                                    'Tuesday',
                                                                    'Wednesday',
                                                                    'Thursday',
                                                                    'Friday',
                                                                    'Saturday',
                                                                ];
                                                                $fullDay = $weekdays[$index];
                                                                // Convert the available_days string to an array
                                                                $availableDays = is_array(
                                                                    $doctor->available_days ?? null,
                                                                )
                                                                    ? $doctor->available_days
                                                                    : json_decode(
                                                                        $doctor->available_days ?? '[]',
                                                                        true,
                                                                    );
                                                                $isAvailable = in_array($fullDay, $availableDays ?? []);
                                                            @endphp
                                                            <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-medium
                                                           {{ $isAvailable ? 'bg-brand-teal-400 text-white border border-brand-teal-500' : 'bg-gray-100 text-gray-400 opacity-50 cursor-not-allowed' }}"
                                                                title="{{ $fullDay }}">{{ substr($day, 0, 1) }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button wire:click="nextStep"
                                                        class="mt-3 w-full py-2 bg-brand-teal-600 hover:bg-brand-teal-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                                                        Select
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div
                                        class="flex flex-col items-center justify-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                        <svg class="h-12 w-12 mb-4 text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-600 mb-2">No doctors available in this department
                                        </p>
                                        <button wire:click="$set('selectedDepartment', null)"
                                            class="text-sm text-brand-teal-600 font-medium hover:text-brand-teal-700 flex items-center">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            View all doctors
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Step 2: Date & Time -->
                    @if ($step === 2)
                        <div class="space-y-6">
                            @if ($selectedDoctor)
                                <!-- Doctor Summary -->
                                <div
                                    class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl border border-brand-teal-200">
                                    <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-5 md:gap-6">
                                        <div
                                            class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full overflow-hidden bg-white border-2 sm:border-4 border-brand-teal-600">
                                            <img src="{{ $selectedDoctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($selectedDoctor->user->name) . '&background=random&rounded=true' }}"
                                                alt="Dr. {{ $selectedDoctor->user->name }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1 text-center sm:text-left">
                                            <h3 class="text-lg sm:text-xl font-bold text-gray-800">Dr.
                                                {{ $selectedDoctor->user->name }}</h3>
                                            <p class="text-xs sm:text-sm font-medium text-brand-teal-700">
                                                {{ $selectedDoctor->department->name }}</p>
                                            <div
                                                class="mt-1 sm:mt-2 flex flex-col sm:flex-row gap-1 sm:gap-2 md:gap-4 justify-center sm:justify-start">
                                                <p class="text-xs sm:text-sm text-gray-600">
                                                    {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}
                                                </p>
                                                <p class="text-xs sm:text-sm text-brand-teal-600 font-medium">
                                                    {{ $appointment_time }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-xl border border-gray-200">
                                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">
                                        <svg class="h-5 w-5 inline-block mr-2 text-brand-teal-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Select Appointment Date
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
                                                            ? 'border-brand-teal-500 text-brand-teal-600 bg-brand-teal-50 shadow-md rounded-t-lg border-t border-l border-r border-brand-teal-200'
                                                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                                                    aria-current="{{ $appointment_date === $dateTab['date'] ? 'page' : 'false' }}">
                                                    <div class="text-center">
                                                        @if ($dateTab['isToday'])
                                                            <span
                                                                class="block text-xs mb-1 font-semibold text-brand-teal-600">Today</span>
                                                        @elseif (\Carbon\Carbon::parse($dateTab['date'])->isTomorrow())
                                                            <span
                                                                class="block text-xs mb-1 font-semibold text-brand-teal-600">Tomorrow</span>
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
                                    @if ($appointment_date)
                                        <div class="pt-4">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-base font-semibold text-gray-800 flex items-center">
                                                    <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
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
                                                                'border-brand-teal-500 text-brand-teal-600' :
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
                                                                'border-brand-teal-500 text-brand-teal-600' :
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
                                                                'border-brand-teal-500 text-brand-teal-600' :
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
                                                                {{ $appointment_time === $time ? 'bg-brand-teal-600 text-brand-teal-600 border-brand-teal-700' : '' }}
                                                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                {{ !$slot['disabled'] ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}
                                                                </div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @empty
                                                            <div
                                                                class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                                <p class="text-sm text-gray-500">No morning slots
                                                                    available</p>
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
                                                                {{ $appointment_time === $time ? 'bg-brand-teal-600 text-brand-teal-600 border-brand-teal-700' : '' }}
                                                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                {{ !$slot['disabled'] ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}
                                                                </div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @empty
                                                            <div
                                                                class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                                <p class="text-sm text-gray-500">No afternoon slots
                                                                    available</p>
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
                                                                {{ $appointment_time === $time ? 'bg-brand-teal-600 text-brand-teal-600 border-brand-teal-700' : '' }}
                                                                {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                                {{ !$slot['disabled'] ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}
                                                                </div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @empty
                                                            <div
                                                                class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                                <p class="text-sm text-gray-500">No evening slots
                                                                    available</p>
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
                                                        class="w-3 h-3 bg-brand-teal-50 border border-brand-teal-200 rounded-full mr-1">
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
                                    @endif
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

                    <!-- Step 3: Patient Information -->
                    @if ($step === 3)
                        <div class="space-y-6">
                            <!-- Doctor Summary -->
                            <div
                                class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-5 rounded-xl border border-brand-teal-200">
                                <div class="flex flex-col sm:flex-row items-center gap-5">
                                    <div
                                        class="w-20 h-20 rounded-full overflow-hidden bg-white border-4 border-brand-teal-600 shadow-lg">
                                        <img src="{{ $selectedDoctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($selectedDoctor->user->name) . '&background=random&rounded=true' }}"
                                            alt="Dr. {{ $selectedDoctor->user->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div class="text-center sm:text-left">
                                        <h3 class="text-xl font-bold text-gray-800">Dr.
                                            {{ $selectedDoctor->user->name }}</h3>
                                        <p class="text-sm font-medium text-brand-teal-700">
                                            {{ $selectedDoctor->department->name }}</p>
                                        <div
                                            class="mt-2 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-start">
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $appointment_time)->format('h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Patient Form -->
                            <div class="bg-white p-5 rounded-xl border border-gray-100 md:shadow-sm">
                                <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                    Patient Information (रोगी जानकारी)
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Name -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Full Name (पूरा
                                            नाम) <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live.debounce.500ms="newPatient.name"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="John Doe (जॉन डो)">
                                        @error('newPatient.name')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Email
                                            (ईमेल)</label>
                                        <input type="email" wire:model.live.debounce.500ms="newPatient.email"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="sadique@example.com">
                                        @error('newPatient.email')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">
                                            Phone (फोन) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="tel" wire:model.live.debounce.500ms="newPatient.phone"
                                            maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="9876543210" pattern="[6-9]{1}[0-9]{9}"
                                            title="Please enter a valid 10-digit Indian mobile number starting with 6,7,8 or 9">
                                        @error('newPatient.phone')
                                            <p class="mt-1 text-xs text-red-600">
                                                @if ($message === 'The new patient.phone must be 10 digits.')
                                                    Phone number must be exactly 10 digits
                                                @elseif($message === 'The new patient.phone format is invalid.')
                                                    Phone number must start with 6,7,8 or 9
                                                @else
                                                    {{ $message }}
                                                @endif
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Age -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Age (आयु) <span
                                                class="text-red-500">*</span></label>
                                        <input type="number" wire:model.live.debounce.500ms="newPatient.age"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.age') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="30" min="0" max="120"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);"
                                            maxlength="3">
                                        @error('newPatient.age')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Gender (लिंग) <span
                                                class="text-red-500">*</span></label>
                                        <select wire:model.live="newPatient.gender"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.gender') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition">
                                            <option value="">Select Gender (लिंग चुनें)</option>
                                            <option value="male">Male (पुरुष)</option>
                                            <option value="female">Female (महिला)</option>
                                            <option value="other">Other (अन्य)</option>
                                        </select>
                                        @error('newPatient.gender')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Pincode -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Pincode (पिनकोड)
                                            <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <input type="text" wire:model.live.debounce.500ms="pincode"
                                                maxlength="6"
                                                class="w-full px-4 py-3 border {{ $errors->has('newPatient.pincode') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                                placeholder="854301">
                                            @if (strlen($pincode) == 6)
                                                <div wire:loading wire:target="pincode"
                                                    class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                                    <svg class="animate-spin h-5 w-5 text-brand-teal-500"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12"
                                                            r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        @error('newPatient.pincode')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- State -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">State (राज्य) <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live="newPatient.state"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="State (राज्य)" disabled>
                                    </div>

                                    <!-- District -->
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-600">District (जिला)
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" wire:model.live="newPatient.district"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="District (जिला)" disabled>
                                    </div>

                                    <!-- Address -->
                                    <div class="md:col-span-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-600">Address (पता) <span
                                                class="text-red-500">*</span></label>
                                        <textarea wire:model.live.debounce.500ms="newPatient.address" rows="4"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="123 Main St, Apt 4B, City (123 मेन स्ट्रीट, अपार्टमेंट 4बी, शहर)"></textarea>
                                        @error('newPatient.address')
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Step 4: Confirmation -->
                    @if ($step === 4)
                        <div class="space-y-4 md:space-y-6 md:max-w-5xl mx-auto px-2 sm:px-0">
                            <!-- Header -->
                            <div class="text-center">
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Confirm Your Appointment</h2>
                                <p class="text-sm sm:text-base text-gray-600 mt-1">Review details before final
                                    confirmation</p>
                            </div>

                            <div class="bg-white rounded-xl shadow-lg border border-brand-teal-200 overflow-hidden transition-all duration-300 hover:shadow-xl">
                                <!-- Header -->
                                <div class="bg-gradient-to-r from-brand-teal-500 to-brand-teal-600 p-4 sm:p-5">
                                    <h3 class="text-base sm:text-lg md:text-xl font-bold text-white flex items-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        Appointment Summary
                                    </h3>
                                    <p class="text-xs sm:text-sm text-white/80 mt-1">Please review your appointment details</p>
                                </div>
                                
                                <!-- Content -->
                                <div class="p-4 sm:p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Doctor Info -->
                                        <div class="flex space-x-4 p-3 rounded-lg bg-brand-teal-50 border border-brand-teal-100">
                                            <div class="flex-shrink-0">
                                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-white border-2 border-brand-teal-300 shadow-md">
                                                    <img src="{{ $selectedDoctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($selectedDoctor->user->name) . '&background=random&rounded=true' }}"
                                                        alt="Dr. {{ $selectedDoctor->user->name }}" class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <span class="text-xs font-medium text-brand-teal-600 uppercase tracking-wider">Your Doctor</span>
                                                <h4 class="text-sm sm:text-base md:text-lg font-bold text-gray-800 mt-1">Dr. {{ $selectedDoctor->user->name }}</h4>
                                                <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $selectedDoctor->department->name }}</p>
                                                <div class="flex items-center mt-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-teal-100 text-brand-teal-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        ₹{{ $selectedDoctor->fee }} Consultation Fee
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Appointment Details -->
                                        <div class="p-3 rounded-lg bg-brand-orange-50 border border-brand-orange-100">
                                            <div class="flex items-center mb-3">
                                                <svg class="w-5 h-5 text-brand-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-xs font-medium text-brand-orange-800 uppercase tracking-wider">Date & Time</span>
                                            </div>
                                            <h4 class="text-sm sm:text-base font-bold text-gray-800">
                                                {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}
                                            </h4>
                                            <p class="mt-1 text-sm font-medium text-brand-orange-700">
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $appointment_time)->format('h:i A') }}
                                            </p>
                                            <div class="mt-3 flex items-center">
                                                <svg class="w-4 h-4 text-brand-orange-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-xs text-gray-600">Please arrive 15 minutes early</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Patient Information -->
                                    <div class="mt-6 p-4 rounded-lg bg-gray-50 border border-gray-200">
                                        <h4 class="text-sm sm:text-base font-semibold text-gray-700 flex items-center mb-4">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            Patient Information
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                            <div>
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Full Name</span>
                                                    <span class="text-sm sm:text-base font-medium text-gray-800">{{ $newPatient['name'] }}</span>
                                                </div>
                                                <div class="h-px bg-gray-200 my-2"></div>
                                                
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Age & Gender</span>
                                                    <span class="text-sm font-medium text-gray-800">{{ $newPatient['age'] }} yrs, {{ ucfirst($newPatient['gender']) }}</span>
                                                </div>
                                                <div class="h-px bg-gray-200 my-2"></div>
                                                
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Location</span>
                                                    <span class="text-sm font-medium text-gray-800">{{ $newPatient['district'] ?? 'Not available' }}, {{ $newPatient['state'] ?? 'Not available' }}</span>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Phone</span>
                                                    <span class="text-sm sm:text-base font-medium text-gray-800">{{ $newPatient['phone'] }}</span>
                                                </div>
                                                <div class="h-px bg-gray-200 my-2"></div>
                                                
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Email</span>
                                                    <span class="text-sm font-medium text-gray-800 truncate">{{ $newPatient['email'] ?: 'Not provided' }}</span>
                                                </div>
                                                <div class="h-px bg-gray-200 my-2"></div>
                                                
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <span class="text-xs text-gray-500">Pincode</span>
                                                    <span class="text-sm font-medium text-gray-800">{{ $newPatient['pincode'] ?? 'Not available' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if(!empty($notes))
                                        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-100 rounded-md">
                                            <h5 class="text-xs font-medium text-yellow-800 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                Notes
                                            </h5>
                                            <p class="mt-1 text-xs text-gray-700">{{ $notes }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details Card -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="bg-brand-teal-100 px-4 py-3">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">Payment Summary</h3>
                                </div>
                                <div class="p-4 sm:p-5">
                                    <!-- Doctor's Fee -->
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-800">Doctor's Consultation Fee
                                            </h4>
                                            <p class="text-xs text-gray-500 mt-1">Payable directly to doctor during
                                                visit</p>
                                        </div>
                                        <span class="text-sm font-semibold">₹{{ $selectedDoctor->fee }}</span>
                                    </div>

                                    <!-- Processing Fee -->
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-800">Booking Fee</h4>
                                            <p class="text-xs text-gray-500 mt-1">Secures your appointment
                                                (non-refundable)</p>
                                        </div>
                                        <span class="text-sm font-semibold">₹50.00</span>
                                    </div>

                                    <!-- Total -->
                                    <div class="flex justify-between items-center pt-4">
                                        <span class="text-base font-bold text-gray-800">Total Amount Due Now</span>
                                        <span class="text-lg font-bold text-brand-teal-600">₹50.00</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes Section -->
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes
                                    (Optional)</label>
                                <textarea wire:model.debounce.500ms="notes" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition text-sm"
                                    placeholder="Any symptoms, concerns, or special requests..."></textarea>
                            </div>

                            <!-- Payment Button -->
                            <button wire:click="createOrder" wire:loading.attr="disabled"
                                wire:loading.target="createOrder"
                                class="w-full bg-brand-teal-600 hover:bg-brand-teal-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center justify-center">
                                <span wire:loading.remove wire:target="createOrder">
                                    Confirm & Pay ₹50 Booking Fee
                                </span>
                                <span wire:loading wire:target="createOrder" class="flex items-center">
                                   
                                    <span>Processing Payment...</span>

                                     <svg class="animate-spin h-5 w-5 text-white mr-2"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                            </button>

                            <!-- Payment Disclaimer -->
                            <div class="text-center px-2 py-2">
                                <p class="text-xs text-gray-500">
                                    <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    The doctor's fee of ₹{{ $selectedDoctor->fee }} will be collected directly by the
                                    doctor
                                    during your appointment.
                                    Today's payment is only for the booking fee to secure your slot.
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Navigation Buttons -->
                    <div class="px-0 py-4 border-t border-gray-200 bg-gray-50 w-full">
                        <div class="flex flex-col-reverse sm:flex-row justify-between gap-4 max-w-5xl mx-auto">
                            @if ($step > 1)
                                <button wire:click="previousStep"
                                    class="px-6 py-3 bg-white border border-brand-orange-300 text-brand-orange-600 rounded-lg hover:bg-brand-orange-50 transition flex items-center justify-center shadow-sm">
                                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Back
                                </button>
                            @else
                                <div></div>
                            @endif

                            @if ($step < 4)
                                <button wire:click="nextStep" wire:loading.attr="disabled"
                                    class="px-6 py-3 bg-brand-teal-600 text-white rounded-lg hover:bg-brand-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-teal-500 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center shadow-md transition-all duration-300">
                                    <span>Continue</span>
                                    <svg class="h-5 w-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span wire:loading wire:target="nextStep" class="ml-2">
                                        <svg class="animate-spin h-5 w-5 text-white" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @script
        <script>
            Livewire.on('razorpay:open', (data) => {
                console.log("Full data from Livewire:", data);
                console.log("orderId:", data.orderId);

                var options = {
                    "key": "{{ config('services.razorpay.key') }}",
                    "amount": "{{ $amount }}",
                    "currency": "INR",
                    "name": "Medbuzzy",
                    "description": "Appointment Booking",
                    "image": "{{ asset('logo.png') }}",
                    "order_id": data.orderId,
                    handler: function(response) {
                        console.log("Patient Data:", data);
                        console.log("Appointment Data:", data.orderId);

                        Livewire.dispatch('payment-success', {
                            paymentId: response.razorpay_payment_id,
                            allData: data,
                            appointmentData: data.appointmentData
                        });
                    },
                    "prefill": {
                        "name": "{{ $newPatient['name'] ?? 'Customer' }}",
                        "email": "{{ $newPatient['email'] ?? 'customer@example.com' }}",
                        "contact": "{{ $newPatient['phone'] ?? '9999999999' }}"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };
                console.log('options', options);

                var rzp1 = new Razorpay(options);
                rzp1.open();

                rzp1.on('payment.failed', function(response) {
                    Livewire.dispatch('payment-failed', {
                        error: response.error.description,
                        appointmentId: data.appointmentId
                    });
                });
            });
        </script>
    @endscript
</div>
