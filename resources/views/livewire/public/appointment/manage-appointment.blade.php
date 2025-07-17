<div class="p-6 max-w-4xl mx-auto bg-white rounded-xl shadow-lg">

    {{-- Step Progress --}}
    <div class="flex items-center justify-between mb-8">
        @foreach ([1, 2, 3, 4, 5, 6] as $i)
            <div class="flex-1 flex flex-col items-center">
                <div
                    class="w-10 h-10 flex items-center justify-center rounded-full
                    {{ $step >= $i ? 'bg-teal-600 text-white' : 'bg-orange-100 text-orange-500' }}
                    font-bold mb-1 transition-all duration-300">
                    {{ $i }}
                </div>
                <div
                    class="text-xs font-semibold {{ $step === $i ? 'text-teal-600' : 'text-gray-400' }} transition-colors">
                    @if ($i === 1)
                        Doctor
                    @elseif ($i === 2)
                        Calender
                    @elseif ($i === 3)
                        Slot
                    @elseif($i === 4)
                        Patient
                    @elseif($i === 5)
                        Payment
                    @else
                        Confirm
                    @endif
                </div>
            </div>
            @if ($i < 6)
                <div
                    class="flex-1 h-1 mx-2 {{ $step > $i ? 'bg-teal-600' : 'bg-orange-100' }} transition-colors duration-300">
                </div>
            @endif
        @endforeach
    </div>

    {{-- Step Heading --}}
    <h2 class="text-2xl font-bold mb-6 text-teal-700">
        @if ($step === 1)
        @elseif ($step === 2)
            Choose From Calender
        @elseif ($step === 3)
            Slot Select
        @elseif($step === 4)
            Patient Information
        @elseif($step === 5)
            Payment Details
        @else
            Confirm Appointment
        @endif
    </h2>

    @if ($step === 1)
        <div class="space-y-6" data-step="1">
            <!-- Department Filter Cards -->
            <div class="bg-white p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Select Department
                </h2>
                <div class="flex flex-wrap gap-2">
                    <button type="button" wire:click="$set('selectedDepartment', null)"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 
                    {{ !$selectedDepartment ? 'bg-teal-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                        All Departments
                    </button>

                    @foreach ($departments as $department)
                        <button type="button" wire:click="$set('selectedDepartment', {{ $department->id }})"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                        {{ $selectedDepartment === $department->id ? 'bg-teal-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                            {{ $department->name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm">


                <!-- Doctors Grid -->
                <div class="bg-white p-5 rounded-xl shadow-sm">
                    <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $doctor_id ? 'Selected Doctor' : 'Choose a Doctor' }}
                        </div>
                        @if ($doctor_id)
                            <button wire:click="$set('doctor_id', null)"
                                class="text-sm text-teal-600 hover:text-teal-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Change Doctor
                            </button>
                        @endif
                    </h2>

                    <!-- Show Doctor Grid if no doctor selected -->
                    @if (count($doctors) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($doctors as $doctor)
                                <div wire:click="$set('doctor_id', {{ $doctor->id }})"
                                    class="relative flex flex-col h-full border rounded-lg overflow-hidden cursor-pointer transition-all duration-300
                                {{ $doctor_id == $doctor->id ? 'ring-2 ring-teal-500 bg-teal-50' : 'hover:shadow-md hover:border-teal-200' }}">

                                    <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-5 text-center border-b">
                                        <div class="relative">
                                            <!-- Fee badge -->
                                            <div
                                                class="absolute -top-1 -right-1 bg-teal-600 text-white text-xs px-2 py-1 rounded-full z-10 shadow-sm">
                                                ₹{{ $doctor->fee }} Fee
                                            </div>

                                            <div
                                                class="w-24 h-24 rounded-full overflow-hidden bg-white mx-auto border-4 border-white shadow-md">
                                                <img src="{{ asset('storage/' . $doctor->image) }}"
                                                    alt="Dr. {{ $doctor->user->name }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <h3 class="text-gray-900 font-bold">Dr. {{ $doctor->user->name }}</h3>
                                            <p class="text-teal-600 text-sm font-medium">
                                                {{ $doctor->department->name ?? 'General Practitioner' }}
                                            </p>

                                            <!-- Available days display -->
                                            <div class="mt-3 flex flex-wrap justify-center gap-1">
                                                @if (is_array($doctor->available_days))
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
                                                            $isAvailable = in_array($fullDay, $doctor->available_days);
                                                        @endphp
                                                        <div class="w-7 h-7 flex items-center justify-center rounded-full text-xs font-medium
                {{ $isAvailable ? 'bg-teal-400 text-white border border-teal-500' : 'bg-gray-100 text-gray-400 opacity-50 cursor-not-allowed' }}"
                                                            title="{{ $fullDay }}">
                                                            {{ substr($day, 0, 1) }}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>


                                            <!-- Select doctor button -->
                                            <button
                                                class="mt-4 w-full py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-md text-sm font-medium transition-colors flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Select Doctor
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center py-12 text-gray-500 bg-gray-50 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H7a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m14 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p>No doctors available for the selected department.</p>
                            <button wire:click="$set('selectedDepartment', null)"
                                class="mt-4 text-teal-600 font-medium hover:text-teal-700">
                                View all departments
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Navigation -->
                {{-- <div class="flex justify-between text-sm text-balance items-center mt-6">
                    <a wire:navigate href=""
                        class="inline-flex items-center text-teal-600 hover:underline text-md mt-1 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Check your appointment.
                    </a>


                </div> --}}
            </div>
    @endif
    @if ($step === 2)

        <div class="border rounded-lg overflow-hidden bg-beige-50">
            <div class="flex flex-col md:flex-row md:items-start">
                <div class="md:w-1/3  p-5 flex items-center justify-center md:border-r border-beige-100">
                    <div class="text-center">
                        <div
                            class="w-28 h-28 rounded-full overflow-hidden bg-white border-4 border-white shadow-lg mx-auto">
                            <img src="{{ $selectedDoctor->image ? $selectedDoctor->image : asset('images/default.jpg') }}"
                                class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mt-4">Dr.
                            {{ $selectedDoctor->user->name }}</h3>
                        <p class="text-sm font-medium text-beige-600">
                            {{ $selectedDoctor->department->name }}</p>
                    </div>
                </div>

                <div class="md:w-2/3 p-5">
                    <h4 class="text-sm font-medium text-gray-500 mb-3">Doctor Information</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <div class="bg-beige-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-beige-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Qualification</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $selectedDoctor->qualification ?? 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-beige-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-beige-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Consultation Fee</p>
                                <p class="text-sm font-medium text-gray-800">
                                    ₹{{ $selectedDoctor->fee }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-beige-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-beige-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Department</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $selectedDoctor->department->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-beige-100 p-2 rounded-full mr-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-beige-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Available Days</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ is_array($selectedDoctor->available_days) ? implode(', ', $selectedDoctor->available_days) : 'Not specified' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-600">Dr. {{ $selectedDoctor->user->name }} is a
                            highly skilled healthcare professional with comprehensive training and
                            experience in the field of {{ $selectedDoctor->department->name }}.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Choose Appointment Date
            </h2>

            @if ($selectedDoctor)
                @php
                    $today = now();
                    $startOfMonth = $today->copy()->startOfMonth();
                    $endOfMonth = $today->copy()->endOfMonth();
                    $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 (Sun) - 6 (Sat)
                    $daysInMonth = $today->daysInMonth;
                    $maxBookingDays = $selectedDoctor->max_booking_days ?? 0;

                    $bookingStart = $today->copy()->startOfDay();
                    $bookingEnd = $today->copy()->addDays($maxBookingDays)->endOfDay();

                    // Convert available days to day numbers (0=Sunday, 6=Saturday)
                    $availableDayNumbers = [];
                    $weekdaysFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    if (is_array($selectedDoctor->available_days)) {
                        foreach ($selectedDoctor->available_days as $day) {
                            $availableDayNumbers[] = array_search($day, $weekdaysFull);
                        }
                    }

                    $hasAvailableDays = !empty($availableDayNumbers);

                    // Check for holiday/leave dates
                    $onLeaveDates = [];
                    if ($selectedDoctor->unavailable_from && $selectedDoctor->unavailable_to) {
                        $startDate = Carbon\Carbon::parse($selectedDoctor->unavailable_from);
                        $endDate = Carbon\Carbon::parse($selectedDoctor->unavailable_to);

                        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                            $onLeaveDates[] = $date->format('Y-m-d');
                        }
                    }
                @endphp

                <!-- Doctor's Availability Indicator -->
                <div class="mb-6 bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm">
                    <!-- Header with status legend -->
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-medium text-gray-700">Weekly Availability</h3>
                            <div class="flex space-x-4">
                                <div class="flex items-center">
                                    <span class="flex items-center">
                                        <span class="w-2.5 h-2.5 rounded-full bg-teal-500 mr-2"></span>
                                        <span class="text-xs text-gray-600">Available</span>
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <span class="flex items-center">
                                        <span class="w-2.5 h-2.5 rounded-full bg-gray-300 mr-2"></span>
                                        <span class="text-xs text-gray-600">Unavailable</span>
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <span class="flex items-center">
                                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 mr-2"></span>
                                        <span class="text-xs text-gray-600">On Leave</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekday indicators -->
                    <div class="grid grid-cols-7 divide-x divide-gray-200">
                        @foreach (['S', 'M', 'T', 'W', 'T', 'F', 'S'] as $index => $day)
                            @php
                                $fullDay = $weekdaysFull[$index];
                                $isAvailable = $hasAvailableDays && in_array($fullDay, $selectedDoctor->available_days);
                            @endphp
                            <div class="py-3 flex flex-col items-center">
                                <span class="text-xs font-medium text-gray-500 mb-1">{{ $day }}</span>
                                <span
                                    class="w-6 h-6 rounded-full flex items-center justify-center 
                    {{ $isAvailable ? 'bg-teal-100 text-teal-800' : 'bg-gray-100 text-gray-400' }}
                    {{ $isAvailable ? 'border border-teal-300' : 'border border-gray-200' }}"
                                    title="{{ $isAvailable ? 'Available on ' . $fullDay : 'Not available on ' . $fullDay }}">
                                    {{ $index + 1 }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Leave notice -->
                    @if (!empty($onLeaveDates))
                        <div class="bg-amber-50 px-4 py-2.5 border-t border-amber-100">
                            <div class="flex items-center text-sm text-amber-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>
                                    Doctor on leave from
                                    <span
                                        class="font-medium">{{ Carbon\Carbon::parse($selectedDoctor->unavailable_from)->format('M j') }}</span>
                                    to
                                    <span
                                        class="font-medium">{{ Carbon\Carbon::parse($selectedDoctor->unavailable_to)->format('M j, Y') }}</span>
                                </span>
                            </div>
                        </div>
                    @endif
                </div>

                @if ($hasAvailableDays)
                    <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-600">
                        <!-- Weekday Headers -->
                        @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayIndex => $day)
                            @php
                                $isAvailable = in_array($dayIndex, $availableDayNumbers);
                            @endphp
                            <div class="font-semibold py-2 {{ $isAvailable ? 'text-gray-800' : 'text-gray-400' }}">
                                {{ $day }}
                            </div>
                        @endforeach

                        <!-- Empty boxes -->
                        @for ($i = 0; $i < $startDayOfWeek; $i++)
                            <div></div>
                        @endfor

                        <!-- Day buttons -->
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $dateObj = $today
                                    ->copy()
                                    ->startOfMonth()
                                    ->addDays($day - 1);
                                $formattedDate = $dateObj->format('Y-m-d');
                                $isWithinBookingRange = $dateObj->between($bookingStart, $bookingEnd);
                                $isAvailableDay = in_array($dateObj->dayOfWeek, $availableDayNumbers);
                                $isOnLeave = in_array($formattedDate, $onLeaveDates);
                                $isBookable = $isWithinBookingRange && $isAvailableDay && !$isOnLeave;
                                $isSelected = $appointment_date === $formattedDate;
                                $isPast = $dateObj->isPast() && !$dateObj->isToday();
                                $isToday = $dateObj->isToday();
                            @endphp

                            <button wire:key="day-{{ $day }}"
                                @if ($isBookable) wire:click="setAppointmentDate('{{ $formattedDate }}')" @endif
                                @disabled(!$isBookable)
                                class="w-full aspect-square rounded-lg transition flex flex-col items-center justify-center relative
                            {{ $isSelected ? 'bg-teal-600 text-white font-bold ring-2 ring-teal-400 ring-offset-2' : '' }}
                            {{ $isBookable ? 'hover:bg-teal-50 cursor-pointer border-2 border-teal-300 bg-white' : '' }}
                            {{ !$isAvailableDay ? 'bg-red-50 border border-red-200 text-red-400' : '' }}
                            {{ $isOnLeave ? 'bg-yellow-50 border border-yellow-200 text-yellow-600' : '' }}
                            {{ $isPast ? 'opacity-50' : '' }}
                            {{ $isToday ? 'border-blue-300 border-2' : '' }}"
                                title="{{ $isOnLeave ? 'Doctor on leave' : (!$isAvailableDay ? 'Doctor not available on ' . $weekdaysFull[$dateObj->dayOfWeek] : ($isWithinBookingRange ? 'Available for booking' : 'Outside booking range')) }}">

                                <div class="flex flex-col items-center gap-0.5">
                                    <span
                                        class="{{ $isSelected ? 'text-white' : ($isToday ? 'text-blue-600 font-medium' : '') }}">{{ $day }}</span>

                                    @if ($isBookable)
                                        <span class="text-[10px] text-teal-600 font-medium">AVAILABLE</span>
                                    @elseif($isOnLeave)
                                        <span class="text-[10px] text-yellow-600 font-medium">ON LEAVE</span>
                                    @elseif(!$isAvailableDay)
                                        <span class="text-[10px] text-red-500 font-medium">UNAVAILABLE</span>
                                    @endif
                                </div>

                                @if ($isToday && !$isSelected)
                                    <span class="absolute bottom-1 w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                @endif
                            </button>
                        @endfor
                    </div>

                    @if ($appointment_date)
                        <div
                            class="mt-4 p-3 bg-teal-50 rounded-lg text-sm text-teal-800 font-medium flex items-center border border-teal-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Selected: <span
                                    class="font-semibold">{{ \Carbon\Carbon::parse($appointment_date)->format('D, M d, Y') }}</span></span>
                        </div>
                    @endif
                @else
                    <div class="text-center py-6 bg-red-50 rounded-lg border border-red-200">
                        <div class="text-red-500 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-red-700">No Availability Set</h3>
                        <p class="text-sm text-red-600 mt-1 max-w-md mx-auto">This doctor hasn't configured any
                            available days. Please contact their office for scheduling options.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-6 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="text-blue-500 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-blue-700">Select a Doctor</h3>
                    <p class="text-sm text-blue-600 mt-1 max-w-md mx-auto">Please choose a doctor from the list above
                        to view their available appointment dates</p>
                </div>
            @endif
        </div>
    @endif
    {{-- step 3 --}}
  @if ($step === 3)
    <!-- Time Slots -->
    <div class="space-y-8">
        <!-- Morning Slots -->
        @if (count($this->morningSlots) > 0)
            <div>
                <h3 class="text-lg font-medium mb-4 text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Morning Slots
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($this->morningSlots as $time => $slot)
                        <button wire:click="selectTimeSlot('{{ $time }}')"
                            @if ($slot['disabled']) disabled @endif
                            class="relative p-3 border rounded-lg text-left transition-all duration-200
                                @if ($appointment_time === $time) ring-1 ring-teal-300
                                @elseif ($slot['disabled']) 
                                    bg-gray-50 text-gray-400 cursor-not-allowed
                                @else 
                                    border-gray-200 hover:border-teal-300 hover:bg-teal-50 @endif">
                            <div class="font-medium text-gray-800">
                                {{ $slot['start'] }} - {{ $slot['end'] }}
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                @if ($slot['disabled'])
                                    <span class="text-red-500 font-medium">Fully Booked</span>
                                @else
                                    <span class="font-medium @if($slot['remaining_capacity'] < $slot['max_capacity']) text-amber-500 @else text-teal-600 @endif">
                                        {{ $slot['remaining_capacity'] }} of {{ $slot['max_capacity'] }} available
                                    </span>
                                @endif
                            </div>
                            @if ($appointment_time === $time)
                                <div class="absolute top-2 right-2 text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
                @if ($morningSlotsFull = collect($this->morningSlots)->every(fn($slot) => $slot['disabled']))
                    <div class="mt-2 text-sm text-amber-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        All morning slots are fully booked. Please try afternoon or evening slots.
                    </div>
                @endif
            </div>
        @endif

        <!-- Afternoon Slots -->
        @if (count($this->afternoonSlots) > 0)
            <div>
                <h3 class="text-lg font-medium mb-4 text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Afternoon Slots
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($this->afternoonSlots as $time => $slot)
                        <button wire:click="selectTimeSlot('{{ $time }}')"
                            @if ($slot['disabled']) disabled @endif
                            class="relative p-3 border rounded-lg text-left transition-all duration-200
                                @if ($appointment_time === $time) ring-1 ring-teal-300
                                @elseif ($slot['disabled']) 
                                    bg-gray-50 text-gray-400 cursor-not-allowed
                                @else 
                                    border-gray-200 hover:border-teal-300 hover:bg-teal-50 @endif">
                            <div class="font-medium text-gray-800">
                                {{ $slot['start'] }} - {{ $slot['end'] }}
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                @if ($slot['disabled'])
                                    <span class="text-red-500 font-medium">Fully Booked</span>
                                @else
                                    <span class="font-medium @if($slot['remaining_capacity'] < $slot['max_capacity']) text-amber-500 @else text-teal-600 @endif">
                                        {{ $slot['remaining_capacity'] }} of {{ $slot['max_capacity'] }} available
                                    </span>
                                @endif
                            </div>
                            @if ($appointment_time === $time)
                                <div class="absolute top-2 right-2 text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
                @if ($afternoonSlotsFull = collect($this->afternoonSlots)->every(fn($slot) => $slot['disabled']))
                    <div class="mt-2 text-sm text-amber-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        All afternoon slots are fully booked. Please try morning or evening slots.
                    </div>
                @endif
            </div>
        @endif

        <!-- Evening Slots -->
        @if (count($this->eveningSlots) > 0)
            <div>
                <h3 class="text-lg font-medium mb-4 text-gray-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Evening Slots
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($this->eveningSlots as $time => $slot)
                        <button wire:click="selectTimeSlot('{{ $time }}')"
                            @if ($slot['disabled']) disabled @endif
                            class="relative p-3 border rounded-lg text-left transition-all duration-200
                                @if ($appointment_time === $time) ring-1 ring-teal-300
                                @elseif ($slot['disabled']) 
                                    bg-gray-50 text-gray-400 cursor-not-allowed
                                @else 
                                    border-gray-200 hover:border-teal-300 hover:bg-teal-50 @endif">
                            <div class="font-medium text-gray-800">
                                {{ $slot['start'] }} - {{ $slot['end'] }}
                            </div>
                            <div class="mt-1 text-sm text-gray-600">
                                @if ($slot['disabled'])
                                    <span class="text-red-500 font-medium">Fully Booked</span>
                                @else
                                    <span class="font-medium @if($slot['remaining_capacity'] < $slot['max_capacity']) text-amber-500 @else text-teal-600 @endif">
                                        {{ $slot['remaining_capacity'] }} of {{ $slot['max_capacity'] }} available
                                    </span>
                                @endif
                            </div>
                            @if ($appointment_time === $time)
                                <div class="absolute top-2 right-2 text-teal-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
                @if ($eveningSlotsFull = collect($this->eveningSlots)->every(fn($slot) => $slot['disabled']))
                    <div class="mt-2 text-sm text-amber-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        All evening slots are fully booked. Please try morning or afternoon slots.
                    </div>
                @endif
            </div>
        @endif

        @if ($appointment_time)
            <div class="mt-6 p-4 bg-teal-50 rounded-lg border border-teal-100">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium text-teal-800">
                        @if ($this->availableSlots[$appointment_time]['remaining_capacity'] === 1)
                            Only 1 spot left in this time slot!
                        @elseif ($this->availableSlots[$appointment_time]['remaining_capacity'] < $this->availableSlots[$appointment_time]['max_capacity'])
                            Only {{ $this->availableSlots[$appointment_time]['remaining_capacity'] }} spots left in this time slot!
                        @else
                            {{ $this->availableSlots[$appointment_time]['remaining_capacity'] }} spots available in this time slot
                        @endif
                    </span>
                </div>
                <p class="mt-2 text-sm text-teal-700">
                    Selected: {{ $this->availableSlots[$appointment_time]['start'] }} - {{ $this->availableSlots[$appointment_time]['end'] }}
                </p>
            </div>
        @endif
    </div>
@endif

    {{-- Step 4 --}}
    @if ($step === 4)
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Name<span
                            class="text-red-500">*</span></label>
                    <input type="text" wire:model.live.blur="newPatient.name"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="John Doe" />
                    @error('newPatient.name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Email<span
                            class="text-red-500">*</span></label>
                    <input type="email" wire:model.live.blur="newPatient.email"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="john@example.com" />
                    @error('newPatient.email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Phone<span
                            class="text-red-500">*</span></label>
                    <input type="tel" wire:model.live.blur="newPatient.phone"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="+1 (555) 123-4567" />
                    @error('newPatient.phone')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Age -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Age<span
                            class="text-red-500">*</span></label>
                    <input type="number" wire:model.live.blur="newPatient.age"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.age') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="30" min="0" />
                    @error('newPatient.age')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-600">Gender<span
                            class="text-red-500">*</span></label>
                    <select wire:model.live.blur="newPatient.gender"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.gender') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('newPatient.gender')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Pincode <span
                            class="text-orange-500">*</span></label>
                    <div class="relative">
                        <input type="text" wire:model.live="pincode" maxlength="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg 
                focus:ring-2 focus:ring-teal-500 focus:border-teal-500 
                transition placeholder-gray-400"
                            placeholder="123456" />
                        <div wire:loading wire:target="pincode"
                            class="absolute inset-y-0 right-3 flex mt-3 items-center">
                            <svg class="animate-spin h-5 w-5 text-orange-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">State <span
                            class="text-orange-500">*</span></label>
                    <input type="text" wire:model.live="newPatient.state" readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 
            text-gray-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 
            transition"
                        placeholder="State will autofill" />
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">District <span
                            class="text-orange-500">*</span></label>
                    <input type="text" wire:model.live="newPatient.district" readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 
            text-gray-700 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 
            transition"
                        placeholder="District will autofill" />
                </div>

                <!-- Address -->
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-600">Address<span
                            class="text-red-500">*</span></label>
                    <textarea wire:model.live.blur="newPatient.address" rows="3"
                        class="w-full px-4 py-3 border {{ $errors->has('newPatient.address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                        placeholder="123 Main St, Apt 4B, City"></textarea>
                    @error('newPatient.address')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    {{-- Step 5 --}}
    @if ($step === 5)
        <div class="space-y-6">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">Payment Method*</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach ($available_payment_methods as $method)
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.live="payment_method" value="{{ $method }}"
                                class="hidden peer" />
                            <div
                                class="p-3 border rounded-lg transition-all duration-200
                                peer-checked:border-teal-500 peer-checked:bg-teal-50 peer-checked:ring-1 peer-checked:ring-teal-500
                                hover:bg-orange-50">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium">{{ $method }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('payment_method')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">Notes</label>
                <textarea wire:model.live="notes" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                    placeholder="Any symptoms, concerns, or special requests..."></textarea>
            </div>
        </div>
    @endif

    {{-- Step 6 --}}
    @if ($step === 6)
        <div class="space-y-6">
            <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-teal-800">Please review your appointment details</h3>
            </div>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Doctor</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                @php $selectedDoctor = $doctors->find($doctor_id); @endphp
                                {{ $selectedDoctor && $selectedDoctor->user ? $selectedDoctor->user->name : 'Not selected' }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Patient</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $newPatient['name'] }} ({{ $newPatient['age'] }} years,
                                {{ ucfirst($newPatient['gender']) }})
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Contact</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $newPatient['email'] }} | {{ $newPatient['phone'] }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $payment_method }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Notes</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $notes ?: 'None provided' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    @endif

    {{-- Navigation --}}
    <div class="mt-8 flex justify-between border-t pt-6">
        @if ($step > 1)
            <button wire:click="previousStep"
                class="px-6 py-3 bg-white border border-orange-300 text-orange-600 rounded-lg hover:bg-orange-50 transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </button>
        @else
            <span></span>
        @endif

        @if ($step < 6)
            <button wire:click="nextStep" wire:loading.attr="disabled"
                class="px-6 py-2.5 bg-teal-600 text-white rounded-md shadow-sm hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                <span>Continue</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span wire:loading wire:target="nextStep" class="ml-2">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        @else
            <button wire:click="submit"
                class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
                Confirm Appointment
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </button>
        @endif

    </div>
</div>
