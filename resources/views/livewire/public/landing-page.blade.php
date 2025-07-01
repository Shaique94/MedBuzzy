<div>
  <!-- Hero with Search (existing component) -->
  <livewire:public.hero />

  <!-- Featured Specialties Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Browse by Specialties</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find the right specialist for your healthcare needs</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        <!-- Urology -->
        <a href="{{ route('our-doctors') }}" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-orange-100 rounded-full flex items-center justify-center group-hover:bg-orange-200 transition-colors">
            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-orange-600 transition-colors">Urology</h3>
          <p class="text-sm text-gray-500 mt-1">50+ Doctors</p>
        </a>
        
        <!-- Neurology -->
        <a href="/specialties/neurology" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-teal-100 rounded-full flex items-center justify-center group-hover:bg-teal-200 transition-colors">
            <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-teal-600 transition-colors">Neurology</h3>
          <p class="text-sm text-gray-500 mt-1">30+ Doctors</p>
        </a>
        
        <!-- Orthopedic -->
        <a href="/specialties/orthopedic" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition-colors">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Orthopedic</h3>
          <p class="text-sm text-gray-500 mt-1">40+ Doctors</p>
        </a>
        
        <!-- Cardiologist -->
        <a href="/specialties/cardiology" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Cardiology</h3>
          <p class="text-sm text-gray-500 mt-1">25+ Doctors</p>
        </a>
        
        <!-- Dentist -->
        <a href="/specialties/dentistry" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-200 transition-colors">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-purple-600 transition-colors">Dentistry</h3>
          <p class="text-sm text-gray-500 mt-1">35+ Doctors</p>
        </a>
        
        <!-- Diagnostic -->
        <a href="/diagnostic-centers" class="group text-center p-6 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
          <div class="w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
          <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition-colors">Diagnostic</h3>
          <p class="text-sm text-gray-500 mt-1">20+ Centers</p>
        </a>
      </div>
      
      <div class="text-center mt-12">
        <a href="/specialties" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition-colors">
          View All Specialties
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- Top Doctors Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Expert Doctors</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Connect with verified healthcare professionals</p>
      </div>

      <!-- Simple Search Bar -->
      <div class="max-w-md mx-auto mb-12">
        <form action="/doctors" method="GET" class="relative">
          <input 
            type="text" 
            name="search" 
            placeholder="Search doctors by name or specialty..." 
            class="w-full pl-5 pr-12 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
          >
          <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-teal-600 hover:text-teal-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </button>
        </form>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Doctor 1 -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
          <div class="relative">
            <div class="h-48 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
              <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md">
                <svg class="w-12 h-12 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-teal-500 text-white text-xs px-2 py-1 rounded-full flex items-center">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Verified
              </span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-bold text-xl text-gray-800 mb-1">Dr. Sarah Johnson</h3>
            <p class="text-teal-600 font-medium mb-3">Cardiologist</p>
            <div class="flex items-center mb-4">
              <div class="flex text-yellow-400">
                ★★★★★
              </div>
              <span class="text-gray-600 text-sm ml-2">(247 reviews)</span>
            </div>
            <div class="flex justify-between items-center mb-4">
              <div>
                <p class="text-gray-600 text-sm">Experience</p>
                <p class="font-semibold">12 years</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Fees</p>
                <p class="font-semibold">₹3,500</p>
              </div>
            </div>
            <div class="flex space-x-3">
              <a href="/doctors/sarah-johnson" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Profile
              </a>
              <a href="/book/sarah-johnson" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Book Now
              </a>
            </div>
          </div>
        </div>

        <!-- Doctor 2 -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
          <div class="relative">
            <div class="h-48 bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
              <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md">
                <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-teal-500 text-white text-xs px-2 py-1 rounded-full flex items-center">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Verified
              </span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-bold text-xl text-gray-800 mb-1">Dr. Michael Chen</h3>
            <p class="text-teal-600 font-medium mb-3">Neurologist</p>
            <div class="flex items-center mb-4">
              <div class="flex text-yellow-400">
                ★★★★★
              </div>
              <span class="text-gray-600 text-sm ml-2">(189 reviews)</span>
            </div>
            <div class="flex justify-between items-center mb-4">
              <div>
                <p class="text-gray-600 text-sm">Experience</p>
                <p class="font-semibold">8 years</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Fees</p>
                <p class="font-semibold">₹4,200</p>
              </div>
            </div>
            <div class="flex space-x-3">
              <a href="/doctors/michael-chen" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Profile
              </a>
              <a href="/book/michael-chen" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Book Now
              </a>
            </div>
          </div>
        </div>

        <!-- Doctor 3 -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
          <div class="relative">
            <div class="h-48 bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
              <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md">
                <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-teal-500 text-white text-xs px-2 py-1 rounded-full flex items-center">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Verified
              </span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-bold text-xl text-gray-800 mb-1">Dr. Priya Patel</h3>
            <p class="text-teal-600 font-medium mb-3">Dermatologist</p>
            <div class="flex items-center mb-4">
              <div class="flex text-yellow-400">
                ★★★★★
              </div>
              <span class="text-gray-600 text-sm ml-2">(312 reviews)</span>
            </div>
            <div class="flex justify-between items-center mb-4">
              <div>
                <p class="text-gray-600 text-sm">Experience</p>
                <p class="font-semibold">10 years</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Fees</p>
                <p class="font-semibold">₹2,800</p>
              </div>
            </div>
            <div class="flex space-x-3">
              <a href="/doctors/priya-patel" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Profile
              </a>
              <a href="/book/priya-patel" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Book Now
              </a>
            </div>
          </div>
        </div>

        <!-- Doctor 4 -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
          <div class="relative">
            <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
              <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-md">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div class="absolute top-4 right-4">
              <span class="bg-teal-500 text-white text-xs px-2 py-1 rounded-full flex items-center">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Verified
              </span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="font-bold text-xl text-gray-800 mb-1">Dr. Robert Wilson</h3>
            <p class="text-teal-600 font-medium mb-3">Pediatrician</p>
            <div class="flex items-center mb-4">
              <div class="flex text-yellow-400">
                ★★★★★
              </div>
              <span class="text-gray-600 text-sm ml-2">(276 reviews)</span>
            </div>
            <div class="flex justify-between items-center mb-4">
              <div>
                <p class="text-gray-600 text-sm">Experience</p>
                <p class="font-semibold">15 years</p>
              </div>
              <div>
                <p class="text-gray-600 text-sm">Fees</p>
                <p class="font-semibold">₹2,500</p>
              </div>
            </div>
            <div class="flex space-x-3">
              <a href="/doctors/robert-wilson" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Profile
              </a>
              <a href="/book/robert-wilson" class="flex-1 text-center bg-teal-600 hover:bg-teal-700 text-white py-2 px-4 rounded-lg text-sm font-semibold transition-colors">
                Book Now
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="text-center mt-12">
        <a href="/doctors" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-lg font-medium hover:bg-teal-700 transition-colors">
          View All Doctors
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <livewire:public.about-us />

    <!-- Booking Process Section -->
