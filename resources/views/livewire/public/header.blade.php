    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-md border-b border-white/20 sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                        BookEasy
                    </span>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 relative group">
                        Hotels
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-purple-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 relative group">
                        Flights
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-purple-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 relative group">
                        Cars
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-purple-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 relative group">
                        Experiences
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-purple-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search Icon -->
                    <button class="p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Notifications -->
                    <button class="p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200 relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5-5 5-5h-5m-6 0H4l5 5-5 5h5m6-10v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h8a2 2 0 012 2z"></path>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- Sign In Button -->
                    <button class="text-purple-600 hover:text-purple-700 font-medium transition-colors duration-200">
                        Sign In
                    </button>

                    <!-- Sign Up Button -->
                    <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Sign Up
                    </button>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 text-gray-600 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all duration-200" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="md:hidden hidden bg-white/95 backdrop-blur-md border-t border-gray-200 py-4">
                <nav class="flex flex-col space-y-4">
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-purple-50">Hotels</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-purple-50">Flights</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-purple-50">Cars</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-purple-50">Experiences</a>
                </nav>
            </div>
        </div>
    </header>