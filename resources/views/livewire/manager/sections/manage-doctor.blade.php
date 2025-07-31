<div class="min-h-screen bg-gray-100 p-6">
  <!-- Search and Filter Section -->
   <div class="bg-white p-4 sm:p-6 rounded-xl shadow-sm mb-6">
    <div class="flex flex-col md:flex-row gap-4 items-center">
      <!-- Search Input -->
      <div class="flex-1 relative w-full">
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
              class="border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white w-full md:w-auto">
        <option value="">All Departments</option>
        @foreach($departments as $department)
          <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
      </select>
      
      <!-- Reset Button -->
      @if($showReset)
        <button wire:click="resetFilters" 
                class="text-red-600 hover:text-red-800 p-2.5 rounded-lg hover:bg-red-100 transition flex items-center gap-1 w-full md:w-auto justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
          Reset
        </button>
      @endif
    </div>
  </div>


  <!-- Doctors Cards -->
  <div class="max-w-6xl mx-auto">
    @forelse($doctors as $doctor)
      <div class="bg-white rounded-xl   p-6  transition duration-300 border border-gray-100">
        <div class="flex flex-col md:flex-row items-start gap-6">
          <!-- Doctor Image/Initial -->
          <div class="flex-shrink-0">
            <div class="h-24 w-24 bg-blue-100 rounded-full flex items-center justify-center overflow-hidden ring-4 ring-blue-100">
              @if($doctor->image)
                <img src="{{ $doctor->image }}" class="h-full w-full object-cover">
              @else
                <span class="text-3xl text-blue-600 font-semibold">{{ substr($doctor->user->name, 0, 1) }}</span>
              @endif
            </div>
          </div>

          <!-- Doctor Info -->
          <div class="flex-1">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $doctor->user->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">
                  @if(is_array($doctor->qualification))
                    {{ implode(', ', $doctor->qualification) }}
                  @else
                    {{ $doctor->qualification }}
                  @endif
                </p>
              </div>
              <div class="flex items-center gap-2">
                <div class="h-3 w-3 rounded-full bg-green-400"></div>
                <span class="text-sm font-medium text-gray-700">{{ $doctor->department->name }}</span>
              </div>
            </div>

            <!-- Specialization and Schedule -->
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-900">Specialization</p>
                <p class="text-sm text-gray-600">{{ $doctor->specialization ?? 'General Practitioner' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-900">Schedule</p>
                <p class="text-sm text-gray-600">
                  {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                </p>
                <p class="text-sm text-gray-500 mt-1">
                  @if(is_array($doctor->available_days))
                    {{ implode(', ', $doctor->available_days) }}
                  @else
                    {{ $doctor->available_days }}
                  @endif
                </p>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="mt-4">
              <p class="text-sm font-medium text-gray-900">Contact</p>
              <div class="flex items-center gap-2 mt-1">
                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm text-gray-600">{{ $doctor->user->email }}</span>
              </div>
              <div class="flex items-center gap-2 mt-1">
                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-sm text-gray-600">{{ $doctor->user->phone ?? 'N/A' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="bg-white rounded-xl shadow-lg p-8 text-center">
        <div class="flex flex-col items-center justify-center text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-lg font-medium text-gray-500">No doctors found</h3>
          <p class="mt-1 text-gray-400">Add your first doctor to get started</p>
        </div>
      </div>
    @endforelse
  </div>

  <!-- Pagination -->
  @if($doctors->hasPages())
    <div class="max-w-4xl mx-auto mt-8 bg-white rounded-xl shadow-lg p-6 border border-gray-100 flex items-center justify-between">
      <div class="text-sm text-gray-700">
        Showing <span class="font-medium">{{ $doctors->firstItem() }}</span> to <span class="font-medium">{{ $doctors->lastItem() }}</span> of <span class="font-medium">{{ $doctors->total() }}</span> results
      </div>
      <div class="flex space-x-2">
        {{ $doctors->links() }}
      </div>
    </div>
  @endif
</div>