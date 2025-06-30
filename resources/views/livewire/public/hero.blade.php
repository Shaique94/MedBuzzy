<section class="bg-white py-16 relative overflow-hidden">
    <!-- Background Image/Pattern -->
    <div class="absolute inset-0 hero-gradient opacity-60"></div>
    
    <div class="container mx-auto px-8 lg:px-16 relative z-10">
        <!-- Main Hero Content -->
        <div class="text-center mb-12">
            <p class="text-gray-600 text-lg mb-4">We Provide Solution</p>
            <h1 class="text-5xl lg:text-7xl font-bold text-gray-800 leading-tight mb-6">
                To <span class="text-orange-600">stressless</span> Life
            </h1>
            <p class="text-gray-600 text-xl mb-8 max-w-2xl mx-auto leading-relaxed">
                People who are more perfectionist are most likely to be depressed,<br>
                Because they stress themselves out so much.
            </p>
        </div>

        <!-- Hero Search Bar with Teal Background -->
        <div class="search-gradient rounded-2xl p-8 mb-16">
            <form action="/search" method="GET">
                <div class="flex flex-col lg:flex-row items-center gap-4">
                    <!-- Location Dropdown -->
                    <div class="flex-shrink-0 lg:w-48">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <select name="location" class="w-full pl-10 pr-4 py-4 bg-white border-2 border-gray-200 rounded-lg text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-white focus:border-orange-400 appearance-none">
                                <option value="">Purnea</option>
                                <option value="purnea">Purnea</option>
                                <option value="delhi">Delhi</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="kolkata">Kolkata</option>
                                <option value="patna">Patna</option>
                                <option value="gaya">Gaya</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Specialty Dropdown -->
                    <div class="flex-shrink-0 lg:w-48">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            <select name="specialty" class="w-full pl-10 pr-4 py-4 bg-white border-2 border-gray-200 rounded-lg text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-white focus:border-orange-400 appearance-none">
                                <option value="">Urology</option>
                                <option value="general">General Medicine</option>
                                <option value="cardiology">Cardiology</option>
                                <option value="dermatology">Dermatology</option>
                                <option value="neurology">Neurology</option>
                                <option value="orthopedics">Orthopedics</option>
                                <option value="pediatrics">Pediatrics</option>
                                <option value="gynecology">Gynecology</option>
                                <option value="urology">Urology</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Search Input - Takes remaining space -->
                    <div class="flex-1 min-w-0">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" 
                                   placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc" 
                                   class="w-full pl-10 pr-4 py-4 bg-white border-2 border-gray-200 rounded-lg text-gray-700 font-medium focus:outline-none focus:ring-2 focus:ring-white focus:border-orange-400">
                        </div>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex-shrink-0">
                        <button type="submit" class="bg-white text-teal-600 p-4 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- CTA Buttons and Stats Section -->
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <!-- Left Side - CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8 lg:mb-0">
                <a href="/book-appointment" class="bg-orange-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-orange-700 transition-colors text-center flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Book Appointment
                </a>
                <a href="/emergency" class="bg-red-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-red-700 transition-colors text-center flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    Emergency
                </a>
            </div>

            <!-- Right Side - Stats -->
            <div class="flex space-x-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-teal-600">500+</div>
                    <div class="text-gray-600 text-sm">Doctors</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-teal-600">10k+</div>
                    <div class="text-gray-600 text-sm">Patients</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-teal-600">24/7</div>
                    <div class="text-gray-600 text-sm">Support</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-10 right-10 w-20 h-20 bg-orange-100 rounded-full opacity-20"></div>
    <div class="absolute bottom-10 left-10 w-16 h-16 bg-teal-200 rounded-full opacity-30"></div>
</section>