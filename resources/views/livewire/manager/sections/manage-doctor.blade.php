<div class="min-h-screen bg-gray-50 p-6">
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 rounded-xl shadow-md mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <div>
        <h1 class="text-3xl font-bold text-white">Doctor Management</h1>
        <p class="text-blue-100 mt-2">Manage all doctors in your healthcare system</p>
      </div>
      
       <div class="flex items-center space-x-4">
            <div class="hidden md:block h-12 w-0.5 bg-blue-400/50"></div>
            
            <div class="flex items-center space-x-2 text-blue-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                {{-- <span class="font-medium">{{ $doctorCount }} Doctors</span> --}}
            </div>
        </div>
    </div>
  </div>

    <!-- Search and Filter Section -->
  <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
    <div class="flex flex-col md:flex-row gap-4 items-center">
      <!-- Search Input -->
      <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" wire:model.live.debounce.300ms="search" 
               placeholder="Search doctors by name or email..."
               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>
      
      <!-- Department Filter -->
      <select wire:model.live="departmentFilter" 
              class="border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
        <option value="">All Departments</option>
        @foreach($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
      
      <!-- Reset Button (shows when either search or filter is active) -->
      @if($showReset)
        <button wire:click="resetFilters" 
                class="text-red-600 hover:text-red-800 p-2.5 rounded-lg hover:bg-red-100 transition flex items-center gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
          Reset
        </button>
      @endif
    </div>
  </div>


  
  <!-- Doctors Table -->
  <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($doctors as $doctor)
            <tr class="hover:bg-blue-50 transition duration-150">
              <!-- Doctor Column -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden">
                    @if($doctor->image)
                      <img src="{{ $doctor->image }}" class="h-full w-full object-cover">
                    @else
                      <span class="text-blue-600 font-medium">{{ substr($doctor->user->name, 0, 1) }}</span>
                    @endif
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-semibold text-gray-900">{{ $doctor->user->name }}</div>
                    <div class="text-xs text-gray-500">
                      @if(is_array($doctor->qualification))
                        {{ implode(', ', $doctor->qualification) }}
                      @else
                        {{ $doctor->qualification }} 
                      @endif
                    </div>
                  </div>
                </div>
              </td>
              
              <!-- Department Column -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="h-2 w-2 rounded-full bg-green-400 mr-2"></div>
                  <span class="text-sm font-medium text-gray-900">{{ $doctor->department->name }}</span>
                </div>
                <div class="text-xs text-gray-500 mt-1">
                  {{ $doctor->specialization ?? 'General Practitioner' }}
                </div>
              </td>
              
              <!-- Schedule Column -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                  {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                </div>
                <div class="text-xs text-gray-500 mt-1">
                  @if(is_array($doctor->available_days))
                    {{ implode(', ', $doctor->available_days) }}
                  @else
                    {{ $doctor->available_days }} 
                  @endif
                </div>
              </td>
              
              <!-- Contact Column -->
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900 flex items-center">
                  <svg class="h-4 w-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  {{ $doctor->user->email }}
                </div>
                <div class="text-sm text-gray-500 mt-1 flex items-center">
                  <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  {{ $doctor->user->phone ?? 'N/A' }}
                </div>
              </td>
              
              <!-- Actions Column -->
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-2">
                  <button class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                  </button>
                  <button class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-12 text-center">
                <div class="flex flex-col items-center justify-center text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <h3 class="text-lg font-medium text-gray-500">No doctors found</h3>
                  <p class="mt-1 text-gray-400">Add your first doctor to get started</p>
                  <button wire:click="$set('showModal', true)" class="mt-4 text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Doctor
                  </button>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    @if($doctors->hasPages())
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
      <div class="text-sm text-gray-700">
        Showing <span class="font-medium">{{ $doctors->firstItem() }}</span> to <span class="font-medium">{{ $doctors->lastItem() }}</span> of <span class="font-medium">{{ $doctors->total() }}</span> results
      </div>
      <div class="flex space-x-2">
        {{ $doctors->links() }}
      </div>
    </div>
    @endif
  </div>
</div>