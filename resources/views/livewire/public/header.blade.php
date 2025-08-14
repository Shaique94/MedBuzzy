<header class="bg-white fixed w-full top-0 z-50 shadow-sm">
    {{-- <!-- Top Bar -->
    <div class="bg-brand-blue-900 p-2 text-white hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center text-sm">
           
            <div class="flex items-center space-x-4">
              <a href="mailto:{{ $contactDetails['email'] }}" class="flex items-center space-x-2 hover:text-brand-blue-100 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    {{ $contactDetails['email'] }}
                </a>
                <a href="tel:{{ $contactDetails['phone'] }}" class="font-semibold hover:text-brand-blue-100 transition-colors">{{ $contactDetails['phone'] }}</a>
            </div>
        </div>
    </div> --}}

    <!-- Main Header -->
    <div class=" mx-auto px-3 lg:px-[10%] py-3 md:py-4 ">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a wire:navigate href="/" class="flex items-center">
                    <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-9 md:h-12">
                </a>
            </div>

            <!-- Desktop Navigation -->
           

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-1 md:space-x-4">
             <!-- Replace the existing User Profile section with this: -->
@auth
    <!-- User Profile Dropdown -->
    <div class="hidden lg:flex items-center space-x-3 relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <div class="w-9 h-9 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-800 font-semibold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false" 
             class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-100">
            <a wire:navigate href="{{ route('user.dashboard') }}" 
               class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>My Profile</span>
            </a>
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
                <a wire:navigate href="{{ route('our-doctors') }}"
                    class="bg-brand-orange-600 text-white px-3 md:px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-600 transition-colors duration-200 flex items-center shadow-md hover:shadow-lg whitespace-nowrap">

                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 14h6m-3-3v6">
                        </path>
                    </svg>
                    <span class=" text-xs md:text-sm sm:inline">Find Doctor</span>
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
            
            <div class="pt-4 border-t space-y-3">
              @auth
    <div class="flex items-center space-x-3 px-3 py-2">
        <div class="w-8 h-8 rounded-full bg-brand-blue-100 flex items-center justify-center text-brand-blue-800 font-semibold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
    </div>
    
    <a wire:navigate href="{{ route('user.dashboard') }}" 
       class="block text-gray-700 hover:text-brand-blue-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-blue-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span>My Profile</span>
    </a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left text-red-600 hover:text-red-700 font-medium py-2 px-3 rounded-lg hover:bg-red-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
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