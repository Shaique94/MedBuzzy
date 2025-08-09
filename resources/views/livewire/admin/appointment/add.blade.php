<div class="min-h-screen bg-gray-100 py-4 px-2 sm:px-4 md:px-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-4 py-3 sm:px-6 sm:py-4 flex justify-between items-center text-white">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h2 class="text-lg sm:text-xl font-bold">Book Appointment</h2>
            </div>
            <a wire:navigate href="{{ route('admin.appointment') }}" class="focus:outline-none focus:ring-2 focus:ring-white rounded-full" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>

        <!-- Progress Bar -->
        <div class="bg-gray-200 h-2 flex">
            <div class="bg-blue-600 h-full transition-all duration-300" style="width: {{ $step * 25 }}%"></div>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6 md:p-8">
            @if (session()->has('success'))
                <div class="mb-4 p-3 sm:p-4 bg-green-100 text-green-700 rounded-lg text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-3 sm:p-4 bg-red-100 text-red-700 rounded-lg text-sm sm:text-base">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Step 1: Select Doctor -->
            @if ($step === 1)
                <div class="space-y-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Select a Doctor</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($doctors as $doctor)
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg border hover:border-blue-500 transition cursor-pointer"
                                wire:click="selectDoctor({{ $doctor->id }})"
                                @if($selected_doctor_id === $doctor->id) style="border-color: #3b82f6;" @endif>
                                <div class="flex items-center space-x-3">
                                    @if ($doctor->image)
                                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->user->name }}'s profile" class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm sm:text-base font-medium text-gray-900">{{ $doctor->user->name }}</h4>
                                        <p class="text-xs sm:text-sm text-gray-500">{{ $doctor->department->name ?? 'No Department' }}</p>
                                        <p class="text-xs sm:text-sm text-gray-500">Fee: ₹{{ number_format($doctor->fee, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button wire:click="nextStep" class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition disabled:opacity-50" wire:loading.attr="disabled" :disabled="empty($doctors)">
                        Next
                    </button>
                </div>
            @endif

            <!-- Step 2: Choose Date & Time -->
            @if ($step === 2)
                <div class="space-y-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Choose Date & Time</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Select Date</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-1">
                                @foreach ($available_dates as $date)
                                    <button wire:click="setAppointmentDate('{{ $date['date'] }}')"
                                        class="p-2 bg-gray-50 rounded-lg text-sm sm:text-base hover:bg-gray-100 transition {{ $appointment_date === $date['date'] ? 'bg-blue-100 border-blue-500' : '' }}"
                                        :disabled="empty($available_dates)">
                                        {{ $date['formatted'] }}<br><span class="text-xs text-gray-500">{{ $date['day'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Select Time</label>
                            <div class="mt-1 space-y-2">
                                <div class="flex space-x-2">
                                    <button wire:click="active_time_tab = 'morning'" class="{{ $active_time_tab === 'morning' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 rounded-lg text-sm sm:text-base transition">Morning</button>
                                    <button wire:click="active_time_tab = 'afternoon'" class="{{ $active_time_tab === 'afternoon' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 rounded-lg text-sm sm:text-base transition">Afternoon</button>
                                    <button wire:click="active_time_tab = 'evening'" class="{{ $active_time_tab === 'evening' ? 'bg-blue-600 text-white' : 'bg-gray-200' }} px-3 py-1 rounded-lg text-sm sm:text-base transition">Evening</button>
                                </div>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                    @foreach ($time_slots as $slot)
                                        @if (strtolower($slot['period']) === $active_time_tab && !$slot['disabled'])
                                            <button wire:click="selectTimeSlot('{{ $slot['time_value'] }}')"
                                                class="p-2 bg-gray-50 rounded-lg text-sm sm:text-base hover:bg-gray-100 transition {{ $appointment_time === $slot['time_value'] ? 'bg-blue-100 border-blue-500' : '' }}"
                                                :disabled="$slot['disabled']">
                                                {{ $slot['start'] }} - {{ $slot['end'] }}<br><span class="text-xs text-gray-500">{{ $slot['tooltip'] }}</span>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                                @if (empty($time_slots))
                                    <p class="text-sm text-red-500">No available time slots for the selected date.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button wire:click="previousStep" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">Back</button>
                        <button wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled" :disabled="!$appointment_date || !$appointment_time">
                            Next
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 3: Enter Patient Details -->
            @if ($step === 3)
                <div class="space-y-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Patient Details</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Name</label>
                            <input wire:model="name" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter patient name">
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Email</label>
                            <input wire:model="email" type="email" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter email (optional)">
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Phone</label>
                            <input wire:model="phone" type="tel" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter phone number">
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Gender</label>
                            <select wire:model="gender" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Address</label>
                            <input wire:model="address" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter address (optional)">
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">PIN Code</label>
                            <input wire:model="pincode" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter PIN code (6 digits)" maxlength="6" wire:loading.class="bg-gray-200" wire:target="pincode">
                            @if ($pincode_loading)
                                <span class="text-sm text-gray-500">Loading...</span>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">District</label>
                            <input wire:model="district" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="District" readonly>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">State</label>
                            <input wire:model="state" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="State" readonly>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Country</label>
                            <input wire:model="country" type="text" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Country" readonly>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Age</label>
                            <input wire:model="age" type="number" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter age (optional)" min="0" max="150">
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <button wire:click="previousStep" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">Back</button>
                        <button wire:click="nextStep" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled" :disabled="!$name || !$phone">
                            Next
                        </button>
                    </div>
                </div>
            @endif

            <!-- Step 4: Payment Options -->
            @if ($step === 4)
                <div class="space-y-6">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Payment Options</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input wire:model="payment_method" type="radio" value="pay_later" class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                            <label class="ml-2 text-sm sm:text-base text-gray-700">Pay Later</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="payment_method" type="radio" value="cash" class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                            <label class="ml-2 text-sm sm:text-base text-gray-700">Cash</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="payment_method" type="radio" value="card" class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                            <label class="ml-2 text-sm sm:text-base text-gray-700">Card</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="payment_method" type="radio" value="upi" class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                            <label class="ml-2 text-sm sm:text-base text-gray-700">UPI</label>
                        </div>
                        <div>
                            <label class="block text-sm sm:text-base font-medium text-gray-700">Notes</label>
                            <textarea wire:model="notes" class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Add any notes (optional)" rows="3"></textarea>
                        </div>
                        <p class="text-sm sm:text-base text-gray-600">Booking Fee: ₹{{ $booking_fee }} | Doctor Fee: ₹{{ $doctor_fee }} | Total: ₹{{ $booking_fee + $doctor_fee }}</p>
                    </div>
                    <div class="flex justify-between">
                        <button wire:click="previousStep" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition">Back</button>
                        <button wire:click="createOrder" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled" :disabled="!$payment_method">
                            Confirm Booking
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>