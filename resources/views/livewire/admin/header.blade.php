<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-800">
           Admin MedBuzzy
        </a>


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