<div>
    <div>
    <!-- Hero with Search (existing component) -->
    <livewire:public.hero />

    <!-- Featured Specialties Section -->
   <section x-data="{
    scroll: 0,
    scrollMax: 0,
    itemWidth: 0,
    containerWidth: 0,
    calculateWidths() {
        // Use $nextTick equivalent in Alpine
        setTimeout(() => {
            this.containerWidth = this.$refs.container.clientWidth;
            this.itemWidth = this.$refs.container.children[0]?.offsetWidth + 24 || 0;
            this.scrollMax = Math.max(this.$refs.container.scrollWidth - this.containerWidth, 0);
        }, 50); // Small delay to ensure DOM is ready
    },
    scrollNext() {
        this.scroll = Math.min(this.scroll + this.containerWidth, this.scrollMax);
        this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
    },
    scrollPrev() {
        this.scroll = Math.max(this.scroll - this.containerWidth, 0);
        this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
    }
}" 
x-init="calculateWidths(); 
        $watch('scroll', () => console.log('Scroll position:', scroll));
        window.addEventListener('resize', () => calculateWidths())" 
class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Browse by Specialties</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find the right specialist for your healthcare
                    needs</p>
            </div>

            <div class="relative">
                <!-- Prev Button -->
                <button @click="scrollPrev"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 lg:-translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 "
                    :class="scroll <= 0 ? 'opacity-50 cursor-not-allowed' : 'opacity-100'" :disabled="scroll <= 0"
                   aria-label="Previous slide"
    :aria-disabled="scroll <= 0">
                    <svg class="w-6 h-6 text-teal-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button @click="scrollNext"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 "
                    :class="scroll >= scrollMax ? 'opacity-50 cursor-not-allowed' : 'opacity-100'"
                    :disabled="scroll >= scrollMax"
                    aria-label="Next slide"
    :aria-disabled="scroll >= scrollMax">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"  aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </button>

                <!-- Departments Grid/Carousel -->
                <div x-ref="container"
                    class="grid grid-flow-col auto-cols-max md:auto-cols-min gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory scroll-smooth">
                    @php
                        // Define icons and colors for departments (fallbacks if needed)
                        $icons = [
                            'General Medicine' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>',
                            'Cardiology' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>',
                            'Dermatology' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
                            'Pediatrics' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>',
                            'Orthopedics' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>',
                            'Gynecology' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 15H7.5C6.12 15 5 16.12 5 17.5M16 15h.5c1.38 0 2.5 1.12 2.5 2.5M7 11a3 3 0 116 0 3 3 0 01-6 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.75l-1 1.5h2l-1 1.5"></path>',
                            'Neurology' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>',
                            'Dentistry' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>',
                            'Psychiatry' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
                            'ENT' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>',
                        ];

                        $colors = [
                            'General Medicine' => 'blue',
                            'Cardiology' => 'red',
                            'Dermatology' => 'pink',
                            'Pediatrics' => 'green',
                            'Orthopedics' => 'orange',
                            'Gynecology' => 'purple',
                            'Neurology' => 'teal',
                            'Dentistry' => 'indigo',
                            'Psychiatry' => 'yellow',
                            'ENT' => 'emerald',
                        ];
                    @endphp

                    @foreach ($departments as $department)
                        @php
                            $name = $department->name;
                            $color = $colors[$name] ?? array_values($colors)[random_int(0, count($colors) - 1)];
                            $icon = $icons[$name] ?? array_values($icons)[random_int(0, count($icons) - 1)];
                            $doctorCount = count($department->doctors) ?? random_int(10, 50);
                        @endphp
                            <a wire:navigate href="{{ route('our-doctors', ['department' => $department->slug]) }}"
                            class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 w-40 md:w-48 snap-start">
                            <div
                                class="w-16 h-16 mx-auto mb-4 bg-{{ $color }}-100 rounded-full flex items-center justify-center group-hover:bg-{{ $color }}-200 transition-colors">
                                <svg class="w-8 h-8 text-{{ $color }}-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icon !!}
                                </svg>
                            </div>
                            <h3
                                class="font-semibold text-gray-900 group-hover:text-{{ $color }}-800 transition-colors">
                                {{ $name }}</h3>
                            <p class="text-sm text-gray-700 mt-1">{{ $doctorCount }} @if ($doctorCount > 1)
                                    Doctors
                                @else
                                    Doctor
                                @endif
                            </p>
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-12">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3  bg-teal-700 text-white rounded-lg font-medium hover:bg-teal-700 transition-colors">
                    View All Specialties
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Top Doctors Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Our Expert Doctors
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Connect with top-tier, verified healthcare
                    professionals ready to provide exceptional care.</p>
            </div>

            <!-- Doctors Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4 sm:p-6">
                @forelse ($doctors as $doctor)
                    <div class="bg-white rounded-xl border border-brand-teal-100 shadow-sm hover:shadow-md transition-all duration-300">
                        <!-- Doctor Header -->
                        <div class="relative bg-brand-teal-50 rounded-t-xl p-4 flex items-center">
                            <!-- Doctor Image/Initial -->
                            <div class="w-12 h-12 mr-3 bg-white rounded-full flex items-center justify-center border-2 border-white overflow-hidden shadow-sm">
                                @if ($doctor->image)
                                    <img src="{{ $doctor->image }}" class="w-full h-full object-cover" alt="{{ $doctor->user->name }}">
                                @else
                                    <span class="text-xl font-bold text-brand-teal-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <!-- Doctor Name & Specialty -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-800 text-base truncate">{{ $doctor->user->name }}</h3>
                                <p class="text-brand-teal-800 text-xs font-medium truncate">{{ $doctor->department->name }}</p>
                            </div>
                            
                            <!-- Rating Badge -->
                            <div class="flex items-center bg-white px-1.5 py-0.5 rounded-md shadow-sm border border-gray-100">
                                <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs font-medium ml-1">{{ number_format($doctor->reviews()->where('approved', true)->avg('rating') ?? 0, 1) }}</span>
                            </div>
                        </div>

                        <!-- Doctor Details -->
                        <div class="p-4">
                            <!-- Availability -->
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 mb-1">Next Available:</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-800">Contact for availability</p>
                                </div>
                            </div>
                            
                            <!-- Stats -->
                            <div class="grid grid-cols-2 gap-2 mb-3">
                                <div class="bg-gray-50 rounded p-2 text-center">
                                    <div class="font-medium text-gray-800 text-sm">{{ $doctor->experience ?? '3+' }} yrs</div>
                                    <div class="text-xs text-gray-500">Experience</div>
                                </div>
                                <div class="bg-gray-50 rounded p-2 text-center">
                                    <div class="font-medium text-gray-800 text-sm">By Appt</div>
                                    <div class="text-xs text-gray-500">Consultation</div>
                                </div>
                            </div>

                            <!-- Book Button -->
                            <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                               class="w-full block bg-teal-800 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-brand-teal-600 transition-colors text-center">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-brand-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xl text-gray-600 font-medium">No doctors found</p>
                        <p class="text-sm text-gray-500 mt-2">Try adjusting your search criteria</p>
                    </div>
                @endforelse
            </div>
            <!-- View All Doctors Button -->
            <div class="text-center mt-12">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3 bg-brand-teal-700 text-white rounded-lg font-medium hover:bg-brand-teal-800 transition-colors duration-200">
                    View All Doctors
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    {{-- <livewire:public.about-us /> --}}


    <!-- How Booking Works Section -->
    <section class="py-16 md:py-24 bg-brand-teal-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-brand-teal-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-brand-orange-400 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-brand-teal-300 rounded-full blur-2xl"></div>
        </div>
        
        <div class="container mx-auto px-4 md:px-6 lg:px-16 relative z-10">
            <div class="flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-20">
                <!-- Left: Process Steps -->
                <div class="w-full lg:w-1/2">
                    <div class="text-center lg:text-left mb-8 lg:mb-12">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                            How <span class="text-brand-teal-600">Booking</span> Works
                        </h2>
                        <p class="text-lg md:text-xl text-gray-600 max-w-lg mx-auto lg:mx-0">
                            Get started in minutes with our seamless, patient-friendly process designed for modern healthcare.
                        </p>
                    </div>

                    <!-- Mobile: Cards Layout -->
                    <div class="lg:hidden grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-white/50 hover:bg-white/90 transition-all duration-300 group">
                            <div class="w-16 h-16 bg-brand-teal-500 text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-4 group-hover:scale-110 transition-transform">
                                1
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Sign Up / Login</h3>
                            <p class="text-gray-600 text-sm">Create your account or log in securely to access all features.</p>
                        </div>
                        
                        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-white/50 hover:bg-white/90 transition-all duration-300 group">
                            <div class="w-16 h-16 bg-brand-orange-500 text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-4 group-hover:scale-110 transition-transform">
                                2
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Pick Specialty</h3>
                            <p class="text-gray-600 text-sm">Browse specialties and select the department that fits your needs.</p>
                        </div>
                        
                        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-white/50 hover:bg-white/90 transition-all duration-300 group">
                            <div class="w-16 h-16 bg-brand-teal-500 text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-4 group-hover:scale-110 transition-transform">
                                3
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Choose Doctor</h3>
                            <p class="text-gray-600 text-sm">View doctor profiles, ratings, and availability to make your choice.</p>
                        </div>
                        
                        <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-white/50 hover:bg-white/90 transition-all duration-300 group">
                            <div class="w-16 h-16 bg-brand-orange-500 text-white rounded-2xl flex items-center justify-center font-bold text-xl mb-4 group-hover:scale-110 transition-transform">
                                4
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Book Instantly</h3>
                            <p class="text-gray-600 text-sm">Select a time slot and confirm your appointment in one click.</p>
                        </div>
                    </div>

                    <!-- Desktop: Timeline Layout -->
                    <div class="hidden lg:block">
                        <div class="relative">
                            <!-- Timeline Line -->
                            <div class="absolute left-6 top-6 bottom-6 w-1 bg-brand-teal-200 rounded-full"></div>
                            
                            <!-- Timeline Items -->
                            <div class="space-y-12">
                                <div class="flex items-start group">
                                    <div class="relative z-10 w-12 h-12 bg-brand-teal-500 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-300">
                                        1
                                    </div>
                                    <div class="ml-8 bg-white/60 backdrop-blur-sm rounded-2xl p-6 flex-1 border border-white/50 group-hover:bg-white/80 group-hover:border-brand-teal-200 transition-all duration-300">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-6 h-6 text-brand-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            Sign Up / Login
                                        </h3>
                                        <p class="text-gray-600">Create your account or log in securely to access all features and manage your health records.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="relative z-10 w-12 h-12 bg-brand-orange-500 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-300">
                                        2
                                    </div>
                                    <div class="ml-8 bg-white/60 backdrop-blur-sm rounded-2xl p-6 flex-1 border border-white/50 group-hover:bg-white/80 group-hover:border-brand-orange-200 transition-all duration-300">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-6 h-6 text-brand-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            Pick a Specialty
                                        </h3>
                                        <p class="text-gray-600">Browse through various medical specialties and select the department that best fits your health needs.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="relative z-10 w-12 h-12 bg-brand-teal-500 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-300">
                                        3
                                    </div>
                                    <div class="ml-8 bg-white/60 backdrop-blur-sm rounded-2xl p-6 flex-1 border border-white/50 group-hover:bg-white/80 group-hover:border-brand-teal-200 transition-all duration-300">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-6 h-6 text-brand-teal-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Choose a Doctor
                                        </h3>
                                        <p class="text-gray-600">View detailed doctor profiles, patient ratings, and real-time availability to make your choice.</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start group">
                                    <div class="relative z-10 w-12 h-12 bg-brand-orange-500 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg group-hover:scale-110 group-hover:shadow-xl transition-all duration-300">
                                        4
                                    </div>
                                    <div class="ml-8 bg-white/60 backdrop-blur-sm rounded-2xl p-6 flex-1 border border-white/50 group-hover:bg-white/80 group-hover:border-brand-orange-200 transition-all duration-300">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-6 h-6 text-brand-orange-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Book Instantly
                                        </h3>
                                        <p class="text-gray-600">Select your preferred time slot and confirm your appointment instantly with secure payment options.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="text-center lg:text-left mt-12">
                        <a wire:navigate href="{{ route('appointment') }}"
                            class="inline-flex items-center px-8 py-4 bg-teal-700 text-white font-bold rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 group">
                            <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Start Booking Now
                            <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Interactive Illustration -->
                <div class="w-full lg:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-lg">
                        <!-- Main Card -->
                        <div class="relative bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-8 border border-white/50 hover:bg-white/90 transition-all duration-500 group">
                            <!-- Header Icon -->
                            <div class="w-24 h-24 bg-brand-teal-500 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <div class="text-center">
                                <h4 class="text-2xl font-bold text-gray-800 mb-3">Book in Seconds</h4>
                                <p class="text-gray-600 leading-relaxed">Our platform makes healthcare access fast, secure, and effortless for patients worldwide.</p>
                            </div>

                            <!-- Feature Pills -->
                            <div class="flex flex-wrap justify-center gap-2 mt-6">
                                <span class="bg-brand-teal-100 text-brand-teal-700 px-3 py-1 rounded-full text-sm font-medium">Instant Booking</span>
                                <span class="bg-brand-orange-100 text-brand-orange-700 px-3 py-1 rounded-full text-sm font-medium">Secure Payment</span>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">24/7 Access</span>
                            </div>
                        </div>

                        <!-- Floating Stats -->
                        <div class="absolute -top-6 -left-6 bg-white/90 backdrop-blur-md rounded-2xl p-4 shadow-xl border border-white/50 animate-float-1">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-xl">10k+</p>
                                    <p class="text-sm text-gray-600">Happy Patients</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -right-6 bg-white/90 backdrop-blur-md rounded-2xl p-4 shadow-xl border border-white/50 animate-float-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-xl">500+</p>
                                    <p class="text-sm text-gray-600">Expert Doctors</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute top-1/2 -right-4 bg-white/90 backdrop-blur-md rounded-2xl p-3 shadow-xl border border-white/50 animate-float-3">
                            <div class="text-center">
                                <p class="font-bold text-gray-800 text-lg">99%</p>
                                <p class="text-xs text-gray-600">Success Rate</p>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="absolute -top-8 right-4 w-16 h-16 bg-brand-orange-400 rounded-2xl opacity-60 blur-sm"></div>
                        <div class="absolute -bottom-8 -left-4 w-20 h-20 bg-brand-teal-400 rounded-2xl opacity-60 blur-sm"></div>
                        <div class="absolute top-1/4 -left-8 w-12 h-12 bg-blue-400 rounded-full opacity-50 blur-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom CSS -->
    <style>
        /* Custom animations for floating elements */
        @keyframes float-1 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-8px) rotate(1deg); }
            66% { transform: translateY(4px) rotate(-1deg); }
        }
        
        @keyframes float-2 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(6px) rotate(-1deg); }
            66% { transform: translateY(-4px) rotate(1deg); }
        }
        
        @keyframes float-3 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(0.5deg); }
        }
        
        .animate-float-1 {
            animation: float-1 6s ease-in-out infinite;
        }
        
        .animate-float-2 {
            animation: float-2 8s ease-in-out infinite;
        }
        
        .animate-float-3 {
            animation: float-3 4s ease-in-out infinite;
        }

        /* Hide scrollbar for carousel */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</div>
</div>
