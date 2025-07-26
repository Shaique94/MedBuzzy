<div>
    <div x-data="{
        tab: 'about',
        doctor: {
            name: '{{ $doctor->user->name }}',
            department: '{{ $doctor->department->name ?? 'N/A' }}',
            fee: '{{ $doctor->fee ?? 'N/A' }}',
            experience: '{{ $doctor->experience ?? 'N/A' }}',
            qualification: '{{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification }}',
            about: '{{ $doctor->about ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet semper elit. Sed non magna vitae lorem consectetur accumsan.' }}',
            locations: [{
                name: 'Main Clinic',
                address: 'Purnea, Bihar, India',
                phone: '{{ $doctor->user->phone }}',
                directions_link: '#'
            }],
            reviews: [{
                    rating: 5,
                    author: 'Rahul Kumar',
                    date: '2023-10-15',
                    comment: 'Excellent doctor! Very friendly and knowledgeable.'
                },
                {
                    rating: 4,
                    author: 'Priya Sharma',
                    date: '2023-09-28',
                    comment: 'Good experience, would recommend.'
                }
            ],
            hours: {
                weekdays: '9:00 AM - 6:00 PM',
                saturday: '10:00 AM - 4:00 PM',
                sunday: 'Closed'
            },
            services: [{
                    name: 'Dental Fillings',
                    description: 'Treatment for cavities and tooth decay with durable filling materials.'
                },
                {
                    name: 'Teeth Whitening',
                    description: 'Professional teeth whitening treatments for a brighter smile.'
                }
            ]
        },
        getStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                stars += i <= rating ? '★' : '☆';
            }
            return stars;
        },
        formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        },
        activeLocation: 0,
        showAllServices: false
    }" class="min-h-screen bg-gradient-to-br from-teal-50 to-cyan-50 px-4 py-8">
        <div class="container mx-auto max-w-6xl">

            <!-- Doctor Profile Header -->
            <div class="bg-white rounded-2xl border border-teal-100 overflow-hidden mb-8">
                <div class="flex flex-col md:flex-row gap-6 p-6 md:p-8">
                    <!-- Doctor Image -->
                    <div class="flex-shrink-0 relative self-center md:self-start">
                        <div class="relative">
                            @if ($doctor->image)
                                <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                                            alt="Dr. {{ $doctor->user->name }}"
                                    class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white object-cover shadow-lg">
                            @else
                                <div
                                    class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-teal-100 border-4 border-white flex items-center justify-center shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-teal-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute -bottom-2 right-2 bg-teal-500 text-white rounded-full p-2 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-4 flex flex-wrap justify-center gap-2 md:hidden">
                            <div class="text-center bg-teal-50 rounded-lg p-2 min-w-[70px]">
                                <div class="text-lg font-bold text-teal-700">99%</div>
                                <div class="text-xs text-teal-600">Rating</div>
                            </div>
                            <div class="text-center bg-teal-50 rounded-lg p-2 min-w-[70px]">
                                <div class="text-lg font-bold text-teal-700">{{ $countFeadback }}</div>
                                <div class="text-xs text-teal-600">Feedback</div>
                            </div>
                            <div class="text-center bg-teal-50 rounded-lg p-2 min-w-[70px]">
                                <div class="text-lg font-bold text-teal-700" x-text="'₹' + doctor.fee"></div>
                                <div class="text-xs text-teal-600">Fee</div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Info -->
                    <div class="flex-grow">
                        <div class="mb-4">
                            <h1 class="text-2xl md:text-3xl font-bold text-teal-900" x-text="doctor.name"></h1>
                            <p class="text-teal-700">
                                {{ is_array($doctor->qualification) ? implode(', ', $doctor->qualification) : $doctor->qualification }}
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span
                                class="bg-teal-50 text-teal-800 px-3 py-1 rounded-full font-medium text-sm border border-teal-100"
                                x-text="doctor.department"></span>

                            <div class="flex items-center gap-1">
                                <div class="flex text-amber-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="ml-1 text-teal-800 font-medium">4.9</span>
                                    <span class="text-teal-500 ml-1 text-sm">(35 reviews)</span>
                                </div>
                            </div>

                            <div class="flex items-center text-sm text-teal-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span x-text="doctor.experience + ' years experience'"></span>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 text-teal-700 mb-4">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Purnea, Bihar</span>
                            <a href="#" class="text-teal-500 hover:underline ml-2 text-sm">Get Directions</a>
                        </div>

                        <!-- Services Tags -->
                        <div class="mb-6">
                            <h3 class="text-sm font-medium text-teal-800 mb-2">Specializations</h3>
                            <div class="flex flex-wrap gap-2">
                                <template
                                    x-for="service in doctor.services.slice(0, showAllServices ? doctor.services.length : 3)"
                                    :key="service.name">
                                    <span
                                        class="bg-cyan-50 text-cyan-800 text-xs px-3 py-1.5 rounded-full border border-cyan-100"
                                        x-text="service.name"></span>
                                </template>
                                <template x-if="doctor.services.length > 3 && !showAllServices">
                                    <button @click="showAllServices = true"
                                        class="bg-teal-50 text-teal-600 text-xs px-3 py-1.5 rounded-full border border-teal-100 hover:bg-teal-100">
                                        +<span x-text="doctor.services.length - 3"></span> more
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- Stats and CTA (Desktop) -->
                        <div
                            class="hidden md:flex flex-wrap items-center justify-between gap-4 mt-6 pt-4 border-t border-teal-100">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-700">99%</div>
                                <div class="text-teal-600 text-xs">Positive Feedback</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-700">{{ $countFeadback }}</div>
                                <div class="text-teal-600 text-xs">Patient Feedback</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-700" x-text="'₹' + doctor.fee"></div>
                                <div class="text-teal-600 text-xs">Consultation Fee</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-teal-700" x-text="doctor.experience"></div>
                                <div class="text-teal-600 text-xs">Years Experience</div>
                            </div>
                            <a wire:navigate href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                                class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-6 py-3 rounded-lg font-medium hover:from-teal-600 hover:to-cyan-600 transition shadow-sm">
                                BOOK APPOINTMENT
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Mobile CTA -->
                <div class="md:hidden p-4 bg-teal-50 border-t border-teal-100">
                    <a wire:navigate href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                        class="block w-full text-center bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-6 py-3 rounded-lg font-medium hover:from-teal-600 hover:to-cyan-600 transition shadow-sm">
                        BOOK APPOINTMENT
                    </a>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div class="bg-white rounded-xl border border-teal-100 mb-8 overflow-hidden sticky top-0 z-10 shadow-sm">
                <nav class="flex overflow-x-auto no-scrollbar">
                    <button @click="tab = 'about'"
                        :class="tab === 'about' ? 'border-teal-500 text-teal-700 bg-teal-50' :
                            'border-transparent text-teal-600 hover:text-teal-700 hover:bg-teal-50'"
                        class="px-6 py-4 font-medium border-b-2 whitespace-nowrap transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Overview
                    </button>
                    <button @click="tab = 'location'"
                        :class="tab === 'location' ? 'border-teal-500 text-teal-700 bg-teal-50' :
                            'border-transparent text-teal-600 hover:text-teal-700 hover:bg-teal-50'"
                        class="px-6 py-4 font-medium border-b-2 whitespace-nowrap transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Locations
                    </button>
                    <button @click="tab = 'reviews'"
                        :class="tab === 'reviews' ? 'border-teal-500 text-teal-700 bg-teal-50' :
                            'border-transparent text-teal-600 hover:text-teal-700 hover:bg-teal-50'"
                        class="px-6 py-4 font-medium border-b-2 whitespace-nowrap transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Reviews
                        <span class="bg-teal-100 text-teal-800 text-xs px-2 py-0.5 rounded-full"
                            x-text="doctor.reviews.length"></span>
                    </button>
                    <button @click="tab = 'hours'"
                        :class="tab === 'hours' ? 'border-teal-500 text-teal-700 bg-teal-50' :
                            'border-transparent text-teal-600 hover:text-teal-700 hover:bg-teal-50'"
                        class="px-6 py-4 font-medium border-b-2 whitespace-nowrap transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Availability
                    </button>
                </nav>
            </div>

            <!-- About Section -->
            <div x-show="tab === 'about'" x-transition class="bg-white rounded-xl border border-teal-100 p-6 mb-8">
                <h2 class="text-xl font-bold text-teal-800 mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    About Dr. <span x-text="doctor.name"></span>
                </h2>

                <div class="space-y-6">
                    <!-- Professional Summary -->
                    <div class="bg-teal-50 rounded-xl p-5 border border-teal-100">
                        <h3 class="font-semibold text-teal-800 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Professional Summary
                        </h3>
                        <p class="text-teal-700 leading-relaxed">
                            Dr. <span x-text="doctor.name"></span> is a <span x-text="doctor.department"></span>
                            specialist
                            with <span x-text="doctor.experience"></span> years of experience.
                            <span x-text="doctor.qualification ? 'Holding ' + doctor.qualification + ', ' : ''"></span>
                            they are dedicated to providing the highest standard of patient care.
                        </p>
                    </div>

                    <!-- Services Offered -->
                    <div class="bg-teal-50 rounded-xl p-5 border border-teal-100">
                        <h3 class="font-semibold text-teal-800 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Services Offered
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <template x-for="service in doctor.services" :key="service.name">
                                <div
                                    class="bg-white p-3 rounded-lg border border-teal-100 hover:border-teal-200 transition">
                                    <h4 class="font-medium text-teal-800 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span x-text="service.name"></span>
                                    </h4>
                                    <p class="text-sm text-teal-600 mt-1" x-text="service.description"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Education & Training -->
                    <div class="bg-teal-50 rounded-xl p-5 border border-teal-100">
                        <h3 class="font-semibold text-teal-800 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Education & Training
                        </h3>
                        <div class="space-y-3">
                            <template x-if="doctor.qualification">
                                <div class="flex items-start gap-3">
                                    <div class="bg-white p-2 rounded-full border border-teal-200 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-teal-700" x-text="doctor.qualification"></p>
                                </div>
                            </template>
                            <div class="flex items-start gap-3">
                                <div class="bg-white p-2 rounded-full border border-teal-200 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-teal-700">Board Certified in <span x-text="doctor.department"></span>
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="bg-white p-2 rounded-full border border-teal-200 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-teal-700">Continuing Medical Education in latest treatments</p>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Message -->
                    <div class="text-center pt-2">
                        <div class="inline-block bg-white p-5 rounded-xl border border-teal-100 max-w-lg">
                            <p class="italic text-teal-600">
                                "My philosophy is to treat every patient with compassion and respect, providing
                                personalized care tailored to your unique needs."
                            </p>
                            <p class="mt-3 font-medium text-teal-800">
                                — Dr. <span x-text="doctor.name"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Locations Section -->
            <div x-show="tab === 'location'" x-transition class="bg-white rounded-xl border border-teal-100 p-6 mb-8">
                <h2 class="text-xl font-bold text-teal-800 mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Practice Locations
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Location Selector (Mobile) -->
                    <div class="lg:hidden">
                        <label for="location-select" class="block text-sm font-medium text-teal-700 mb-2">Select
                            Location</label>
                        <select id="location-select" x-model="activeLocation"
                            class="w-full rounded-lg border-teal-200 text-teal-700 focus:border-teal-500 focus:ring-teal-500">
                            <template x-for="(location, index) in doctor.locations" :key="index">
                                <option :value="index" x-text="location.name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Location List (Desktop) -->
                    <div class="hidden lg:block space-y-3">
                        <template x-for="(location, index) in doctor.locations" :key="index">
                            <button @click="activeLocation = index"
                                :class="activeLocation === index ? 'bg-teal-100 border-teal-300' :
                                    'bg-white border-teal-100 hover:bg-teal-50'"
                                class="w-full text-left p-4 rounded-lg border transition flex items-center gap-3">
                                <div
                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-teal-50 border border-teal-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-teal-800" x-text="location.name"></h3>
                                    <p class="text-sm text-teal-600 truncate" x-text="location.address"></p>
                                </div>
                            </button>
                        </template>
                    </div>

                    <!-- Selected Location Details -->
                    <div class="lg:col-span-2">
                        <template x-for="(location, index) in doctor.locations" :key="index">
                            <div x-show="activeLocation === index"
                                class="bg-teal-50 rounded-xl overflow-hidden border border-teal-100">
                                <!-- Location Header -->
                                <div class="bg-teal-100 px-5 py-4">
                                    <h3 class="font-semibold text-teal-800 text-lg flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span x-text="location.name"></span>
                                    </h3>
                                </div>

                                <!-- Location Content -->
                                <div class="p-5">
                                    <div class="space-y-4">
                                        <!-- Address -->
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0 mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-teal-800 mb-1">Address</h4>
                                                <p class="text-teal-700" x-text="location.address"></p>
                                            </div>
                                        </div>

                                        <!-- Contact -->
                                        <div class="flex items-center gap-4">
                                            <div class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-teal-800 mb-1">Phone</h4>
                                                <p class="text-teal-700" x-text="location.phone"></p>
                                            </div>
                                        </div>

                                        <!-- Map Embed -->
                                        <div class="mt-6 rounded-lg overflow-hidden border border-teal-200">
                                            <div
                                                class="aspect-w-16 aspect-h-9 bg-teal-100 flex items-center justify-center">
                                                <div class="text-center p-6">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-12 w-12 mx-auto text-teal-400" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                    </svg>
                                                    <h4 class="mt-2 font-medium text-teal-800">Location Map</h4>
                                                    <p class="text-sm text-teal-600 mt-1">Interactive map would be
                                                        displayed here</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex flex-wrap gap-3 mt-6">
                                            <a :href="'https://maps.google.com/?q=' + encodeURIComponent(location.address)"
                                                target="_blank"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                </svg>
                                                View on Map
                                            </a>

                                            <a :href="location.directions_link" target="_blank"
                                                class="inline-flex items-center gap-2 px-4 py-2 border border-teal-500 text-teal-600 rounded-lg hover:bg-teal-50 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                                Get Directions
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="doctor.locations.length === 0">
                            <div class="text-center py-8 bg-teal-50 rounded-xl border border-teal-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-teal-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-teal-800">No locations available</h3>
                                <p class="mt-1 text-teal-600">Contact the doctor for location information</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div x-show="tab === 'reviews'" x-transition class="bg-white rounded-xl border border-teal-100 p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <h2 class="text-xl font-bold text-teal-800 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Patient Reviews
                    </h2>

                    <!-- Rating Summary -->
                    <div class="flex items-center gap-4 bg-teal-50 p-3 rounded-lg border border-teal-100">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-teal-700">4.9</div>
                            <div class="text-teal-600 text-sm">Average Rating</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-teal-700" x-text="doctor.reviews.length"></div>
                            <div class="text-teal-600 text-sm">Total Reviews</div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <template x-for="review in doctor.reviews" :key="review.date">
                        <div class="border border-teal-100 rounded-lg p-5 hover:border-teal-200 transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-medium text-teal-800" x-text="review.author"></h3>
                                    <div class="text-amber-400 text-lg" x-text="getStars(review.rating)"></div>
                                </div>
                                <span class="text-teal-500 text-sm" x-text="formatDate(review.date)"></span>
                            </div>
                            <p class="text-teal-700" x-text="review.comment"></p>
                        </div>
                    </template>

                    <div class="pt-4">
                        @auth
                            <!-- Show review form for logged in users -->
                            <button wire:click="$dispatch('reviewModal')"
                                class="inline-flex items-center gap-2 bg-teal-500 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-teal-600 transition shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Leave a Review
                            </button>
                            <livewire:public.review.review />
                        @else
                            <!-- Show login prompt for guests -->
                            <a href="{{ route('admin.login') }}"
                                class="inline-flex items-center gap-2 bg-teal-100 text-teal-700 px-5 py-2.5 rounded-lg font-medium hover:bg-teal-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Login to Leave a Review
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Business Hours Section -->
            <div x-show="tab === 'hours'" x-transition class="bg-white rounded-xl border border-teal-100 p-6 mb-8">
                <h2 class="text-xl font-bold text-teal-800 mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Availability & Hours
                </h2>

                <div class="bg-teal-50 rounded-xl p-5 border border-teal-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @php
                            $availableDays = is_array($doctor->available_days)
                                ? $doctor->available_days
                                : explode(',', $doctor->available_days);
                            $startTime = is_array($doctor->start_time) ? $doctor->start_time : [$doctor->start_time];
                            $endTime = is_array($doctor->end_time) ? $doctor->end_time : [$doctor->end_time];

                            $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $today = date('l'); // Gets current day name (e.g. "Monday")
                        @endphp

                        @foreach ($allDays as $day)
                            @php
                                $isAvailable = in_array($day, $availableDays);
                                $dayIndex = array_search($day, $allDays);
                                $timeSlot =
                                    isset($startTime[$dayIndex]) && isset($endTime[$dayIndex])
                                        ? date('g:i A', strtotime($startTime[$dayIndex])) .
                                            ' - ' .
                                            date('g:i A', strtotime($endTime[$dayIndex]))
                                        : null;
                                $isToday = $day === $today;
                            @endphp

                            <div
                                class="flex items-center p-4 rounded-lg {{ $isToday ? 'bg-white shadow-md border-2 border-teal-300' : ($isAvailable ? 'bg-white border border-teal-100' : 'bg-gray-50 border border-gray-100') }}">
                                <div
                                    class="flex-shrink-0 h-12 w-12 rounded-full flex items-center justify-center 
                                      {{ $isAvailable ? 'bg-teal-100 text-teal-600' : 'bg-gray-200 text-gray-500' }}">
                                    <span class="font-medium">{{ substr($day, 0, 3) }}</span>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="font-medium {{ $isAvailable ? 'text-teal-800' : 'text-gray-500' }}">
                                        {{ $day }}
                                        @if ($isToday)
                                            <span
                                                class="ml-2 bg-teal-500 text-white text-xs px-2 py-0.5 rounded-full">Today</span>
                                        @endif
                                    </div>
                                    <div class="{{ $isAvailable ? 'text-teal-600 font-medium' : 'text-gray-400' }}">
                                        {{ $isAvailable ? ($timeSlot ?: 'Available by appointment') : 'Closed' }}
                                    </div>
                                </div>
                                @if ($isAvailable)
                                    <div class="ml-2">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full 
                                              {{ $timeSlot ? 'bg-teal-100 text-teal-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ $timeSlot ? 'Scheduled' : 'On Call' }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="mt-6 bg-amber-50 rounded-xl p-5 border border-amber-100">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-amber-800 mb-1">Emergency Contact</h3>
                            <p class="text-amber-700">
                                For medical emergencies outside of business hours, please call the office at
                                <span class="font-medium">{{ $doctor->user->phone }}</span> and follow the prompts to
                                reach the
                                on-call provider.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>
