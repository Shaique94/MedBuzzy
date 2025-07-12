<div>
    <section class="relative overflow-hidden bg-gradient-to-br from-brand-teal-50 to-white py-16 lg:py-24">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-full h-full opacity-5">
            <div class="absolute top-10 right-10 w-24 h-24 bg-brand-orange-300 rounded-full blur-xl"></div>
            <div class="absolute bottom-10 left-10 w-20 h-20 bg-brand-teal-300 rounded-full blur-xl"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <!-- Hero content -->
            <div class="text-center mb-12 lg:mb-16 max-w-4xl mx-auto">
                <p class="text-brand-teal-600 font-medium text-lg lg:text-xl mb-4">Your Health Journey Starts Here</p>
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Find <span class="text-brand-orange-600">Trusted</span> Healthcare <br>Near You
                </h1>
                <p class="text-gray-600 text-lg lg:text-xl mb-8 max-w-3xl mx-auto leading-relaxed">
                    Connect with verified doctors and healthcare providers in your community
                </p>
            </div>

            <!-- Search box -->
            <form wire:submit.prevent="search" class="space-y-4 md:space-y-0 grid grid-cols-1 md:grid-cols-12 gap-4">
                <!-- Specialty -->
                <div class="md:col-span-3">
                    <div class="relative border rounded">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <select name="specialty" wire:model.live="selectedDepartment"
                            class="block w-full pl-10 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 rounded-lg">
                            <option value="">Select Specialty</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Search input -->
                <div class="md:col-span-8">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" wire:model.live="searchQuery"
                            placeholder="Search doctors by name, email, or qualification"
                            class="block w-full pl-10 pr-4 py-3 border border-teal-300 focus:outline-none focus:ring-2 focus:ring-brand-teal-500 focus:border-brand-teal-500 rounded-lg">
                    </div>
                </div>

                <!-- Search button -->
                <div class="md:col-span-1">
                    <button type="submit"
                        class="w-full h-full flex items-center justify-center bg-brand-teal-600 text-white rounded-lg hover:bg-brand-teal-700 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- CTA and stats -->
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 mt-12">
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/book-appointment"
                        class="bg-brand-orange-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-brand-orange-700 transition-colors text-center flex items-center justify-center shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Book Appointment
                    </a>
                    <a href="/emergency"
                        class="bg-teal-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-900 transition-colors text-center flex items-center justify-center shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        Emergency Care
                    </a>
                </div>
                <div class="flex divide-x divide-gray-200 bg-white rounded-lg shadow-sm p-2">
                    <div class="px-6 py-3 text-center">
                        <div class="text-2xl font-bold text-brand-teal-600">500+</div>
                        <div class="text-gray-600 text-sm font-medium">Verified Doctors</div>
                    </div>
                    <div class="px-6 py-3 text-center">
                        <div class="text-2xl font-bold text-brand-teal-600">10k+</div>
                        <div class="text-gray-600 text-sm font-medium">Happy Patients</div>
                    </div>
                    <div class="px-6 py-3 text-center">
                        <div class="text-2xl font-bold text-brand-teal-600">24/7</div>
                        <div class="text-gray-600 text-sm font-medium">Support</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-10 right-10 w-20 h-20 bg-orange-200 rounded-full opacity-20"></div>
        <div class="absolute bottom-10 left-10 w-16 h-16 bg-teal-200 rounded-full opacity-30"></div>
    </section>
</div>