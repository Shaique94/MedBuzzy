<div>
    <!-- Appointments Content -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">My Appointments</h1>
            <a href="{{ route('our-doctors') }}" class="bg-brand-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> New Appointment
            </a>
        </div>
        
        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="flex space-x-8">
                <button wire:click="$set('activeTab', 'upcoming')" 
                        class="py-4 px-1 text-sm font-medium {{ $activeTab === 'upcoming' ? 'tab-active text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                    Upcoming Appointments
                </button>
                <button wire:click="$set('activeTab', 'past')" 
                        class="py-4 px-1 text-sm font-medium {{ $activeTab === 'past' ? 'tab-active text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                    Past Appointments
                </button>
                <button wire:click="$set('activeTab', 'cancelled')" 
                        class="py-4 px-1 text-sm font-medium {{ $activeTab === 'cancelled' ? 'tab-active text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                    Cancelled
                </button>
            </nav>
        </div>
        
        <!-- Upcoming Appointments -->
        @if($activeTab === 'upcoming')
        <div class="space-y-4">
            {{-- @forelse($upcomingAppointments as $appointment) --}}
            @forelse($upcomingAppointments as $appointment)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-start space-x-4">
                        <img src="{{ $appointment->doctor->image }}" 
                     class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold text-gray-800">Dr. {{ $appointment->doctor->user->name }}</h3>
                            <p class="text-gray-600">{{ $appointment->doctor->specialty }}</p>
                            <div class="flex items-center mt-1 text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                               <span>{{ $appointment->appointment_date->format('D, M j, Y') }}</span>
                                <i class="fas fa-clock ml-4 mr-2"></i>
                               <span>{{ $appointment->appointment_time }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2 mt-4 md:mt-0">
                     <span class="px-3 py-1 {{ in_array($appointment->status, ['confirmed', 'scheduled']) ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full text-sm flex items-center">
    <i class="fas {{ in_array($appointment->status, ['confirmed', 'scheduled']) ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i> 
    {{ ucfirst($appointment->status) }}
</span>
                      @if(in_array($appointment->status, ['confirmed', 'pending', 'scheduled']))
  <button wire:click="cancelAppointment({{ $appointment->id }})"
                                           class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm flex items-center">
    <i class="fas fa-times mr-1"></i> Cancel
                                        </button>
@endif
                        {{-- <button wire:click="viewDetails({{ $appointment->id }})" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm flex items-center">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </button> --}}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-500">No upcoming appointments</h3>
                <p class="text-gray-400 mt-1">Schedule your first appointment to get started</p>
            </div>
            @endforelse
        </div>
        @endif
        
        <!-- Past Appointments -->
        @if($activeTab === 'past')
        <div class="space-y-4">
            @forelse($pastAppointments as $appointment)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-start space-x-4">
                          <img src="{{ $appointment->doctor->image }}" 
                     class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold text-gray-800">Dr. {{ $appointment->doctor->user->name }}</h3>
                            <p class="text-gray-600">{{ $appointment->doctor->specialty }}</p>
                            <div class="flex items-center mt-1 text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                              <span>{{ $appointment->appointment_date->format('D, M j, Y') }}</span>
                                <i class="fas fa-clock ml-4 mr-2"></i>
                               <span>{{ $appointment->appointment_time }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2 mt-4 md:mt-0">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm flex items-center">
                            <i class="fas fa-check-circle mr-1"></i> Completed
                        </span>
                         <button wire:click="deleteAppointment({{ $appointment->id }})" 
       class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm flex items-center">
        <i class="fas fa-trash mr-1"></i> Delete
    </button>
                        {{-- <button wire:click="viewDetails({{ $appointment->id }})" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm flex items-center">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </button> --}}
                        {{-- @if(!$appointment->has_rating)
                        <button wire:click="rateAppointment({{ $appointment->id }})" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm flex items-center">
                            <i class="fas fa-star mr-1"></i> Rate
                        </button>
                        @endif --}}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <i class="fas fa-calendar-check text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-500">No past appointments</h3>
                <p class="text-gray-400 mt-1">Your appointment history will appear here</p>
            </div>
            @endforelse
        </div>
        @endif
        
        <!-- Cancelled Appointments -->
        @if($activeTab === 'cancelled')
        <div class="space-y-4">
            @forelse($cancelledAppointments as $appointment)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-start space-x-4">
                      <img src="{{ $appointment->doctor->image }}" 
                     class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-semibold text-gray-800">Dr. {{ $appointment->doctor->user->name }}</h3>
                            <p class="text-gray-600">{{ $appointment->doctor->specialty }}</p>
                            <div class="flex items-center mt-1 text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                              <span>{{ $appointment->appointment_date->format('D, M j, Y') }}</span>
                                <i class="fas fa-clock ml-4 mr-2"></i>
                               <span>{{ $appointment->appointment_time }}</span>
                            </div>
                            @if($appointment->cancellation_reason)
                            <div class="mt-2 text-sm text-red-600">
                                <i class="fas fa-info-circle mr-1"></i> {{ $appointment->cancellation_reason }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2 mt-4 md:mt-0">
                        <button wire:click="deleteAppointment({{ $appointment->id }})" 
       class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm flex items-center">
        <i class="fas fa-trash mr-1"></i> Delete
    </button>
                        {{-- <button wire:click="viewDetails({{ $appointment->id }})" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm flex items-center">
                            <i class="fas fa-eye mr-1"></i> View Details
                        </button> --}}
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-500">No cancelled appointments</h3>
                <p class="text-gray-400 mt-1">You haven't cancelled any appointments yet</p>
            </div>
            @endforelse
        </div>
        @endif
    </div>

  <!-- Appointment Detail Modal -->
@if($showDetailModal)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Appointment Details</h3>
            <button wire:click="$set('showDetailModal', false)" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6">
            @if($selectedAppointment)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Doctor Information</h4>
                    <div class="flex items-center space-x-4 mb-4">
                        <img src="{{ $selectedAppointment->doctor->profile_image ?? 'https://via.placeholder.com/80x80/3B82F6/FFFFFF?text=DR' }}" 
                             alt="Doctor" class="w-16 h-16 rounded-full object-cover">
                        <div>
                            <p class="font-semibold">Dr. {{ $selectedAppointment->doctor->user->name }}</p>
                            <p class="text-gray-600">{{ $selectedAppointment->doctor->specialty }}</p>
                            <p class="text-sm text-gray-500">{{ $selectedAppointment->doctor->hospital }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Appointment Details</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <!-- FIXED: Changed date to appointment_date -->
                            <span class="font-medium">{{ $selectedAppointment->appointment_date->format('l, F j, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Time:</span>
                            <!-- FIXED: Changed time to appointment_time -->
                            <span class="font-medium">{{ $selectedAppointment->appointment_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="px-2 py-1 rounded-full text-xs font-medium 
                                {{ $selectedAppointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $selectedAppointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $selectedAppointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $selectedAppointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($selectedAppointment->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Appointment ID:</span>
                            <span class="font-medium">#{{ $selectedAppointment->id }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="font-medium text-gray-700 mb-2">Additional Information</h4>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">
                        {{ $selectedAppointment->notes ?? 'No additional notes provided for this appointment.' }}
                    </p>
                </div>
            </div>
            @endif
        </div>
        <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
            <button wire:click="$set('showDetailModal', false)" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Close
            </button>
            @if($selectedAppointment && ($selectedAppointment->status === 'confirmed' || $selectedAppointment->status === 'pending'))
            <button wire:click="cancelAppointment({{ $selectedAppointment->id }})" class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200">
                Cancel Appointment
            </button>
            @endif
        </div>
    </div>
</div>
@endif
</div>
