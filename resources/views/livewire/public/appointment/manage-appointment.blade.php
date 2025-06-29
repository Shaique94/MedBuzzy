<div class="p-6 max-w-4xl mx-auto bg-white rounded-xl shadow-lg">
    {{-- Step Progress --}}
    <div class="flex items-center justify-between mb-8">
        @foreach([1,2,3,4] as $i)
            <div class="flex-1 flex flex-col items-center">
                <div class="w-8 h-8 flex items-center justify-center rounded-full
                    {{ $step >= $i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}
                    font-bold mb-1">
                    {{ $i }}
                </div>
                <div class="text-xs font-semibold {{ $step === $i ? 'text-blue-600' : 'text-gray-400' }}">
                    @if($i === 1) Doctor
                    @elseif($i === 2) Patient
                    @elseif($i === 3) Payment
                    @else Confirm
                    @endif
                </div>
            </div>
            @if($i < 4)
                <div class="flex-1 h-1 {{ $step > $i ? 'bg-blue-600' : 'bg-gray-200' }}"></div>
            @endif
        @endforeach
    </div>

    {{-- Step Heading --}}
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Step {{ $step }} of 4</h2>

    {{-- Step 1: Choose Doctor --}}
    @if($step === 1)
        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-800">Choose a Doctor</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($doctors as $doctor)
                    @if($doctor && $doctor->user)
                        <div
                            wire:click="$set('doctor_id', {{ $doctor->id }})"
                            class="cursor-pointer p-5 border rounded-xl shadow-sm transition
                                {{ $doctor_id == $doctor->id ? 'ring-2 ring-blue-500 bg-blue-50' : 'hover:bg-blue-50' }}"
                        >
                            <h4 class="text-lg font-bold text-blue-700">{{ $doctor->user->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $doctor->qualification ?? 'General' }}</p>
                        </div>
                    @endif
                @empty
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        No doctors available.
                    </div>
                @endforelse
                {{-- If all doctors are filtered out due to missing user, show empty message --}}
                @if($doctors->count() === 0 || $doctors->filter(fn($d) => $d && $d->user)->count() === 0)
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        No doctors available.
                    </div>
                @endif
            </div>

           
        </div>
    @endif

    {{-- Step 2: Patient Info --}}
    @if($step === 2)
        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-800">Enter Patient Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Name</label>
                    <input type="text" wire:model.defer="newPatient.name" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Email</label>
                    <input type="email" wire:model.defer="newPatient.email" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Phone</label>
                    <input type="text" wire:model.defer="newPatient.phone" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Age</label>
                    <input type="number" wire:model.defer="newPatient.age" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Gender</label>
                    <select wire:model.defer="newPatient.gender" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-600">Pincode</label>
                    <input type="text" wire:model.defer="newPatient.pincode" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-1 text-sm font-medium text-gray-600">Address</label>
                    <input type="text" wire:model.defer="newPatient.address" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200" />
                </div>
            </div>
        </div>
    @endif

    {{-- Step 3: Payment and Notes --}}
    @if($step === 3)
        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-800">Payment & Notes</h3>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Payment Method</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($available_payment_methods as $method)
                        <label class="cursor-pointer">
                            <input type="radio" wire:model.defer="payment_method" value="{{ $method }}" class="hidden peer">
                            <span class="peer-checked:bg-blue-600 peer-checked:text-white border border-gray-300 bg-gray-50 rounded-lg px-4 py-2 text-gray-700 font-medium transition hover:bg-blue-100 uppercase">
                                {{ $method }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('payment_method') <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-600">Notes</label>
                <textarea wire:model.defer="notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-200"></textarea>
            </div>
        </div>
    @endif

    {{-- Step 4: Confirmation --}}
    @if($step === 4)
        <div class="space-y-4">
            <h3 class="text-xl font-semibold text-gray-800">Confirm Appointment</h3>
            <div class="bg-gray-100 rounded-xl p-4 space-y-2">
                @php
                    $selectedDoctor = $doctors->find($doctor_id);
                @endphp
                <p>
                    <strong>Doctor:</strong>
                    <span class="text-blue-700">
                        {{-- Safely check for doctor and user --}}
                        @if($selectedDoctor && $selectedDoctor->user)
                            {{ $selectedDoctor->user->name }}
                        @else
                            N/A
                        @endif
                    </span>
                </p>
                <p><strong>Patient:</strong> <span class="text-blue-700">{{ $newPatient['name'] }}</span> ({{ $newPatient['phone'] }})</p>
                <p><strong>Payment Method:</strong> <span class="text-blue-700">
                    {{$payment_method ?: 'Not specified' }}
                </span></p>
                <p><strong>Notes:</strong> <span class="text-blue-700">{{ $notes ?: 'None' }}</span></p>
                <p><strong>Time:</strong> <span class="text-blue-700">{{ now()->format('Y-m-d H:i') }}</span></p>
            </div>
            <div class="text-green-600 font-medium">
                This appointment will be scheduled immediately upon confirmation.
            </div>
        </div>
    @endif

    {{-- Navigation Buttons --}}
    <div class="mt-8 flex justify-between">
        @if($step > 1)
            <button wire:click="previousStep" class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Back</button>
        @else
            <span></span>
        @endif

        @if($step < 4)
            <button wire:click="nextStep" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Next</button>
        @else
            <button wire:click="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Confirm Appointment</button>
        @endif
    </div>
</div>

