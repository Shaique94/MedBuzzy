<div class="print-content"> 
<div class="py-3 sm:py-4 lg:py-6 px-2 sm:px-4 lg:px-8 max-w-5xl mx-auto">
    <!-- Header with print button -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 lg:mb-8 px-1 space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">Patient Details</h1>
            @if($patient->active)
                <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                    Active
                </span>
            @endif
        </div>
        
        @if($latestAppointment)
            <a wire:navigate href="{{ route('appointment.receipt', ['appointment' => $latestAppointment->id]) }}"
               class="flex items-center justify-center sm:justify-start space-x-2 px-3 sm:px-4 py-2 sm:py-3 bg-white border border-blue-200 rounded-lg shadow-sm hover:bg-blue-50 transition-colors text-sm sm:text-base"
               title="Print Receipt">
               <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span class="font-medium text-blue-700">
                    <span class="hidden sm:inline">Print Receipt</span>
                    <span class="sm:hidden">Print</span>
                </span>
            </a>
        @endif
    </div>

    <!-- Patient details card -->
    <div class="bg-white shadow-sm rounded-lg lg:rounded-xl overflow-hidden mb-4 sm:mb-6 print:shadow-none">
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg sm:text-xl font-medium text-gray-900 capitalize">{{ $patient->name }}</h2>
            <p class="text-xs sm:text-sm text-gray-500">Patient ID: {{ $patient->id }}</p>
        </div>
        
        <div class="px-4 sm:px-6 py-4 sm:py-6">
            <!-- Mobile: Stack layout -->
            <div class="block sm:hidden space-y-6">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-base font-medium text-gray-700 mb-3 pb-2 border-b border-gray-200">Personal Information</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Age/Gender:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->age }} years / {{ ucfirst($patient->gender) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Phone:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->user->phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Email:</span>
                            <span class="text-gray-800 text-sm font-medium break-all">{{ $patient->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Address Information -->
                <div>
                    <h3 class="text-base font-medium text-gray-700 mb-3 pb-2 border-b border-gray-200">Address Information</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-500 text-sm block">Address:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->address }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">Pincode:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->pincode ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">District:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->district ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 text-sm">State/Country:</span>
                            <span class="text-gray-800 text-sm font-medium">{{ $patient->state ?? 'N/A' }}, {{ $patient->country ?? 'India' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Desktop: Grid layout -->
            <div class="hidden sm:grid sm:grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4 pb-2 border-b border-gray-200">Personal Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Age/Gender:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->age }} years / {{ ucfirst($patient->gender) }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Phone:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->user->phone }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Email:</span>
                            <span class="text-gray-800 font-medium break-all">{{ $patient->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Address Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4 pb-2 border-b border-gray-200">Address Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="text-gray-500 w-32">Address:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->address }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">Pincode:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->pincode ?? 'N/A' }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">District:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->district ?? 'N/A' }}</span>
                        </div>
                        <div class="flex">
                            <span class="text-gray-500 w-32">State/Country:</span>
                            <span class="text-gray-800 font-medium">{{ $patient->state ?? 'N/A' }}, {{ $patient->country ?? 'India' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action buttons -->
    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-between items-start sm:items-center bg-white px-4 sm:px-6 py-3 sm:py-4 shadow-sm rounded-lg lg:rounded-xl print:hidden mb-6">
        <div class="flex items-center space-x-2 text-xs sm:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-gray-500">Created: {{ $patient->created_at->format('d M Y, h:i A') }}</span>
        </div>
        
        <div class="flex space-x-2 sm:space-x-3 w-full sm:w-auto">
            <a wire:navigate href=""
               class="flex-1 sm:flex-initial flex items-center justify-center space-x-2 px-3 sm:px-4 py-2 sm:py-3 bg-white border border-blue-200 rounded-lg shadow-sm hover:bg-blue-50 transition-colors text-sm"
               title="Edit Patient">
               <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="font-medium text-blue-700">
                    <span class="hidden sm:inline">Edit Patient</span>
                    <span class="sm:hidden">Edit</span>
                </span>
            </a>
        </div>
    </div>

    <!-- Appointments/Transactions section -->
    <div class="mt-8">
        <h2 class="text-lg font-medium text-gray-900 mb-4">Recent Appointments</h2>
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fee
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($appointments as $appointment)
                        <tr>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    @if($appointment->appointment_date && $appointment->appointment_time)
        {{ \Carbon\Carbon::parse($appointment->appointment_date->format('Y-m-d').' '.$appointment->appointment_time)->format('d M Y, h:i A') }}
    @else
        N/A
    @endif
</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                Dr {{ $appointment->doctor->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                       ($appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($appointment->payment)
        ₹{{ number_format($appointment->payment->amount, 2) }}
    @else
        ₹0.00
    @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
<button 
    wire:click="$dispatch('openModal', { 
        component: 'fee-collection-modal', 
        arguments: { 
            patientId: {{ $patient->id }},
            appointmentId: {{ $appointment->id ?? 'null' }}
        }
    })"   class="relative inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 
                       text-white text-sm font-medium rounded-lg shadow hover:shadow-md 
                       transition-all duration-200 ease-in-out hover:from-green-600 hover:to-green-700
                       focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75
                       active:scale-95 transform"
            >
    <span class="inline-flex items-center group">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-4 w-4 mr-1.5 transition-transform duration-200 group-hover:scale-110" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="relative">
                        Collect Fee
                    </span>
                </span>
</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Print-specific styles -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .print-content, .print-content * {
            visibility: visible;
        }
        .print-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none;
        }
    }
</style>
</div>