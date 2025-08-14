<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-brand-blue-600">Hello, {{ $user->name }}!</h2>
                <p class="text-gray-600 mt-1">Here's your appointment summary</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('appointment') }}" class="bg-brand-orange-500 hover:bg-brand-orange-600 text-white px-4 py-2 rounded-lg inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Book New
                </a>
            </div>
        </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-calendar-day text-brand-blue-500 mr-2"></i>
                Upcoming Appointments
            </h3>
        </div>
        
        @if($upcomingAppointments->isEmpty())
            <div class="p-6 text-center text-gray-500">
                <i class="fas fa-calendar-times text-3xl mb-2"></i>
                <p>No upcoming appointments</p>
            </div>
        @else
            <div class="divide-y divide-gray-200">
                @foreach($upcomingAppointments as $appointment)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="mb-3 md:mb-0">
                                <h4 class="font-medium text-gray-900">
                                    Dr. {{ $appointment->doctor->user->name }}
                                    <span class="text-sm text-gray-500 ml-2">{{ $appointment->doctor->department->name }}</span>
                                </h4>
                                <div class="flex items-center mt-1 text-sm">
                                    <i class="fas fa-clock text-brand-blue-500 mr-1.5"></i>
                                    <span>{{ $appointment->appointment_date->format('D, M j, Y') }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $appointment->appointment_time->format('h:i A') }}</span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="#" class="text-sm bg-brand-blue-50 text-brand-blue-600 px-3 py-1 rounded-lg">
                                    <i class="fas fa-eye mr-1"></i> Details
                                </a>
                                <button wire:click="cancelAppointment({{ $appointment->id }})" class="text-sm bg-red-50 text-red-600 px-3 py-1 rounded-lg">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Past Appointments -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-history text-gray-500 mr-2"></i>
                Recent History
            </h3>
        </div>
        
        @if($pastAppointments->isEmpty())
            <div class="p-6 text-center text-gray-500">
                <p>No past appointments found</p>
            </div>
        @else
            <div class="divide-y divide-gray-200">
                @foreach($pastAppointments as $appointment)
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium">{{ $appointment->doctor->user->name }}</h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $appointment->appointment_date->format('M j, Y') }} • 
                                    {{ $appointment->status }}
                                </p>
                            </div>
                            <a href="#" class="text-sm text-brand-blue-500 hover:underline">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>