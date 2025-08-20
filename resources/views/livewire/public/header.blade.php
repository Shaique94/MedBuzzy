<header class="bg-white fixed w-full top-0 z-50 shadow-sm">
    {{-- <!-- Top Bar -->
    <div class="bg-brand-blue-900 p-2 text-white hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
           
            <div class="flex items-center space-x-4">
              <a href="mailto:{{ $contactDetails['email'] }}" class="flex items-center space-x-2 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    {{ $contactDetails['email'] }}
                </a>
                <a href="tel:{{ $contactDetails['phone'] }}" class="font-semibold hover:text-white transition-colors">{{ $contactDetails['phone'] }}</a>
            </div>
        </div>
    </div> --}}

    <!-- Main Header -->
    <div class=" mx-auto px-2 lg:px-[10%] py-2 md:py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a wire:navigate href="/" class="flex items-center">

                    <svg id="Layer_1" class="h-8 md:h-10" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 141.61 28.02">
                        <defs>
                            <style>
                                .cls-1 {
                                    fill: #003066;
                                }

                                .cls-2 {
                                    fill: #f7931e;
                                }

                                .cls-3 {
                                    fill: #fff;
                                }

                                .cls-4 {
                                    font-size: 8.8px;
                                    fill: #f2f2f2;
                                    font-family: Poppins-SemiBold, Poppins;
                                    font-weight: 600;
                                }
                            </style>
                        </defs>
                        <title>logo</title>
                        <path class="cls-1"
                            d="M15.65,18.93c-.61-.06-1.22-.17-1.83-.2-.94,0-1.88,0-2.82,0a4.74,4.74,0,0,1-3.93-1.91A3.48,3.48,0,0,1,6.48,14a2.81,2.81,0,0,1,3.27-2,8.35,8.35,0,0,1,4.49,2.4c.7.66,1.44,1.29,2.19,2a3,3,0,0,1,3.19-1.54,2.59,2.59,0,0,0-1-2.35c-.16-.12-.38-.29-.39-.45s0-.65.23-.75a.68.68,0,0,1,1,.25,9.81,9.81,0,0,1,.71,1.82,9.1,9.1,0,0,1,.15,1.58l1.48.77a5.3,5.3,0,0,1,2.54-2,2.41,2.41,0,0,1,.89-.14.57.57,0,0,1,.59.67.56.56,0,0,1-.67.58c-1.35-.34-2.15.44-2.94,1.34A3.51,3.51,0,0,1,23,19.28a3.21,3.21,0,0,1-2.37,2.17,23.8,23.8,0,0,1,.36,3,7.71,7.71,0,0,1-1.66,5,11.39,11.39,0,0,1-6.38,3.9c-.59.15-1.17.35-1.76.48a.69.69,0,0,0-.58.76,3.42,3.42,0,0,0,2.75,3.33,6.4,6.4,0,0,0,5.2-1.19,15.1,15.1,0,0,0,5.28-7c.1-.23.2-.47.28-.71.19-.55.4-1-.13-1.59a1.81,1.81,0,0,1,.69-2.64,1.89,1.89,0,0,1,2.59.94,1.81,1.81,0,0,1-1.09,2.5l-.08,0c-.77-.13-.82.45-1,1a18.21,18.21,0,0,1-4.69,7.32,8.6,8.6,0,0,1-6,2.52A4.6,4.6,0,0,1,9.63,35.1a.57.57,0,0,1,0-.29c.29-1-.24-1.84-.55-2.72a13.63,13.63,0,0,1-.92-5,8.05,8.05,0,0,1,6.6-7.93,4.31,4.31,0,0,1,.88,0Zm3,9.31a21.76,21.76,0,0,1-8.5-4.51c-.24,1-.48,1.85-.67,2.74,0,.11.11.29.22.38A22,22,0,0,0,16,30.25a.59.59,0,0,0,.5-.09C17.23,29.55,17.9,28.92,18.63,28.24Zm-6.58-6.6a21.71,21.71,0,0,0,7.64,3.74c-.1-1-.19-1.87-.3-2.75,0-.08-.2-.18-.31-.21a6.16,6.16,0,0,1-3.6-1.94.53.53,0,0,0-.4-.18A8.16,8.16,0,0,0,12.05,21.64ZM9.61,30.27l.85,2.25,2.51-.6ZM19.82,17.6c0,.58.28.9.81.91a.78.78,0,0,0,.85-.87.88.88,0,0,0-.89-.88A.77.77,0,0,0,19.82,17.6Zm5.73,9.47a.56.56,0,0,0,.59-.65.56.56,0,0,0-.63-.62.58.58,0,0,0-.63.62A.6.6,0,0,0,25.55,27.07Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2"
                            d="M18.63,28.24c-.73.68-1.4,1.31-2.09,1.92a.59.59,0,0,1-.5.09,22,22,0,0,1-6.36-3.4c-.11-.09-.25-.27-.22-.38.19-.89.43-1.77.67-2.74A21.76,21.76,0,0,0,18.63,28.24Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2"
                            d="M12.05,21.64a8.16,8.16,0,0,1,3-1.34.53.53,0,0,1,.4.18,6.16,6.16,0,0,0,3.6,1.94c.11,0,.3.13.31.21.11.88.2,1.76.3,2.75A21.71,21.71,0,0,1,12.05,21.64Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-2" d="M9.61,30.27,13,31.92l-2.51.6Z" transform="translate(-6.39 -11)" />
                        <path class="cls-3"
                            d="M19.82,17.6a.77.77,0,0,1,.77-.84.88.88,0,0,1,.89.88.78.78,0,0,1-.85.87C20.1,18.5,19.81,18.18,19.82,17.6Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-3"
                            d="M25.55,27.07a.6.6,0,0,1-.67-.65.58.58,0,0,1,.63-.62.56.56,0,0,1,.63.62A.56.56,0,0,1,25.55,27.07Z"
                            transform="translate(-6.39 -11)" /><text class="cls-4"
                            transform="translate(1.57 7.52) scale(1.02 1)">+</text>
                        <path class="cls-1"
                            d="M48.05,15V30.13h-4V20.64l-3.53,9.49H37.1l-3.56-9.51v9.51h-4V15h4.86l4.45,10.58L43.21,15Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1"
                            d="M63,24.77H54a2.71,2.71,0,0,0,.75,2,2.53,2.53,0,0,0,1.72.59,2.4,2.4,0,0,0,1.46-.41,1.89,1.89,0,0,0,.77-1.06h4.21a4.89,4.89,0,0,1-1.12,2.28,5.87,5.87,0,0,1-2.18,1.58,7.92,7.92,0,0,1-6.34-.17A5.64,5.64,0,0,1,51,27.39a6.31,6.31,0,0,1-.84-3.29A6.37,6.37,0,0,1,51,20.8a5.49,5.49,0,0,1,2.31-2.14,7.42,7.42,0,0,1,3.39-.75,7.5,7.5,0,0,1,3.4.74,5.47,5.47,0,0,1,2.27,2.06,5.87,5.87,0,0,1,.8,3.06A4.61,4.61,0,0,1,63,24.77Zm-4.59-3.34a2.63,2.63,0,0,0-1.76-.6,2.7,2.7,0,0,0-1.81.61A2.43,2.43,0,0,0,54,23.21H59.1A2.15,2.15,0,0,0,58.41,21.43Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1"
                            d="M72.68,18.54a3.79,3.79,0,0,1,1.56,1.71V14.13h4v16h-4V28a3.79,3.79,0,0,1-1.56,1.71,5,5,0,0,1-2.56.63,5.51,5.51,0,0,1-2.87-.75,5.27,5.27,0,0,1-2-2.15,7,7,0,0,1-.74-3.29,7,7,0,0,1,.74-3.3,5.24,5.24,0,0,1,2-2.14,5.51,5.51,0,0,1,2.87-.75A5,5,0,0,1,72.68,18.54Zm-3.34,3.4a2.92,2.92,0,0,0-.78,2.16,2.92,2.92,0,0,0,.78,2.16,3.08,3.08,0,0,0,4.12,0,2.91,2.91,0,0,0,.8-2.14,2.88,2.88,0,0,0-.8-2.15,3.1,3.1,0,0,0-4.12,0Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1"
                            d="M93.18,23.6A3.53,3.53,0,0,1,94.05,26,3.67,3.67,0,0,1,92.64,29a6.38,6.38,0,0,1-4,1.1H81V14.84h7.46a6.38,6.38,0,0,1,3.88,1,3.38,3.38,0,0,1,1.38,2.9,3.43,3.43,0,0,1-.79,2.3,3.74,3.74,0,0,1-2.07,1.2A4.22,4.22,0,0,1,93.18,23.6Zm-8.25-2.51h2.61c1.38,0,2.07-.55,2.07-1.64s-.71-1.65-2.12-1.65H84.93Zm5,4.35a1.55,1.55,0,0,0-.58-1.29,2.59,2.59,0,0,0-1.65-.46H84.93v3.44h2.84C89.24,27.13,90,26.56,90,25.44Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1"
                            d="M109.05,18.06V30.13h-4V28a4.15,4.15,0,0,1-1.66,1.69,5.12,5.12,0,0,1-2.57.62,4.68,4.68,0,0,1-3.55-1.38A5.28,5.28,0,0,1,96,25.07v-7h4v6.56a2.56,2.56,0,0,0,.69,1.91,2.46,2.46,0,0,0,1.84.68,2.52,2.52,0,0,0,1.91-.71,2.77,2.77,0,0,0,.7-2V18.06Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1" d="M115.3,27h6v3.09H111V27.21l5.58-6.07h-5.49V18.06h10V21Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1" d="M126.7,27h6v3.09H122.35V27.21l5.58-6.07h-5.49V18.06h10V21Z"
                            transform="translate(-6.39 -11)" />
                        <path class="cls-1"
                            d="M137.58,18.06l3.12,7.4,2.9-7.4H148l-8.09,17.83h-4.38l3.05-6.21-5.44-11.62Z"
                            transform="translate(-6.39 -11)" />
                    </svg>
                </a>
            </div>

          

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-1 md:space-x-4">

                <!-- Replace the existing User Profile section with this: -->
                @auth
                    <!-- User Profile Dropdown -->
                    <div class="hidden lg:flex items-center space-x-3 relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div
                                class="w-9 h-9 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-800 font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200"
                                :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-100">
                            @if (auth()->user()->role === 'patient')
                                <a wire:navigate href="{{ route('user.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>My Profile</span>
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth


                <!-- Book Now Button -->
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="bg-brand-orange-600 text-white px-3 md:px-4 py-2 rounded-lg md:font-semibold hover:bg-brand-orange-600 transition-colors duration-200 items-center shadow-md hover:shadow-lg whitespace-nowrap hidden sm:flex">

                    <svg class="w-4 h-4 mr-1 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14h6m-3-3v6">
                        </path>
                    </svg>
                    <span class="text-xs md:text-sm sm:inline">Find Doctor</span>
                </a>

                @guest
                    <div class="hidden md:flex items-center">
                        <a wire:navigate href="/login"
                            class="bg-brand-blue-600 text-white px-3 md:px-4 py-2 rounded-lg font-semibold hover:bg-brand-blue-600 transition-colors duration-200 flex items-center shadow-md hover:shadow-lg whitespace-nowrap">
                            <span class=" text-xs md:text-sm sm:inline">Login/Register</span>
                        </a>

                    </div>
                @endguest

                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-600 hover:text-brand-blue-600 p-2 focus:outline-none"
                    id="mobile-menu-button" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="lg:hidden bg-white border-t hidden shadow-lg" id="mobile-menu">
        <nav class="container mx-auto px-4 py-4 space-y-2">
            <a wire:navigate href="/"
                class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 mobile-menu-link">
                Home
            </a>
            <a wire:navigate href="{{ route('our-doctors') }}"
                class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 mobile-menu-link">
                Find Doctor
            </a>
            <a wire:navigate href="{{ route('about-us') }}"
                class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 mobile-menu-link">
                About Medbuzzy
            </a>
            <a wire:navigate href="{{ route('contact-us') }}"
                class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 mobile-menu-link">
                Contact Us
            </a>

            @guest
                <a wire:navigate href="/login"
                    class="bg-brand-blue-600 flex justify-center text-white px-3 md:px-4 py-2 rounded-lg font-semibold hover:bg-brand-blue-600 transition-colors duration-200  items-center shadow-md hover:shadow-lg whitespace-nowrap">
                    <span class=" text-xs md:text-sm sm:inline">Login/register</span>
                </a>
            @endguest





            <div class="pt-4 border-t space-y-3">

                @auth
                    {{-- <div class="flex items-center space-x-3 px-3 py-2">
        <div class="w-8 h-8 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-800 font-semibold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
    </div> --}}

                    @if (auth()->user()->role === 'patient')
                        <a wire:navigate href="{{ route('user.dashboard') }}"
                            class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>My Profile</span>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-red-600 hover:text-red-700 font-medium py-2 px-3 rounded-lg hover:bg-red-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth

            </div>
        </nav>
    </div>
