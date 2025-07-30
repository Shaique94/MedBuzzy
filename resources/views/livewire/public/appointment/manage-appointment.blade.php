<div><div>
    <div class="min-h-screen p-1  sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto md:shadow-xl ">
            <!-- Header -->
            <div class="text-center bg-teal-600 rounded py-5">
                <h1 class="text-3xl font-bold text-gray-50">Book an Appointment</h1>
                <p class="mt-2 text-gray-200">Schedule your visit with our expert doctors</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white  overflow-hidden">
                <!-- Progress Steps -->
                <div class="bg-brand-teal-50 px-6 py-4">
                    <div class="flex items-center justify-between">
                        @foreach ([
            1 => ['label' => 'Doctor', 'icon' => 'user-md'],
            2 => ['label' => 'Date & Time', 'icon' => 'calendar-alt'],
            3 => ['label' => 'Details', 'icon' => 'user-circle'],
            4 => ['label' => 'Confirm', 'icon' => 'check-circle'],
        ] as $stepNumber => $stepInfo)
                            <div class="flex flex-col items-center relative flex-1">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-full 
                                    {{ $step >= $stepNumber ? 'bg-brand-teal-600 text-white' : 'bg-white text-gray-400 border-2 border-gray-300' }}
                                    transition-all duration-300 relative z-10">
                                    @if ($stepInfo['icon'] === 'user-md')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    @elseif($stepInfo['icon'] === 'calendar-alt')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($stepInfo['icon'] === 'user-circle')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif($stepInfo['icon'] === 'check-circle')
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    @if ($step === $stepNumber)
                                        <div
                                            class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-brand-teal-600 rounded-full">
                                        </div>
                                    @endif
                                </div>
                                <span
                                    class="mt-2 text-xs font-medium {{ $step >= $stepNumber ? 'text-brand-teal-600' : 'text-gray-500' }} hidden sm:block">
                                    {{ $stepInfo['label'] }}
                                </span>
                                <span
                                    class="mt-2 text-[10px] font-medium {{ $step >= $stepNumber ? 'text-brand-teal-600' : 'text-gray-500' }} sm:hidden">
                                    {{ substr($stepInfo['label'], 0, 3) }}
                                </span>
                                @if ($stepNumber < 4)
                                    <div
                                        class="hidden sm:block absolute top-5 left-2/3 w-full h-1 {{ $step > $stepNumber ? 'bg-brand-teal-600' : 'bg-gray-300' }}">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Step Content -->
                <div class=" p-2 sm:p-8">
                    <!-- Step 1: Select Doctor -->
                    @if ($step === 1)
                        <div class="space-y-6">
                            <!-- Department Filter -->
                            <div
                                class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-5 rounded-xl border border-brand-teal-200">
                                <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Filter by Department
                                </h2>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" wire:click="$set('selectedDepartment', null)"
                                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 
                                        {{ !$selectedDepartment ? 'bg-brand-teal-600 text-white shadow-md' : 'bg-white hover:bg-brand-orange-50 text-gray-800 border border-gray-200' }}">
                                        All Specialties
                                    </button>
                                    @foreach ($departments as $department)
                                        <button type="button"
                                            wire:click="$set('selectedDepartment', {{ $department->id }})"
                                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 shadow-sm
                                            {{ $selectedDepartment === $department->id ? 'bg-brand-teal-600 text-white shadow-md' : 'bg-white hover:bg-brand-orange-50 text-gray-800 border border-gray-200' }}">
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
                                            <path
                                                d="M232 224h56v56a8 8 0 008 8h48a8 8 0 008-8v-56h56a8 8 0 008-8v-48a8 8 0 00-8-8h-56v-56a8 8 0 00-8-8h-48a8 8 0 00-8 8v56h-56a8 8 0 00-8 8v48a8 8 0 008 8zM576 48a48.14 48.14 0 00-48-48H112a48.14 48.14 0 00-48 48v416a48.14 48.14 0 0048 48h416a48.14 48.14 0 0048-48zM96 464V48a16 16 0 0116-16h416a16 16 0 0116 16v416a16 16 0 01-16 16H112a16 16 0 01-16-16zm352-208a96 96 0 10-96 96 96 96 0 0096-96zm-96 64a64 64 0 1164-64 64.1 64.1 0 01-64 64zm0-96a32 32 0 1032 32 32 32 0 00-32-32z">
                                            </path>
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
                                                                $availableDays = is_array($doctor->available_days ?? null)
                                                                    ? $doctor->available_days
                                                                    : json_decode($doctor->available_days ?? '[]', true);
                                                                $isAvailable = in_array($fullDay, $availableDays ?? []);
                                                            @endphp
                                                            <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-medium
                                                               {{ $isAvailable ? 'bg-brand-teal-400 text-white border border-brand-teal-500' : 'bg-gray-100 text-gray-400 opacity-50 cursor-not-allowed' }}"
                                                                title="{{ $fullDay }}">{{ substr($day, 0, 1) }}</div>
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
                                        <svg class="h-12 w-12 mb-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        <p class="text-sm text-gray-600 mb-2">No doctors available in this department</p>
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
                                    class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-4 sm:p-5 md:p-6 rounded-xl sm:rounded-2xl  border border-brand-teal-200">
                                    <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-5 md:gap-6">
                                        <div
                                            class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full overflow-hidden bg-white border-2 sm:border-4 border-brand-teal-600 ">
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
                                                    {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                                                <p class="text-xs sm:text-sm text-gray-600">{{ $appointment_time }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-2 sm:p-4 md:p-6 rounded-xl sm:rounded-2xl border border-gray-100 ">
                                    <h2
                                        class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 sm:mb-5 md:mb-6 flex items-center">
                                        <svg class="h-5 w-5 sm:h-6 sm:w-6 mr-2 text-brand-teal-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $appointment_date ? 'Selected: ' . \Carbon\Carbon::parse($appointment_date)->format('M j, Y') : 'Select Date' }}
                                    </h2>

                                    @if (!$appointment_date)
                                        <div 
                                            x-data="{
                                                scroll: 0,
                                                scrollMax: 0,
                                                scrollTo(val) {
                                                    this.$refs.dates.scrollTo({ left: val, behavior: 'smooth' });
                                                    this.scroll = val;
                                                },
                                                next() {
                                                    this.scrollTo(Math.min(this.scroll + 600, this.scrollMax));
                                                },
                                                prev() {
                                                    this.scrollTo(Math.max(this.scroll - 600, 0));
                                                },
                                                updateScroll() {
                                                    this.scroll = this.$refs.dates.scrollLeft;
                                                    this.scrollMax = this.$refs.dates.scrollWidth - this.$refs.dates.clientWidth;
                                                }
                                            }"
                                            x-init="updateScroll(); $nextTick(() => { updateScroll(); }); window.addEventListener('resize', updateScroll)"
                                            class="relative w-full"
                                        >
                                            <!-- Left Arrow -->
                                            <button type="button" @click="prev" 
                                                class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white border border-gray-200 rounded-full p-3 shadow-lg hover:bg-brand-teal-50 transition"
                                                :class="scroll <= 0 ? 'opacity-50 cursor-not-allowed' : ''"
                                                :disabled="scroll <= 0">
                                                <svg class="w-6 h-6 text-brand-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <!-- Date Tabs Scrollbar -->
                                            <div 
                                                x-ref="dates"
                                                @scroll="updateScroll"
                                                class="flex overflow-x-auto gap-4 px-16 py-4 scrollbar-hide snap-x snap-mandatory w-full"
                                                style="scroll-behavior: smooth; min-width: 100vw;"
                                            >
                                                @php
                                                    $today = \Carbon\Carbon::today();
                                                    $endDate = \Carbon\Carbon::today()->addDays(30);
                                                    $dateTabs = [];
                                                    $currentDate = $today->copy();
                                                    while ($currentDate <= $endDate) {
                                                        $formattedDate = $currentDate->format('Y-m-d');
                                                        $isWithinBookingRange = !empty($validBookingDays) && is_array($validBookingDays) && in_array($formattedDate, $validBookingDays);
                                                        $isAvailableDay = !empty($availableDayNumbers) && is_array($availableDayNumbers) && in_array($currentDate->dayOfWeek, $availableDayNumbers);
                                                        $isOnLeave = !empty($onLeaveDates) && is_array($onLeaveDates) && in_array($formattedDate, $onLeaveDates);
                                                        $isBookable = $isWithinBookingRange && $isAvailableDay && !$isOnLeave;
                                                        $isPast = $currentDate->isPast() && !$currentDate->isToday();
                                                        $isToday = $currentDate->isToday();

                                                        if ($isWithinBookingRange) {
                                                            $dateTabs[] = [
                                                                'date' => $formattedDate,
                                                                'isBookable' => $isBookable,
                                                                'isPast' => $isPast,
                                                                'isToday' => $isToday,
                                                                'isOnLeave' => $isOnLeave,
                                                                'isAvailableDay' => $isAvailableDay,
                                                                'day' => $currentDate->format('D'),
                                                                'dateDisplay' => $currentDate->format('M j'),
                                                            ];
                                                        }
                                                        $currentDate->addDay();
                                                    }
                                                @endphp

                                                @foreach ($dateTabs as $tab)
                                                    <button
                                                        wire:key="date-{{ $tab['date'] }}"
                                                        wire:click="setAppointmentDate('{{ $tab['date'] }}')"
                                                        @disabled(!$tab['isBookable'] || $tab['isPast'])
                                                        class="flex flex-col items-center min-w-[120px] max-w-[120px] px-4 py-3 rounded-xl text-base font-semibold transition-all duration-200 snap-center border-2 shadow-sm
                                                            {{ $appointment_date === $tab['date'] ? 'bg-brand-teal-600 text-white border-brand-teal-700 shadow-lg scale-105' : '' }}
                                                            {{ $tab['isBookable'] && !$tab['isPast'] ? 'hover:bg-brand-teal-100 bg-white border-brand-teal-200 text-brand-teal-700' : '' }}
                                                            {{ !$tab['isAvailableDay'] ? 'bg-red-100 border-red-300 text-red-600' : '' }}
                                                            {{ $tab['isOnLeave'] ? 'bg-brand-orange-100 border-brand-orange-300 text-brand-orange-600' : '' }}
                                                            {{ $tab['isPast'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                            {{ $tab['isToday'] ? 'border-2 border-blue-400 text-blue-600 font-bold' : '' }}"
                                                        title="{{ $tab['isOnLeave'] ? 'Doctor on leave' : (!$tab['isAvailableDay'] ? 'Not available' : ($tab['isBookable'] ? 'Available' : ($tab['isPast'] ? 'Past date' : 'Outside booking range'))) }}"
                                                        aria-label="Select date {{ $tab['dateDisplay'] }} {{ $tab['isToday'] ? '(Today)' : '' }}"
                                                    >
                                                        <span class="text-lg">{{ $tab['isToday'] ? 'Today' : ($tab['isPast'] ? 'Past' : $tab['dateDisplay']) }}</span>
                                                        <span class="text-xs text-gray-500 font-normal">{{ $tab['day'] }}</span>
                                                        @if ($tab['isBookable'] && !$tab['isPast'])
                                                            <span class="text-green-600 text-xs mt-1 font-medium">Slots Available</span>
                                                        @elseif ($tab['isOnLeave'])
                                                            <span class="text-orange-600 text-xs mt-1 font-medium">On Leave</span>
                                                        @elseif (!$tab['isAvailableDay'])
                                                            <span class="text-red-600 text-xs mt-1 font-medium">Not Available</span>
                                                        @endif
                                                    </button>
                                                @endforeach
                                            </div>
                                            <!-- Right Arrow -->
                                            <button type="button" @click="next" 
                                                class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-white border border-gray-200 rounded-full p-3 shadow-lg hover:bg-brand-teal-50 transition"
                                                :class="scroll >= scrollMax ? 'opacity-50 cursor-not-allowed' : ''"
                                                :disabled="scroll >= scrollMax">
                                                <svg class="w-6 h-6 text-brand-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endif

                                    <!-- Legend -->
                                    <div class="mt-6 flex flex-wrap gap-6 justify-center text-xs text-gray-600 bg-gray-50 py-3 rounded-xl border border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-brand-teal-50 border border-brand-teal-200 rounded-full mr-2"></div>
                                            <span>Available</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-brand-orange-100 border border-brand-orange-300 rounded-full mr-2"></div>
                                            <span>On Leave</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-red-100 border border-red-300 rounded-full mr-2"></div>
                                            <span>Not Available</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-gray-100 border border-gray-200 rounded-full mr-2"></div>
                                            <span>Past</span>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 border-2 border-blue-400 rounded-full mr-2"></div>
                                            <span>Today</span>
                                        </div>
                                    </div>

                                    <!-- Time Slots Section -->
                                    @if ($appointment_date)
                                        <div class="bg-white p-5 rounded-xl md:border md:border-gray-100 ">
                                            <div class="flex py-4  justify-between items-start sm:items-center mb-4 gap-4">
                                                <h2 class="text-20px font-semibold text-gray-800 flex items-center">
                                                    <svg class="h-5 w-5 mr-2 text-brand-orange-500" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Select Time Slot
                                                </h2>
                                                <button wire:click="clearAppointmentDate"
                                                    class="px-4 py-2 bg-brand-teal-100 text-brand-teal-800 rounded-lg hover:bg-brand-teal-200 transition flex items-center text-sm">
                                                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Back
                                                </button>
                                            </div>

                                            @php
                                                $maxSlots = $selectedDoctor->patients_per_slot ?? 4;
                                                $fillingUpThreshold = max(2, ceil($maxSlots * 0.5));
                                            @endphp

                                            <!-- Morning Slots -->
                                            <div class="mb-6">
                                                <h3 class="text-sm font-semibold text-gray-600 mb-3 flex items-center">
                                                    <svg class="h-4 w-4 mr-2 text-brand-teal-600" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Morning (Before 12 PM)
                                                </h3>
                                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                                    @php $hasMorning = false; @endphp
                                                    @foreach ($this->availableSlots as $time => $slot)
                                                        @php
                                                            $hour = (int) date('H', strtotime($slot['start']));
                                                            $isMorning = $hour < 12;
                                                            if ($isMorning) {
                                                                $hasMorning = true;
                                                            }
                                                        @endphp
                                                        @if ($isMorning)
                                                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                                                @if ($slot['disabled']) disabled @endif
                                                                class="p-3 border rounded-lg text-center transition-all duration-200 
                                                            {{ $appointment_time === $time ? 'bg-brand-teal-600 text-white border-brand-teal-700 ' : '' }}
                                                            {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] == 1 ? 'bg-red-200 border-red-300 text-red-800' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > 1 && $slot['remaining_capacity'] <= $fillingUpThreshold ? 'bg-brand-orange-100 border-brand-orange-200 text-brand-orange-700' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > $fillingUpThreshold ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @endif
                                                    @endforeach
                                                    @if (!$hasMorning)
                                                        <div
                                                            class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                            <p class="text-sm text-gray-500">No morning slots available</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Afternoon Slots -->
                                            <div class="mb-6">
                                                <h3 class="text-sm font-semibold text-gray-600 mb-3 flex items-center">
                                                    <svg class="h-4 w-4 mr-2 text-brand-teal-600" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Afternoon (12 PM - 4 PM)
                                                </h3>
                                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                                    @php $hasAfternoon = false; @endphp
                                                    @foreach ($this->availableSlots as $time => $slot)
                                                        @php
                                                            $hour = (int) date('H', strtotime($slot['start']));
                                                            $isAfternoon = $hour >= 12 && $hour < 16;
                                                            if ($isAfternoon) {
                                                                $hasAfternoon = true;
                                                            }
                                                        @endphp
                                                        @if ($isAfternoon)
                                                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                                                @if ($slot['disabled']) disabled @endif
                                                                class="p-3 border rounded-lg text-center transition-all duration-200 shadow-sm
                                                            {{ $appointment_time === $time ? 'bg-brand-teal-600 text-white border-brand-teal-700 shadow-md' : '' }}
                                                            {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] == 1 ? 'bg-red-200 border-red-300 text-red-800' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > 1 && $slot['remaining_capacity'] <= $fillingUpThreshold ? 'bg-brand-orange-100 border-brand-orange-200 text-brand-orange-700' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > $fillingUpThreshold ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @endif
                                                    @endforeach
                                                    @if (!$hasAfternoon)
                                                        <div
                                                            class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                            <p class="text-sm text-gray-500">No afternoon slots available
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Evening Slots -->
                                            <div>
                                                <h3 class="text-sm font-semibold text-gray-600 mb-3 flex items-center">
                                                    <svg class="h-4 w-4 mr-2 text-brand-teal-600" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    </svg>
                                                    Evening (After 4 PM)
                                                </h3>
                                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                                    @php $hasEvening = false; @endphp
                                                    @foreach ($this->availableSlots as $time => $slot)
                                                        @php
                                                            $hour = (int) date('H', strtotime($slot['start']));
                                                            $isEvening = $hour >= 16;
                                                            if ($isEvening) {
                                                                $hasEvening = true;
                                                            }
                                                        @endphp
                                                        @if ($isEvening)
                                                            <button wire:click="selectTimeSlot('{{ $time }}')"
                                                                @if ($slot['disabled']) disabled @endif
                                                                class="p-3 border rounded-lg text-center transition-all duration-200 shadow-sm
                                                            {{ $appointment_time === $time ? 'bg-brand-teal-600 text-white border-brand-teal-700 shadow-md' : '' }}
                                                            {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] == 1 ? 'bg-red-200 border-red-300 text-red-800' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > 1 && $slot['remaining_capacity'] <= $fillingUpThreshold ? 'bg-brand-orange-100 border-brand-orange-200 text-brand-orange-700' : '' }}
                                                            {{ !$slot['disabled'] && $slot['remaining_capacity'] > $fillingUpThreshold ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                                <div class="text-sm font-medium">
                                                                    {{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                                <div class="text-xs mt-1">
                                                                    {{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}
                                                                </div>
                                                            </button>
                                                        @endif
                                                    @endforeach
                                                    @if (!$hasEvening)
                                                        <div
                                                            class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                            <p class="text-sm text-gray-500">No evening slots available</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- Slot Legend -->
                                                <div class="mt-6 flex flex-wrap justify-end gap-4 border-t pt-3">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-4 h-4 bg-brand-teal-100 border border-brand-teal-200 rounded-full mr-1.5">
                                                        </div>
                                                        <span class="text-xs text-gray-600">Available
                                                            ({{ $fillingUpThreshold + 1 }}-{{ $maxSlots }}
                                                            slots)</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-4 h-4 bg-brand-orange-100 border border-brand-orange-200 rounded-full mr-1.5">
                                                        </div>
                                                        <span class="text-xs text-gray-600">Filling Up
                                                            (2-{{ $fillingUpThreshold }} slots)</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-4 h-4 bg-red-100 border border-red-200 rounded-full mr-1.5">
                                                        </div>
                                                        <span class="text-xs text-gray-600">Almost Full (1 slot)</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-4 h-4 bg-gray-100 border border-gray-200 rounded-full mr-1.5">
                                                        </div>
                                                        <span class="text-xs text-gray-600">Full (0 slots)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12 bg-blue-50 rounded-xl border border-blue-200">
                                <svg class="h-12 w-12 mx-auto text-blue-500 mb-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-xl font-medium text-blue-700">Select a Doctor First</h3>
                                <p class="text-sm text-blue-600 mt-2">Please choose a doctor to view available
                                    dates
                                </p>
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
                                        alt="Dr. {{ $selectedDoctor->user->name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="text-center sm:text-left">
                                    <h3 class="text-xl font-bold text-gray-800">Dr. {{ $selectedDoctor->user->name }}</h3>
                                    <p class="text-sm font-medium text-brand-teal-700">
                                        {{ $selectedDoctor->department->name }}</p>
                                    <div
                                        class="mt-2 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-start">
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ $appointment_time }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Form -->
                        <div class="bg-white p-5 rounded-xl border border-gray-100 md:shadow-sm">
                            <h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center">
                                <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                </svg>
                                Patient Information (रोगी जानकारी)
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Name -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Full Name (पूरा नाम) <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.live.debounce.500ms="newPatient.name"
                                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                        placeholder="John Doe (जॉन डो)">
                                    @error('newPatient.name')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Email (ईमेल)</label>
                                    <input type="email" wire:model.live.debounce.500ms="newPatient.email"
                                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                        placeholder="john@example.com (john@example.com)">
                                    @error('newPatient.email')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Phone (फोन) <span
                                            class="text-red-500">*</span></label>
                                    <input type="tel" wire:model.live.debounce.500ms="newPatient.phone"
                                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                        placeholder="+91 9876543210 (+91 9876543210)">
                                    @error('newPatient.phone')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Age -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Age (आयु) <span
                                            class="text-red-500">*</span></label>
                                    <input type="number" wire:model.live.debounce.500ms="newPatient.age"
                                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.age') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                        placeholder="30 (30)" min="0" max="120">
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
                                    <label class="block mb-2 text-sm font-medium text-gray-600">Pincode (पिनकोड) <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <input type="text" wire:model.live.debounce.500ms="pincode" maxlength="6"
                                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.pincode') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                            placeholder="123456 (123456)">
                                        @if (strlen($pincode) == 6)
                                            <div wire:loading wire:target="pincode"
                                                class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                                <svg class="animate-spin h-5 w-5 text-brand-teal-500" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
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
                                        placeholder="State (राज्य)">
                                </div>

                                <!-- District -->
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-600">District (जिला) <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" wire:model.live="newPatient.district"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                                        placeholder="District (जिला)">
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
                    <div class="space-y-4 md:space-y-6 max-w-md md:max-w-3xl mx-auto px-2 sm:px-0">
                        <!-- Header -->
                        <div class="text-center">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Confirm Your Appointment</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-1">Review details before final confirmation</p>
                        </div>

                        <div
                            class="bg-brand-teal-50 p-2 sm:p-3 md:p-4 rounded-lg sm:rounded-xl shadow-sm border border-brand-teal-100">
                            <h3 class="text-sm sm:text-base md:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">
                                Appointment Summary</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
                                <div class="space-y-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500">Doctor</p>
                                    <div class="flex items-center gap-1 sm:gap-2">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-full overflow-hidden bg-white border-2 border-brand-teal-200">
                                            <img src="{{ $selectedDoctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($selectedDoctor->user->name) . '&background=random&rounded=true' }}"
                                                alt="Dr. {{ $selectedDoctor->user->name }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm md:text-base font-semibold text-gray-800">Dr.
                                                {{ $selectedDoctor->user->name }}</p>
                                            <p class="text-[10px] sm:text-xs text-brand-teal-600">
                                                {{ $selectedDoctor->department->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500">Appointment</p>
                                    <p class="text-xs sm:text-sm md:text-base font-semibold text-gray-800">
                                        {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                                    <p class="text-[10px] sm:text-xs text-gray-600">{{ $appointment_time }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500">Patient</p>
                                    <p class="text-xs sm:text-sm md:text-base font-semibold text-gray-800">
                                        {{ $newPatient['name'] }}</p>
                                    <p class="text-[10px] sm:text-xs text-gray-600">{{ $newPatient['age'] }} yrs,
                                        {{ ucfirst($newPatient['gender']) }}</p>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500">Contact</p>
                                    <p class="text-xs sm:text-sm text-gray-800">
                                        {{ $newPatient['email'] ?: 'Not provided' }}</p>
                                    <p class="text-xs sm:text-sm text-gray-800">{{ $newPatient['phone'] }}</p>
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
                                        <h4 class="text-sm font-medium text-gray-800">Doctor's Consultation Fee</h4>
                                        <p class="text-xs text-gray-500 mt-1">Payable directly to doctor during visit</p>
                                    </div>
                                    <span class="text-sm font-semibold">₹{{ $selectedDoctor->fee }}</span>
                                </div>

                                <!-- Processing Fee -->
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
                                    <span class="text-lg font-bold text-brand-teal-600">₹50.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes (Optional)</label>
                            <textarea wire:model.debounce.500ms="notes" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition text-sm"
                                placeholder="Any symptoms, concerns, or special requests..."></textarea>
                        </div>

                        <!-- Payment Button -->
                        <button wire:click="createOrder" wire:loading.attr="disabled" wire:loading.target="createOrder"
                            class="w-full bg-brand-teal-600 hover:bg-brand-teal-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition-all duration-300 flex items-center justify-center">
                            <span wire:loading.remove wire:target="createOrder">
                                Confirm & Pay ₹50 Booking Fee
                            </span>
                            <span wire:loading wire:target="createOrder" class="flex items-center">
                                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing Payment...
                            </span>
                        </button>

                        <!-- Payment Disclaimer -->
                        <div class="text-center px-2">
                            <p class="text-xs text-gray-500">
                                <svg class="w-4 h-4 inline-block mr-1 -mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                The doctor's fee of ₹{{ $selectedDoctor->fee }} will be collected directly by the doctor
                                during your appointment.
                                Today's payment is only for the booking fee to secure your slot.
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Navigation Buttons -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
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
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
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

<style>
/* Full-width scroll bar for date tabs */
[x-ref="dates"]::-webkit-scrollbar {
    display: none;
}
[x-ref="dates"] {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
</div>