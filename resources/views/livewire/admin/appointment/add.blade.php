<div>
    <div class="min-h-screen p-1 sm:px-0 lg:px-0 bg-gray-50">
        <div class="w-full max-w-none mx-0">
            <!-- Header -->
            <div class="text-center bg-blue-600 rounded-none py-6 w-full">
                <h1 class="text-3xl font-bold text-gray-50">Book an Appointment</h1>
                <p class="mt-2 text-gray-200">Schedule a patient visit with our expert doctors</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white w-full rounded-none border-t border-b border-blue-200">
                <!-- Progress Steps -->
                <div class="bg-blue-50 px-0 py-4 w-full border-b border-blue-100">
                    <div class="flex items-center justify-between max-w-5xl mx-auto flex-nowrap overflow-x-auto scrollbar-hide gap-0 sm:gap-0 px-2 sm:px-0">
                        <!-- Step 1: Doctor Selection -->
                        <div class="flex items-center min-w-0 flex-1">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium {{ $step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                                1
                            </div>
                            <div class="ml-2 min-w-0 flex-1">
                                <p class="text-xs font-medium {{ $step >= 1 ? 'text-blue-600' : 'text-gray-500' }} truncate">Select Doctor</p>
                            </div>
                        </div>

                        <!-- Arrow -->
                        <div class="mx-2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Step 2: Date & Time -->
                        <div class="flex items-center min-w-0 flex-1">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium {{ $step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                                2
                            </div>
                            <div class="ml-2 min-w-0 flex-1">
                                <p class="text-xs font-medium {{ $step >= 2 ? 'text-blue-600' : 'text-gray-500' }} truncate">Date & Time</p>
                            </div>
                        </div>

                        <!-- Arrow -->
                        <div class="mx-2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Step 3: Patient Details -->
                        <div class="flex items-center min-w-0 flex-1">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium {{ $step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                                3
                            </div>
                            <div class="ml-2 min-w-0 flex-1">
                                <p class="text-xs font-medium {{ $step >= 3 ? 'text-blue-600' : 'text-gray-500' }} truncate">Patient Details</p>
                            </div>
                        </div>

                        <!-- Arrow -->
                        <div class="mx-2 text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <!-- Step 4: Confirmation -->
                        <div class="flex items-center min-w-0 flex-1">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium {{ $step >= 4 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                                4
                            </div>
                            <div class="ml-2 min-w-0 flex-1">
                                <p class="text-xs font-medium {{ $step >= 4 ? 'text-blue-600' : 'text-gray-500' }} truncate">Confirmation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step Content -->
                <div class="p-0 sm:p-0 w-full max-w-5xl mx-auto mt-5">
                    <!-- Messages -->
                    @if (session()->has('success'))
                        <div class="mb-4 p-3 sm:p-4 bg-green-100 text-green-700 rounded-lg text-sm sm:text-base mx-4">
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-3 sm:p-4 bg-red-100 text-red-700 rounded-lg text-sm sm:text-base mx-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Step 1: Select Doctor -->
                    @if ($step === 1)
                        <div class="space-y-6 px-4">
                            <!-- Department Filter -->
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Filter by Department
                                </h2>
                                <!-- Department buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" wire:click="$set('selectedDepartment', null)"
                                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                                        {{ !$selectedDepartment ? 'ring-2 ring-blue-500 bg-blue-50 border-blue-200' : 'bg-gradient-to-br from-blue-50 to-blue-100 hover:to-blue-200 hover:shadow-md' }}"
                                        title="Show all specialties">
                                        All Specialties
                                    </button>
                                    @foreach ($departments as $department)
                                        <button type="button" wire:click="$set('selectedDepartment', {{ $department->id }})"
                                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                                            {{ $selectedDepartment === $department->id ? 'ring-2 ring-blue-500 bg-blue-50 border-blue-200' : 'bg-gradient-to-br from-blue-50 to-blue-100 hover:to-blue-200 hover:shadow-md' }}"
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
                                        <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Available Doctors
                                    </span>
                                    @if ($doctor_id)
                                        <span class="text-sm text-green-600 bg-green-100 px-2 py-1 rounded-full">Selected</span>
                                    @endif
                                </h2>

                                @if (count($doctors) > 0)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach ($doctors as $doctor)
                                            <div class="bg-white border-2 rounded-xl p-4 hover:shadow-lg transition-all duration-300 cursor-pointer
                                                {{ $doctor_id === $doctor->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}"
                                                wire:click="selectDoctor({{ $doctor->id }})">
                                                <div class="flex items-start space-x-3">
                                                    @if ($doctor->image)
                                                        <img src="{{ $doctor->image }}" alt="{{ $doctor->user->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-gray-200">
                                                    @else
                                                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg border-2 border-gray-200">
                                                            {{ substr($doctor->user->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <div class="flex-1 min-w-0">
                                                        <h3 class="font-semibold text-gray-900 truncate">Dr. {{ $doctor->user->name }}</h3>
                                                        <p class="text-sm text-blue-600 font-medium truncate">{{ $doctor->department->name ?? 'General' }}</p>
                                                        <div class="mt-2 space-y-1">
                                                            <div class="flex items-center text-xs text-gray-600">
                                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"></path>
                                                                </svg>
                                                                Fee: ₹{{ number_format($doctor->fee ?? 0) }}
                                                            </div>
                                                            @if ($doctor->experience)
                                                                <div class="flex items-center text-xs text-gray-600">
                                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    {{ $doctor->experience }} years exp.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900">No doctors available</h3>
                                        <p class="mt-2 text-gray-500">Try selecting a different department or check back later.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-end pt-6">
                                <button wire:click="nextStep" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled"
                                    @if(!$doctor_id) disabled @endif>
                                    <span wire:loading.remove>Continue</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Step 2: Date & Time -->
                    @if ($step === 2)
                        <div class="space-y-6 px-4">
                            @if ($selectedDoctor)
                                <!-- Doctor Summary -->
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                    <div class="flex items-center space-x-3">
                                        @if ($selectedDoctor->image)
                                            <img src="{{ $selectedDoctor->image }}" alt="{{ $selectedDoctor->user->name }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                                {{ substr($selectedDoctor->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-semibold text-gray-900">Dr. {{ $selectedDoctor->user->name }}</h3>
                                            <p class="text-sm text-blue-600">{{ $selectedDoctor->department->name ?? 'General' }}</p>
                                            <p class="text-sm text-gray-600">Fee: ₹{{ number_format($selectedDoctor->fee ?? 0) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Date Selection -->
                            <div>
                                <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4">Select Date</h3>
                                <input wire:model.live="appointment_date" type="date" 
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    min="{{ date('Y-m-d') }}">
                            </div>

                            <!-- Time Selection -->
                            @if ($appointment_date)
                                <div>
                                    <h3 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4">Available Time Slots</h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                        @foreach ($time_slots as $slot)
                                            <button wire:click="selectTimeSlot('{{ $slot['key'] }}')"
                                                class="p-3 border-2 rounded-lg text-sm font-medium transition-all duration-200
                                                {{ $appointment_time === $slot['start'] ? 'border-blue-500 bg-blue-50 text-blue-700' : 'border-gray-200 hover:border-blue-300 hover:bg-blue-50' }}
                                                {{ $slot['disabled'] ? 'opacity-50 cursor-not-allowed bg-gray-100' : 'cursor-pointer' }}"
                                                @if($slot['disabled']) disabled @endif>
                                                {{ $slot['start'] }} - {{ $slot['end'] }}<br><span class="text-xs text-gray-500">{{ $slot['tooltip'] }}</span>
                                            </button>
                                        @endforeach
                                    </div>
                                    @if (empty($time_slots))
                                        <p class="text-sm text-red-500">No available time slots for the selected date.</p>
                                    @endif
                                </div>
                            @endif

                            <!-- Navigation -->
                            <div class="flex justify-between pt-6">
                                <button wire:click="previousStep" 
                                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                                    Back
                                </button>
                                <button wire:click="nextStep" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled" 
                                    @if(!$appointment_date || !$appointment_time) disabled @endif>
                                    <span wire:loading.remove>Continue</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Step 3: Patient Details -->
                    @if ($step === 3)
                        <div class="space-y-6 px-4">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Patient Details</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Name *</label>
                                    <input wire:model="newPatient.name" type="text" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter patient name">
                                    @error('newPatient.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Email</label>
                                    <input wire:model="newPatient.email" type="email" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter email (optional)">
                                    @error('newPatient.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Phone *</label>
                                    <input wire:model="newPatient.phone" type="tel" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter phone number" 
                                        maxlength="10" 
                                        pattern="[0-9]{10}" 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0,10)">
                                    @error('newPatient.phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    @if (session()->has('phone_exists'))
                                        <div class="mt-1 text-sm text-yellow-600 bg-yellow-50 p-2 rounded">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            {{ session('phone_exists') }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Gender *</label>
                                    <select wire:model="newPatient.gender" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('newPatient.gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Age *</label>
                                    <input wire:model="newPatient.age" type="number" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter age" min="0" max="150">
                                    @error('newPatient.age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">PIN Code *</label>
                                    <input wire:model.live.debounce.500ms="newPatient.pincode" type="text" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter PIN code (6 digits)" maxlength="6">
                                    @if ($pincode_loading)
                                        <span class="text-sm text-gray-500">Loading location...</span>
                                    @endif
                                    @error('newPatient.pincode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">District</label>
                                    <input wire:model="newPatient.district" type="text" 
                                        class="mt-1 w-full p-2 border rounded-lg bg-gray-100" 
                                        placeholder="District" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">State</label>
                                    <input wire:model="newPatient.state" type="text" 
                                        class="mt-1 w-full p-2 border rounded-lg bg-gray-100" 
                                        placeholder="State" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Country</label>
                                    <input wire:model="newPatient.country" type="text" 
                                        class="mt-1 w-full p-2 border rounded-lg bg-gray-100" 
                                        placeholder="Country" readonly>
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-sm sm:text-base font-medium text-gray-700">Address (Optional)</label>
                                    <textarea wire:model="newPatient.address" 
                                        class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                        placeholder="Enter complete address (optional)" rows="3"></textarea>
                                    @error('newPatient.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between pt-6">
                                <button wire:click="previousStep" 
                                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                                    Back
                                </button>
                                <button wire:click="nextStep" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled"
                                    @if(!$newPatient['name'] || !$newPatient['phone'] || !$newPatient['age'] || !$newPatient['gender'] || !$newPatient['pincode']) disabled @endif>
                                    <span wire:loading.remove>Continue</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Step 4: Payment Options -->
                    @if ($step === 4)
                        <div class="space-y-6 px-4">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-700">Payment Options</h3>
                            
                            <!-- Appointment Summary -->
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                                <h4 class="font-semibold text-gray-800 mb-3">Appointment Summary</h4>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>Doctor:</span>
                                        <span class="font-medium">Dr. {{ $selectedDoctor->user->name ?? '' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Department:</span>
                                        <span class="font-medium">{{ $selectedDoctor->department->name ?? 'General' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Date:</span>
                                        <span class="font-medium">{{ $appointment_date ? \Carbon\Carbon::parse($appointment_date)->format('d M Y') : '' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Time:</span>
                                        <span class="font-medium">{{ $appointment_time ?? '' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Patient:</span>
                                        <span class="font-medium">{{ $newPatient['name'] ?? '' }}</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="flex justify-between text-lg font-bold border-t pt-2">
                                        <span>Total Payment:</span>
                                        <span class="text-green-600">₹50</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Fixed amount for admin bookings</p>
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-800">Payment Method</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input wire:model="payment_method" type="radio" value="cash" 
                                            class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                        <label class="ml-2 text-sm sm:text-base text-gray-700">Cash</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input wire:model="payment_method" type="radio" value="card" 
                                            class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                        <label class="ml-2 text-sm sm:text-base text-gray-700">Card</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input wire:model="payment_method" type="radio" value="upi" 
                                            class="h-4 w-4 text-blue-600 focus:ring-2 focus:ring-blue-500">
                                        <label class="ml-2 text-sm sm:text-base text-gray-700">UPI</label>
                                    </div>
                                </div>
                                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <label class="block text-sm sm:text-base font-medium text-gray-700">Additional Notes</label>
                                <textarea wire:model="notes" 
                                    class="mt-1 w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" 
                                    placeholder="Add any notes (optional)" rows="3"></textarea>
                            </div>

                            <!-- Navigation -->
                            <div class="flex justify-between pt-6">
                                <button wire:click="previousStep" 
                                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                                    Back
                                </button>
                                <button wire:click="save" 
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:loading.attr="disabled"
                                    @if(!$payment_method) disabled @endif>
                                    <span wire:loading.remove>Confirm Appointment</span>
                                    <span wire:loading>Booking...</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Phone number exists message -->
    @if (session()->has('phone_exists'))
        <div class="fixed top-20 right-4 z-50 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded max-w-md">
            <strong class="font-bold">Info:</strong>
            <span class="block sm:inline">{{ session('phone_exists') }}</span>
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.fixed.top-20').style.display = 'none';
            }, 5000);
        </script>
    @endif

    <!-- Razorpay Script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('razorpay:open', (data) => {
                console.log('Razorpay event received:', data);
                
                if (!data || !data[0]) {
                    console.error('Invalid data received for Razorpay');
                    return;
                }
                
                const options = {
                    key: data[0].key,
                    amount: data[0].amount,
                    currency: 'INR',
                    name: 'MedBuzzy',
                    description: 'Appointment Booking',
                    order_id: data[0].orderId,
                    handler: function(response) {
                        console.log('Payment successful:', response);
                        // Payment successful
                        Livewire.dispatch('payment-success', [
                            response.razorpay_payment_id,
                            data
                        ]);
                    },
                    prefill: {
                        name: data[0].patientData.name,
                        email: data[0].patientData.email,
                        contact: data[0].patientData.phone
                    },
                    modal: {
                        ondismiss: function() {
                            console.log('Payment cancelled by user');
                            // Payment cancelled
                            Livewire.dispatch('payment-failed', {
                                error: 'Payment cancelled by user'
                            });
                        }
                    },
                    theme: {
                        color: "#2563eb"
                    }
                };
                
                console.log('Opening Razorpay with options:', options);
                
                try {
                    const rzp = new Razorpay(options);
                    rzp.open();
                } catch (error) {
                    console.error('Error opening Razorpay:', error);
                    Livewire.dispatch('payment-failed', {
                        error: 'Failed to open payment gateway: ' + error.message
                    });
                }
            });
        });
    </script>
</div>