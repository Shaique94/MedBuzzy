<div class="min-h-screen bg-gray-50" 
     x-data="{ 
         scrolled: false,
         filterDrawerOpen: false
     }" 
     x-init="
         window.addEventListener('scroll', () => { 
             scrolled = window.pageYOffset > 300;
         });
     ">
    <!-- Global loading overlay -->
    <div wire:loading.flex wire:target="loadDoctors, department_id, sortBy, searchQuery, minExperience, genderFilter, minRating, minFee, maxFee, resetFilters"
         class="fixed inset-0 bg-white bg-opacity-70 z-50 items-center justify-center">
        <div class="bg-white p-5 rounded-lg shadow-lg flex flex-col items-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4 border-t-brand-blue-600 animate-spin"></div>
            <h2 class="text-center text-gray-700 text-xl font-semibold">Loading...</h2>
            <p class="text-center text-gray-500">Please wait while we find the best doctors for you</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Page Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">Find a Doctor</h1>
            <p class="text-gray-600 mt-1">Search for skilled healthcare providers in your area</p>
        </div>

        <!-- Search & Filtering Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <form wire:submit.prevent="loadDoctors">
                <!-- Search Input -->
                <div class="flex items-center mb-4">
                    <div class="relative flex-grow">
                        <input type="text" wire:model.live.debounce.300ms="searchQuery"
                            placeholder="Search by doctor name or specialty"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg wire:loading.remove wire:target="searchQuery" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <svg wire:loading wire:target="searchQuery" class="animate-spin w-5 h-5 text-brand-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit"
                        class="ml-3 bg-brand-blue-600 text-white px-5 py-3 rounded-lg hover:bg-brand-blue-700 transition-colors relative"
                        wire:loading.class="opacity-75 cursor-wait" 
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Search</span>
                        <span wire:loading wire:target="loadDoctors" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Searching...
                        </span>
                    </button>
                </div>

                <!-- Filters & Sorting (Desktop) -->
                <div class="hidden md:flex items-center justify-between">
                    <!-- Filter Buttons -->
                    <div class="flex items-center space-x-3 flex-wrap gap-y-2">
                        <!-- Department/Specialty Filter -->
                        <div>
                            <select wire:model.live="departmentSlug"
                                class="pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-brand-blue-500 focus:border-brand-blue-500 bg-white">
                                <option value="">All Specialties</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->slug }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Experience Filter -->
                        <div>
                            <select wire:model.live="minExperience"
                                class="pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-brand-blue-500 focus:border-brand-blue-500 bg-white">
                                <option value="0">Any Experience</option>
                                <option value="1">1+ years</option>
                                <option value="3">3+ years</option>
                                <option value="5">5+ years</option>
                                <option value="10">10+ years</option>
                            </select>
                        </div>
                        
                        <!-- Gender Filter -->
                        <div class="flex items-center space-x-2 border border-gray-300 rounded-lg px-3 py-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model.live="genderFilter" value="male" 
                                       class="form-checkbox h-4 w-4 text-brand-blue-600 rounded">
                                <span class="ml-2 text-sm text-gray-700">Male</span>
                            </label>
                            <span class="text-gray-300">|</span>
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model.live="genderFilter" value="female"
                                       class="form-checkbox h-4 w-4 text-brand-blue-600 rounded">
                                <span class="ml-2 text-sm text-gray-700">Female</span>
                            </label>
                        </div>
                        
                        <!-- More Filters Button -->
                        <button type="button" @click="filterDrawerOpen = true"
                            class="flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 group transition-all duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500 group-hover:text-brand-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            More Filters
                        </button>
                    </div>

                    <!-- Sort Dropdown -->
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-2">Sort by:</span>
                        <select wire:model.live="sortBy"
                            class="pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-brand-blue-500 focus:border-brand-blue-500 bg-white">
                            <option value="recommended">Recommended</option>
                            <option value="rating">Rating</option>
                            <option value="experience">Experience</option>
                            <option value="fee_low">Fee: Low to High</option>
                            <option value="fee_high">Fee: High to Low</option>
                        </select>
                    </div>
                </div>
                
                <!-- Mobile Filter Toggle -->
                <div class="md:hidden flex justify-between mt-4">
                    <button type="button" @click="filterDrawerOpen = true"
                        class="flex items-center px-4 py-2 bg-gray-100 rounded-lg text-sm text-gray-700 hover:bg-gray-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filters
                    </button>
                    <select wire:model.live="sortBy"
                        class="pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg bg-white">
                        <option value="recommended">Sort: Recommended</option>
                        <option value="rating">Sort: Rating</option>
                        <option value="fee_low">Sort: Low Price</option>
                        <option value="fee_high">Sort: High Price</option>
                    </select>
                </div>
                
                <!-- Active Filters Tags -->
                @if($this->hasActiveFilters)
                <div class="flex flex-wrap gap-2 mt-4">
                    @if($departmentSlug)
                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                            {{ $departments->firstWhere('slug', $departmentSlug)->name ?? '' }}
                            <button type="button" wire:click="$set('departmentSlug', null)" class="ml-1.5 text-brand-blue-600 hover:text-brand-blue-800">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                                </svg>
                            </button>
                        </span>
                    @endif
                    
                    @if(count($genderFilter) > 0 && count($genderFilter) < 2)
                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                            {{ ucfirst($genderFilter[0]) }}
                            <button type="button" wire:click="$set('genderFilter', [])" class="ml-1.5 text-brand-blue-600 hover:text-brand-blue-800">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                                </svg>
                            </button>
                        </span>
                    @endif
                    
                    @if($minExperience > 0)
                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                            {{ $minExperience }}+ years experience
                            <button type="button" wire:click="$set('minExperience', 0)" class="ml-1.5 text-brand-blue-600 hover:text-brand-blue-800">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                                </svg>
                            </button>
                        </span>
                    @endif
                    
                    @if($minRating > 0)
                        <span class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-brand-blue-100 text-brand-blue-800">
                            {{ $minRating }}+ rating
                            <button type="button" wire:click="$set('minRating', 0)" class="ml-1.5 text-brand-blue-600 hover:text-brand-blue-800">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"></path>
                                </svg>
                            </button>
                        </span>
                    @endif
                    
                    <!-- Clear All Filters Button -->
                    <button type="button" wire:click="resetFilters" 
                            class="inline-flex items-center px-2.5 py-1.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
                        Clear all
                    </button>
                </div>
                @endif
            </form>
        </div>

        <!-- Sticky Filter Bar -->
        <div x-show="scrolled" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-5"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-5"
             class="fixed top-0 left-0 right-0 bg-brand-blue-600 shadow-md border-b border-brand-blue-200 z-50 py-2 px-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Left: Condensed Filter Controls -->
                <div class="flex items-center space-x-2">
                    <!-- Department Dropdown -->
                    <select wire:model.live="departmentSlug"
                        class="text-sm border border-gray-300 rounded-md bg-white py-1.5 px-3 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        <option value="">All Specialties</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->slug }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    
                    <!-- Quick Filters Button -->
                    <button type="button" @click="filterDrawerOpen = true"
                        class="flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs sm:text-sm text-gray-700 bg-white hover:bg-white group transition-all duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 mr-1.5 text-gray-500 group-hover:text-brand-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Filters
                    </button>
                    
                    <!-- Count Pills -->
                    <div class="hidden sm:flex items-center">
                        <span class="text-xs font-medium bg-brand-blue-100 text-brand-blue-800 px-2 py-1 rounded-md">
                            {{ count($doctors) }} results
                        </span>
                    </div>
                </div>
                
                <!-- Right: Sorting -->
                <div class="md:flex items-center hidden">
                    <select wire:model.live="sortBy"
                        class="text-xs sm:text-sm border border-gray-300 rounded-md bg-white py-1.5 px-3 focus:ring-brand-blue-500 focus:border-brand-blue-500">
                        <option value="recommended">Sort: Recommended</option>
                        <option value="rating">Sort: Rating</option>
                        <option value="fee_low">Sort: Low Price</option>
                        <option value="fee_high">Sort: High Price</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Main Content - Doctor List -->
            <div class="flex-1">
                <!-- Results Count -->
                <div class="mb-4 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        <span class="text-brand-blue-600">{{ count($doctors) }}</span> doctors found
                    </h2>
                    
                    <!-- Loading indicator for sorting/filtering -->
                    <div wire:loading wire:target="sortBy, departmentSlug, minExperience, genderFilter, minRating, minFee, maxFee" 
                         class="text-sm text-brand-blue-600 flex items-center">
                        <svg class="animate-spin mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Updating results...
                    </div>
                </div>
                
                <!-- Doctor Cards -->
                <div class="space-y-4 relative">
                    <!-- Empty state with loader -->
                    <div wire:loading.flex wire:target="loadDoctors, departmentSlug, sortBy, searchQuery, minExperience, genderFilter, minRating, minFee, maxFee, resetFilters" 
                         class="w-full py-12 items-center justify-center" 
                         wire:loading.class.remove="hidden">
                        <div class="text-center">
                            <div class="inline-block animate-pulse">
                                <div class="rounded-full h-12 w-12 bg-brand-blue-200 mb-4 mx-auto"></div>
                                <div class="h-4 bg-gray-200 rounded w-24 mb-2.5 mx-auto"></div>
                                <div class="h-2 bg-gray-200 rounded w-32 mx-auto"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actual doctor list -->
                    <div wire:loading.class="opacity-50" 
                         wire:target="loadDoctors, departmentSlug, sortBy, searchQuery, minExperience, genderFilter, minRating, minFee, maxFee, resetFilters">
                        @forelse ($doctors as $doctor)
                            <div class="bg-white rounded-lg border border-gray-200 hover:border-brand-blue-300 transition-all shadow-sm mb-3 overflow-hidden">
                                <div class="p-4">
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <!-- Doctor Image -->
                                        <div class="sm:self-start">
                                            <div class="flex items-center justify-center w-24 h-24 mx-auto sm:mx-0 rounded-full bg-brand-blue-50 overflow-hidden border-2 border-white shadow">
                                                @if ($doctor->image)
                                                    <img src="{{ $doctor->image }}"
                                                        alt="Dr. {{ $doctor->user->name }}"
                                                        class="w-full h-full object-cover"
                                                        loading="lazy">
                                                @else
                                                    <span class="text-3xl font-bold text-brand-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Doctor Details -->
                                        <div class="flex-1 text-center sm:text-left">
                                            <!-- Name, Specialty, Qualifications -->
                                            <h3 class="text-lg font-bold text-gray-900">Dr. {{ $doctor->user->name }}</h3>
                                            <p class="text-sm text-brand-blue-600 font-medium">{{ $doctor->department->name }}</p>
                                            
                                            @if(is_array($doctor->qualification) && !empty(array_filter($doctor->qualification)))
                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ implode(', ', array_filter($doctor->qualification)) }}
                                                </p>
                                            @endif
                                            
                                            <!-- Rating -->
                                            <div class="flex items-center justify-center sm:justify-start mt-2 gap-1">
                                                <div class="flex text-yellow-400">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= round($doctor->reviews_avg_rating ?? 0) ? 'text-yellow-400' : 'text-gray-200' }}" 
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-600">
                                                    {{ number_format($doctor->reviews_avg_rating ?? 0, 1) }}
                                                    <span class="text-gray-400">({{ $doctor->reviews_count ?? 0 }})</span>
                                                </span>
                                            </div>
                                            
                                            <!-- Key Info -->
                                            <div class="grid grid-cols-2 gap-y-1 gap-x-2 mt-3 text-sm">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>{{ $doctor->experience ?? '3+' }} yrs experience</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    <span>₹{{ $doctor->fee }} consultation fee</span>
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

                                        <!-- Action Buttons -->
                                        <div class="flex flex-col sm:items-end gap-3 mt-4 sm:mt-0">
                                            <div class="hidden sm:block text-right">
                                                <p class="text-lg font-bold text-brand-blue-600">₹{{ $doctor->fee }}</p>
                                                <p class="text-xs text-gray-500">Consultation Fee</p>
                                            </div>
                                            <div class="flex flex-col gap-2 sm:items-end">
                                                <a wire:navigate href="{{ route('doctor-detail', ['slug' => $doctor->slug]) }}"
                                                    class="text-center w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                                                    <span class="flex items-center justify-center">
                                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Profile
                                                    </span>
                                                </a>
                                                <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                                    class="text-center w-full sm:w-auto px-4 py-2 bg-brand-blue-600 rounded-lg text-white hover:bg-brand-blue-700 transition-colors text-sm">
                                                    <span class="flex items-center justify-center">
                                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        Book Appointment
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-white border border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No doctors found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search criteria or filters</p>
                                <button wire:click="resetFilters"
                                    class="mt-4 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Reset all filters
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pagination -->
                @if($doctors->count() > 0 && method_exists($doctors, 'links'))
                    <div class="mt-6">
                        <div wire:loading.class="opacity-50" wire:target="gotoPage, nextPage, previousPage">
                            {{ $doctors->links() }}
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Right Sidebar - Ads & Location (hidden on mobile) -->
            <div class="hidden lg:block lg:w-80 space-y-6">
                <!-- Location Info -->
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-3">Location</h3>
                    <div class="aspect-w-16 aspect-h-9 mb-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57533.40408300683!2d87.41575413242887!3d25.777662611245257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff99e8757bcf5%3A0x56f6b0a7cb789eb3!2sPurnea%2C%20Bihar!5e0!3m2!1sen!2sin!4v1688110359547!5m2!1sen!2sin" 
                            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="text-sm text-gray-600">Purnea, Bihar, India</p>
                    <p class="text-sm text-gray-600 mt-1">Find doctors in your locality for personalized care</p>
                </div>

                <!-- Ads Section -->
                <div class="bg-gradient-to-r from-brand-blue-50 to-brand-blue-100 p-5 rounded-lg border border-brand-blue-200 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-3">Health Insurance</h3>
                    <p class="text-sm text-gray-600 mb-3">Protect yourself and your family with comprehensive health insurance coverage</p>
                    <div class="w-full h-32 bg-white rounded-lg mb-3 flex items-center justify-center text-brand-blue-500">
                        <span class="text-lg font-bold">Insurance Ad</span>
                    </div>
                    <a href="#" class="text-sm text-brand-blue-600 hover:underline">Learn more →</a>
                </div>
                
                <!-- Promotional Content -->
                <div class="bg-gradient-to-r from-brand-teal-50 to-brand-teal-100 p-5 rounded-lg border border-brand-teal-200 shadow-sm">
                    <h3 class="font-bold text-gray-900 mb-3">Need Help?</h3>
                    <p class="text-sm text-gray-600 mb-4">Our healthcare concierge can help you find the right doctor</p>
                    <button class="w-full bg-brand-teal-500 text-white py-2 rounded-lg text-sm hover:bg-brand-teal-600 transition-colors">
                        Contact Support
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Advanced Filter Drawer (slides in from right) -->
    <div x-show="filterDrawerOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 w-full sm:w-96 bg-white shadow-xl overflow-y-auto"
         @click.outside="filterDrawerOpen = false">
        
        <!-- Drawer Header -->
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Filter Options</h3>
            <button @click="filterDrawerOpen = false" class="p-2 rounded-full hover:bg-gray-100 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Filter Content -->
        <div class="p-4 space-y-4">
            <!-- Specialty Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Specialty</label>
                <select wire:model.live="departmentSlug" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">All Specialties</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->slug }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gender Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model.live="genderFilter" value="male" 
                               class="rounded text-brand-blue-600 focus:ring-brand-blue-500 h-5 w-5">
                        <span class="ml-2 text-gray-700">Male</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" wire:model.live="genderFilter" value="female"
                               class="rounded text-brand-blue-600 focus:ring-brand-blue-500 h-5 w-5">
                        <span class="ml-2 text-gray-700">Female</span>
                    </label>
                </div>
            </div>
            
            <!-- Experience Filter -->
            <div>
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
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Fee Range (₹{{ $minFee }} - ₹{{ $maxFee }})
                </label>
                <div class="flex gap-4">
                    <input type="number" wire:model.live="minFee" min="0" max="10000" step="100"
                          class="w-full p-2 text-sm border border-gray-300 rounded-lg"
                          placeholder="Min">
                    <input type="number" wire:model.live="maxFee" min="0" max="10000" step="100"
                          class="w-full p-2 text-sm border border-gray-300 rounded-lg"
                          placeholder="Max">
                </div>
            </div>
            
            <!-- Rating Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Rating</label>
                <div class="flex items-center gap-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button" wire:click="$set('minRating', {{ $i }})"
                                class="w-8 h-8 rounded-full flex items-center justify-center transition-colors
                                      {{ $minRating >= $i ? 'bg-brand-blue-600 text-white' : 'bg-gray-100 text-gray-400 hover:bg-gray-200' }}">
                            {{ $i }}
                        </button>
                    @endfor
                    <button type="button" wire:click="$set('minRating', 0)"
                            class="text-xs text-brand-blue-600 hover:underline ml-2">Clear</button>
                </div>
            </div>
        </div>
        
        <!-- Drawer Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex gap-3">
                <button wire:click="resetFilters" @click="filterDrawerOpen = false"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Reset
                </button>
                <button wire:click="loadDoctors" @click="filterDrawerOpen = false"
                    class="flex-1 px-3 py-2 bg-brand-blue-600 text-white rounded-lg hover:bg-brand-blue-700 transition-colors">
                    Apply
                </button>
            </div>
        </div>
    </div>
    
    <!-- Modal backdrop -->
    <div x-show="filterDrawerOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="filterDrawerOpen = false"
         class="fixed inset-0 bg-gray-900/30 backdrop-blur-sm z-40">
    </div>
    
    <style>
        /* Make sure x-cloak works properly */
        [x-cloak] { display: none !important; }
        
        /* Ensure the sticky header appears above other elements */
        .fixed { 
            position: fixed !important;
        }
        
        /* Loading animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Pulse animation for skeleton loader */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Enhance button hover effects */
        .button-hover {
            transition: all 0.2s ease;
        }
        
        .button-hover:hover {
            transform: translateY(-1px);
        }
        
        /* Make sure the filter drawer appears on top */
        .z-50 {
            z-index: 50;
        }
        .z-40 {
            z-index: 40;
        }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('filterDrawer', {
                open: false
            });
        });
    </script>
</div>