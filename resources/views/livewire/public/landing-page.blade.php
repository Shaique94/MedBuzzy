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
    window.addEventListener('resize', calculateWidths)" class="py-16 bg-brand-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-brand-blue-800 mb-4">Browse by Specialties</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find the right specialist for your healthcare
                    needs</p>
            </div>

            <div class="relative">
                <!-- Prev Button -->
                <button @click="scrollPrev"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-4 lg:-translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 focus:outline-none"
                    :class="scroll <= 0 ? 'opacity-50 cursor-not-allowed' : 'opacity-100'" :disabled="scroll <= 0">
                    <svg class="w-6 h-6 text-brand-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button @click="scrollNext"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 focus:outline-none"
                    :class="scroll >= scrollMax ? 'opacity-50 cursor-not-allowed' : 'opacity-100'"
                    :disabled="scroll >= scrollMax">
                    <svg class="w-6 h-6 text-brand-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            'General Medicine' => 'brand-blue',
                            'Cardiology' => 'brand-blue',
                            'Dermatology' => 'brand-blue',
                            'Pediatrics' => 'brand-blue',
                            'Orthopedics' => 'brand-blue',
                            'Gynecology' => 'brand-blue',
                            'Neurology' => 'brand-blue',
                            'Dentistry' => 'brand-blue',
                            'Psychiatry' => 'brand-blue',
                            'ENT' => 'brand-blue',
                        ];
                    @endphp

                    @foreach ($departments as $department)
                        @php
                            $name = $department->name;
                            $useYellow = random_int(0, 1) === 1; // Randomly choose between blue and yellow
                            $color = $useYellow ? 'brand-blue' : 'brand-blue';
                            $icon = $icons[$name] ?? array_values($icons)[random_int(0, count($icons) - 1)];
                            $doctorCount = count($department->doctors) ?? random_int(10, 50);
                        @endphp
                        <a wire:navigate href="{{ route('our-doctors', ['department_id' => $department->id]) }}"
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
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-12">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3 bg-brand-blue-600 text-white rounded-lg font-medium hover:bg-brand-blue-700 transition-colors">
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
                    <div class="bg-white rounded-xl border border-brand-blue-100 shadow-sm hover:shadow-md transition-all duration-300">
                        <!-- Doctor Header -->
                        <div class="relative bg-brand-blue-50 rounded-t-xl p-4 flex items-center">
                            <!-- Doctor Image/Initial -->
                            <div class="w-12 h-12 mr-3 bg-white rounded-full flex items-center justify-center border-2 border-white overflow-hidden shadow-sm">
                                @if ($doctor->image)
                                    <img src="{{ $doctor->image }}" class="w-full h-full object-cover" alt="{{ $doctor->user->name }}">
                                @else
                                    <span class="text-xl font-bold text-brand-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            
                            <!-- Doctor Name & Specialty -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-800 text-base truncate">{{ $doctor->user->name }}</h3>
                                <p class="text-brand-blue-600 text-xs font-medium truncate">{{ $doctor->department->name }}</p>
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
                               class="w-full block bg-brand-blue-500 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-brand-blue-600 transition-colors text-center">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 text-brand-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    class="inline-flex items-center px-6 py-3 bg-brand-blue-500 text-white rounded-lg font-medium hover:bg-brand-blue-600 transition-colors duration-200">
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
    <section class="bg-brand-blue-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-brand-blue-800 sm:text-4xl">How It Works</h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-600 mx-auto">
                    Book your doctor appointment in three simple steps
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold shadow-md">1</div>
                    <div class="h-32 flex items-center justify-center">
                        <svg class="size-32" viewBox="-40 -40 480.00 480.00" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M222 76C210.988 106.84 171.627 128.31 147 132" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M236 44.053C123.346 20.1218 96.7679 144.026 136.104 167" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M256 54C302.745 75.4047 288.975 108.654 272.736 144" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M260.902 122C295.577 228.082 142 250.963 142 156.601" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M218.892 153C219.298 150.031 218.46 147.754 218 145" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M191 154C191 151.332 191 148.668 191 146" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M60 345.501C60 309.522 83.3747 224.325 163.582 228.248C185.925 229.341 191.24 351.835 206.062 345.501C232 334.416 223.446 254.231 243.571 224.158C340.019 219.027 341 340.572 341 359" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M296 271C288.365 253.665 267.103 230.409 247 228" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M163 232C139.27 246.396 128.966 267.837 120 292" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M93.0228 347.996C90.4525 330.039 91.6852 307.132 109.075 296.665C157.969 267.237 151.718 362.878 128.138 345.983" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M293.07 271.039C321.891 269.785 283.781 299.392 290.907 273.038" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M304 324.289C291.859 322.728 282.476 327.953 271 329" stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Find a Doctor</h3>
                    <p class="mt-2 text-gray-600">Search for specialists by location, specialty or condition</p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-yellow-500 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold shadow-md">2</div>
                    <div class="h-32 flex items-center justify-center">
                       <svg class="size-28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 17H21M17 21V13M10 11H4M20 9V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V19C4 20.1046 4.89543 21 6 21H10M15 3V7M9 3V7" stroke="#003066" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Book Appointment</h3>
                    <p class="mt-2 text-gray-600">Select a convenient time slot and book instantly</p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
                    <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold shadow-md">3</div>
                    <div class="h-32 flex items-center justify-center">
                      <svg class="size-28" fill="#003066" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M19.699219 1C17.665885 1 16 2.6658854 16 4.6992188L16 15.400391C16 17.433724 17.665885 19.099609 19.699219 19.099609L30.400391 19.099609C32.433724 19.099609 34.099609 17.433724 34.099609 15.400391L34.099609 4.6992188 A 1.0001 1.0001 0 0 0 34.097656 4.6328125C33.964738 2.6383346 32.334115 1 30.300781 1L19.699219 1 z M 19.699219 3L30.300781 3C31.265919 3 32.030467 3.7585597 32.099609 4.7617188L32.099609 15.400391C32.099609 16.367057 31.367057 17.099609 30.400391 17.099609L19.699219 17.099609C18.732552 17.099609 18 16.367057 18 15.400391L18 4.6992188C18 3.7325521 18.732552 3 19.699219 3 z M 24 6L24 9L21 9L21 11L24 11L24 14L26 14L26 11L29 11L29 9L26 9L26 6L24 6 z M 6.6992188 9C4.6658853 9 3 10.665885 3 12.699219L3 46L48 46L48 12.699219C48 10.665885 46.334115 9 44.300781 9L36 9L36 11L44.300781 11C45.267448 11 46 11.732552 46 12.699219L46 44L30 44L30 33L29 33L25.400391 33L20 33L20 44L5 44L5 12.699219C5 11.732552 5.7325521 11 6.6992188 11L14 11L14 9L6.6992188 9 z M 6.9589844 21.958984L6.9589844 30.041016L16.041016 30.041016L16.041016 21.958984L15 21.958984L10.900391 21.958984L6.9589844 21.958984 z M 19.958984 21.958984L19.958984 30.041016L30.041016 30.041016L30.041016 21.958984L29 21.958984L24.900391 21.958984L19.958984 21.958984 z M 33.958984 21.958984L33.958984 30.041016L43.041016 30.041016L43.041016 21.958984L42 21.958984L38.900391 21.958984L33.958984 21.958984 z M 9.0410156 24.041016L10.900391 24.041016L13.958984 24.041016L13.958984 27.958984L9.0410156 27.958984L9.0410156 24.041016 z M 22.041016 24.041016L24.900391 24.041016L27.958984 24.041016L27.958984 27.958984L22.041016 27.958984L22.041016 24.041016 z M 36.041016 24.041016L38.900391 24.041016L40.958984 24.041016L40.958984 27.958984L36.041016 27.958984L36.041016 24.041016 z M 6.9589844 32.958984L6.9589844 41.041016L16.041016 41.041016L16.041016 32.958984L15 32.958984L10.900391 32.958984L6.9589844 32.958984 z M 33.958984 32.958984L33.958984 41.041016L43.041016 41.041016L43.041016 32.958984L42 32.958984L38.900391 32.958984L33.958984 32.958984 z M 22 35L25.400391 35L28 35L28 44L22 44L22 35 z M 9.0410156 35.041016L10.900391 35.041016L13.958984 35.041016L13.958984 38.958984L9.0410156 38.958984L9.0410156 35.041016 z M 36.041016 35.041016L38.900391 35.041016L40.958984 35.041016L40.958984 38.958984L36.041016 38.958984L36.041016 35.041016 z"></path></g></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Visit Doctor</h3>
                    <p class="mt-2 text-gray-600">Get quality care from top healthcare professionals</p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a wire:navigate href="{{ route('our-doctors') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500">
                    Find a Doctor
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
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