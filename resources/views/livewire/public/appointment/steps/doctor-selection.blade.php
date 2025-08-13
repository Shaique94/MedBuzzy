<div>
    <!-- Filter & Search Section -->
    <div class="mb-6 space-y-4">
        <!-- Search and Filter Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="searchQuery" 
                    class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 text-sm"
                    placeholder="Search by doctor name or specialty...">
                @if($searchQuery)
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" wire:click="$set('searchQuery', '')" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <div class="hidden sm:block">
                    <button type="button" wire:click="toggleViewType" class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        @if($viewType === 'grid')
                            <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        @endif
                    </button>
                </div>
                <button type="button" wire:click="toggleFilter" class="p-2 border border-gray-300 rounded-lg hover:bg-gray-50 sm:hidden">
                    <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
                <div class="relative inline-block">
                    <select wire:model.live="sortBy" class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 text-sm">
                        <option value="recommended">Recommended</option>
                        <option value="rating">Top Rated</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="experience">Most Experienced</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Filter -->
        <div x-data="{ open: @entangle('isFilterOpen') }" x-show="open" x-transition.opacity.duration.200ms class="sm:hidden">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h4 class="font-medium text-gray-700 mb-2">Filter by Department</h4>
                <div class="flex flex-wrap gap-2">
                    <button type="button" wire:click="$set('selectedDepartment', null)"
                        class="px-3 py-1.5 text-xs rounded-lg font-medium transition-all duration-200
                            {{ !$selectedDepartment ? 'bg-brand-blue-800 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                        All Specialties
                    </button>
                    @foreach ($departments as $department)
                        <button type="button" wire:click="$set('selectedDepartment', {{ $department->id }})"
                            class="px-3 py-1.5 text-xs rounded-lg font-medium transition-all duration-200
                                {{ $selectedDepartment === $department->id ? 'bg-brand-blue-800 text-white' : 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-50' }}">
                            {{ $department->name }}
                        </button>
                    @endforeach
                </div>
                @if($selectedDepartment || $searchQuery)
                    <div class="mt-3 flex justify-end">
                        <button type="button" wire:click="clearFilters" class="text-xs text-brand-blue-600 hover:underline">
                            Clear Filters
                        </button>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Desktop Filter -->
        <div class="hidden sm:block">
            <div class="bg-gradient-to-r from-brand-blue-50 to-brand-blue-100 p-4 rounded-xl border border-brand-blue-200">
                <h4 class="font-medium text-brand-blue-800 mb-3">Filter by Department</h4>
                <div class="flex flex-wrap gap-2">
                    <button type="button" wire:click="$set('selectedDepartment', null)"
                        class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                            {{ !$selectedDepartment ? 'ring-2 ring-brand-blue-800 bg-brand-blue-50 border-brand-blue-200' : 'bg-gradient-to-br from-brand-blue-50 to-brand-yellow-50 hover:to-brand-yellow-100 hover:shadow-md' }}">
                        All Specialties
                    </button>
                    @foreach ($departments as $department)
                        <button type="button" wire:click="$set('selectedDepartment', {{ $department->id }})"
                            class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300
                                {{ $selectedDepartment === $department->id ? 'ring-2 ring-brand-blue-800 bg-brand-blue-50 border-brand-blue-200' : 'bg-gradient-to-br from-brand-blue-50 to-brand-yellow-50 hover:to-brand-yellow-100 hover:shadow-md' }}">
                            {{ $department->name }}
                        </button>
                    @endforeach
                </div>
                @if($selectedDepartment || $searchQuery)
                    <div class="mt-3 flex justify-end">
                        <button type="button" wire:click="clearFilters" class="text-sm text-brand-blue-600 hover:underline flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear Filters
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Results Header -->
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-800">
            {{ $doctors->total() }} {{ $doctors->total() === 1 ? 'Doctor' : 'Doctors' }} Found
            @if($selectedDepartment)
                @php
                    $deptName = $departments->where('id', $selectedDepartment)->first()->name ?? '';
                @endphp
                <span class="text-brand-blue-600">in {{ $deptName }}</span>
            @endif
        </h2>
        <div class="text-sm text-gray-500">
            Page {{ $doctors->currentPage() }} of {{ $doctors->lastPage() }}
        </div>
    </div>

    <!-- Doctor Cards - Grid View -->
    @if($viewType === 'grid')
        @if($doctors->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($doctors as $doctor)
                    <div wire:key="doctor-card-{{ $doctor->id }}" wire:click="selectDoctor({{ $doctor->id }})"
                        class="relative flex flex-col h-full border rounded-xl overflow-hidden cursor-pointer transition-all duration-300 hover:shadow-md
                        {{ $doctorId == $doctor->id ? 'ring-2 ring-brand-blue-800 bg-brand-blue-50 border-brand-blue-200' : 'border-gray-200 hover:border-brand-blue-300' }}">
                        <div class="bg-gradient-to-br from-brand-blue-50 to-brand-yellow-50 p-4">
                            <!-- Doctor Header -->
                            <div class="flex items-center mb-3">
                                <div class="relative">
                                    <div class="w-16 h-16 rounded-full overflow-hidden bg-white border-4 border-white shadow">
                                        <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                            alt="Dr. {{ $doctor->user->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Price Badge -->
                                    <div class="absolute -top-2 -right-2 bg-brand-blue-800 text-white text-xs px-2 py-1 rounded-full shadow">
                                        ₹{{ $doctor->fee }}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-gray-900 font-bold text-base">Dr. {{ $doctor->user->name }}</h3>
                                    <p class="text-brand-blue-800 text-xs font-medium">
                                        {{ $doctor->department->name ?? 'General' }}
                                    </p>
                                    <!-- Rating -->
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-400">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= round($doctor->average_rating ?? 0))
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ml-1 text-xs text-gray-600">
                                            ({{ $doctor->reviews_count ?? 0 }})
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Doctor Info -->
                            <div class="space-y-3 mt-4">
                                <!-- Experience & Fee -->
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-brand-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="font-medium">{{ $doctor->experience ?? '5+' }} years exp.</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-brand-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="font-medium">₹{{ $doctor->fee }}</span>
                                    </div>
                                </div>
                                
                                <!-- Available Days -->
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-center gap-1">
                                        @php
                                            $weekdays = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
                                            $weekdayFull = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                            $availableDays = is_array($doctor->available_days)
                                                ? $doctor->available_days
                                                : (is_string($doctor->available_days)
                                                    ? json_decode($doctor->available_days, true)
                                                    : []);
                                        @endphp

                                        @foreach($weekdays as $index => $day)
                                            <div class="w-6 h-6 flex items-center justify-center rounded-full text-xs font-medium
                                                {{ in_array($weekdayFull[$index], $availableDays ?? []) ? 'bg-brand-blue-800 text-white' : 'bg-gray-100 text-gray-400 opacity-50' }}"
                                                title="{{ $weekdayFull[$index] }}">
                                                {{ $day }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Select Button -->
                            <button class="mt-4 w-full py-2 bg-brand-blue-800 hover:bg-brand-blue-900 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                                Select
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                <svg class="h-12 w-12 mb-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm text-gray-600 mb-2">No doctors found</p>
                <button wire:click="clearFilters" class="text-sm text-brand-blue-600 font-medium hover:text-brand-blue-700 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Clear filters
                </button>
            </div>
        @endif
    @else
        <!-- Doctor Cards - List View -->
        @if($doctors->count() > 0)
            <div class="space-y-4">
                @foreach($doctors as $doctor)
                    <div wire:key="doctor-card-list-{{ $doctor->id }}" wire:click="selectDoctor({{ $doctor->id }})"
                        class="relative border rounded-xl overflow-hidden cursor-pointer transition-all duration-300 hover:shadow-md
                        {{ $doctorId == $doctor->id ? 'ring-2 ring-brand-blue-800 bg-brand-blue-50 border-brand-blue-200' : 'border-gray-200 hover:border-brand-blue-300' }}">
                        <div class="bg-gradient-to-br from-brand-blue-50 to-brand-yellow-50 p-4">
                            <div class="flex items-start">
                                <!-- Doctor Image -->
                                <div class="flex-shrink-0 relative">
                                    <div class="w-16 h-16 rounded-full overflow-hidden bg-white border-4 border-white shadow">
                                        <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                            alt="Dr. {{ $doctor->user->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Price Badge -->
                                    <div class="absolute -top-2 -right-2 bg-brand-blue-800 text-white text-xs px-2 py-1 rounded-full shadow">
                                        ₹{{ $doctor->fee }}
                                    </div>
                                </div>

                                <!-- Doctor Info -->
                                <div class="ml-4 flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                        <div>
                                            <h3 class="text-gray-900 font-bold text-lg">Dr. {{ $doctor->user->name }}</h3>
                                            <p class="text-brand-blue-800 text-sm font-medium">
                                                {{ $doctor->department->name ?? 'General' }}
                                            </p>
                                        </div>
                                        
                                        <!-- Rating -->
                                        <div class="flex items-center mt-1 sm:mt-0">
                                            <div class="flex text-yellow-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= round($doctor->average_rating ?? 0))
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="ml-1 text-sm text-gray-600">
                                                {{ number_format($doctor->average_rating ?? 0, 1) }} ({{ $doctor->reviews_count ?? 0 }})
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Doctor details -->
                                    <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-2">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-brand-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <span class="text-sm">{{ $doctor->experience ?? '5+' }} years exp.</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-brand-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm">₹{{ $doctor->fee }} fee</span>
                                        </div>
                                        
                                        <!-- Available Days Summary -->
                                        <div class="flex items-center col-span-2 sm:col-span-1">
                                            <svg class="w-4 h-4 text-brand-blue-600 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm">Available {{ count($availableDays ?? []) }} days/week</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Select Button -->
                                    <div class="mt-4 flex justify-end">
                                        <button class="px-6 py-2 bg-brand-blue-800 hover:bg-brand-blue-900 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                                            Select
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                <svg class="h-12 w-12 mb-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm text-gray-600 mb-2">No doctors found</p>
                <button wire:click="clearFilters" class="text-sm text-brand-blue-600 font-medium hover:text-brand-blue-700 flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Clear filters
                </button>
            </div>
        @endif
    @endif

    <!-- Pagination Controls -->
    @if($doctors->hasPages())
        <div class="mt-6">
            {{ $doctors->links() }}
        </div>
    @endif
</div>
