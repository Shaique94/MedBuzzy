<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-800">
            MedBuzzy
        </a>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-6">
    <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>

    <!-- Dropdown for Find -->
    <div class="relative group">
        <a href="#" class="text-gray-600 hover:text-gray-800 flex items-center">
            Find
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </a>
        <!-- Dropdown Menu -->
        <div class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
            <a href="{{route('our-doctors')}}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">Doctor</a>
            <a href="/find-hospital" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">Hospital</a>
            <a href="/find-clinic" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-800">Clinic</a>
        </div>
    </div>
    <a href="{{route('contact-us')}}" class="text-gray-600 hover:text-gray-800">Contact</a>
</nav>

        <!-- Call to Action -->
        <a href="/book-appointment" class="hidden md:inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Book Appointment
        </a>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-600 focus:outline-none" id="mobile-menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden bg-white border-t border-gray-200" id="mobile-menu" style="display: none;">
        <nav class="flex flex-col space-y-2 p-4">
            <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>
            <a href="/about-us" class="text-gray-600 hover:text-gray-800">About Us</a>
            <a href="/services" class="text-gray-600 hover:text-gray-800">Services</a>
            <a href="/contact" class="text-gray-600 hover:text-gray-800">Contact</a>
            <a href="/book-appointment" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Book Appointment
            </a>
        </nav>
    </div>

    <script>
        // Toggle mobile menu visibility
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.style.display = mobileMenu.style.display === 'none' || mobileMenu.style.display === '' ? 'block' : 'none';
        });
    </script>
</header>