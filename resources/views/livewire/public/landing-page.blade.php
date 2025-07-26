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
                this.$nextTick(() => {
                    this.containerWidth = this.$refs.container.clientWidth;
                    this.itemWidth = this.$refs.container.children[0].offsetWidth + 24; // width + gap
                    this.scrollMax = this.$refs.container.scrollWidth - this.containerWidth;
                });
            },
            scrollNext() {
                this.scroll = Math.min(this.scroll + this.containerWidth, this.scrollMax);
                this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
            },
            scrollPrev() {
                this.scroll = Math.max(this.scroll - this.containerWidth, 0);
                this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
            }
        }" x-init="calculateWidths();
        window.addEventListener('resize', calculateWidths)" class="py-16 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Browse by Specialties</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find the right specialist for your healthcare
                        needs</p>
                </div>

                <div class="relative">
                    <!-- Prev Button -->
                    <button @click="scrollPrev"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 lg:-translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 focus:outline-none"
                        :class="scroll <= 0 ? 'opacity-50 cursor-not-allowed' : 'opacity-100'" :disabled="scroll <= 0">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Next Button -->
                    <button @click="scrollNext"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 focus:outline-none"
                        :class="scroll >= scrollMax ? 'opacity-50 cursor-not-allowed' : 'opacity-100'"
                        :disabled="scroll >= scrollMax">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <a href="{{ route('our-doctors', ['department_id' => $department->id]) }}"
                                class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 w-40 md:w-48 snap-start">
                                <div
                                    class="w-16 h-16 mx-auto mb-4 bg-{{ $color }}-100 rounded-full flex items-center justify-center group-hover:bg-{{ $color }}-200 transition-colors">
                                    <svg class="w-8 h-8 text-{{ $color }}-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                <h3
                                    class="font-semibold text-gray-800 group-hover:text-{{ $color }}-600 transition-colors">
                                    {{ $name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $doctorCount }} @if ($doctorCount > 1)
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
                    <a href="{{ route('our-doctors') }}"
                        class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition-colors">
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
        <section class="py-16  bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Our Expert Doctors
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Connect with top-tier, verified healthcare
                        professionals ready to provide exceptional care.</p>
                </div>

                <!-- Search Bar -->
               

                <!-- Doctors Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-4 sm:p-6">
                    @forelse ($doctors as $doctor)
                        <div
                            class="bg-white rounded-xl shadow overflow-hidden   flex flex-col border border-brand-teal-50">
                            <!-- Doctor Image/Placeholder -->
                            <div
                                class="relative h-60 bg-gradient-to-br from-brand-teal-100 to-brand-orange-100 flex items-center justify-center">
                                <div
                                    class="w-36 h-36 bg-white rounded-full flex items-center justify-center shadow-xl border-4 border-white overflow-hidden">
                                    @if ($doctor->image)
                                        <img src="{{ $doctor->image }}" class="w-full h-full object-cover"
                                            alt="{{ $doctor->user->name }}">
                                    @else
                                        <span
                                            class="text-4xl font-bold text-brand-teal-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                    @endif
                                </div>

                                <!-- Verified Badge -->
                                <span
                                    class="absolute top-4 right-4 bg-brand-teal-500 text-white text-xs px-3 py-1.5 rounded-full flex items-center font-semibold shadow-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Verified
                                </span>
                            </div>

                            <!-- Doctor Details -->
                            <div class="p-6 flex-grow flex flex-col">
                                <!-- Name and Department -->
                                <div class="mb-4">
                                    <h3 class="font-bold text-xl text-gray-800 truncate">{{ $doctor->user->name }}</h3>
                                    <p class="text-brand-teal-600 font-medium text-sm mt-1">
                                        {{ $doctor->department->name }}</p>
                                </div>

                                <!-- Rating -->
                                <div class="mb-4 flex items-center">
                                    <div class="flex text-brand-orange-400 mr-2">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-gray-500 text-sm">({{ rand(50, 500) }} reviews)</span>
                                </div>

                                <!-- Experience and Fees -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Experience</p>
                                        <p class="font-semibold text-gray-800 text-sm">
                                            {{ $doctor->experience ?? '12' }} years</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-xs uppercase tracking-wide">Fees</p>
                                        <p class="font-semibold text-gray-800 text-sm">₹ {{ $doctor->fee }}</p>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="mt-auto grid grid-cols-2 gap-3">
                                    <a href="{{ route('doctor-detail', ['doctor_id' => $doctor->id]) }}"
                                        class="text-center border-2 border-brand-teal-500 text-brand-teal-500 hover:bg-brand-teal-500 hover:text-white py-2 rounded-lg text-sm font-semibold transition-all duration-200">
                                        View Profile
                                    </a>
                                    <a href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                                        class="text-center bg-brand-teal-500 hover:bg-brand-teal-600 text-white py-2 rounded-lg text-sm font-semibold transition-all duration-200">
                                        Book Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 text-brand-teal-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <p class="text-xl text-gray-600 font-medium">No doctors found</p>
                            <p class="text-sm text-gray-500 mt-2">Try adjusting your search criteria</p>
                        </div>
                    @endforelse
                </div>
                <!-- View All Doctors Button -->
                <div class="text-center mt-12">
                    <a wire:navigate href="{{ route('our-doctors') }}"
                        class="inline-flex items-center px-6 py-3 bg-brand-teal-500 text-white rounded-lg font-medium hover:bg-brand-teal-600 transition-colors duration-200 shadow-md">
                        View All Doctors
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <livewire:public.about-us />

        <!-- Booking Process Section -->
        <!-- 4-Step Process Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-8 lg:px-16">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <!-- Right side - Visual -->
                    <div class="lg:w-1/2">
                        <div class="relative">
                            <!-- Main illustration background -->
                            <div
                                class="w-full h-96 bg-gradient-to-br from-teal-100 to-orange-100 rounded-3xl p-8 flex items-center justify-center">
                                <div class="text-center">
                                    <div
                                        class="w-32 h-32 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                        <svg class="w-16 h-16 text-teal-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-800 mb-2">Easy Appointment Booking</h4>
                                    <p class="text-gray-600">Book appointments with just a few clicks</p>
                                </div>
                            </div>

                            <!-- Floating elements -->
                            <div class="absolute -top-4 -right-4 w-20 h-20 bg-orange-200 rounded-2xl opacity-60"></div>
                            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-teal-200 rounded-2xl opacity-60"></div>

                            <!-- Stats floating cards -->
                            <div class="absolute top-8 -left-8 bg-white rounded-xl p-4 shadow-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">10k+</p>
                                        <p class="text-xs text-gray-600">Happy Patients</p>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute bottom-8 -right-8 bg-white rounded-xl p-4 shadow-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">500+</p>
                                        <p class="text-xs text-gray-600">Expert Doctors</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Left side - Content -->
                    <div class="lg:w-1/2">
                        <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Simple 4-Step Booking Process
                        </h2>
                        <p class="text-xl text-gray-600 mb-12 leading-relaxed">Book your appointment with ease through
                            our
                            streamlined process designed for your convenience</p>

                        <!-- Process Steps -->
                        <div class="space-y-8">
                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-teal-400 rounded-2xl flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">1</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Create Your Account</h3>
                                    <p class="text-gray-600">Sign up with your basic details and verify your identity
                                        for
                                        secure access</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-teal-600 rounded-2xl flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">2</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Choose Specialty</h3>
                                    <p class="text-gray-600">Browse through various medical specialties and find the
                                        right
                                        department</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-teal-400 rounded-2xl flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">3</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Select Your Doctor</h3>
                                    <p class="text-gray-600">View profiles, ratings, and availability of verified
                                        healthcare professionals</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-teal-600 rounded-2xl flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">4</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Confirm Appointment</h3>
                                    <p class="text-gray-600">Pick your preferred time slot and confirm your booking
                                        instantly</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <a href="{{ route('appointment') }}"
                                class="inline-flex items-center px-8 py-4 bg-teal-400 text-white font-semibold rounded-xl hover:bg-orange-700 transition-colors">
                                Start Booking Now
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <!-- Health Initiatives Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-8 lg:px-16">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Health Insights & Updates</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Stay informed with the latest healthcare news,
                        tips,
                        and insights from our medical experts</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Article Card 1 -->
                    <article
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                        <div class="relative">
                            <div
                                class="w-full h-64 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                <svg class="w-24 h-24 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-teal-400 text-white text-xs px-3 py-1 rounded-full font-medium">Featured</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600">Dr. Ruby Martin</span>
                                </div>
                                <span class="text-sm text-gray-500">Dec 4, 2024</span>
                            </div>
                            <h3
                                class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                                Digital Healthcare Revolution: Making Clinics Paperless</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">Discover how digital transformation is
                                revolutionizing healthcare delivery and improving patient care through technology.</p>
                            <a href="/blog/digital-healthcare"
                                class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>

                    <!-- Article Card 2 -->
                    <article
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                        <div class="relative">
                            <div
                                class="w-full h-64 bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                                <svg class="w-24 h-24 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-teal-600 text-white text-xs px-3 py-1 rounded-full font-medium">Popular</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600">Dr. Danish Omar</span>
                                </div>
                                <span class="text-sm text-gray-500">Dec 1, 2024</span>
                            </div>
                            <h3
                                class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                                Benefits of Online Doctor Consultations</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">Explore the advantages of virtual healthcare
                                consultations and how they're making medical care more accessible.</p>
                            <a href="/blog/online-consultations"
                                class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>

                    <!-- Article Card 3 -->
                    <article
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                        <div class="relative">
                            <div
                                class="w-full h-64 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full font-medium">Trending</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600">Dr. Sophia Williams</span>
                                </div>
                                <span class="text-sm text-gray-500">Nov 28, 2024</span>
                            </div>
                            <h3
                                class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">
                                5 Reasons to Choose Telemedicine</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">Learn why telemedicine is becoming the
                                preferred
                                choice for modern healthcare and patient convenience.</p>
                            <a href="/blog/telemedicine-benefits"
                                class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>

                <div class="text-center mt-16">
                    <a href="/blog"
                        class="inline-flex items-center px-8 py-4 bg-teal-600 text-white font-semibold rounded-xl hover:from-orange-700 hover:to-teal-700 transition-all duration-300">
                        View All Articles
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

    </div>

    <style>
        /* Hide scrollbar for carousel */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }
    </style>

</div>