</header>

<script>
    // Initialize menu on first load and after Livewire navigation
    document.addEventListener('DOMContentLoaded', setupMobileMenu);
    document.addEventListener('livewire:navigated', setupMobileMenu);

    function setupMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (!mobileMenuButton || !mobileMenu) return; // Exit if elements don't exist

        // Remove old event listeners (if any) to prevent duplicates
        mobileMenuButton.replaceWith(mobileMenuButton.cloneNode(true));
        mobileMenu.replaceWith(mobileMenu.cloneNode(true));

        // Get fresh references
        const newButton = document.getElementById('mobile-menu-button');
        const newMenu = document.getElementById('mobile-menu');

        // Toggle menu on button click
        newButton.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event bubbling
            newMenu.classList.toggle('hidden');
            newMenu.classList.toggle('block');
            newButton.setAttribute('aria-expanded', newMenu.classList.contains('block'));
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!newMenu.contains(e.target) && !newButton.contains(e.target)) {
                newMenu.classList.add('hidden');
                newMenu.classList.remove('block');
                newButton.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu when clicking links (optional)
        document.querySelectorAll('.mobile-menu-link').forEach(link => {
            link.addEventListener('click', () => {
                newMenu.classList.add('hidden');
                newMenu.classList.remove('block');
                newButton.setAttribute('aria-expanded', 'false');
            });
        });
    }
</script>