<!-- 4-Step Process Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-8 lg:px-16">
        <div class="flex flex-col lg:flex-row items-center gap-16">
              <!-- Right side - Visual -->
            <div class="lg:w-1/2">
                <div class="relative">
                    <!-- Main illustration background -->
                    <div class="w-full h-96 bg-gradient-to-br from-teal-100 to-orange-100 rounded-3xl p-8 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <svg class="w-16 h-16 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Easy Appointment Booking</h4>
                            <p class="text-gray-600">Book appointments with just a few clicks</p>
                        </div>
                    </div>
                    
                    <!-- Floating elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-orange-200 rounded-2xl opacity-60"></div>
                    <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-teal-200 rounded-2xl opacity-60"></div>
                    
                    <!-- Stats floating cards -->
                    <div class="absolute top-8 -left-8 bg-white rounded-xl p-4 shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">10k+</p>
                                <p class="text-xs text-gray-600">Happy Patients</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute bottom-8 -right-8 bg-white rounded-xl p-4 shadow-lg">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">500+</p>
                                <p class="text-xs text-gray-600">Expert Doctors</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Left side - Content -->
            <div class="lg:w-1/2">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Simple 4-Step Booking Process</h2>
                <p class="text-xl text-gray-600 mb-12 leading-relaxed">Book your appointment with ease through our streamlined process designed for your convenience</p>
                
                <!-- Process Steps -->
                <div class="space-y-8">
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-teal-400 rounded-2xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">1</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Create Your Account</h3>
                            <p class="text-gray-600">Sign up with your basic details and verify your identity for secure access</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-teal-600 rounded-2xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">2</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Choose Specialty</h3>
                            <p class="text-gray-600">Browse through various medical specialties and find the right department</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-teal-400 rounded-2xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">3</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Select Your Doctor</h3>
                            <p class="text-gray-600">View profiles, ratings, and availability of verified healthcare professionals</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-teal-600 rounded-2xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">4</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Confirm Appointment</h3>
                            <p class="text-gray-600">Pick your preferred time slot and confirm your booking instantly</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12">
                    <a href="/book-appointment" class="inline-flex items-center px-8 py-4 bg-teal-400 text-white font-semibold rounded-xl hover:bg-orange-700 transition-colors">
                        Start Booking Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
          
        </div>
    </div>
