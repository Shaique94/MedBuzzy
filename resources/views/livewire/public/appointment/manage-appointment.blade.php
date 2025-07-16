<div class="p-6 max-w-4xl mx-auto bg-white rounded-xl shadow-lg">

    {{-- Step Progress --}}
    <div class="flex items-center justify-between mb-8">
        @foreach ([1, 2, 3, 4 ,5,6] as $i)
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
                Doctor
                @elseif ($i === 3)
                Doctor
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
    Select Your Doctor
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <div class="flex justify-between text-sm text-balance items-center mt-6">
            <a wire:navigate href=""
                class="inline-flex items-center text-teal-600 hover:underline text-md mt-1 md:mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Check your appointment.
            </a>


        </div>
    </div>
@endif
    @if($step ===2)
    <!-- Appointment Calendar -->
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <h2 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-teal-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Choose Appointment Date
        </h2>

        <div class="grid grid-cols-7 gap-2 text-center text-sm text-gray-600">
            @php
            $today = now();
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth();
            $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 (Sun) - 6 (Sat)
            $daysInMonth = $today->daysInMonth;
            @endphp

            <!-- Weekday Headers -->
            @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
            <div class="font-semibold text-gray-700">{{ $day }}</div>
            @endforeach

            <!-- Empty boxes before 1st -->
            @for ($i = 0; $i < $startDayOfWeek; $i++)
                <div>
        </div>
        @endfor

        <!-- Days -->
        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
            $date=$today->copy()->startOfMonth()->addDays($day - 1)->format('Y-m-d');
            @endphp
            <button wire:click="$set('appointment_date', '{{ $date }}')"
                class="w-full aspect-square rounded-md border text-gray-800 hover:bg-teal-100
                {{ $appointment_date === $date ? 'bg-teal-600 text-white font-bold' : 'bg-gray-50' }}">
                {{ $day }}
            </button>
            @endfor
    </div>

    @if ($appointment_date)
    <div class="mt-4 text-sm text-teal-700 font-medium">
        Selected Date: {{ \Carbon\Carbon::parse($appointment_date)->format('D, d M Y') }}
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