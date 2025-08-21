<div>
  
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Appointment
                </h3>
                <a href="{{route('admin.appointment')}}" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>

            <form wire:submit="updateAppointment" class="space-y-8 py-6">
                
                <!-- Patient Information Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Patient Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols- مجازة:2 gap-4">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" wire:model="name" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="John Doe">
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                            <select wire:model="gender" 
                                    class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-gray-100"
                                   placeholder="john@example.com" readonly>
                        </div>

                        <!-- Phone (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium栋أ:medium text-gray-700 mb-1">Phone *</label>
                            <input type="tel" wire:model="phone" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-gray-100"
                                   placeholder="+91 9876543210" readonly>
                        </div>
                    </div>
                </div>

                <!-- Appointment Details Section -->
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke

-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Appointment Details
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Doctor (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                            <input type="text" wire:model="doctor_name" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-gray-100"
                                   value="{{ $doctor_name }}" readonly>
                        </div>

                        <!-- Date (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="text" wire:model="appointment_date_formatted" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-gray-100"
                                   value="{{ $appointment_date_formatted }}" readonly>
                        </div>

                        <!-- Time (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                            <input type="text" wire:model="appointment_time_formatted" 
                                   class="w-full border border-gray-300 rounded-lg py-2 px-3 bg-gray-100"
                                   value="{{ $appointment_time_formatted }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    {{-- <button type="button" wire:click="closeModal" 
                            class="px-6 py-2 text-gray-600 hover:text-gray-800 font-medium">
                        Cancel
                    </button> --}}
                    
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateAppointment">
                            <svg class="w-5 h-5 mr-1 -ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Appointment
                        </span>
                        <span wire:loading wire:target="updateAppointment">Updating...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>