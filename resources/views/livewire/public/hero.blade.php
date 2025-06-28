<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Floating Shapes -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-pink-500/20 rounded-full blur-2xl animate-bounce" style="animation-duration: 3s;"></div>
            <div class="absolute bottom-32 left-1/4 w-24 h-24 bg-yellow-400/20 rounded-full blur-xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 right-1/3 w-36 h-36 bg-blue-400/20 rounded-full blur-2xl animate-bounce" style="animation-duration: 4s; animation-delay: 2s;"></div>
            
            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/5 to-transparent" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0); background-size: 50px 50px;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Main Hero Content -->
            <div class="mb-16">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">Trusted by 2M+ travelers worldwide</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-6xl md:text-8xl font-bold text-white mb-8 leading-tight">
                    Your Dream
                    <div class="relative inline-block">
                        <span class="bg-gradient-to-r from-yellow-400 via-pink-400 to-purple-400 bg-clip-text text-transparent animate-pulse">
                            Getaway
                        </span>
                        <div class="absolute -inset-2 bg-gradient-to-r from-yellow-400/20 via-pink-400/20 to-purple-400/20 blur-2xl rounded-lg"></div>
                    </div>
                    <br>Awaits
                </h1>

                <!-- Subtitle -->
                <p class="text-2xl text-white/80 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Discover breathtaking destinations, book seamless experiences, and create unforgettable memories with the world's most trusted booking platform.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                    <button class="group bg-gradient-to-r from-purple-600 to-blue-600 text-white px-10 py-4 rounded-2xl hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-purple-500/25 font-semibold text-lg">
                        Start Exploring
                        <svg class="inline-block ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                    <button class="group bg-white/10 backdrop-blur-md text-white px-10 py-4 rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:scale-105 shadow-2xl font-semibold text-lg">
                        Watch Demo
                        <svg class="inline-block ml-2 w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h1m4 0h1"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Enhanced Search Bar -->
            <div class="relative max-w-5xl mx-auto">
                <div class="bg-white/10 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl">
                    <!-- Search Tabs -->
                    <div class="flex justify-center mb-6">
                        <div class="bg-white/10 rounded-2xl p-2 flex space-x-2">
                            <button class="px-6 py-2 bg-white text-purple-600 rounded-xl font-semibold shadow-lg transition-all duration-300">Hotels</button>
                            <button class="px-6 py-2 text-white/80 hover:text-white hover:bg-white/10 rounded-xl font-semibold transition-all duration-300">Flights</button>
                            <button class="px-6 py-2 text-white/80 hover:text-white hover:bg-white/10 rounded-xl font-semibold transition-all duration-300">Cars</button>
                            <button class="px-6 py-2 text-white/80 hover:text-white hover:bg-white/10 rounded-xl font-semibold transition-all duration-300">Experiences</button>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="relative">
                            <label class="block text-white/70 text-sm font-medium mb-2">Destination</label>
                            <div class="relative">
                                <input type="text" placeholder="Where to?" class="w-full px-4 py-4 rounded-2xl bg-white/90 border-0 focus:ring-2 focus:ring-purple-500 focus:outline-none text-gray-800 placeholder-gray-500 font-medium pl-12">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <label class="block text-white/70 text-sm font-medium mb-2">Check-in</label>
                            <div class="relative">
                                <input type="date" class="w-full px-4 py-4 rounded-2xl bg-white/90 border-0 focus:ring-2 focus:ring-purple-500 focus:outline-none text-gray-800 font-medium pl-12">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <label class="block text-white/70 text-sm font-medium mb-2">Check-out</label>
                            <div class="relative">
                                <input type="date" class="w-full px-4 py-4 rounded-2xl bg-white/90 border-0 focus:ring-2 focus:ring-purple-500 focus:outline-none text-gray-800 font-medium pl-12">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <label class="block text-white/70 text-sm font-medium mb-2">Guests</label>
                            <div class="relative">
                                <select class="w-full px-4 py-4 rounded-2xl bg-white/90 border-0 focus:ring-2 focus:ring-purple-500 focus:outline-none text-gray-800 font-medium pl-12 appearance-none">
                                    <option>2 Adults</option>
                                    <option>1 Adult</option>
                                    <option>3 Adults</option>
                                    <option>4+ Adults</option>
                                    <option>Family (2+2)</option>
                                </select>
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="mt-6 flex justify-center">
                        <button class="group bg-gradient-to-r from-purple-600 to-blue-600 text-white px-12 py-4 rounded-2xl hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-purple-500/25 font-bold text-lg">
                            <svg class="inline-block mr-3 w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search Amazing Deals
                            <svg class="inline-block ml-3 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Popular Destinations -->
                <div class="mt-12 text-center">
                    <p class="text-white/70 mb-4 font-medium">Popular destinations:</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">🏝️ Maldives</span>
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">🗼 Paris</span>
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">🏛️ Rome</span>
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">🏖️ Bali</span>
                        <span class="px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white/90 border border-white/20 hover:bg-white/20 transition-all duration-300 cursor-pointer">🌸 Tokyo</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-8 h-12 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white/60 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>