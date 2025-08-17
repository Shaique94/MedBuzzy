<div class="">
    <!-- Hero with Search (existing component) -->
    <livewire:public.hero />

    <!-- Featured Specialties Section -->

    <section
        x-data="departmentsScroller()"
        x-init="init()"
        class="py-8 bg-brand-blue-50"
    >

        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-semibold text-brand-blue-800 mb-4">Browse by Specialties</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find the right specialist for your healthcare needs
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
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-4 lg:translate-x-8 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 " aria-label="Next slide"
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
                            class="flex flex-col items-center bg-white rounded-xl shadow hover:shadow-md border border-brand-blue-100 px-6 py-5 min-w-[180px] snap-center transition-all duration-200">
                            <div class="mb-3">
                                <svg class="w-10 h-10 text-brand-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                    <text x="12" y="16" text-anchor="middle" font-size="10"
                                        fill="currentColor">{{ substr($department->name, 0, 1) }}</text>
                                </svg>
                            </div>
                            <div class="font-semibold text-brand-blue-800 text-base mb-1">{{ $department->name }}</div>
                            <div class="text-xs text-gray-500">{{ $department->doctors->count() ?? 0 }} doctors</div>

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
    <section class="py-8 bg-white">
        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 mb-4 tracking-tight">Our Expert Doctors</h2>
                <p class="text-lg text-gray-600  mx-auto">Connect with top-tier, verified healthcare professionals ready to provide exceptional care.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-6 p-4 sm:p-6">
                @forelse ($doctors as $doctor)

                    <div class="bg-white rounded-xl border border-brand-blue-100 shadow-sm hover:shadow-md transition-all duration-300"
                        wire:key="doctor-{{ $doctor->id }}">
                        <div class="relative bg-brand-blue-50 rounded-t-xl p-4 flex items-center">
                            <img src="{{ $doctor->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor->user->name) . '&background=random&rounded=true' }}"
                                alt="Dr. {{ $doctor->user->name }}"
                                class="w-16 h-16 rounded-full border-4 border-white object-cover shadow" loading="lazy">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Dr. {{ $doctor->user->name }}</h3>
                                <p class="text-brand-blue-600 text-xs font-medium">
                                    {{ $doctor->department->name ?? 'General' }}</p>
                                <div class="flex items-center mt-1">
                                    <div class="flex text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-1 text-xs text-gray-600">
                                        ({{ $doctor->reviews_count ?? 0 }})
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-brand-blue-800">{{ $doctor->experience ?? '5+' }} yrs
                                    exp.</span>
                                <span class="font-medium text-brand-blue-800">₹{{ $doctor->fee }}</span>
                            </div>

                            <a wire:navigate href="{{ route('doctor-detail', ['slug' => $doctor->slug]) }}"
                                class="block mt-4 w-full bg-brand-blue-600 text-white py-2 rounded-lg font-medium text-center hover:bg-brand-blue-700 transition-colors">
                                View Profile

                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-4">
                        <svg class="w-16 h-16 mx-auto mb-4 text-brand-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                        </svg>
                        <p class="text-xl text-gray-600 font-medium">No doctors found</p>
                        <p class="text-sm text-gray-500 mt-2">Try adjusting your search criteria</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="inline-flex items-center px-6 py-3 bg-brand-blue-500 text-white rounded-lg font-medium hover:bg-brand-blue-600 transition-colors duration-200">

                    View All Doctors
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- How Booking Works Section -->
    <section class="bg-brand-blue-50 py-8">
        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold text-brand-blue-800 sm:text-4xl">How It Works</h2>
                <p class="mt-4 max-w-2xl text-lg text-gray-600 mx-auto">
                    Book your doctor appointment in three simple steps
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
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
                                <path d="M191 154C191 151.332 191 148.668 191 146" stroke="#003066"
                                    stroke-opacity="0.9" stroke-width="16" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
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
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
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
                                    stroke="#003066" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>

                    </div>
                    <h3 class="text-xl font-semibold text-brand-blue-900 mt-4">Book Appointment</h3>
                    <p class="mt-2 text-gray-600">Select a convenient time slot and book instantly</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-white rounded-xl p-6 text-center shadow-lg border border-brand-blue-100 relative">
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
                <button wire:click="showPhoneModal"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500">
                    Find a Doctor
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>

            <!-- Phone Verification Modal -->
            @if ($showModal)
                <div
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300">
                    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 mx-4 transform transition-all duration-300"
                        @click.away="showModal = false">
                        @if (!$showVerification)
                            <div>
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-medium text-gray-900">Enter Your Phone Number</h3>
                                   <button wire:click="ClosePhoneModal">
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18 18 6M6 6l12 12" />
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
            @endif
        </div>
    </section>


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
            this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
        },
        scrollPrev() {
            this.scroll = Math.max(this.scroll - this.containerWidth, 0);
            this.$refs.container.scrollTo({ left: this.scroll, behavior: 'smooth' });
        },
    };
};
</script>

