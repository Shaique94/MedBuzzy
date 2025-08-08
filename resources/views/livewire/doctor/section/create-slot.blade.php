<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 md:mb-8">
    <!-- Title -->
    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Schedule Management</h2>
    
    <!-- Button - conditionally shown -->
    @if (!$showForm)
        <button wire:click="$toggle('showForm')"
            class="flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg transition duration-200 transform hover:scale-105 w-full sm:w-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ $doctor ? 'Edit Schedule' : 'Create Schedule' }}</span>
        </button>
    @endif
</div>

    @if (session()->has('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($showForm)
        <form wire:submit.prevent="save" class="space-y-6 mb-8 bg-white p-6 rounded-lg shadow">
            <!-- Time Settings -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="time" wire:model="start_time" id="start_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('start_time')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input type="time" wire:model="end_time" id="end_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('end_time')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="slot_duration_minutes" class="block text-sm font-medium text-gray-700 mb-1">Slot
                        Duration (minutes)</label>
                    <select wire:model="slot_duration_minutes" id="slot_duration_minutes"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="15">15 minutes</option>
                        <option value="30">30 minutes</option>
                        <option value="45">45 minutes</option>
                        <option value="60">60 minutes</option>
                    </select>
                    @error('slot_duration_minutes')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="patients_per_slot" class="block text-sm font-medium text-gray-700 mb-1">Patients per
                        Slot</label>
                    <input type="number" wire:model="patients_per_slot" id="patients_per_slot" min="1"
                        max="10"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('patients_per_slot')
                        <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Available Days -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Available Days</label>
                <div class="flex flex-wrap gap-3">
                    @foreach ($daysOfWeek as $day)
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="available_days" value="{{ $day }}"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">{{ $day }}</span>
                        </label>
                    @endforeach
                </div>
                @error('available_days')
                    <span class="mt-1 text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">max_booking_days</label>
                <input type="number" min="1" max="30" wire:model="max_booking_days"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('max_booking_days')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" wire:click="$toggle('showForm')"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Schedule
                </button>
            </div>
        </form>
    @endif

    <!-- Current Schedule -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Current Schedule</h3>
        </div>

        @if ($doctor && $doctor->start_time)
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Working Hours</h4>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} -
                            {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Slot Duration</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $doctor->slot_duration_minutes }} minutes</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Patients per Slot</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $doctor->patients_per_slot }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Available Days</h4>
                        <p class="mt-1 text-sm text-gray-900">
                            @if (is_array($doctor->available_days))
                                {{ implode(', ', $doctor->available_days) }}
                            @else
                                {{ $doctor->available_days ?? 'Not set' }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-500">Max Booking Days</h4>
                        <p class="mt-1 text-sm text-gray-900">{{ $doctor->max_booking_days }}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="px-6 py-4">
                <p class="text-sm text-gray-500">No schedule information available.</p>
            </div>
        @endif
    </div>


</div>
