<div class="p-6 max-w-4xl mx-auto bg-white rounded-xl shadow-lg">
    {{-- Step Progress --}}
    <div class="flex items-center justify-between mb-8">
        @foreach ([1, 2, 3, 4] as $i)
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
                    @elseif($i === 2)
                        Patient
                    @elseif($i === 3)
                        Payment
                    @else
                        Confirm
                    @endif
                </div>
            </div>
            @if ($i < 4)
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
        @elseif($step === 2)
            Patient Information
        @elseif($step === 3)
            Payment Details
        @else
            Confirm Appointment
        @endif
    </h2>

    {{-- Step 1 --}}
    @if ($step === 1)
        <div class="space-y-6">
            <div class="relative">
                <input type="text" wire:model.live="doctorSearch" placeholder="Search doctors..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" />
                <div class="absolute right-3 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($doctors as $doctor)
                    @if ($doctor && $doctor->user)
                        <div wire:click="$set('doctor_id', {{ $doctor->id }})"
                            class="cursor-pointer p-5 border rounded-xl shadow-sm transition-all duration-300
                                {{ $doctor_id == $doctor->id ? 'ring-2 ring-teal-500 bg-teal-50 transform scale-[1.02]' : 'hover:bg-orange-50 hover:shadow-md' }}">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold">
                                        {{ substr($doctor->user->name, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-bold text-gray-800 truncate">{{ $doctor->user->name }}</h4>
                                    <p class="text-sm text-teal-600 font-medium">
                                        {{ $doctor->qualification ?? 'General Practitioner' }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ $doctor->specialization ?? 'MD' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-2 text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-3 text-lg font-medium text-gray-600">No doctors found</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    {{-- Step 2 --}}
    @if ($step === 2)
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
                        <p class="mt-1 text-xs text-red-600">{{ $message}}</p>
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
                        <p class="mt-1 text-xs text-red-600">{{ $message}}</p>
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
                        <p class="mt-1 text-xs text-red-600">{{ $message}}</p>
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
                        <p class="mt-1 text-xs text-red-600">{{ $message}}</p>
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
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
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
                        <p class="mt-1 text-xs text-red-600">{{ $message}}</p>
                    @enderror
                </div>
            </div>
        </div>
    @endif

    {{-- Step 3 --}}
    @if ($step === 3)
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

    {{-- Step 4 --}}
    @if ($step === 4)
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

        @if ($step < 4)
            <button wire:click="nextStep"
                class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition flex items-center">
                Continue
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
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
