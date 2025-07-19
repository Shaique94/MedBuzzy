<div class="p-4 sm:p-6 max-w-5xl mx-auto bg-white rounded-2xl shadow-xl">
    <!-- Step Progress -->
    <div class="flex items-center justify-between mb-8">
        @foreach ([1 => 'Doctor', 2 => 'Date & Time', 3 => 'Patient', 4 => 'Confirm'] as $i => $label)
            <div class="flex-1 flex flex-col items-center relative">
                <div class="w-10 h-10 flex items-center justify-center rounded-full
                    {{ $step >= $i ? 'bg-brand-teal-600 text-white shadow-md' : 'bg-brand-orange-100 text-brand-orange-500' }}
                    font-bold text-base mb-2 transition-all duration-300 relative z-10">
                    {{ $i }}
                    @if ($step === $i)
                        <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-brand-teal-600 rounded-full"></div>
                    @endif
                </div>
                <span class="text-xs sm:text-sm font-medium {{ $step >= $i ? 'text-brand-teal-600' : 'text-gray-400' }}">
                    {{ $label }}
                </span>
            </div>
            @if ($i < 4)
                <div class="flex-1 h-1 mx-2 {{ $step > $i ? 'bg-brand-teal-600' : 'bg-brand-orange-100' }} transition-colors duration-300 relative top-5"></div>
            @endif
        @endforeach
    </div>

    <!-- Step 1: Doctor & Department Selection -->
    @if ($step === 1)
        <div class="space-y-6">
            <!-- Department Filter -->
            <div class="bg-brand-teal-50 p-4 sm:p-6 rounded-xl border border-brand-teal-100">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="h-6 w-6 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Select Department
                </h2>
                <div class="flex flex-wrap gap-2">
                    <button type="button" wire:click="$set('selectedDepartment', null)"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 shadow-sm
                        {{ !$selectedDepartment ? 'bg-brand-teal-600 text-white shadow-md' : 'bg-white hover:bg-brand-orange-50 text-gray-800 border border-gray-200' }}">
                        All Departments
                    </button>
                    @foreach ($departments as $department)
                        <button type="button" wire:click="$set('selectedDepartment', {{ $department->id }})"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 shadow-sm
                            {{ $selectedDepartment === $department->id ? 'bg-brand-teal-600 text-white shadow-md' : 'bg-white hover:bg-brand-orange-50 text-gray-800 border border-gray-200' }}">
                            {{ $department->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Doctors Grid -->
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-gray-100">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4 flex items-center justify-between">
                    <span class="flex items-center">
                        <svg class="h-6 w-6 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $doctor_id ? 'Selected Doctor' : 'Choose a Doctor' }}
                    </span>
                    @if ($doctor_id)
                        <button wire:click="$set('doctor_id', null)" class="text-sm text-brand-teal-600 hover:text-brand-teal-800 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Change Doctor
                        </button>
                    @endif
                </h2>

                @if (count($doctors) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($doctors as $doctor)
                            <div wire:click="$set('doctor_id', {{ $doctor->id }})"
                                class="relative flex flex-col h-full border rounded-xl overflow-hidden cursor-pointer transition-all duration-300 shadow-sm hover:shadow-md
                                {{ $doctor_id == $doctor->id ? 'ring-2 ring-brand-teal-500 bg-brand-teal-50 border-brand-teal-200' : 'border-gray-200 hover:border-brand-teal-200' }}">
                                <div class="bg-gradient-to-br from-brand-teal-50 to-brand-orange-50 p-5 text-center">
                                    <div class="relative">
                                        <div class="absolute -top-2 -right-2 bg-brand-teal-600 text-white text-xs px-2 py-1 rounded-full shadow-md">
                                            ₹{{ $doctor->fee }} Fee
                                        </div>
                                        <div class="w-24 h-24 rounded-full overflow-hidden bg-white mx-auto border-4 border-white shadow-md">
                                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="Dr. {{ $doctor->user->name }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default.jpg') }}'">
                                        </div>
                                    </div>
                                    <h3 class="text-gray-900 font-bold mt-4 text-lg">Dr. {{ $doctor->user->name }}</h3>
                                    <p class="text-brand-teal-600 text-sm font-medium mb-2">{{ $doctor->department->name ?? 'General Practitioner' }}</p>
                                    <div class="mt-3 flex flex-wrap justify-center gap-1">
                                        @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $index => $day)
                                            @php
                                                $weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                                $fullDay = $weekdays[$index];
                                                $isAvailable = in_array($fullDay, $doctor->available_days ?? []);
                                            @endphp
                                            <div class="w-7 h-7 flex items-center justify-center rounded-full text-xs font-medium
                                                {{ $isAvailable ? 'bg-brand-teal-400 text-white border border-brand-teal-500' : 'bg-gray-100 text-gray-400 opacity-50 cursor-not-allowed' }}"
                                                title="{{ $fullDay }}">{{ substr($day, 0, 1) }}</div>
                                        @endforeach
                                    </div>
                                    <button class="mt-4 w-full py-2 bg-brand-teal-600 hover:bg-brand-teal-700 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                                        Select Doctor
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <svg class="h-14 w-14 mb-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H7a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m14 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-gray-600 mb-2">No doctors available in this department</p>
                        <button wire:click="$set('selectedDepartment', null)" class="mt-2 text-brand-teal-600 font-medium hover:text-brand-teal-700 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            View all departments
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Step 2: Date & Time Selection -->
    @if ($step === 2)
        <div class="space-y-8 max-w-4xl mx-auto">
            @if ($selectedDoctor)
                <div class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-6 rounded-2xl shadow-lg border border-brand-teal-200">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-white border-4 border-brand-teal-600 shadow-lg">
                            <img src="{{ asset('storage/' . $selectedDoctor->image) }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default.jpg') }}'">
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="text-xl font-bold text-gray-800">Dr. {{ $selectedDoctor->user->name }}</h3>
                            <p class="text-sm font-medium text-brand-teal-700">{{ $selectedDoctor->department->name }}</p>
                            <div class="mt-2 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-start">
                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                                <p class="text-sm text-gray-600">{{ $appointment_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="h-6 w-6 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $appointment_date ? 'Selected Date: ' . \Carbon\Carbon::parse($appointment_date)->format('F j, Y') : 'Select Appointment Date' }}
                    </h2>

                    @if ($hasAvailableDays)
                        <!-- Calendar Section (Hidden when a date is selected) -->
                        @if (!$appointment_date)
                            <div class="flex items-center justify-between mb-6">
                                <button wire:click="previousMonth" class="px-4 py-2 bg-brand-teal-100 text-brand-teal-800 rounded-lg hover:bg-brand-teal-200 transition flex items-center">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Previous
                                </button>
                                <h3 class="text-lg font-medium text-gray-800">{{ \Carbon\Carbon::parse($currentMonth)->format('F Y') }}</h3>
                                <button wire:click="nextMonth" class="px-4 py-2 bg-brand-teal-100 text-brand-teal-800 rounded-lg hover:bg-brand-teal-200 transition flex items-center">
                                    Next
                                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                                <div class="grid grid-cols-7 gap-1 text-center text-sm font-semibold text-gray-600 bg-gray-50 py-3">
                                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                                        <div class="px-2">{{ $day }}</div>
                                    @endforeach
                                </div>
                                <div class="grid grid-cols-7 gap-1 text-center text-sm p-2">
                                    @for ($i = 0; $i < $startDayOfWeek; $i++)
                                        <div class="bg-gray-50 rounded-lg h-10 sm:h-12"></div>
                                    @endfor
                                    @for ($day = 1; $day <= $daysInMonth; $day++)
                                        @php
                                            $dateObj = \Carbon\Carbon::parse($currentMonth)->startOfMonth()->addDays($day - 1);
                                            $formattedDate = $dateObj->format('Y-m-d');
                                            $isWithinBookingRange = in_array($formattedDate, $validBookingDays);
                                            $isAvailableDay = in_array($dateObj->dayOfWeek, $availableDayNumbers);
                                            $isOnLeave = in_array($formattedDate, $onLeaveDates);
                                            $isBookable = $isWithinBookingRange && $isAvailableDay && !$isOnLeave;
                                            $isSelected = $appointment_date === $formattedDate;
                                            $isPast = $dateObj->isPast() && !$dateObj->isToday();
                                            $isToday = $dateObj->isToday();
                                        @endphp
                                        <button wire:key="day-{{ $day }}"
                                            @if ($isBookable) wire:click="setAppointmentDate('{{ $formattedDate }}')" @endif
                                            @disabled(!$isBookable || $isPast)
                                            class="w-full h-10 sm:h-12 rounded-lg transition-all duration-200 flex flex-col items-center justify-center text-sm
                                            {{ $isSelected ? 'bg-brand-teal-600 text-white font-bold ring-2 ring-brand-teal-400' : '' }}
                                            {{ $isBookable && !$isPast ? 'hover:bg-brand-teal-100 bg-brand-teal-50 border border-brand-teal-200' : '' }}
                                            {{ !$isAvailableDay ? 'bg-red-100 border border-red-300 text-red-600' : '' }}
                                            {{ $isOnLeave ? 'bg-brand-orange-100 border border-brand-orange-300 text-brand-orange-600' : '' }}
                                            {{ $isPast ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : '' }}
                                            {{ $isToday ? 'border-2 border-blue-400 text-blue-600 font-semibold' : '' }}"
                                            title="{{ $isOnLeave ? 'Doctor on leave' : (!$isAvailableDay ? 'Not available' : ($isBookable ? 'Available' : ($isPast ? 'Past date' : 'Outside booking range'))) }}">
                                            {{ $day }}
                                            @if ($isToday)
                                                <span class="text-[10px] text-blue-600">Today</span>
                                            @endif
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="mt-6 flex flex-wrap gap-4 justify-center text-xs text-gray-600">
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
                                    <span>Past Date</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 border-2 border-blue-400 rounded-full mr-2"></div>
                                    <span>Today</span>
                                </div>
                            </div>
                        @endif

                        <!-- Time Slots Section (Shown when a date is selected) -->
                        @if ($appointment_date)
                            <div class="mt-6 bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-lg">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
                                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                                        <svg class="h-6 w-6 mr-2 text-brand-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Select Appointment Time
                                    </h2>
                                    <button wire:click="clearAppointmentDate" class="px-4 py-2 bg-brand-teal-100 text-brand-teal-800 rounded-lg hover:bg-brand-teal-200 transition flex items-center text-sm">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                        Back to Calendar
                                    </button>
                                </div>
                                <div wire:loading wire:target="setAppointmentDate" class="py-8 text-center text-gray-500">
                                    <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-brand-teal-500 border-r-2 border-brand-teal-500 border-b-2 border-transparent mx-auto mb-4"></div>
                                    <p>Loading time slots...</p>
                                </div>
                                <div wire:loading.remove wire:target="setAppointmentDate" class="space-y-6">
                                    @php
                                        $maxSlots = $selectedDoctor->patients_per_slot ?? 4;
                                        $fillingUpThreshold = max(2, ceil($maxSlots * 0.5));
                                    @endphp
                                    <!-- Morning Slots -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-600 mb-4 flex items-center">
                                            <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                            Morning (Before 12 PM)
                                        </h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                            @php $hasMorning = false; @endphp
                                            @foreach ($this->availableSlots as $time => $slot)
                                                @php
                                                    $hour = (int) date('H', strtotime($slot['start']));
                                                    $isMorning = $hour < 12;
                                                    if ($isMorning) $hasMorning = true;
                                                @endphp
                                                @if ($isMorning)
                                                    <button wire:click="selectTimeSlot('{{ $time }}')"
                                                        @if ($slot['disabled']) disabled @endif
                                                        class="p-3 border rounded-lg text-center transition-all duration-200 shadow-sm
                                                        {{ $appointment_time === $time ? 'bg-brand-teal-600 text-white border-brand-teal-700 shadow-md' : '' }}
                                                        {{ $slot['disabled'] ? 'bg-gray-100 text-gray-400 cursor-not-allowed border-gray-200' : '' }}
                                                        {{ !$slot['disabled'] && $slot['remaining_capacity'] == 1 ? 'bg-red-200 border-red-300 text-red-800' : '' }}
                                                        {{ !$slot['disabled'] && $slot['remaining_capacity'] > 1 && $slot['remaining_capacity'] <= $fillingUpThreshold ? 'bg-brand-orange-100 border-brand-orange-200 text-brand-orange-700' : '' }}
                                                        {{ !$slot['disabled'] && $slot['remaining_capacity'] > $fillingUpThreshold ? 'bg-brand-teal-50 border-brand-teal-200 hover:bg-brand-teal-100 text-brand-teal-800' : '' }}">
                                                        <div class="text-sm font-medium">{{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                        <div class="text-xs mt-1">{{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}</div>
                                                    </button>
                                                @endif
                                            @endforeach
                                            @if (!$hasMorning)
                                                <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                    <p class="text-gray-500 text-sm">No morning slots available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Afternoon Slots -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-600 mb-4 flex items-center">
                                            <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                            Afternoon (12 PM - 4 PM)
                                        </h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                            @php $hasAfternoon = false; @endphp
                                            @foreach ($this->availableSlots as $time => $slot)
                                                @php
                                                    $hour = (int) date('H', strtotime($slot['start']));
                                                    $isAfternoon = $hour >= 12 && $hour < 16;
                                                    if ($isAfternoon) $hasAfternoon = true;
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
                                                        <div class="text-sm font-medium">{{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                        <div class="text-xs mt-1">{{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}</div>
                                                    </button>
                                                @endif
                                            @endforeach
                                            @if (!$hasAfternoon)
                                                <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                    <p class="text-gray-500 text-sm">No afternoon slots available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Evening Slots -->
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-600 mb-4 flex items-center">
                                            <svg class="h-5 w-5 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                            </svg>
                                            Evening (After 4 PM)
                                        </h3>
                                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                            @php $hasEvening = false; @endphp
                                            @foreach ($this->availableSlots as $time => $slot)
                                                @php
                                                    $hour = (int) date('H', strtotime($slot['start']));
                                                    $isEvening = $hour >= 16;
                                                    if ($isEvening) $hasEvening = true;
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
                                                        <div class="text-sm font-medium">{{ date('h:i A', strtotime($slot['start'])) }}</div>
                                                        <div class="text-xs mt-1">{{ $slot['disabled'] ? 'Full' : $slot['remaining_capacity'] . ' slot' . ($slot['remaining_capacity'] != 1 ? 's' : '') }}</div>
                                                    </button>
                                                @endif
                                            @endforeach
                                            @if (!$hasEvening)
                                                <div class="col-span-full py-6 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                                    <p class="text-gray-500 text-sm">No evening slots available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if (empty($this->availableSlots))
                                        <div class="py-8 text-center bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                            <p class="text-gray-500 text-sm">No time slots available for this date.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-10 bg-red-50 rounded-2xl border border-red-200">
                            <svg class="h-14 w-14 mx-auto text-red-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <h3 class="text-xl font-medium text-red-700">No Availability Set</h3>
                            <p class="text-sm text-red-600">Please contact the doctor's office for scheduling options.</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-10 bg-blue-50 rounded-2xl border border-blue-200">
                    <svg class="h-14 w-14 mx-auto text-blue-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h3 class="text-xl font-medium text-blue-700">Select a Doctor</h3>
                    <p class="text-sm text-blue-600">Please choose a doctor to view available dates.</p>
                </div>
            @endif
            @error('appointment_time')
                <p class="mt-4 text-sm text-red-500 text-center">{{ $message }}</p>
            @enderror
        </div>
    @endif

    <!-- Step 3: Patient Information -->
    @if ($step === 3)
        <div class="space-y-8 max-w-4xl mx-auto">
            <div class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-6 rounded-2xl shadow-lg border border-brand-teal-200">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden bg-white border-4 border-brand-teal-600 shadow-lg">
                        <img src="{{ asset('storage/' . $selectedDoctor->image) }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default.jpg') }}'">
                    </div>
                    <div class="flex-1 text-center sm:text-left">
                        <p class="text-xl font-bold text-gray-800">Dr. {{ $selectedDoctor->user->name }}</p>
                        <p class="text-sm font-medium text-brand-teal-700">{{ $selectedDoctor->department->name }}</p>
                        <div class="mt-2 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-start">
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment_time }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <svg class="h-6 w-6 mr-2 text-brand-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Patient Information
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Name<span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live.debounce.500ms="newPatient.name"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                            placeholder="John Doe"/>
                        @error('newPatient.name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Email</label>
                        <input type="email" wire:model.live.debounce.500ms="newPatient.email"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                            placeholder="john@example.com"/>
                        @error('newPatient.email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Phone<span class="text-red-500">*</span></label>
                        <input type="tel" wire:model.live.debounce.500ms="newPatient.phone"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                            placeholder="+91 123-456-7890"/>
                        @error('newPatient.phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Age<span class="text-red-500">*</span></label>
                        <input type="number" wire:model.live.debounce.500ms="newPatient.age"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.age') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                            placeholder="30" min="0" max="120"/>
                        @error('newPatient.age') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Gender<span class="text-red-500">*</span></label>
                        <select wire:model.live="newPatient.gender"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.gender') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('newPatient.gender') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">Pincode<span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.500ms="pincode" maxlength="6"
                                class="w-full px-4 py-3 border {{ $errors->has('newPatient.pincode') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                                placeholder="123456"/>
                            <div wire:loading wire:target="pincode" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg class="animate-spin h-5 w-5 text-brand-teal-500" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('newPatient.pincode') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">State<span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="newPatient.state" readonly
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                            placeholder="State will autofill"/>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-600">District<span class="text-red-500">*</span></label>
                        <input type="text" wire:model.live="newPatient.district" readonly
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                            placeholder="District will autofill"/>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-600">Address<span class="text-red-500">*</span></label>
                        <textarea wire:model.live.debounce.500ms="newPatient.address" rows="4"
                            class="w-full px-4 py-3 border {{ $errors->has('newPatient.address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition bg-white"
                            placeholder="123 Main St, Apt 4B, City"></textarea>
                        @error('newPatient.address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Step 4: Payment & Confirmation -->
    @if ($step === 4)
        <div class="space-y-6 max-w-4xl mx-auto">
            <div class="bg-brand-teal-50 p-6 rounded-2xl shadow-sm border border-brand-teal-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Appointment Summary</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-500">Doctor</p>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-white border-2 border-brand-teal-200">
                                <img src="{{ asset('storage/' . $selectedDoctor->image) }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default.jpg') }}'">
                            </div>
                            <div>
                                <p class="text-base font-semibold text-gray-800">Dr. {{ $selectedDoctor->user->name }}</p>
                                <p class="text-xs text-brand-teal-600">{{ $selectedDoctor->department->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-500">Appointment</p>
                        <p class="text-base font-semibold text-gray-800">{{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}</p>
                        <p class="text-xs text-gray-600">{{ $appointment_time }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-500">Patient</p>
                        <p class="text-base font-semibold text-gray-800">{{ $newPatient['name'] }}</p>
                        <p class="text-xs text-gray-600">{{ $newPatient['age'] }} yrs, {{ ucfirst($newPatient['gender']) }}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-medium text-gray-500">Contact</p>
                        <p class="text-sm text-gray-800">{{ $newPatient['email'] }}</p>
                        <p class="text-sm text-gray-800">{{ $newPatient['phone'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Details</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Consultation Fee</span>
                        <span class="font-medium">₹{{ $selectedDoctor->fee }}</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-gray-600">Taxes & Fees</span>
                        <span class="font-medium">₹0</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-lg font-semibold">Total Amount</span>
                        <span class="text-lg font-bold text-brand-teal-600">₹{{ $selectedDoctor->fee }}</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <label class="block mb-3 text-sm font-medium text-gray-600">Payment Method<span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach ($available_payment_methods as $method)
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="payment_method" value="{{ $method }}" class="hidden peer"/>
                            <div class="p-4 border rounded-xl transition-all duration-200 flex items-center justify-center
                                peer-checked:border-brand-teal-500 peer-checked:bg-brand-teal-50 peer-checked:ring-1 peer-checked:ring-brand-teal-500
                                hover:bg-brand-orange-50 border-gray-200">
                                <span class="text-sm font-medium">{{ $method }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('payment_method') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <label class="block mb-3 text-sm font-medium text-gray-600">Notes (Optional)</label>
                <textarea wire:model.live="notes" rows="3"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 transition"
                    placeholder="Any symptoms, concerns, or special requests..."></textarea>
            </div>
        </div>
    @endif

    <!-- Navigation -->
    <div class="mt-8 flex flex-col sm:flex-row justify-between gap-4 border-t pt-6">
        @if ($step > 1)
            <button wire:click="previousStep"
                class="px-6 py-3 bg-white border border-brand-orange-300 text-brand-orange-600 rounded-lg hover:bg-brand-orange-50 transition flex items-center justify-center shadow-sm">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back
            </button>
        @else
            <div></div>
        @endif
        
        @if ($step < 4)
            <button wire:click="nextStep" wire:loading.attr="disabled"
                class="px-6 py-3 bg-brand-teal-600 text-white rounded-lg hover:bg-brand-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-teal-500 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center shadow-md">
                <span>Continue</span>
                <svg class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span wire:loading wire:target="nextStep" class="ml-2">
                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        @else
            <button wire:click="submit"
                class="px-6 py-3 bg-brand-teal-600 text-white rounded-lg hover:bg-brand-teal-700 transition flex items-center justify-center shadow-md group">
                <span>Confirm Appointment</span>
                <svg class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </button>
        @endif
    </div>
</div>