</section>

<!-- Health Initiatives Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-8 lg:px-16">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Health Insights & Updates</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Stay informed with the latest healthcare news, tips, and insights from our medical experts</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article Card 1 -->
            <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                <div class="relative">
                    <div class="w-full h-64 bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                        <svg class="w-24 h-24 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-400 text-white text-xs px-3 py-1 rounded-full font-medium">Featured</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600">Dr. Ruby Martin</span>
                        </div>
                        <span class="text-sm text-gray-500">Dec 4, 2024</span>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">Digital Healthcare Revolution: Making Clinics Paperless</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Discover how digital transformation is revolutionizing healthcare delivery and improving patient care through technology.</p>
                    <a href="/blog/digital-healthcare" class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                        Read More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Article Card 2 -->
            <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                <div class="relative">
                    <div class="w-full h-64 bg-gradient-to-br from-teal-100 to-teal-200 flex items-center justify-center">
                        <svg class="w-24 h-24 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-600 text-white text-xs px-3 py-1 rounded-full font-medium">Popular</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600">Dr. Danish Omar</span>
                        </div>
                        <span class="text-sm text-gray-500">Dec 1, 2024</span>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">Benefits of Online Doctor Consultations</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Explore the advantages of virtual healthcare consultations and how they're making medical care more accessible.</p>
                    <a href="/blog/online-consultations" class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                        Read More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </article>

            <!-- Article Card 3 -->
            <article class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-orange-200 transition-all duration-300 group">
                <div class="relative">
                    <div class="w-full h-64 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <svg class="w-24 h-24 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600 text-white text-xs px-3 py-1 rounded-full font-medium">Trending</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600">Dr. Sophia Williams</span>
                        </div>
                        <span class="text-sm text-gray-500">Nov 28, 2024</span>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-3 group-hover:text-orange-600 transition-colors leading-tight">5 Reasons to Choose Telemedicine</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">Learn why telemedicine is becoming the preferred choice for modern healthcare and patient convenience.</p>
                    <a href="/blog/telemedicine-benefits" class="inline-flex items-center text-teal-600 font-medium hover:text-teal-700 transition-colors">
                        Read More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </article>
        </div>
        
        <div class="text-center mt-16">
            <a href="/blog" class="inline-flex items-center px-8 py-4 bg-teal-600 text-white font-semibold rounded-xl hover:from-orange-700 hover:to-teal-700 transition-all duration-300">
                View All Articles
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

</div>