<div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
        <div class="container mx-auto px-4 py-6 max-w-7xl">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-brand-blue-600">Welcome back, {{ $user->name }}!
                        </h1>
                        <p class="text-gray-600 mt-1">Here's your health dashboard overview</p>
                    </div>
                    <div class="mt-4 md:mt-0 flex items-center space-x-3">
                        <div class="text-center bg-white rounded-xl px-4 py-3 shadow-sm border border-gray-100">
                            <div class="text-lg font-bold text-brand-blue-600" x-data="{ time: '' }"
                                x-init="time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
                                setInterval(() => time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }), 1000)" x-text="time">
                                --:-- --
                            </div>
                            <div class="text-xs text-gray-500">Current Time</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Dashboard Summary -->
                <div
                    class="stats-card  bg-white rounded-lg p-6 border border-gray-100 hover:border-brand-blue-200 transition-all duration-300 group relative overflow-hidden shadow-xs hover:shadow-md">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-brand-blue-50/30 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider ">Health Overview</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['total_appointments'] }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Total medical visits</p>
                        </div>
                        <div
                            class="p-3 rounded-lg bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition-colors shadow-inner">
                            <i class="fas fa-tachometer-alt text-xl"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-blue-100 group-hover:bg-blue-300 transition-colors">
                    </div>
                </div>

                <!-- My Appointments -->
                <div
                    class="stats-card bg-white rounded-lg p-6 border border-gray-100 hover:border-green-200 transition-all duration-300 group relative overflow-hidden shadow-xs hover:shadow-md">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-green-600 uppercase tracking-wider">My Appointments</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['upcoming'] }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Upcoming visits</p>
                        </div>
                        <div
                            class="p-3 rounded-lg bg-green-50 text-green-600 group-hover:bg-green-100 transition-colors shadow-inner">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-green-100 group-hover:bg-green-300 transition-colors">
                    </div>
                </div>

                <!-- Profile Activity -->
                <div
                    class="stats-card bg-white rounded-lg p-6 border border-gray-100 hover:border-amber-200 transition-all duration-300 group relative overflow-hidden shadow-xs hover:shadow-md">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-amber-50/30 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Profile Activity
                            </p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['doctors'] }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Care specialists</p>
                        </div>
                        <div
                            class="p-3 rounded-lg bg-amber-50 text-amber-600 group-hover:bg-amber-100 transition-colors shadow-inner">
                            <i class="fas fa-user-edit text-xl"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-amber-100 group-hover:bg-amber-300 transition-colors">
                    </div>
                </div>

                <!-- Prescriptions -->
                <div
                    class="stats-card bg-white rounded-lg p-6 border border-gray-100 hover:border-purple-200 transition-all duration-300 group relative overflow-hidden shadow-xs hover:shadow-md">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-purple-600 uppercase tracking-wider">Prescriptions</p>
                            <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['departments'] }}</h3>
                            <p class="text-xs text-gray-500 mt-1">Medical departments</p>
                        </div>
                        <div
                            class="p-3 rounded-lg bg-purple-50 text-purple-600 group-hover:bg-purple-100 transition-colors shadow-inner">
                            <i class="fas fa-prescription text-xl"></i>
                        </div>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 right-0 h-1 bg-purple-100 group-hover:bg-purple-300 transition-colors">
                    </div>
                </div>
            </div>

            <style>
                .stats-card {
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    transform: translateY(0);
                }

                .stats-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                }

                .stats-card h3 {
                    position: relative;
                    display: inline-block;
                }

                .stats-card h3::after {
                    content: '';
                    position: absolute;
                    bottom: -2px;
                    left: 0;
                    width: 0;
                    height: 2px;
                    background: currentColor;
                    transition: width 0.4s ease;
                }

                .stats-card:hover h3::after {
                    width: 100%;
                }
            </style>


            <!-- Upcoming Appointments -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                <div class="p-5 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold flex items-center">
                            <i class="fas fa-calendar-day text-brand-blue-500 mr-2"></i>
                            Upcoming Appointments
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">Your scheduled visits with doctors</p>
                    </div>
                    <div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $upcomingAppointments->count() }} Scheduled
                        </span>
                        <a href="{{ route('our-doctors') }}"
                            class="ml-3 text-sm px-2 py-1 bg-brand-blue-600 hover:bg-brand-blue-800 text-white rounded-lg">
                            <i class="fas fa-plus mr-1"></i> New
                        </a>
                    </div>
                </div>

                @if ($upcomingAppointments->isEmpty())
                    <div class="p-8 text-center">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand-blue-50 text-brand-blue-600 mb-4">
                            <i class="fas fa-calendar-times text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-700">No upcoming appointments</h4>
                        <p class="text-gray-500 mb-4">You don't have any scheduled visits yet</p>
                        <a href="{{ route('our-doctors') }}"
                            class="inline-flex items-center px-4 py-2 bg-brand-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-plus mr-2"></i> Book Appointment
                        </a>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach ($upcomingAppointments as $appointment)
                            <div class="p-5 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                        <div
                                            class="flex-shrink-0 h-12 w-12 rounded-lg bg-brand-blue-100 flex items-center justify-center text-brand-blue-600">
                                            <i class="fas fa-user-md text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">
                                                Dr. {{ $appointment->doctor->user->name }}
                                                <span
                                                    class="text-sm text-gray-500 ml-2">{{ $appointment->doctor->department->name }}</span>
                                            </h4>
                                            <div class="flex flex-wrap items-center mt-2 text-sm text-gray-600 gap-y-1">
                                                <div class="flex items-center mr-4">
                                                    <i class="fas fa-calendar-alt mr-2 text-brand-blue-500"></i>
                                                 {{ \Carbon\Carbon::parse($appointment->appointment_date)->timezone('Asia/Kolkata')->format('D, M j, Y') }}
                                                </div>
                                                <div class="flex items-center mr-4">
                                                    <i class="fas fa-clock mr-2 text-green-500"></i>
                                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->timezone('Asia/Kolkata')->format('h:i A') }}
                                                </div>
                                                @if ($appointment->reason)
                                                    <div class="flex items-center">
                                                        <i class="fas fa-comment-medical mr-2 text-amber-500"></i>
                                                        {{ $appointment->reason }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        {{-- <button
                                            class="text-sm bg-brand-blue-50 text-brand-blue-600 px-4 py-2 rounded-lg hover:bg-brand-blue-100 transition-colors flex items-center">
                                            <i class="fas fa-eye mr-2"></i> Details
                                        </button> --}}
                                        <button wire:click="cancelAppointment({{ $appointment->id }})"
                                            class="text-sm bg-red-50 text-red-600 px-4 py-2 rounded-lg hover:bg-red-100 transition-colors flex items-center">
                                            <i class="fas fa-times mr-2"></i> Cancel
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
                <div class="p-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-history text-gray-500 mr-2"></i>
                        Recent Appointments
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Your past medical visits</p>
                </div>

                @if ($pastAppointments->isEmpty())
                    <div class="p-8 text-center">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 text-gray-600 mb-4">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-700">No past appointments</h4>
                        <p class="text-gray-500">Your appointment history will appear here</p>
                    </div>
                @else
                    <div class="divide-y divide-gray-100">
                       @foreach ($pastAppointments as $appointment)
<div class="p-5 hover:bg-gray-50 transition-colors" x-data="{ expanded: false }">
    <div class="flex items-center justify-between cursor-pointer" @click="expanded = !expanded">
        <!-- Basic Info -->
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600">
                <i class="fas fa-user-md"></i>
            </div>
            <div>
                <h4 class="font-medium text-gray-900">
                    Dr. {{ $appointment->doctor->user->name }}
                </h4>
                <div class="flex items-center mt-1 text-sm text-gray-500">
                    <i class="fas fa-calendar-day mr-2"></i>
                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M j, Y') }}
                </div>
            </div>
        </div>
        <!-- Toggle Button -->
        <button class="text-gray-400 hover:text-brand-blue-600 transition-transform" 
                :class="{ 'rotate-90': expanded }">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Expandable Content -->
    <div x-show="expanded" x-collapse class="mt-3 pl-14 space-y-2 text-sm">
        <div class="flex items-center">
            <i class="fas fa-building mr-2 text-blue-500 w-5"></i>
            <span class="text-gray-600">Department:</span>
            <span class="ml-2">{{ $appointment->doctor->department->name }}</span>
        </div>
        <div class="flex items-center">
            <i class="fas fa-envelope mr-2 text-blue-500 w-5"></i>
            <span class="text-gray-600">Email:</span>
            <span class="ml-2">{{ $appointment->doctor->user->email }}</span>
        </div>
        @if($appointment->reason)
        <div class="flex items-start">
            <i class="fas fa-comment-medical mr-2 text-amber-500 w-5 mt-1"></i>
            <div>
                <span class="text-gray-600">Reason:</span>
                <p class="ml-2">{{ $appointment->reason }}</p>
            </div>
        </div>
        @endif
        <!-- Add more fields as needed -->
    </div>
</div>
@endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>