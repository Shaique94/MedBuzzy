<div x-data="{
    tab: 'about',
    doctor: {
        name: '{{ $doctor->user->name }}',
        department: '{{ $doctor->department->name ?? 'N/A' }}',
        fee: '{{ $doctor->fee ?? 'N/A' }}',
        about: '{{ $doctor->about ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet semper elit. Sed non magna vitae lorem consectetur accumsan.' }}',
        locations: [{
            name: 'Main Clinic',
            address: 'Purnea, Bihar, India',
            phone: '{{$doctor->user->phone}}'
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
    }
}" class="min-h-screen bg-gradient-to-br from-teal-50 to-cyan-50 px-4 py-8">
    <div class="container mx-auto max-w-6xl">

        <!-- Doctor Profile Header -->
        <div class="bg-white rounded-xl shadow-sm border border-teal-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Doctor Image -->
                <div class="flex-shrink-0 relative">
                    @if ($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->user->name }}"
                            class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-teal-100 object-cover shadow-lg">
                        <div class="absolute -bottom-2 right-2 bg-orange-500 text-white rounded-full p-2 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @endif
                </div>


                <!-- Doctor Info -->
                <div class="flex-grow">
                    <div class="mb-4">
                        <h1 class="text-2xl md:text-3xl font-bold text-teal-800" x-text="doctor.name"></h1>
                        <p class="text-teal-600">
                            {{ $doctor->qualification ? $doctor->qualification : 'N/A' }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 mb-4">
                        <span class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full font-medium"
                            x-text="doctor.department"></span>

                        <div class="flex items-center gap-1">
                            <div class="flex text-orange-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="ml-1 text-teal-700 font-medium">4.9</span>
                                <span class="text-teal-400 ml-1">(35 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 text-teal-600 mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 12.414a4 4 0 00-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a1 1 0 00-1.414 1.414l4.243 4.243a6 6 0 01-8.486 8.486l-4.242-4.242a1 1 0 00-1.414 1.414l4.242 4.243a4 4 0 005.657-5.657l-4.243-4.243a1 1 0 00-1.414 1.414l4.243 4.243z">
                            </path>
                        </svg>
                        <span>Purnea, Bihar</span>
                        <a href="#" class="text-teal-500 hover:underline ml-2">Get Directions</a>
                    </div>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <template x-for="service in doctor.services" :key="service.name">
                            <span class="bg-cyan-100 text-cyan-800 text-sm px-3 py-1 rounded"
                                x-text="service.name"></span>
                        </template>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-teal-700">99%</div>
                            <div class="text-teal-600 text-sm">Positive Feedback</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-teal-700">{{ $countFeadback }}</div>
                            <div class="text-teal-600 text-sm">Feedback</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-teal-700" x-text="'₹' + doctor.fee"></div>
                            <div class="text-teal-600 text-sm">Consultation Fee</div>
                        </div>
                        <a wire:navigate href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                            class=" bg-teal-500 text-white px-8 py-3 rounded-lg font-medium shadow hover:from-teal-600 hover:to-cyan-600 transition">
                            BOOK APPOINTMENT
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="bg-white rounded-xl shadow-sm border border-teal-100 mb-8 overflow-hidden">
            <nav class="flex overflow-x-auto">
                <button @click="tab = 'about'"
                    :class="tab === 'about' ? 'border-teal-500 text-teal-700' :
                        'border-transparent text-teal-500 hover:text-teal-700'"
                    class="px-6 py-4 font-medium border-b-2 whitespace-nowrap">Overview</button>
                <button @click="tab = 'location'"
                    :class="tab === 'location' ? 'border-teal-500 text-teal-700' :
                        'border-transparent text-teal-500 hover:text-teal-700'"
                    class="px-6 py-4 font-medium border-b-2 whitespace-nowrap">Locations</button>
                <div>
                    <button @click="tab = 'reviews'"
                        :class="tab === 'reviews' ? 'border-teal-500 text-teal-700' :
                            'border-transparent text-teal-500 hover:text-teal-700'"
                        class="px-6 py-4 font-medium border-b-2 whitespace-nowrap">Reviews</button>
                </div>
                <button @click="tab = 'hours'"
                    :class="tab === 'hours' ? 'border-teal-500 text-teal-700' :
                        'border-transparent text-teal-500 hover:text-teal-700'"
                    class="px-6 py-4 font-medium border-b-2 whitespace-nowrap">Business Hours</button>
            </nav>
        </div>

        <!-- About Section -->
       <div x-show="tab === 'about'" x-transition
     class="bg-white rounded-xl shadow-md border border-teal-100 p-6 mb-8">
    <h2 class="text-xl font-bold text-teal-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        About Dr. <span x-text="doctor.user.name"></span>
    </h2>
    
    <div class="space-y-6 text-teal-700 leading-relaxed">
        <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
            <h3 class="font-semibold text-teal-800 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                My Professional Approach
            </h3>
            <p>
                With <span x-text="doctor.experience || 'several'"></span> years of experience in <span x-text="doctor.department.name || 'medicine'"></span>, 
                I am committed to providing compassionate, patient-centered care. My approach focuses on listening carefully 
                to understand each patient's unique needs and working together to develop the most effective treatment plan.
            </p>
        </div>
        
        <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
            <h3 class="font-semibold text-teal-800 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                My Philosophy
            </h3>
            <p>
                I believe in treating the whole person, not just the symptoms. My practice combines evidence-based medicine 
                with personalized attention to help patients achieve their best possible health outcomes. Every patient deserves 
                to be heard, understood, and treated with respect and dignity.
            </p>
        </div>
        
        <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
            <h3 class="font-semibold text-teal-800 mb-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Education & Qualifications
            </h3>
            <p>
                <template x-if="doctor.qualification">
                    <span x-text="'I hold ' + doctor.qualification + ' and '"></span>
                </template>
                I am dedicated to continuous learning through regular training and staying current with the latest 
                advancements in <span x-text="doctor.department.name || 'my field'"></span>. This commitment ensures my patients 
                receive the most up-to-date and effective care available.
            </p>
        </div>
        
        <div class="text-center pt-4">
            <p class="italic text-teal-600">
                "I look forward to partnering with you on your journey to better health."
            </p>
            <p class="mt-2 font-medium text-teal-800">
                — Dr. <span >{{$doctor->user->name}}</span>
            </p>
        </div>
    </div>
</div>

        <!-- Locations Section -->
       <div x-show="tab === 'location'" x-transition
     class="bg-white rounded-xl shadow-md border border-teal-100 p-6 mb-8">
    <h2 class="text-xl font-bold text-teal-800 mb-6 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Locations
    </h2>
    
    <div class="space-y-6">
        <template x-for="(location, index) in doctor.locations" :key="index">
            <div class="bg-teal-50 rounded-lg overflow-hidden border border-teal-100 hover:shadow-md transition-all duration-300">
                <!-- Location Header -->
                <div class="bg-teal-100 px-4 py-3 flex items-center justify-between">
                    <h3 class="font-semibold text-teal-800 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span x-text="location.name"></span>
                    </h3>
                    <span class="bg-white text-teal-600 text-xs px-2 py-1 rounded-full font-medium">
                        Location <span x-text="index + 1"></span>
                    </span>
                </div>
                
                <!-- Location Details -->
                <div class="p-4">
                    <div class="flex items-start gap-4 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-teal-700" x-text="location.address"></p>
                    </div>
                    
                    <div class="flex items-center gap-4 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <p class="text-teal-700" x-text="'Phone: ' + location.phone"></p>
                    </div>
                    
                    <!-- Additional Info -->
                    <template x-if="location.additional_info">
                        <div class="flex items-start gap-4 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-teal-700" x-text="location.additional_info"></p>
                        </div>
                    </template>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 mt-4 pt-3 border-t border-teal-100">
                        <a :href="'https://maps.google.com/?q=' + encodeURIComponent(location.address)" 
                           target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            View on Map
                        </a>
                        
                        <template x-if="location.directions_link">
                            <a :href="location.directions_link" 
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 border border-teal-500 text-teal-600 rounded-lg hover:bg-teal-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                Get Directions
                            </a>
                        </template>
                        
                        <template x-if="location.website">
                            <a :href="location.website" 
                               target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2 border border-teal-500 text-teal-600 rounded-lg hover:bg-teal-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9-3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                Visit Website
                            </a>
                        </template>
                    </div>
                </div>
            </div>
        </template>
        
        <template x-if="doctor.locations.length === 0">
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-teal-800">No locations available</h3>
                <p class="mt-1 text-teal-600">Contact the doctor for location information</p>
            </div>
        </template>
    </div>
</div>

        <!-- Reviews Section -->
        <div x-show="tab === 'reviews'" x-transition
            class="bg-white rounded-xl shadow-sm border border-teal-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-teal-800 mb-4">Patient Reviews</h2>

            <div class="space-y-6">
                <template x-for="review in doctor.reviews" :key="review.date">
                    <div class="border-b border-teal-100 pb-6 last:border-0 last:pb-0">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-medium text-teal-800" x-text="review.author"></h3>
                                <div class="text-orange-400" x-text="getStars(review.rating)"></div>
                            </div>
                            <span class="text-teal-500 text-sm" x-text="formatDate(review.date)"></span>
                        </div>
                        <p class="text-teal-700" x-text="review.comment"></p>
                    </div>
                </template>


                <div class="pt-4 space-y-5">
                    @auth
                        <!-- Show review form for logged in users -->
                        <button wire:click="$dispatch('reviewModal')"
                            class="bg-teal-100 text-teal-700 px-4 py-2 rounded-lg font-medium hover:bg-teal-200 transition">
                            Leave a Review
                        </button>
                        <livewire:public.review.review />
                    @else
                        <!-- Show login prompt for guests -->
                        <a href="{{ route('login') }}"
                            class="inline-block bg-teal-100 text-teal-700 px-4 py-2 rounded-lg font-medium hover:bg-teal-200 transition">
                            Login to Leave a Review
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Business Hours Section -->

       <div x-show="tab === 'hours'" x-transition
     class="bg-white rounded-xl shadow-sm border border-teal-100 p-6 mb-8">
    <h2 class="text-xl font-bold text-teal-800 mb-4">Business Hours</h2>
    
    <div class="rounded-lg p-4 border border-teal-100">
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
                    $timeSlot = isset($startTime[$dayIndex]) && isset($endTime[$dayIndex])
                        ? date('g:i A', strtotime($startTime[$dayIndex])) . ' - ' . date('g:i A', strtotime($endTime[$dayIndex]))
                        : null;
                    $isToday = ($day === $today);
                @endphp

                <div class="flex items-center p-3 rounded-lg {{ $isAvailable ? 'bg-white shadow-sm border border-teal-200' : 'bg-gray-50' }} relative">
                    @if($isToday)
                        <span class="absolute -top-2 -right-2 bg-teal-500 text-white text-xs px-2 py-1 rounded-full">
                            Today
                        </span>
                    @endif
                    
                    <div class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center 
                              {{ $isAvailable ? 'bg-teal-100 text-teal-600' : 'bg-gray-200 text-gray-500' }}">
                        <span class="font-medium text-sm">{{ substr($day, 0, 1) }}</span>
                    </div>
                    <div class="ml-4 flex-1">
                        <div class="font-medium text-sm {{ $isAvailable ? 'text-teal-800' : 'text-gray-500' }}">
                            {{ $day }}
                        </div>
                        <div class="text-sm {{ $isAvailable ? 'text-teal-600 font-medium' : 'text-gray-400' }}">
                            {{ $isAvailable ? ($timeSlot ?: 'Available') : 'Closed' }}
                        </div>
                    </div>
                    @if ($isAvailable)
                        <div class="ml-2">
                            <span class="px-2 py-1 text-xs rounded-full 
                                      {{ $timeSlot ? 'bg-teal-100 text-teal-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $timeSlot ? 'Scheduled' : 'On Call' }}
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @if(count(array_filter($availableDays)) === 0)
        <div class="text-center py-4 text-teal-600">
            No business hours available
        </div>
    @endif
</div>
     

    </div>
</div>
