<header class="bg-white fixed w-full top-0 z-50 shadow-sm">
    <!-- Top Bar -->
    <div class="bg-brand-teal-600 p-2 text-white  hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
           
            <div class="flex items-center space-x-4">
              <a href="mailto:{{ $contactDetails['email'] }}" class="flex items-center space-x-2 hover:text-brand-teal-100 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    {{ $contactDetails['email'] }}
                </a>
                <a href="tel:{{ $contactDetails['phone'] }}" class="font-semibold hover:text-brand-teal-100 transition-colors">{{ $contactDetails['phone'] }}</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="container mx-auto px-4 py-1 ">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a wire:navigate href="/" class="flex items-center">
                    <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-16 md:h-20">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-2">
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    Find Doctor
                </a>
                <a wire:navigate href="{{ route('about-us') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    About MedBuzzy
                </a>
                <a wire:navigate href="{{ route('contact-us') }}"
                    class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                    Contact Us
                </a>
            </nav>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                @auth
                   

                    <!-- User Profile -->
                    <div class="hidden lg:flex items-center space-x-3 group relative">
                        <div class="flex items-center space-x-2">
                             @if(auth()->user()->role === 'admin')
                        <a wire:navigate href="{{ route('admin.dashboard') }}"
                            class="hidden lg:flex items-center space-x-2 text-gray-700 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h2a2 2 0 00-2 2"/>
                            </svg>
                            <span>Admin Dashboard</span>
                        </a>
                    @else
                            <div class="w-9 h-9 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        @endif
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
                <a wire:navigate href="{{ route('appointment') }}"
                    class="bg-brand-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-600 transition-colors duration-200 flex items-center shadow-md hover:shadow-lg whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class=" text-xs md:text-sm sm:inline">Book Now</span>
                </a>

                @guest
                    <div class="hidden md:flex items-center space-x-3">
                        <a wire:navigate href="/login"
                            class="text-gray-600 hover:text-brand-teal-600 font-medium transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-brand-teal-50 whitespace-nowrap">
                            Login
                        </a>
                        {{-- <a wire:navigate href="/register"
                            class="bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700 transition-colors duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                            Sign Up
                        </a> --}}
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
            <a wire:navigate href="/"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Home
            </a>
            <a wire:navigate href="{{ route('our-doctors') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Find Doctor
            </a>
            <a wire:navigate href="{{ route('about-us') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                About Medbuzzy
            </a>
            <a wire:navigate href="{{ route('contact-us') }}"
                class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                Contact Us
            </a>
            
            <div class="pt-4 border-t space-y-3">
                @auth
                    <div class="flex items-center space-x-3 px-3 py-2">
                        <div class="w-8 h-8 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    </div>
                    
                    @if(auth()->user()->role === 'admin')
                        <a wire:navigate href="{{ route('admin.dashboard') }}"
                            class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h2a2 2 0 00-2 2"/>
                            </svg>
                            <span>Admin Dashboard</span>
                        </a>
                    @endif
                    
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
                    <a wire:navigate href="/login"
                        class="block text-center text-gray-600 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 mobile-menu-link">
                        Login
                    </a>
                    {{-- <a wire:navigate href="{{ route('register') }}"
                        class="block text-center bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700 transition-colors duration-200 shadow-md hover:shadow-lg mobile-menu-link">
                        Sign Up
                    </a> --}}
                @endauth
                <a wire:navigate href="{{ route('appointment') }}"
                    class="block text-center bg-brand-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-600 transition-colors duration-200 shadow-md hover:shadow-lg mobile-menu-link">
                    Book Appointment
                </a>
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