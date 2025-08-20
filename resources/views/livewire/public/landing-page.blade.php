<div x-data @phone-modal-opened.window="$nextTick(()=>{ if($refs.phoneModal){ $refs.phoneModal.focus?.(); } })">

    {{-- {{ dd($doctors) }} --}}
    <!-- Hero with Search (existing component) -->
    <livewire:public.hero :doctors="$doctors" :departments="$departments" />

    <!-- Featured Specialties Section -->

    <section x-data="departmentsScroller()" x-init="init()" class="py-8 bg-brand-blue-50">

        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <h2 class="text-xl md:text-2xl font-semibold text-brand-blue-800 mb-1 md:mb-2">Browse by Specialties
                </h2>
                <p class="text-sm text-gray-600  mx-auto">Find the right specialist for your healthcare needs
                </p>
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
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 "
                    aria-label="Next slide"
                    :class="scroll >= scrollMax ? 'opacity-50 cursor-not-allowed' : 'opacity-100'"
                    :disabled="scroll >= scrollMax">
                    <svg class="w-6 h-6 text-brand-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>

                    </svg>
                </button>

                <!-- Departments Grid/Carousel -->
                <div x-ref="container"
                    class="grid grid-flow-col auto-cols-max md:auto-cols-min gap-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory scroll-smooth">
                    @foreach ($departments as $department)
                        <a wire:navigate href="{{ route('our-doctors', ['department_id' => $department->id]) }}"
                            wire:key="dept-{{ $department->id }}"
                            class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-md border border-brand-blue-200 px-6 py-5 min-w-[180px] snap-center transition-all duration-200">
                            <div class="mb-3">
                                <svg class="w-10 h-10 text-brand-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    <text x="12" y="16" text-anchor="middle" font-size="10"
                                        fill="currentColor">{{ substr($department->name, 0, 1) }}</text>
                                </svg>
                            </div>
                            <div class="font-semibold text-brand-blue-800 text-base mb-1">{{ $department->name }}</div>

                        </a>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-12">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3 bg-brand-blue-600 text-white rounded-lg font-medium hover:bg-brand-blue-700 transition-colors">

                    View All Specialties
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Top Doctors Section -->
    <section class="py-5 bg-white">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-4">
                <h2 class="text-xl md:text-2xl font-semibold text-brand-blue-800 mb-1">Our Top Specialists</h2>
                <p class="text-sm text-gray-600 mx-auto">
                    Connect with our verified specialists.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 sm:gap-6">
                @forelse ($doctors as $doctor)
                    <div class="bg-white rounded-xl border border-brand-blue-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden p-5 sm:p-4"
                        wire:key="doctor-{{ $doctor->id }}">
                        <!-- Doctor Image Section -->
                        <div class="relative h-48 overflow-hidden">
                            <a wire:navigate href="{{ route('doctor-detail', ['slug' => $doctor->slug]) }}">
                                <img src="{{ $doctor->image ? $doctor->image . '?tr=w-300,h-150,fo-auto,f-auto' : 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                    srcset="{{ $doctor->image ? $doctor->image . '?tr=w-200,h-100,fo-face,f-auto' : 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true&w=200' }} 200w,
                                     {{ $doctor->image ? $doctor->image . '?tr=w-300,h-200,fo-auto,f-auto' : 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true&w=400' }} 400w"
                                    sizes="(max-width: 640px) 100vw, (max-width: 1024px) 50vw, (max-width: 1280px) 33.33vw, 25vw"
                                    alt="Dr. {{ $doctor->user->name ?? '' }}"
                                    class="w-full object-cover transition-transform duration-500 hover:scale-105"
                                    loading="lazy">
                            </a>


                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-brand-blue-900/80 to-transparent p-3">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-brand-blue-600 bg-opacity-90 rounded-md text-sm sm:text-xs text-white">
                                        {{ $doctor->department->name ?? 'Specialist' }}
                                    </span>
                                    <div class="flex items-center text-white text-sm sm:text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="ml-1">{{ $doctor->reviews_avg_rating ? number_format($doctor->reviews_avg_rating, 1) : '5.0' }}
                                            ({{ $doctor->reviews_count ?? 0 }})
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Doctor Info Section -->
                        <div class="p-4">
                            <a href="{{ route('doctor-detail', $doctor->slug) }}">

                                <h3 class="text-lg font-semibold text-brand-blue-800">Dr. {{ $doctor->user->name }}
                                </h3>
                            </a>

                            <div class="mt-2 space-y-2 text-sm">
                                @if ($doctor->qualification)
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-brand-blue-600 mr-2 shrink-0 mt-0.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span
                                            class="text-gray-700">{{ is_array($doctor->qualification) ? $doctor->qualification[0] : json_decode($doctor->qualification, true)[0] ?? 'Specialist' }}</span>
                                    </div>
                                @endif

                                @if ($doctor->experience)
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-brand-blue-600 mr-2 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-gray-700">{{ $doctor->experience }} Experience</span>
                                    </div>
                                @endif

                                @if ($doctor->city)
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-brand-blue-600 mr-2 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-gray-700 truncate">{{ $doctor->city }}</span>
                                    </div>
                                @endif

                                @if ($doctor->clinic_hospital_name)
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-brand-blue-600 mr-2 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="text-gray-700 truncate">{{ $doctor->clinic_hospital_name }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <span class="flex items-center text-brand-blue-800 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-yellow-500 mr-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    ₹{{ $doctor->fee }}
                                </span>

                                @if ($doctor->languages_spoken)
                                    <span class="text-xs text-gray-500">
                                        Speaks:
                                        {{ implode(', ', array_slice(is_array($doctor->languages_spoken) ? $doctor->languages_spoken : json_decode($doctor->languages_spoken, true) ?? ['English'], 0, 2)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">
                                <a wire:navigate href="{{ route('doctor-detail', ['slug' => $doctor->slug]) }}"
                                    class="text-center py-2 px-3 bg-white border border-brand-blue-600 text-brand-blue-600 rounded-lg text-sm font-medium hover:bg-brand-blue-50 transition-colors">
                                    View Profile
                                </a>
                                <a wire:navigate href="{{ route('appointment', ['doctor_slug' => $doctor->slug]) }}"
                                    class="text-center py-2 px-3 bg-brand-blue-600 text-white rounded-lg text-sm font-medium hover:bg-brand-blue-700 transition-colors">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-brand-blue-300 mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-medium text-gray-700">No doctors available</h3>
                        <p class="text-gray-500 mt-2 max-w-sm mx-auto">We're currently updating our list of
                            specialists.
                            Please check back soon.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-10">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3 bg-brand-blue-600 text-white rounded-lg font-medium hover:bg-brand-blue-700 transition-colors shadow-md hover:shadow-lg">
                    Explore All Specialists
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- How Booking Works Section -->
    <section class="bg-brand-blue-50 py-5">
        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-xl font-semibold text-brand-blue-800 sm:text-2xl">How It Works</h2>
                <p class="mt-1  text-sm text-gray-600 mx-auto">
                    Book your doctor appointment in three simple steps
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-6 text-center border border-brand-blue-200 relative">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-semibold shadow-md">
                        1</div>
                    <div class="h-32 flex items-center justify-center">
                        <svg class="size-32" viewBox="-40 -40 480.00 480.00" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M222 76C210.988 106.84 171.627 128.31 147 132" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M236 44.053C123.346 20.1218 96.7679 144.026 136.104 167" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M256 54C302.745 75.4047 288.975 108.654 272.736 144" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M260.902 122C295.577 228.082 142 250.963 142 156.601" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M218.892 153C219.298 150.031 218.46 147.754 218 145" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M191 154C191 151.332 191 148.668 191 146" stroke="#003066" stroke-opacity="0.9"
                                    stroke-width="16" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path
                                    d="M60 345.501C60 309.522 83.3747 224.325 163.582 228.248C185.925 229.341 191.24 351.835 206.062 345.501C232 334.416 223.446 254.231 243.571 224.158C340.019 219.027 341 340.572 341 359"
                                    stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M296 271C288.365 253.665 267.103 230.409 247 228" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M163 232C139.27 246.396 128.966 267.837 120 292" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M93.0228 347.996C90.4525 330.039 91.6852 307.132 109.075 296.665C157.969 267.237 151.718 362.878 128.138 345.983"
                                    stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M293.07 271.039C321.891 269.785 283.781 299.392 290.907 273.038"
                                    stroke="#003066" stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M304 324.289C291.859 322.728 282.476 327.953 271 329" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                    </div>

                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Find a Doctor</h3>
                    <p class="mt-2 text-gray-600">Search for specialists by location, specialty or condition</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white rounded-xl p-6 text-center  border border-brand-blue-200 relative">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-yellow-500 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-semibold shadow-md">
                        2</div>
                    <div class="h-32 flex items-center justify-center">
                        <svg class="size-28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M13 17H21M17 21V13M10 11H4M20 9V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V19C4 20.1046 4.89543 21 6 21H10M15 3V7M9 3V7"
                                    stroke="#003066" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>

                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Book Appointment</h3>
                    <p class="mt-2 text-gray-600">Select a convenient time slot and book instantly</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-6 text-center border border-brand-blue-200 relative">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-brand-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-semibold shadow-md">
                        3</div>
                    <div class="h-32 flex items-center justify-center">
                        <svg class="size-28" fill="#003066" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M19.699219 1C17.665885 1 16 2.6658854 16 4.6992188L16 15.400391C16 17.433724 17.665885 19.099609 19.699219 19.099609L30.400391 19.099609C32.433724 19.099609 34.099609 17.433724 34.099609 15.400391L34.099609 4.6992188 A 1.0001 1.0001 0 0 0 34.097656 4.6328125C33.964738 2.6383346 32.334115 1 30.300781 1L19.699219 1 z M 19.699219 3L30.300781 3C31.265919 3 32.030467 3.7585597 32.099609 4.7617188L32.099609 15.400391C32.099609 16.367057 31.367057 17.099609 30.400391 17.099609L19.699219 17.099609C18.732552 17.099609 18 16.367057 18 15.400391L18 4.6992188C18 3.7325521 18.732552 3 19.699219 3 z M 24 6L24 9L21 9L21 11L24 11L24 14L26 14L26 11L29 11L29 9L26 9L26 6L24 6 z M 6.6992188 9C4.6658853 9 3 10.665885 3 12.699219L3 46L48 46L48 12.699219C48 10.665885 46.334115 9 44.300781 9L36 9L36 11L44.300781 11C45.267448 11 46 11.732552 46 12.699219L46 44L30 44L30 33L29 33L25.400391 33L20 33L20 44L5 44L5 12.699219C5 11.732552 5.7325521 11 6.6992188 11L14 11L14 9L6.6992188 9 z M 6.9589844 21.958984L6.9589844 30.041016L16.041016 30.041016L16.041016 21.958984L15 21.958984L10.900391 21.958984L6.9589844 21.958984 z M 19.958984 21.958984L19.958984 30.041016L30.041016 30.041016L30.041016 21.958984L29 21.958984L24.900391 21.958984L19.958984 21.958984 z M 33.958984 21.958984L33.958984 30.041016L43.041016 30.041016L43.041016 21.958984L42 21.958984L38.900391 21.958984L33.958984 21.958984 z M 9.0410156 24.041016L10.900391 24.041016L13.958984 24.041016L13.958984 27.958984L9.0410156 27.958984L9.0410156 24.041016 z M 22.041016 24.041016L24.900391 24.041016L27.958984 24.041016L27.958984 27.958984L22.041016 27.958984L22.041016 24.041016 z M 36.041016 24.041016L38.900391 24.041016L40.958984 24.041016L40.958984 27.958984L36.041016 27.958984L36.041016 24.041016 z M 6.9589844 32.958984L6.9589844 41.041016L16.041016 41.041016L16.041016 32.958984L15 32.958984L10.900391 32.958984L6.9589844 32.958984 z M 33.958984 32.958984L33.958984 41.041016L43.041016 41.041016L43.041016 32.958984L42 32.958984L38.900391 32.958984L33.958984 32.958984 z M 22 35L25.400391 35L28 35L28 44L22 44L22 35 z M 9.0410156 35.041016L10.900391 35.041016L13.958984 35.041016L13.958984 38.958984L9.0410156 38.958984L9.0410156 35.041016 z M 36.041016 35.041016L38.900391 35.041016L40.958984 35.041016L40.958984 38.958984L36.041016 38.958984L36.041016 35.041016 z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Visit Doctor</h3>
                    <p class="mt-2 text-gray-600">Get quality care from top healthcare professionals</p>
                </div>
            </div>
            <div class="text-center mt-12">
                @auth
                    <a wire:navigate href="{{ route('our-doctors') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500">
                        Find a Doctor
                        <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                @else
                    <button wire:click="$dispatch('open-phone-modal')"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500">
                        Find a Doctor
                        <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                @endauth
            </div>
        </div>
    </section>

    <!-- Fullscreen loader shown while showPhoneModal request is in-flight -->
    <x-fullscreen-loader message="Preparing verification…" wire:loading.flex wire:target="showPhoneModal" />

    <!-- Phone Modal: add x-ref so Alpine can focus after open -->
    {{-- @if ($showModal)
    <div x-ref="phoneModal" tabindex="-1"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 mx-4 transform transition-all duration-300"
            @click.away="showModal = false">
            @if (!$showVerification)
            <div>
                <div class="flex justify-between">
                    <h3 class="text-lg font-medium text-gray-900">Enter Your Phone Number</h3>
                    <button wire:click="ClosePhoneModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                    </button>

                </div>
                <p class="mt-2 text-sm text-gray-500">We'll send a verification code to this number.
                </p>

                <div class="mt-4">
                    <input wire:model="phone" type="tel"
                        class="block w-full rounded-md border-gray-300 border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                        placeholder="10-digit phone number">
                    @error('phone')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-5 sm:mt-6">
                    <button wire:click="submitPhone" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-blue-600 text-base font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 sm:text-sm">
                        Send Verification Code
                    </button>
                </div>
            </div>
            @else
            <div>
                <h3 class="text-lg font-medium text-gray-900">Verify Your Phone</h3>
                <p class="mt-2 text-sm text-gray-500">We sent a code to {{ $phone }}. Enter it
                    below.</p>
                <p class="mt-1 text-xs text-gray-400">Demo code: {{ $generatedCode }}</p>

                <div class="mt-4">
                    <input wire:model="verificationCode" type="text"
                        class="block w-full rounded-md border-gray-300 border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                        placeholder="4-digit code">
                    @error('verificationCode')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-5 sm:mt-6">
                    <button wire:click="verifyCode" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-blue-600 text-base font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 sm:text-sm">
                        Verify & Continue
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif --}}

    <livewire:public.phone.verify />

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</div>

<script>
    // Define Alpine factory once
    window.departmentsScroller = window.departmentsScroller || function () {
        return {
            scroll: 0,
            scrollMax: 0,
            itemWidth: 0,
            containerWidth: 0,
            init() {
                queueMicrotask(() => this.calculateWidths());
                window.addEventListener('resize', () => queueMicrotask(() => this.calculateWidths()));
            },
            calculateWidths() {
                if (!this.$refs.container) return;
                this.containerWidth = this.$refs.container.clientWidth;
                const first = this.$refs.container.children[0];
                this.itemWidth = (first ? first.offsetWidth : 0) + 24;
                this.scrollMax = Math.max(0, this.$refs.container.scrollWidth - this.containerWidth);
            },
            scrollNext() {
                this.scroll = Math.min(this.scroll + this.containerWidth, this.scrollMax);
                this.$refs.container.scrollTo({
                    left: this.scroll,
                    behavior: 'smooth'
                });
            },
            scrollPrev() {
                this.scroll = Math.max(this.scroll - this.containerWidth, 0);
                this.$refs.container.scrollTo({
                    left: this.scroll,
                    behavior: 'smooth'
                });
            },
        };
    };
</script>

<!-- Bridge Livewire server dispatch to a DOM CustomEvent so Alpine listeners (e.g. @phone-modal-opened.window) work -->
<script>
    if (typeof Livewire !== 'undefined') {
        Livewire.on('phone-modal-opened', () => {
            try {
                window.dispatchEvent(new CustomEvent('phone-modal-opened'));
            } catch (e) {
                // fallback for older browsers
                var ev = document.createEvent('Event');
                ev.initEvent('phone-modal-opened', true, true);
                window.dispatchEvent(ev);
            }
        });
    }
</script>