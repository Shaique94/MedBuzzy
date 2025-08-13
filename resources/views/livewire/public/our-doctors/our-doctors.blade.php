<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Page Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Find a Doctor</h1>
            <p class="text-gray-600 mt-1">Search for skilled healthcare providers in your area</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <form wire:submit.prevent="loadDoctors" class="relative">
                <div class="flex items-center">
                    <div class="relative flex-grow">
                        <input type="text" wire:model.live.debounce.300ms="searchQuery"
                            placeholder="Search by name, specialty"
                            class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-1 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            @if($searchQuery)
                            <button type="button" wire:click="$set('searchQuery', '')" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                            @endif
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-brand-blue-500 text-white p-3 rounded-r-lg hover:bg-brand-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <div x-data="{ mobileFiltersOpen: false }">
            <!-- Mobile Filter Toggle -->
            <div class="block sm:hidden mb-4">
                <button @click="mobileFiltersOpen = !mobileFiltersOpen" 
                        class="flex items-center justify-between w-full px-4 py-3 bg-gray-100 rounded-lg text-left">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        <span class="font-medium text-gray-700">Filters</span>
                    </span>
                    <svg x-show="!mobileFiltersOpen" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg x-show="mobileFiltersOpen" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Main Content Layout -->
            <div class="flex flex-col sm:flex-row gap-6">
                <!-- Filters Panel -->
                <aside class="w-full sm:w-64 lg:w-72"
                       :class="{'hidden sm:block': !mobileFiltersOpen, 'block': mobileFiltersOpen}">
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Filter Results</h2>
                        
                        <!-- Specialty Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Specialty</label>
                            <select wire:model.live="department_id"
                                class="w-full p-2 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                                <option value="">All Specialties</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gender Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model.live="genderFilter" value="male" 
                                           class="rounded text-brand-blue-600 focus:ring-brand-blue-500 h-4 w-4">
                                    <span class="ml-2 text-gray-700">Male</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model.live="genderFilter" value="female"
                                           class="rounded text-brand-blue-600 focus:ring-brand-blue-500 h-4 w-4">
                                    <span class="ml-2 text-gray-700">Female</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Experience Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Experience ({{ $minExperience }}+ years)
                            </label>
                            <input type="range" wire:model.live="minExperience" min="0" max="20" step="1"
                                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>Any</span>
                                <span>5</span>
                                <span>10</span>
                                <span>15</span>
                                <span>20+</span>
                            </div>
                        </div>
                        
                        <!-- Fee Range Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fee Range (₹{{ $minFee }} - ₹{{ $maxFee }})
                            </label>
                            <div class="flex gap-4">
                                <input type="number" wire:model.live="minFee" min="0" max="10000" step="100"
                                      class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-blue-500 focus:border-brand-blue-500"
                                      placeholder="Min">
                                <input type="number" wire:model.live="maxFee" min="0" max="10000" step="100"
                                      class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-blue-500 focus:border-brand-blue-500"
                                      placeholder="Max">
                            </div>
                        </div>
                        
                        <!-- Rating Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Rating</label>
                            <div class="flex items-center gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" wire:click="$set('minRating', {{ $i }})"
                                            class="w-8 h-8 rounded-full flex items-center justify-center 
                                                  {{ $minRating >= $i ? 'bg-brand-blue-500 text-white' : 'bg-gray-100 text-gray-400' }}">
                                        {{ $i }}
                                    </button>
                                @endfor
                                <button type="button" wire:click="$set('minRating', 0)"
                                        class="text-xs text-brand-blue-600 ml-2">Clear</button>
                            </div>
                        </div>

                        <!-- Apply/Reset Buttons -->
                        <div class="flex gap-3">
                            <button wire:click="resetFilters"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                Reset
                            </button>
                            <button wire:click="loadDoctors"
                                class="flex-1 px-3 py-2 bg-brand-blue-500 text-white rounded-lg hover:bg-brand-blue-600 transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>
                </aside>

                <!-- Results Area -->
                <div class="flex-1">
                    <!-- Results Count + Sort By -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                        <h2 class="text-base sm:text-lg font-medium text-gray-900">
                            <span class="text-brand-blue-600">{{ count($doctors) }}</span> doctors found
                            @if ($department_id)
                                in <span class="text-brand-blue-600">{{ $departments->find($department_id)->name ?? '' }}</span>
                            @endif
                        </h2>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 mr-2">Sort by:</span>
                            <select wire:model.live="sortBy"
                                class="text-sm border px-2 py-1 border-gray-300 rounded-md focus:ring-brand-blue-500 focus:border-brand-blue-500">
                                <option value="name">Name</option>
                                <option value="rating">Rating</option>
                                <option value="experience">Experience</option>
                                <option value="fee_low">Fee: Low to High</option>
                                <option value="fee_high">Fee: High to Low</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Mobile Active Filters -->
                    @if($this->hasActiveFilters)
                    <div class="mb-4 sm:flex sm:flex-wrap gap-2 hidden sm:block">
                        @if($department_id)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                                {{ $departments->find($department_id)->name ?? '' }}
                                <button type="button" wire:click="$set('department_id', null)" class="ml-1 text-brand-blue-600 hover:text-brand-blue-800">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if(count($genderFilter) > 0 && count($genderFilter) < 2)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                                {{ ucfirst($genderFilter[0]) }}
                                <button type="button" wire:click="$set('genderFilter', [])" class="ml-1 text-brand-blue-600 hover:text-brand-blue-800">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if($minExperience > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                                {{ $minExperience }}+ years experience
                                <button type="button" wire:click="$set('minExperience', 0)" class="ml-1 text-brand-blue-600 hover:text-brand-blue-800">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if($minRating > 0)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                                {{ $minRating }}+ rating
                                <button type="button" wire:click="$set('minRating', 0)" class="ml-1 text-brand-blue-600 hover:text-brand-blue-800">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </div>
                    @endif

                    <!-- Doctor Cards -->
                    <div class="space-y-4">
                        @forelse ($doctors as $doctor)
                            <div class="border border-gray-200 rounded-lg hover:border-brand-blue-300 transition-colors">
                                <div class="p-4">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Doctor Image -->
                                        <div class="sm:self-start">
                                            <div class="flex items-center justify-center w-20 h-20 mx-auto sm:mx-0 rounded-full bg-brand-blue-100 overflow-hidden border border-gray-200">
                                                @if ($doctor->image)
                                                    <img src="{{ $doctor->image }}" 
                                                         alt="Dr. {{ $doctor->user->name }}" 
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-2xl font-semibold text-brand-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Doctor Info -->
                                        <div class="flex-1 text-center sm:text-left">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $doctor->user->name }}</h3>
                                            <p class="text-sm text-brand-blue-600 font-medium">{{ $doctor->department->name }}</p>
                                            
                                            <!-- Qualifications -->
                                            @if(is_array($doctor->qualification) && !empty(array_filter($doctor->qualification)))
                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ implode(', ', array_filter($doctor->qualification)) }}
                                                </p>
                                            @endif
                                            
                                            <!-- Rating -->
                                            <div class="flex items-center justify-center sm:justify-start mt-2 gap-1">
                                                <div class="flex text-amber-400">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= round($doctor->reviews_avg_rating ?? 0) ? 'text-amber-400' : 'text-gray-300' }}" 
                                                             fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-600">
                                                    {{ number_format($doctor->reviews_avg_rating ?? 0, 1) }}
                                                    ({{ $doctor->reviews_count ?? 0 }})
                                                </span>
                                            </div>
                                            
                                            <!-- Key Info -->
                                            <div class="grid grid-cols-2 gap-y-1 gap-x-2 mt-2 text-sm">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>{{ $doctor->experience ?? '3+' }} yrs exp</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    <span>₹{{ $doctor->fee }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>
                                                        @php
                                                            $availableDays = is_array($doctor->available_days) 
                                                                ? $doctor->available_days 
                                                                : (is_string($doctor->available_days) 
                                                                    ? json_decode($doctor->available_days, true) ?? []
                                                                    : []);
                                                            $daysCount = count($availableDays);
                                                        @endphp
                                                        {{ $daysCount }} {{ $daysCount == 1 ? 'day' : 'days' }} available
                                                    </span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <span>{{ $doctor->city ?? 'Purnea' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex flex-col sm:items-end gap-2 mt-3 sm:mt-0">
                                            <div class="hidden sm:block text-right">
                                                <p class="text-lg font-semibold text-brand-blue-600">₹{{ $doctor->fee }}</p>
                                                <p class="text-sm text-gray-500">Consultation Fee</p>
                                            </div>
                                            <div class="flex flex-col sm:items-end gap-2">
                                                <a wire:navigate href="{{ route('doctor-detail', ['slug' => $doctor->slug]) }}"
                                                   class="text-center sm:w-auto w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                                                    View Profile
                                                </a>
                                                <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                                   class="text-center sm:w-auto w-full px-4 py-2 bg-brand-blue-500 rounded-lg text-white hover:bg-brand-blue-600 transition-colors text-sm">
                                                    Book Appointment
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 border border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No doctors found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try changing your search criteria or filters</p>
                                <button wire:click="resetFilters" 
                                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500">
                                    Reset all filters
                                </button>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($doctors->count() > 0 && method_exists($doctors, 'links'))
                        <div class="mt-6">
                            {{ $doctors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
