<div class="space-y-6">
    <!-- Doctor Summary -->
    @if(isset($appointmentData['selected_doctor']))
        <div class="bg-gradient-to-r from-brand-blue-50 to-brand-blue-100 p-5 rounded-xl border border-brand-blue-200">
            <div class="flex flex-col sm:flex-row items-center gap-5">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-white border-4 border-brand-blue-800 shadow-lg">
                    <img src="{{ $appointmentData['selected_doctor']->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($appointmentData['selected_doctor']->user->name) . '&background=random&rounded=true' }}"
                        alt="Dr. {{ $appointmentData['selected_doctor']->user->name }}"
                        class="w-full h-full object-cover">
                </div>
                <div class="text-center sm:text-left">
                    <h3 class="text-xl font-bold text-brand-blue-900">Dr. {{ $appointmentData['selected_doctor']->user->name }}</h3>
                    <p class="text-sm font-medium text-brand-blue-700">{{ $appointmentData['selected_doctor']->department->name }}</p>
                    <div class="mt-2 flex flex-col sm:flex-row gap-2 sm:gap-4 justify-center sm:justify-start">
                        <p class="text-sm text-gray-600">
                            {{ isset($appointmentData['appointment_date']) ? \Carbon\Carbon::parse($appointmentData['appointment_date'])->format('l, F j, Y') : 'Date not selected' }}
                        </p>
                        <p class="text-sm text-brand-blue-600 font-medium">
                            {{ isset($appointmentData['appointment_time']) ? \Carbon\Carbon::createFromFormat('H:i', $appointmentData['appointment_time'])->format('h:i A') : 'Time not selected' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Patient Form -->
    <div class="bg-white p-5 rounded-xl border border-gray-100 md:shadow-sm">
        <h2 class="text-xl font-semibold text-brand-blue-900 mb-5 flex items-center">
            <svg class="h-5 w-5 mr-2 text-brand-blue-800" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
            </svg>
            Patient Information (रोगी जानकारी)
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Name -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Full Name (पूरा नाम) <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.live.debounce.500ms="patient.name"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="John Doe (जॉन डो)">
                @error('patient.name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Email (ईमेल)
                </label>
                <input type="email" wire:model.live.debounce.500ms="patient.email"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="example@email.com">
                @error('patient.email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Phone (फोन) <span class="text-red-500">*</span>
                </label>
                <input type="tel" wire:model.live.debounce.500ms="patient.phone"
                    maxlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.phone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="9876543210">
                @error('patient.phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Age -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Age (आयु) <span class="text-red-500">*</span>
                </label>
                <input type="number" wire:model.live.debounce.500ms="patient.age"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.age') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="30" min="1" max="120"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3);"
                    maxlength="3">
                @error('patient.age')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Gender (लिंग) <span class="text-red-500">*</span>
                </label>
                <select wire:model.live="patient.gender"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.gender') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition">
                    <option value="">Select Gender (लिंग चुनें)</option>
                    <option value="male">Male (पुरुष)</option>
                    <option value="female">Female (महिला)</option>
                    <option value="other">Other (अन्य)</option>
                </select>
                @error('patient.gender')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pincode -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Pincode (पिनकोड) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.500ms="patient.pincode"
                        maxlength="6"
                        class="w-full px-4 py-3 border {{ $errors->has('patient.pincode') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                        placeholder="110001">
                    @if (strlen($patient['pincode']) == 6)
                        <div wire:loading wire:target="patient.pincode"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-brand-blue-500" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                @error('patient.pincode')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- State -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    State (राज्य) <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.live="patient.state"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.state') ? 'border-red-500' : 'border-gray-300' }} rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition {{ !empty($patient['pincode']) && strlen($patient['pincode']) === 6 ? 'bg-gray-50' : '' }}"
                    placeholder="State (राज्य)" 
                    {{ !empty($patient['pincode']) && strlen($patient['pincode']) === 6 ? 'readonly' : '' }}>
                @error('patient.state')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- District -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    District (जिला) <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model.live="patient.district"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.district') ? 'border-red-500' : 'border-gray-300' }} rounded-lg bg-gray-50 text-gray-700 focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition {{ !empty($patient['pincode']) && strlen($patient['pincode']) === 6 ? 'bg-gray-50' : '' }}"
                    placeholder="District (जिला)" 
                    {{ !empty($patient['pincode']) && strlen($patient['pincode']) === 6 ? 'readonly' : '' }}>
                @error('patient.district')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Address (पता) <span class="text-red-500">*</span>
                </label>
                <textarea wire:model.live.debounce.500ms="patient.address" rows="3"
                    class="w-full px-4 py-3 border {{ $errors->has('patient.address') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="House/Flat No., Street, Locality (घर/फ्लैट नंबर, गली, क्षेत्र)"></textarea>
                @error('patient.address')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-600">
                    Additional Notes (अतिरिक्त जानकारी)
                </label>
                <textarea wire:model.live.debounce.500ms="notes" rows="3"
                    class="w-full px-4 py-3 border {{ $errors->has('notes') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition"
                    placeholder="Any symptoms, concerns, or special requests... (कोई लक्षण, चिंताएं या विशेष अनुरोध...)"></textarea>
                @error('notes')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>
