<div>
    <div x-data="{
        tab: 'about',
        isMobile: window.innerWidth < 768,
        showMobileStats: false,
        init() {
            this.isMobile = window.innerWidth < 768;
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 768;
            });
        }
    }" x-init="init()" class="min-h-screen bg-gray-50 mt-5">

        <!-- Mobile Header with Back Button -->
        <div class="md:hidden bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="px-4 py-3">
                <div class="flex items-center gap-3">
                    <button onclick="history.back()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <div class="flex-1 min-w-0">
                        <h1 class="text-lg font-bold text-gray-900 truncate">Dr. {{ $doctor->user->name }}</h1>
                        <p class="text-sm text-brand-blue-600 truncate">
                            {{ $doctor->department->name ?? 'General Medicine' }}
                        </p>
                    </div>
                    <button @click="showMobileStats = !showMobileStats"
                        class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Quick Stats Dropdown -->
                <div x-show="showMobileStats" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-1" class="grid grid-cols-2 gap-3 mt-4">
                    <div class="bg-brand-blue-50 rounded-xl p-3 border border-brand-blue-200">
                        <div class="text-xl font-bold text-brand-blue-700">{{ number_format($averageRating, 1) }}</div>
                        <div class="text-xs text-brand-blue-600">Rating</div>
                    </div>
                    <div class="bg-brand-blue-50 rounded-xl p-3 border border-brand-blue-200">
                        <div class="text-xl font-bold text-brand-blue-700">{{ $countFeedback }}</div>
                        <div class="text-xs text-brand-blue-600">Reviews</div>
                    </div>
                    <div class="bg-brand-blue-50 rounded-xl p-3 border border-brand-blue-200">
                        <div class="text-xl font-bold text-brand-blue-700">₹{{ $doctor->fee }}</div>
                        <div class="text-xs text-brand-blue-600">Consultation</div>
                    </div>
                    <div class="bg-brand-blue-50 rounded-xl p-3 border border-brand-blue-200">
                        <div class="text-xl font-bold text-brand-blue-700">{{ $doctor->experience ?? '5+' }} yrs</div>
                        <div class="text-xs text-brand-blue-600">Experience</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto max-w-5xl px-4 py-6">
            <!-- Doctor Profile Header -->
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden mb-6">
                <div class="bg-brand-blue-50 h-24 md:h-32 relative"></div>

                <div class="relative px-4 md:px-6 pb-6">
                    <!-- Doctor Image and Basic Info -->
                    <div class="flex flex-col md:flex-row gap-6 items-start md:items-end -mt-12 md:-mt-16">
                        <!-- Doctor Image -->
                        <div class="relative self-center md:self-start flex-shrink-0">
                            <div class="relative">
                                @if ($doctor->image)
                                    <img src="{{ $doctor->image }}" alt="Dr. {{ $doctor->user->name }}"
                                        class="w-24 h-24 md:w-32 md:h-32 rounded-lg border-4 border-white object-cover">
                                @else
                                    <div
                                        class="w-24 h-24 md:w-32 md:h-32 rounded-lg bg-brand-blue-100 border-4 border-white flex items-center justify-center">
                                        <span class="text-3xl md:text-4xl font-bold text-brand-blue-700">
                                            {{ substr($doctor->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                <!-- Verified Badge -->
                                <div
                                    class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full p-1 border-2 border-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Info -->
                        <div class="flex-grow text-center self-center md:text-left">
                            <div class="mb-4 pb-2">
                                <h1 class="text-xl md:text-3xl font-bold text-gray-900 mb-1">Dr.
                                    {{ $doctor->user->name }}
                                </h1>
                                <p class="text-md text-brand-blue-600 font-medium mb-2">
                                    {{ $doctor->department->name ?? 'General Medicine' }}
                                </p>
                                @if ($doctor->qualification)
                                    <p class="text-gray-600 text-sm mt-1">
                                        {{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification }}
                                    </p>
                                @endif
                            </div>

                            <!-- Rating and Reviews -->
                            <div class="flex flex-col md:flex-row md:items-center gap-2 mb-3">
                                <div class="flex items-center justify-center md:justify-start gap-1">
                                    <div class="flex text-amber-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= round($averageRating ?? 0) ? 'text-amber-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-600">{{ number_format($averageRating, 1) }}
                                        ({{ $countFeedback }} {{ $countFeedback == 1 ? 'review' : 'reviews' }})</p>
                                </div>
                            </div>

                            <!-- Key Stats - Desktop -->
                            <div class="hidden md:flex gap-4 text-sm">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-brand-blue-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $doctor->experience ?? '5+' }} years experience</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-brand-blue-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>₹{{ $doctor->fee }} fee</span>
                                </div>
                            </div>

                            <!-- Appointment Button (Desktop) -->
                            <div class=" md:flex gap-3 mt-3">
                                <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                    class="bg-brand-blue-500 hover:bg-brand-blue-600 text-white py-2 px-4 rounded-lg inline-flex items-center gap-2 transition-colors text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="bg-white rounded-lg border border-gray-200 overflow-x-auto mb-6">
                <div class="flex scrollbar-hide">
                    <button @click="tab = 'about'"
                        :class="tab === 'about' ? 'text-white bg-brand-blue-500' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-shrink-0 px-4 py-3 font-medium transition-colors min-w-[90px] text-center">
                        About
                    </button>
                    <button @click="tab = 'availability'"
                        :class="tab === 'availability' ? 'text-white bg-brand-blue-500' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-shrink-0 px-4 py-3 font-medium transition-colors min-w-[90px] text-center">
                        Schedule
                    </button>
                    <button @click="tab = 'location'"
                        :class="tab === 'location' ? 'text-white bg-brand-blue-500' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-shrink-0 px-4 py-3 font-medium transition-colors min-w-[90px] text-center">
                        Location
                    </button>
                    <button @click="tab = 'reviews'"
                        :class="tab === 'reviews' ? 'text-white bg-brand-blue-500' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-shrink-0 px-4 py-3 font-medium transition-colors min-w-[90px] text-center">
                        Reviews
                    </button>
                </div>
            </div>

            <!-- Tab Content -->
            <div>
                <!-- About Section -->
                <div x-show="tab === 'about'" x-transition class="space-y-6">
                    <!-- About -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            About
                        </h2>
                        <p class="text-gray-700">
                            {{ $doctor->professional_bio ?? 'Experienced healthcare professional dedicated to providing comprehensive medical care with a patient-centered approach. Committed to staying current with the latest medical advances and treatment options.' }}
                        </p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Experience & Expertise
                        </h2>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 text-center">
                                <div class="text-lg font-semibold text-gray-900">{{ $doctor->experience ?? '5+' }}
                                </div>
                                <div class="text-sm text-gray-600">Years</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 text-center">
                                <div class="text-lg font-semibold text-gray-900">₹{{ $doctor->fee }}</div>
                                <div class="text-sm text-gray-600">Fee</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 text-center">
                                <div class="text-lg font-semibold text-gray-900">
                                    {{ number_format($averageRating, 1) }}
                                </div>
                                <div class="text-sm text-gray-600">Rating</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 text-center">
                                <div class="text-lg font-semibold text-gray-900">{{ $countFeedback }}</div>
                                <div class="text-sm text-gray-600">Reviews</div>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Services Offered
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" x-data="{ showAll: false }">
                            <div class="flex items-start space-x-3 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <div
                                    class="w-8 h-8 rounded-lg bg-brand-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-brand-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">General Consultation</h4>
                                    <p class="text-sm text-gray-600">Comprehensive health assessment and medical
                                        consultation.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <div
                                    class="w-8 h-8 rounded-lg bg-brand-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-brand-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">Health Screening</h4>
                                    <p class="text-sm text-gray-600">Preventive health checkups and early disease
                                        detection.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($doctor->languages_spoken))
                        <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                                </svg>
                                Languages Spoken
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($doctor->languages_spoken as $language)
                                    <span
                                        class="bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded-full">{{ $language }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(!empty($doctor->achievements_awards))
                        <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Achievements & Awards
                            </h2>
                            <ul class="space-y-3">
                                @foreach($doctor->achievements_awards as $achievement)
                                    <li class="flex items-start gap-2">
                                        <svg class="w-4 h-4 text-brand-blue-500 mt-1 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">{{ $achievement }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                     @if(!empty($doctor->social_media_links))
                        <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                Connect
                            </h2>
                            <div class="flex gap-3">
                                @foreach($doctor->social_media_links as $platform => $link)
                                    @if($link)
                                        <a href="{{ $link }}" target="_blank" class="hover:opacity-80">
                                            @if($platform === 'facebook')
                                                <svg class="w-6 h-6 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($platform === 'twitter')
                                                <svg class="w-6 h-6 text-[#1DA1F2]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path
                                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                                    </path>
                                                </svg>
                                            @elseif($platform === 'instagram')
                                                <svg class="w-6 h-6 text-[#E4405F]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Availability Section -->
                <div x-show="tab === 'availability'" x-transition class="space-y-6">
                    <!-- Weekly Schedule -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Weekly Schedule
                        </h2>

                        <div class="space-y-2">
                            @php
                                $availableDays = is_array($doctor->available_days)
                                    ? $doctor->available_days
                                    : (is_string($doctor->available_days)
                                        ? json_decode($doctor->available_days, true) ?? []
                                        : []);
                                $allDays = [
                                    'Monday',
                                    'Tuesday',
                                    'Wednesday',
                                    'Thursday',
                                    'Friday',
                                    'Saturday',
                                    'Sunday',
                                ];
                                $today = date('l');
                            @endphp

                            @foreach ($allDays as $day)
                                @php
                                    $isAvailable = in_array($day, $availableDays);
                                    $isToday = $day === $today;
                                @endphp
                                <div
                                    class="flex items-center justify-between p-3 rounded-lg {{ $isToday ? 'bg-brand-blue-50 border border-brand-blue-200' : 'bg-gray-50 border border-gray-100' }}">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full flex items-center justify-center {{ $isAvailable ? 'bg-brand-blue-100 text-brand-blue-600' : 'bg-gray-200 text-gray-500' }}">
                                            <span class="font-medium text-xs">{{ substr($day, 0, 2) }}</span>
                                        </div>
                                        <div>
                                            <div class="{{ $isAvailable ? 'text-gray-900' : 'text-gray-500' }}">
                                                {{ $day }}
                                                @if ($isToday)
                                                    <span
                                                        class="ml-2 bg-brand-blue-500 text-white text-xs px-2 py-0.5 rounded-full">Today</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div
                                            class="{{ $isAvailable ? 'text-brand-blue-600 font-medium' : 'text-gray-400' }}">
                                            {{ $isAvailable ? '9:00 AM - 6:00 PM' : 'Closed' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Appointment Info -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Appointment Information
                        </h2>
                        <div class="space-y-2 text-gray-700">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>30-minute consultations</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>₹{{ $doctor->fee }} consultation fee</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Section -->
                <div x-show="tab === 'location'" x-transition class="space-y-6">
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Clinic Location
                        </h2>

                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 bg-brand-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>

                            <div class="flex-grow">
                                @if($doctor->clinic_hospital_name)
                                    <h3 class="font-medium text-gray-900 mb-1">{{ $doctor->clinic_hospital_name }}</h3>
                                @endif
                                <p class="text-gray-700 mb-3">
                                    @if ($doctor->city && $doctor->state)
                                        {{ $doctor->city }}, {{ $doctor->state }}, India
                                        @if ($doctor->pincode)
                                            <br><span class="text-sm text-gray-600">PIN: {{ $doctor->pincode }}</span>
                                        @endif
                                    @else
                                        Purnea, Bihar, India
                                    @endif
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <a href="https://maps.google.com/?q=@if ($doctor->city && $doctor->state) {{ urlencode($doctor->city . ', ' . $doctor->state . ', India') }}@else Purnea,Bihar,India @endif"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg transition-colors text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        Get Directions
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div x-show="tab === 'reviews'" x-transition class="space-y-6">
                    <div class="bg-white rounded-lg border border-gray-200 p-4 md:p-6">
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Reviews
                        </h2>

                        <!-- Rating Summary -->
                        <div class="flex flex-col md:flex-row items-start gap-4 mb-6">
                            <div class="flex flex-col items-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <div class="text-3xl font-bold text-gray-900">{{ number_format($averageRating, 1) }}
                                </div>
                                <div class="flex text-amber-400 my-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($averageRating ?? 0) ? 'text-amber-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <div class="text-sm text-gray-600">Based on {{ $countFeedback }}
                                    {{ $countFeedback == 1 ? 'review' : 'reviews' }}
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="space-y-1.5">
                                    @php
                                        $ratingCounts = $doctor
                                            ->reviews()
                                            ->where('approved', true)
                                            ->selectRaw('rating, count(*) as count')
                                            ->groupBy('rating')
                                            ->pluck('count', 'rating')
                                            ->toArray();

                                        // Calculate percentages for star ratings
                                        $percentages = [];
                                        for ($i = 5; $i >= 1; $i--) {
                                            $count = $ratingCounts[$i] ?? 0;
                                            $percentages[$i] = $countFeedback > 0 ? ($count / $countFeedback) * 100 : 0;
                                        }
                                    @endphp

                                    @for ($i = 5; $i >= 1; $i--)
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-gray-600 w-8">{{ $i }}★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-brand-blue-500 h-2 rounded-full"
                                                    style="width: {{ $percentages[$i] }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-600 w-12">{{ $ratingCounts[$i] ?? 0 }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- Button to open the review modal -->
                            @if ($doctor)
                                <!-- In your main template -->
                                {{-- <button wire:click="$dispatch('openReviewModal', {doctorId: {{ $doctor->id }}})"
                                    class="bg-brand-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-brand-blue-600 transition-colors mb-6">
                                    Write a Review
                                </button> --}}
                            @endif

                            <!-- Reviews List -->
                            <div class="space-y-3">
                                @forelse($approvedReviews as $review)
                                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-medium text-gray-900">{{ $review->user->name }}</h3>
                                                <div class="flex text-amber-400 mt-1">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            <span
                                                class="text-gray-500 text-xs">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <p class="text-gray-600 text-sm">{{ $review->comment }}</p>
                                    </div>
                                @empty
                                    <div
                                        class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-200">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        <h3 class="text-gray-500 font-medium">No Reviews Yet</h3>
                                        <p class="text-gray-400 text-sm mt-1">Be the first to share your experience</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Review Modal -->
                            <livewire:public.review.review />
                        </div>

                        <!-- Add Review Button -->
                        <div class="mt-6 text-center">
                            @auth
                                <button wire:click="$dispatch('openReviewModal', {doctorId: {{ $doctor->id }}})"
                                    class="bg-brand-blue-500 hover:bg-brand-blue-600 text-white py-2 px-4 rounded-lg inline-flex items-center gap-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    Write a Review
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="bg-brand-blue-500 hover:bg-brand-blue-600 text-white py-2 px-4 rounded-lg inline-flex items-center gap-2 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    Login to Write a Review
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Doctors Section -->
            <section class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Related Doctors</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($relatedDoctors as $relatedDoctor)
                        <div
                            class="bg-white rounded-lg border border-gray-200 hover:border-brand-blue-300 transition-colors">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center overflow-hidden">
                                        @if ($relatedDoctor->image)
                                            <img src="{{ $relatedDoctor->image }}" alt="Dr. {{ $relatedDoctor->user->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span
                                                class="text-xl font-semibold text-brand-blue-600">{{ substr($relatedDoctor->user->name, 0, 1) }}</span>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-medium text-gray-900">Dr. {{ $relatedDoctor->user->name }}
                                        </h3>
                                        <p class="text-xs text-brand-blue-600">{{ $relatedDoctor->department->name }}
                                        </p>

                                        <div class="flex items-center gap-1 mt-1">
                                            @php $rating = $relatedDoctor->reviews_avg_rating ?? 0; @endphp
                                            <div class="flex text-amber-400">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3 h-3 {{ $i <= round($rating) ? 'text-amber-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-xs text-gray-600">
                                                {{ number_format($rating, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-3">
                                    <div class="text-sm">
                                        <span class="text-gray-900 font-medium">₹{{ $relatedDoctor->fee }}</span>
                                        <span class="text-gray-600"> fee</span>
                                    </div>
                                    <a wire:navigate href="{{ route('doctor-detail', ['slug' => $relatedDoctor->slug]) }}"
                                        class="text-brand-blue-500 hover:text-brand-blue-600 text-sm font-medium">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Floating Action Button (Mobile) -->
        <div class="fixed bottom-0 inset-x-0 z-50 md:hidden bg-white border-t border-gray-200 p-3">
            <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                class="block w-full bg-brand-blue-500 hover:bg-brand-blue-600 text-white py-3 rounded-lg font-medium text-center">
                Book Appointment
            </a>
        </div>
    </div>
</div>