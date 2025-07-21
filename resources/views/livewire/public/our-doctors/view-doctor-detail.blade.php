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
            phone: '+91 1234567890'
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
                        <p class="text-teal-600">{{ $doctor->qualification ? implode(', ', $doctor->qualification) : 'N/A' }}</p>
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
                            <div class="text-3xl font-bold text-teal-700" x-text="doctor.reviews.length"></div>
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
            class="bg-white rounded-xl shadow-sm border border-teal-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-teal-800 mb-4">About Me</h2>
            <p class="text-teal-700 leading-relaxed" x-text="doctor.about"></p>
        </div>

        <!-- Locations Section -->
        <div x-show="tab === 'location'" x-transition
            class="bg-white rounded-xl shadow-sm border border-teal-100 p-6 mb-8">
            <h2 class="text-xl font-bold text-teal-800 mb-4">Location</h2>
            <template x-for="location in doctor.locations" :key="location.name">
                <div class="mb-6 last:mb-0">
                    <h3 class="font-medium text-teal-700 mb-2" x-text="location.name"></h3>
                    <p class="text-teal-600 mb-1" x-text="location.address"></p>
                    <p class="text-teal-600" x-text="'Phone: ' + location.phone"></p>
                    <a href="#" class="inline-block mt-3 text-teal-500 hover:underline">View on Map</a>
                </div>
            </template>
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
            <ul class="text-teal-700 leading-relaxed space-y-2">
                <li class="flex justify-between">
                    <span>Monday - Friday:</span>
                    <span x-text="doctor.hours.weekdays"></span>
                </li>
                <li class="flex justify-between">
                    <span>Saturday:</span>
                    <span x-text="doctor.hours.saturday"></span>
                </li>
                <li class="flex justify-between">
                    <span>Sunday:</span>
                    <span x-text="doctor.hours.sunday"></span>
                </li>
            </ul>
        </div>

        <!-- Services Section -->
        <div class="bg-white rounded-xl shadow-sm border border-teal-100 p-6">
            <h2 class="text-xl font-bold text-teal-800 mb-4">Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <template x-for="service in doctor.services" :key="service.name">
                    <div class="bg-teal-50 p-4 rounded-lg border border-teal-100">
                        <h3 class="font-medium text-teal-800 mb-2" x-text="service.name"></h3>
                        <p class="text-teal-600 text-sm" x-text="service.description"></p>
                    </div>
                </template>
            </div>
        </div>

    </div>
</div>
