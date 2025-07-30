<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="border-b px-6 py-4 flex justify-between items-center bg-blue-600 text-white rounded-t-lg">
                    <h3 class="text-xl font-semibold">Edit Doctor Details</h3>
                    <button wire:click="closeModal" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="saveDoctor" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information Column -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-medium text-gray-800 border-b pb-2">Personal Information</h4>

                        <!-- Profile Image -->
                        <div class="flex flex-col items-center">
                            @if ($newImage)
                                <img src="{{ $newImage->temporaryUrl() }}" class="w-32 h-32 rounded-full object-cover mb-3 border-2 border-gray-200">
                            @elseif ($image)
                                <img src="{{ $image }}" class="w-32 h-32 rounded-full object-cover mb-3 border-2 border-gray-200">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-100 flex items-center justify-center mb-3 border-2 border-gray-200">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <input type="file" wire:model="newImage" id="upload-{{ $imageTimestamp }}" class="hidden" accept="image/*">
                            <label for="upload-{{ $imageTimestamp }}" class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 cursor-pointer text-sm font-medium transition-colors">
                                Change Photo
                            </label>
                            @error('newImage')
                                <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name*</label>
                            <input wire:model.live="name" type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="Enter full name">
                            @error('name')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input wire:model.live="phone" type="tel" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="Enter phone number">
                            @error('phone')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1">Qualifications*</label>
                            <input wire:model.live="qualificationInput" type="text" id="qualification" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="e.g., MBBS, MD, PhD">
                            <p class="text-xs text-gray-500 mt-1">Enter multiple qualifications separated by commas</p>
                            @error('qualification')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                            <select wire:model.live="department_id" id="department_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                <option value="">Select Department</option>
                                @foreach (\App\Models\Department::all() as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Professional Information Column -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-medium text-gray-800 border-b pb-2">Professional Information</h4>

                        <div>
                            <label for="fee" class="block text-sm font-medium text-gray-700 mb-1">Consultation Fee*</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500">$</span>
                                <input wire:model.live="fee" type="number" id="fee" min="0" step="1" class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="500">
                                @error('fee')
                                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="patients_per_slot" class="block text-sm font-medium text-gray-700 mb-1">Patients per Slot*</label>
                            <input wire:model.live="patients_per_slot" type="number" id="patients_per_slot" min="1" max="10" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="Enter patients per slot">
                            @error('patients_per_slot')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="max_booking_days" class="block text-sm font-medium text-gray-700 mb-1">Max Booking Days*</label>
                            <input wire:model.live="max_booking_days" type="number" id="max_booking_days" min="1" max="30" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="Enter max booking days">
                            @error('max_booking_days')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                            <select wire:model.live="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <input wire:model.live="slug" type="text" id="slug" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" placeholder="e.g., dr-john-doe">
                            @error('slug')
                                <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Availability Section (Full width) -->
                    <div class="md:col-span-2 space-y-6">
                        <h4 class="text-lg font-medium text-gray-800 border-b pb-2">Availability</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Available Days -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Available Days*</label>
                                <div class="flex flex-wrap gap-4">
                                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                        <label class="inline-flex items-center">
                                            <input
                                                type="checkbox"
                                                wire:model.live="available_days"
                                                value="{{ $day }}"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 h-5 w-5"
                                                {{ in_array($day, $available_days ?? []) ? 'checked' : '' }}
                                            >
                                            <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('available_days')
                                    <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time*</label>
                                    <input wire:model.live="start_time" type="time" id="start_time" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                    @error('start_time')
                                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time*</label>
                                    <input wire:model.live="end_time" type="time" id="end_time" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                    @error('end_time')
                                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="slot_duration_minutes" class="block text-sm font-medium text-gray-700 mb-1">Slot Duration (min)*</label>
                                    <select wire:model.live="slot_duration_minutes" id="slot_duration_minutes" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                        <option value="15">15 minutes</option>
                                        <option value="30">30 minutes</option>
                                        <option value="45">45 minutes</option>
                                        <option value="60">60 minutes</option>
                                    </select>
                                    @error('slot_duration_minutes')
                                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="md:col-span-2 flex justify-end space-x-4 pt-6 border-t">
                        <button type="button" wire:click="closeModal" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>