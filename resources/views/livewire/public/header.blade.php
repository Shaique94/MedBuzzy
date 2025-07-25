<header class="bg-white fixed w-full top-0 z-50 shadow-sm">
    <!-- Top Bar -->
    <div class="bg-brand-teal-600 text-white py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
            <div class="flex items-center space-x-6">
                <span class="flex items-center space-x-2 hover:text-brand-teal-100 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    info@medbuzzy.com
                </span>
                <span class="flex items-center space-x-2 hover:text-brand-teal-100 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Purnea, Bihar, India
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="hover:text-brand-teal-100 transition-colors">24/7 Emergency Available</span>
                </span>
                <span class="font-semibold hover:text-brand-teal-100 transition-colors">+91 943-080-8079</span>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center transition-transform hover:scale-105 duration-200">
                    <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-16 md:h-20">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-2">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    Find Doctor
                </a>
                <a href="{{ route('about-us') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    About
                </a>
                <a href="{{ route('contact-us') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    Contact
                </a>
            </nav>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- User Profile -->
                    <div class="hidden lg:flex items-center space-x-3 group relative">
                        <div class="flex items-center space-x-2">
                            <div class="w-9 h-9 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        
                        <!-- Logout Dropdown -->
                        <div class="absolute right-0 top-full mt-2 w-40 bg-white rounded-lg shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
                
                <!-- Book Now Button -->
                <a href="{{ route('appointment') }}"
                    class="bg-brand-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-600 transition-colors duration-200 flex items-center shadow-md hover:shadow-lg whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="hidden sm:inline">Book Now</span>
                </a>

                @guest
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="/login"
                            class="text-gray-600 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50 whitespace-nowrap">
                            Login
                        </a>
                        <a href="/register"
                            class="bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700 transition-colors duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                            Sign Up
                        </a>
                    </div>
                @endguest

                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-600 hover:text-brand-teal-600 p-2 focus:outline-none"
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
            <a href="/"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Home
            </a>
            <a wire:navigate href="{{ route('our-doctors') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Find Doctor
            </a>
            <a href="{{ route('about-us') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                About
            </a>
            <a href="{{ route('contact-us') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Contact
            </a>
            
            <div class="pt-4 border-t space-y-3">
                @auth
                    <div class="flex items-center space-x-3 px-3 py-2">
                        <div class="w-8 h-8 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-red-600 hover:text-red-700 font-medium py-2 px-3 rounded-lg hover:bg-red-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="/login"
                        class="block text-center text-gray-600 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                        Login
                    </a>
                    <a wire:navigate href="{{ route('register') }}"
                        class="block text-center bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700 transition-colors duration-200 shadow-md hover:shadow-lg mobile-menu-link">
                        Sign Up
                    </a>
                @endauth
                <a href="{{ route('appointment') }}"
                    class="block text-center bg-brand-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-600 transition-colors duration-200 shadow-md hover:shadow-lg mobile-menu-link">
                    Book Appointment
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
        
        // Toggle mobile menu
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('block');
            
            // Toggle aria-expanded attribute
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
        });
        
        // Close mobile menu when clicking on any link
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('block');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('block');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    });
</script>