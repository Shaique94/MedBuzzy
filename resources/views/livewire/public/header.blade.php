<div>
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <!-- Top Bar -->
        <div class="bg-brand-teal-600 text-white py-2 hidden md:block">
            <div class="container mx-auto px-4 flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        info@medbuzzy.com
                    </span>
                    <span class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        Purnea, Bihar, India
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        24/7 Emergency Available
                    </span>
                    <span class="font-semibold">+91 943-080-8079</span>
                </div>
            </div>
        </div>
        <!-- Main Header -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-brand-orange-600 rounded-lg flex items-center justify-center mr-3">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-brand-teal-700">MedBuzzy</h1>
                        <p class="text-xs text-gray-500">Your Health Partner</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors">Home</a>
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-brand-teal-600 font-medium flex items-center transition-colors">
                            Find Doctor
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="/find-doctor" class="block px-4 py-3 text-gray-600 hover:bg-brand-orange-50 hover:text-brand-orange-600 first:rounded-t-lg">Find Doctor</a>
                            <a href="/find-hospital" class="block px-4 py-3 text-gray-600 hover:bg-brand-orange-50 hover:text-brand-orange-600">Find Hospital</a>
                            <a href="/find-clinic" class="block px-4 py-3 text-gray-600 hover:bg-brand-orange-50 hover:text-brand-orange-600 last:rounded-b-lg">Find Clinic</a>
                        </div>
                    </div>
                    <a href="/services" class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors">Services</a>
                    <a href="/about" class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors">About</a>
                    <a href="/contact" class="text-gray-700 hover:text-brand-teal-600 font-medium transition-colors">Contact</a>
                </nav>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="/login" class="text-gray-600 hover:text-brand-teal-600 font-medium transition-colors">Login</a>
                        <a href="/register" class="bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700 transition-colors">Sign Up</a>
                    </div>
                    <a href="/book-appointment" class="bg-brand-orange-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-orange-700 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Book Now
                    </a>
                    <button class="lg:hidden text-gray-600 hover:text-brand-teal-600 p-2" id="mobile-menu-button">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden bg-white border-t hidden" id="mobile-menu">
            <nav class="container mx-auto px-4 py-4 space-y-4">
                <a href="/" class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2">Home</a>
                <div class="space-y-2">
                    <button class="flex items-center justify-between w-full text-gray-700 hover:text-brand-teal-600 font-medium py-2" onclick="toggleMobileDropdown('find')">
                        Find Doctor
                        <svg class="w-4 h-4 transition-transform" id="find-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="pl-4 space-y-2 hidden" id="find-dropdown">
                        <a href="/find-doctor" class="block text-gray-600 hover:text-brand-orange-600 py-1">Find Doctor</a>
                        <a href="/find-hospital" class="block text-gray-600 hover:text-brand-orange-600 py-1">Find Hospital</a>
                        <a href="/find-clinic" class="block text-gray-600 hover:text-brand-orange-600 py-1">Find Clinic</a>
                    </div>
                </div>
                <a href="/services" class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2">Services</a>
                <a href="/about" class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2">About</a>
                <a href="/contact" class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2">Contact</a>
                <div class="pt-4 border-t space-y-3">
                    <a href="/login" class="block text-center text-gray-600 hover:text-brand-teal-600 font-medium py-2">Login</a>
                    <a href="/register" class="block text-center bg-brand-teal-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-brand-teal-700">Sign Up</a>
                    <a href="/book-appointment" class="block text-center bg-brand-orange-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-brand-orange-700">Book Appointment</a>
                </div>
            </nav>
        </div>

        <script>
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            });

            function toggleMobileDropdown(type) {
                const dropdown = document.getElementById(type + '-dropdown');
                const arrow = document.getElementById(type + '-arrow');
                dropdown.classList.toggle('hidden');
                arrow.style.transform = dropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            }
        </script>
    </header>
</div>