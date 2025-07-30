 <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
     <div class="container mx-auto px-4 py-6">
         <!-- Stats Cards -->
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
             <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                 <div class="flex items-center">
                     <div class="bg-blue-100 p-3 rounded-lg">
                         <i class="bi bi-calendar-check-fill fs-3 text-blue-600 text-xl"></i>
                     </div>
                     <div class="ml-4">
                         <h3 class="text-2xl font-bold text-gray-800">{{ $appointmentsCount }}</h3>
                         <p class="text-gray-600"> Appointments</p>
                     </div>
                 </div>
             </div>
             <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                 <div class="flex items-center">
                     <div class="bg-green-100 p-3 rounded-lg">
                         <i class="bi bi-people-fill fs-3 text-green-600 text-xl"></i>
                     </div>
                     <div class="ml-4">
                         <h3 class="text-2xl font-bold text-gray-800">{{ $patientsCount }}</h3>
                         <p class="text-gray-600">Patients</p>
                     </div>
                 </div>
             </div>
             <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                 <div class="flex items-center">
                     <div class="bg-amber-100 p-3 rounded-lg">
                         <i class="bi bi-heart-pulse-fill fs-3 text-amber-600 text-xl"></i>
                     </div>
                     <div class="ml-4">
                         <h3 class="text-2xl font-bold text-gray-800">{{ $doctorsCount }}</h3>
                         <p class="text-gray-600">Doctors</p>
                     </div>

                 </div>
             </div>

             <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-amber-500">
                 <div class="flex items-center">
                     <div class="bg-amber-100 p-3 rounded-lg">
                         <i class="bi bi-currency-rupee fs-3 text-amber-600 text-xl"></i>
                     </div>
                     <div class="ml-4">
                         <h3 class="text-2xl font-bold text-gray-800">32</h3>
                         <p class="text-gray-600">Revenue</p>
                     </div>

                 </div>
             </div>

         </div>

         <!-- Upcoming Appointments -->
         <div class="bg-white rounded-xl shadow-md p-6 mb-8">
             <div class="flex justify-between items-center mb-6">
                 <h2 class="text-lg font-bold text-gray-800">Upcoming Appointments</h2>
                 <a href="#" class="text-blue-600 text-sm font-medium hover:underline">View All</a>
             </div>
             <div class="overflow-x-auto">
                 <table class="w-full">
                     <thead class="text-left text-gray-500 border-b">
                         <tr>
                             <th class="pb-3 font-medium">Patient</th>
                             <th class="pb-3 font-medium">Doctor</th>
                             <th class="pb-3 font-medium">Date</th>
                             <th class="pb-3 font-medium">Time</th>
                             <th class="pb-3 font-medium">Status</th>
                             <th class="pb-3 font-medium">Actions</th>
                         </tr>
                     </thead>
                     <tbody class="divide-y">

                         @forelse ($appointments as $appointment)
                             <tr>
                                 <td class="py-4">
                                     <div class="flex items-center">
                                         <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80"
                                             class="w-10 h-10 rounded-full object-cover mr-3">
                                         <div>
                                             <p class="font-medium text-gray-800">{{ $appointment->patient->name }}</p>
                                             <p class="text-sm text-gray-600">ID: {{ $appointment->patient->id }}</p>
                                         </div>
                                     </div>
                                 </td>
                                 <td class="py-4">
                                     <p class="font-medium text-gray-800">{{ $appointment->doctor->user->name }}</p>
                                 </td>
                                 <td class="py-4">
                                     <p class="font-medium text-gray-800">{{ $appointment->date . now() }}</p>
                                 </td>
                                 <td class="py-4">
                                     <p class="font-medium">
                                         {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}
                                     </p>
                                     <p class="text-sm text-gray-600">
                                         {{ \Carbon\Carbon::parse($appointment->appointment_date)->isToday() ? 'Today' : \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                                     </p>
                                 </td>

                                 <td class="py-4">
                                     <span
                                         class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Confirmed</span>
                                 </td>
                                 <td class="py-4">
                                     <div class="flex space-x-1 sm:space-x-2">
                                         <!-- Button to trigger modal -->
                                         <button
                                             class="text-blue-600 hover:text-blue-900 p-2 rounded-full hover:bg-blue-50"
                                             wire:click="$dispatch('openModal', {id: {{ $appointment->patient->id }} })"
                                             title="View Details">
                                             <i class="fas fa-eye"></i>
                                         </button>

                                         <!-- Modal -->
                                         <livewire:admin.appointment.view-details />
                                         <a href="{{ route('admin.update.appointment', $appointment->id) }}"
                                             class="text-teal-500 p-1 sm:p-2 rounded-lg hover:bg-yellow-50 transition"
                                             title="Edit">
                                             <svg class="w-6 h-6 text-gray-800 text-teal-500" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 fill="none" viewBox="0 0 24 24">
                                                 <path stroke="currentColor" stroke-linecap="round"
                                                     stroke-linejoin="round" stroke-width="2"
                                                     d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                             </svg>
                                         </a>

                                         <a href="{{ route('appointment.receipt', ['appointment' => $appointment->id]) }}"
                                             class="text-gray-500 hover:text-gray-700 p-1 sm:p-2 rounded-lg hover:bg-gray-50 transition"
                                             title="Print Receipt">
                                             <i class="fas fa-print text-sm sm:text-base"></i>
                                         </a>
                                     </div>
                                 </td>
                             </tr>
                         @empty
                             <tr>
                                 <td>No appointments found.</td>
                             </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </main>
