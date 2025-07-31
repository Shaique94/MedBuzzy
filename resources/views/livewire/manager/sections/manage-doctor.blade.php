<div class="min-h-screen bg-gray-50 p-2 sm:p-4 lg:p-6">
  <!-- Search and Filter Section -->
   <div class="bg-white p-3 sm:p-4 lg:p-6 rounded-lg lg:rounded-xl shadow-sm mb-4 lg:mb-6 mx-1 sm:mx-0">
    <div class="flex flex-col space-y-3 lg:space-y-0 lg:flex-row lg:gap-4 lg:items-center">
      <!-- Search Input -->
      <div class="flex-1 relative w-full">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" wire:model.live.debounce.300ms="search" 
               placeholder="Search doctors by name or email..."
               class="block w-full pl-9 sm:pl-10 pr-3 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
      </div>
      
      <!-- Filters Row -->
      <div class="flex flex-col sm:flex-row gap-2 lg:gap-3 w-full lg:w-auto">
        <!-- Department Filter -->
        <select wire:model.live="departmentFilter" 
                class="border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white flex-1 sm:flex-initial text-sm sm:text-base">
          <option value="">All Departments</option>
          @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
        
        <!-- Reset Button -->
        @if($showReset)
          <button wire:click="resetFilters" 
                  class="text-red-600 hover:text-red-800 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg hover:bg-red-50 transition flex items-center justify-center gap-2 border border-red-200 flex-1 sm:flex-initial text-sm sm:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
            <span class="hidden sm:inline">Reset</span>
          </button>
        @endif
      </div>
    </div>
  </div>

  <!-- Doctors Cards Container -->
  <div class="space-y-3 sm:space-y-4 lg:space-y-6 max-w-6xl mx-auto">
    @forelse($doctors as $doctor)
      <div class="bg-white rounded-lg lg:rounded-xl shadow-sm hover:shadow-md p-4 sm:p-5 lg:p-6 transition duration-300 border border-gray-100 mx-1 sm:mx-0">
        <div class="flex flex-col lg:flex-row lg:items-start gap-4 lg:gap-6">
          <!-- Doctor Image/Initial -->
          <div class="flex justify-center lg:justify-start flex-shrink-0">
            <div class="h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden ring-4 ring-blue-100">
              @if($doctor->image)
                <img src="{{ $doctor->image }}" class="h-full w-full object-cover" alt="{{ $doctor->user->name }}">
              @else
                <span class="text-xl sm:text-2xl lg:text-3xl text-blue-600 font-semibold">{{ substr($doctor->user->name, 0, 1) }}</span>
              @endif
            </div>
          </div>

          <!-- Doctor Info -->
          <div class="flex-1 text-center lg:text-left">
            <!-- Name and Department -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-3 lg:mb-4">
              <div>
                <h3 class="text-lg sm:text-xl lg:text-xl font-bold text-gray-900">{{ $doctor->user->name }}</h3>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                  @if(is_array($doctor->qualification))
                    {{ implode(', ', $doctor->qualification) }}
                  @else
                    {{ $doctor->qualification }}
                  @endif
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-end gap-2 mt-2 lg:mt-0">
                <div class="h-2.5 w-2.5 sm:h-3 sm:w-3 rounded-full bg-green-400"></div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 bg-gray-100 px-2 py-1 rounded-full">{{ $doctor->department->name }}</span>
              </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 text-sm">
              <!-- Specialization -->
              <div class="bg-gray-50 p-3 rounded-lg">
                <p class="text-xs sm:text-sm font-medium text-gray-900 mb-1">Specialization</p>
                <p class="text-xs sm:text-sm text-gray-600">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
              </div>
              
              <!-- Schedule -->
              <div class="bg-blue-50 p-3 rounded-lg">
                <p class="text-xs sm:text-sm font-medium text-gray-900 mb-1">Schedule</p>
                <p class="text-xs sm:text-sm text-gray-600 font-medium">
                  {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                  @if(is_array($doctor->available_days))
                    {{ implode(', ', array_slice($doctor->available_days, 0, 3)) }}
                    @if(count($doctor->available_days) > 3)
                      <span class="text-gray-400">+{{ count($doctor->available_days) - 3 }} more</span>
                    @endif
                  @else
                    {{ $doctor->available_days }}
                  @endif
                </p>
              </div>

              <!-- Contact Info -->
              <div class="bg-green-50 p-3 rounded-lg sm:col-span-2 lg:col-span-1">
                <p class="text-xs sm:text-sm font-medium text-gray-900 mb-2">Contact</p>
                <div class="space-y-1">
                  <div class="flex items-center gap-2">
                    <svg class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-xs sm:text-sm text-gray-600 truncate">{{ $doctor->user->email }}</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <svg class="h-3 w-3 sm:h-4 sm:w-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span class="text-xs sm:text-sm text-gray-600">{{ $doctor->user->phone ?? 'N/A' }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="bg-white rounded-lg lg:rounded-xl shadow-sm p-6 sm:p-8 lg:p-12 text-center mx-1 sm:mx-0">
        <div class="flex flex-col items-center justify-center text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mb-4 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-base sm:text-lg font-medium text-gray-500">No doctors found</h3>
          <p class="mt-1 text-sm text-gray-400">
            @if($search || $departmentFilter)
              Try adjusting your search filters
            @else
              Add your first doctor to get started
            @endif
          </p>
        </div>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($doctors->hasPages())
    <div class="max-w-6xl mx-auto mt-6 lg:mt-8 bg-white rounded-lg lg:rounded-xl shadow-sm p-4 sm:p-6 border border-gray-100 mx-1 sm:mx-0">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div class="text-xs sm:text-sm text-gray-700 text-center sm:text-left">
          Showing <span class="font-medium">{{ $doctors->firstItem() }}</span> to <span class="font-medium">{{ $doctors->lastItem() }}</span> of <span class="font-medium">{{ $doctors->total() }}</span> results
        </div>
        <div class="flex justify-center sm:justify-end">
          {{ $doctors->links() }}
        </div>
      </div>
    </div>
  @endif
</div>