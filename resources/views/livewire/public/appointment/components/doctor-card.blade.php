<div class="lg:col-span-1 bg-gradient-to-r from-brand-blue-50 to-brand-blue-100 p-5 rounded-xl border border-brand-blue-200">
    <div class="flex flex-col sm:flex-row md:flex-col lg:flex-row items-center sm:items-start md:items-center lg:items-start gap-4">
        <!-- Doctor Image -->
        <div class="w-24 h-24 sm:w-20 sm:h-20 rounded-full overflow-hidden bg-white border-4 border-white flex-shrink-0 relative">
            <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                 alt="Dr. {{ $doctor->user->name ?? '' }}" class="w-full h-full object-cover">
            
            <!-- Verified Badge -->
            <div class="absolute bottom-0 right-0 bg-green-500 text-white rounded-full p-1 border-2 border-white">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        
        <!-- Doctor Info -->
        <div class="flex-1 text-center sm:text-left md:text-center lg:text-left">
            <h3 class="text-lg font-bold text-brand-blue-900">Dr. {{ $doctor->user->name ?? '' }}</h3>
            <p class="text-sm font-medium text-brand-blue-700 mb-2">{{ $doctor->department->name ?? 'General' }}</p>
            
            <!-- Experience and Qualifications -->
            <div class="flex flex-wrap items-center justify-center sm:justify-start md:justify-center lg:justify-start gap-x-3 gap-y-1 mb-2 text-gray-600">
                <!-- Experience -->
                @if(isset($doctor->experience) && $doctor->experience)
                <div class="flex items-center text-xs">
                    <svg class="w-3 h-3 mr-1 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $doctor->experience }} yrs exp</span>
                </div>
                @endif
                
                <!-- Rating if available -->
                @if(isset($doctor->reviews_avg_rating) || isset($doctor->rating))
                <div class="flex items-center text-xs">
                    <svg class="w-3 h-3 mr-1 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>{{ number_format(isset($doctor->reviews_avg_rating) ? $doctor->reviews_avg_rating : ($doctor->rating ?? 0), 1) }}</span>
                </div>
                @endif
                
                <!-- Fee -->
                <div class="flex items-center text-xs">
                    <svg class="w-3 h-3 mr-1 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                    <span>₹{{ $doctor->fee ?? '' }}</span>
                </div>
            </div>
            
            <!-- Appointment Info (use formatted props if available) -->
            @if(!empty($formattedDate) || !empty($formattedTime) || !empty($appointment_date))
                <div class="text-sm text-gray-600 bg-white bg-opacity-50 px-3 py-2 rounded-lg mt-2">
                    <div class="flex items-center justify-center sm:justify-start md:justify-center lg:justify-start mb-1">
                        <svg class="w-4 h-4 mr-1 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>
                            @if(!empty($formattedDate))
                                {{ $formattedDate }}
                            @elseif(!empty($appointment_date))
                                {{ \Carbon\Carbon::parse($appointment_date)->format('l, F j, Y') }}
                            @endif
                        </span>
                    </div>
                    @php
                        $displayTime = null;
                    @endphp
                    @if(!empty($formattedTime))
                        @php $displayTime = $formattedTime; @endphp
                    @elseif(!empty($appointment_time))
                        @php
                            try {
                                $displayTime = \Carbon\Carbon::createFromFormat('H:i', $appointment_time)->format('h:i A');
                            } catch (\Exception $e) {
                                try {
                                    $displayTime = \Carbon\Carbon::createFromFormat('H:i:s', $appointment_time)->format('h:i A');
                                } catch (\Exception $e) {
                                    try {
                                        $displayTime = \Carbon\Carbon::parse($appointment_time)->format('h:i A');
                                    } catch (\Exception $e) {
                                        $displayTime = $appointment_time;
                                    }
                                }
                            }
                        @endphp
                    @endif
                    @if($displayTime)
                        <div class="text-xs text-gray-700 mt-1">{{ $displayTime }}</div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    
    <!-- Qualifications -->
    @if(!empty($doctor->qualification))
        <div class="mt-4 text-sm text-gray-700 border-t border-brand-blue-200 pt-3">
            <div class="flex items-start">
                <svg class="w-4 h-4 mr-2 text-brand-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-medium">{{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : ($doctor->qualification ?? '') }}</span>
            </div>
        </div>
    @endif
    
    <!-- More Information Section - Desktop: Always visible, Mobile: Collapsible -->
    <div x-data="{ 
        expanded: false,
        isMobile: window.innerWidth < 1024,
        init() {
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
            });
        }
    }" class="mt-3">
        <!-- Mobile only: Toggle button -->
        <button 
            @click="expanded = !expanded" 
            class="w-full text-sm text-left flex items-center justify-between py-1.5 text-brand-blue-700 hover:text-brand-blue-900 transition-colors lg:hidden"
        >
            <span class="font-medium">More information</span>
            <svg 
                class="w-4 h-4 transition-transform duration-200" 
                :class="{'rotate-180': expanded}" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        
        <!-- Desktop: Section heading (always visible) -->
        <div class="hidden lg:block">
            <h4 class="font-medium text-sm text-brand-blue-700 mb-2">More Information</h4>
        </div>
        
        <!-- Content: Mobile (collapsible) & Desktop (always visible) -->
        <div 
            x-show="expanded || !isMobile" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="text-xs space-y-2 mt-2 text-gray-700 bg-white bg-opacity-50 p-3 rounded-lg"
        >
            <!-- Available Days -->
            @if(isset($doctor->available_days) && !empty($doctor->available_days))
                <div class="flex items-start">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-brand-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <span class="font-medium">Available days:</span>
                        <span>
                            @php
                                $availableDays = is_array($doctor->available_days) 
                                    ? $doctor->available_days 
                                    : (is_string($doctor->available_days) 
                                        ? json_decode($doctor->available_days, true) 
                                        : []);
                            @endphp
                            {{ implode(', ', $availableDays) }}
                        </span>
                    </div>
                </div>
            @endif
            
            <!-- Languages -->
            @if(isset($doctor->languages_spoken) && !empty($doctor->languages_spoken))
                <div class="flex items-start">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-brand-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                    </svg>
                    <div>
                        <span class="font-medium">Languages:</span>
                        <span>
                            @php
                                $languages = is_array($doctor->languages_spoken) 
                                    ? $doctor->languages_spoken 
                                    : (is_string($doctor->languages_spoken) 
                                        ? json_decode($doctor->languages_spoken, true) 
                                        : []);
                            @endphp
                            {{ implode(', ', $languages) }}
                        </span>
                    </div>
                </div>
            @endif
            
            <!-- Location if available -->
            @if(isset($doctor->city) || isset($doctor->state))
                <div class="flex items-start">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-brand-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div>
                        <span class="font-medium">Location:</span> 
                        <span>
                            {{ $doctor->city ? $doctor->city . ', ' : '' }}{{ $doctor->state ?? '' }}
                            {{ $doctor->pincode ? '- ' . $doctor->pincode : '' }}
                        </span>
                    </div>
                </div>
            @endif
            
            <!-- Working Hours -->
            @if(isset($doctor->start_time) && isset($doctor->end_time))
                <div class="flex items-start">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-brand-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <span class="font-medium">Hours:</span>
                        <span>
                            {{ \Carbon\Carbon::parse($doctor->start_time)->format('h:i A') }} - 
                            {{ \Carbon\Carbon::parse($doctor->end_time)->format('h:i A') }}
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
