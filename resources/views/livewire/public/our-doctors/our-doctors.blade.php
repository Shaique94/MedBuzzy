<div class="min-h-screen bg-gradient-to-br from-teal-50 via-cyan-50 to-teal-100 px-2 sm:px-4 py-8 sm:py-12">
    <div class="container mx-auto">
        <!-- Page Heading -->
        <div class="text-center mb-8 sm:mb-12">
            <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold text-gray-800 mb-2 sm:mb-3">Find Your Doctor</h1>
            <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">Browse and connect with verified, expert healthcare professionals</p>
        </div>

        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-8 sm:mb-10">
            <form action="" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search doctors by name, specialty, or location..."
                    class="w-full pl-5 pr-12 py-2 sm:py-3 border border-teal-200 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 bg-white shadow-sm text-sm sm:text-base">
                <button type="submit"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-teal-600 hover:text-teal-700">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 sm:gap-10">
            <!-- Filter Section -->
            <aside class="w-full lg:w-1/4 bg-white/90 p-4 sm:p-8 rounded-2xl shadow-xl border border-teal-100 static lg:sticky top-20 sm:top-24 h-auto lg:h-[520px] overflow-y-auto z-20 mb-6 lg:mb-0 flex-shrink-0">
                <h3 class="text-lg sm:text-xl font-bold mb-4 sm:mb-6 flex items-center gap-2 text-teal-700">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    Search Filter
                </h3>
                <div class="space-y-6 sm:space-y-8">
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-teal-800 mb-1 sm:mb-2">Specialty</label>
                        <div class="relative">
                            <select
                                class="mt-1 block w-full border-teal-200 rounded-lg shadow-sm focus:ring-teal-400 focus:border-teal-400 transition text-xs sm:text-base">
                                <option>Urology</option>
                                <option>Cardiology</option>
                                <option>Dermatology</option>
                                <option>Neurology</option>
                            </select>
                            <span class="absolute right-3 top-3 text-teal-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-teal-800 mb-1 sm:mb-2">Gender</label>
                        <div class="mt-2 flex gap-4">
                            <label class="inline-flex items-center gap-1">
                                <input type="checkbox" class="form-checkbox text-teal-500 rounded focus:ring-teal-400"
                                    checked>
                                <span class="ml-1">Male</span>
                            </label>
                            <label class="inline-flex items-center gap-1">
                                <input type="checkbox" class="form-checkbox text-teal-500 rounded focus:ring-teal-400">
                                <span class="ml-1">Female</span>
                            </label>
                        </div>
                    </div>
                    <button
                        class="w-full bg-teal-500 text-white py-2 sm:py-3 rounded-lg font-semibold shadow-md hover:from-teal-600 hover:to-teal-600 transition flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        Search
                    </button>
                </div>
            </aside>
            <section class="w-full lg:w-3/4">
                <div
                    class="bg-white/90 p-4 sm:p-6 rounded-2xl shadow-xl mb-6 sm:mb-8 flex flex-col md:flex-row md:items-center md:justify-between border border-teal-100">
                    <h2 class="text-lg sm:text-xl font-bold text-teal-800 mb-2 md:mb-0">
                        2 matches found for:
                        <span class="bg-teal-100 text-teal-700 px-2 py-1 rounded-lg font-semibold">Urology</span>
                        in <span class="text-teal-700">Purnea</span>
                    </h2>
                    <div class="mt-2 md:mt-0">
                        <select
                            class="border-teal-200 rounded-lg shadow-sm focus:ring-teal-400 focus:border-teal-400 transition text-xs sm:text-base">
                            <option>Sort by</option>
                            <option>Rating</option>
                            <option>Experience</option>
                            <option>Price</option>
                        </select>
                    </div>
                </div>
                @foreach ($doctors as $doctor)
                <!-- Doctor Cards in Row -->
                <div class="space-y-6 sm:space-y-8">
                    <!-- Doctor Card 1 -->
                    <div
                        class="bg-white/95 p-4 sm:p-6 rounded-2xl shadow-xl flex flex-col md:flex-row items-center border border-teal-100 hover:shadow-2xl transition group">
                        <div class="relative">
                            <img src="https://via.placeholder.com/100" alt="Dr. ABC Anand"
                                class="w-20 h-20 sm:w-28 sm:h-28 rounded-full border-4 border-teal-100 shadow-md object-cover">
                            <span class="absolute bottom-1 right-1 bg-teal-500 text-white rounded-full p-1 shadow"
                                title="Verified">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </div>
                        <div class="flex-1 ml-0 md:ml-6 mt-4 md:mt-0 w-full">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-1 sm:gap-2 mb-1">
                                <h3 class="text-base sm:text-lg font-bold text-teal-900">{{$doctor->user->name ?? 'N/A'}}</h3>
                                <span
                                    class="bg-teal-100 text-teal-700 text-xs px-2 py-1 rounded-full font-semibold">{{$doctor->department->name}}</span>
                            </div>
                            <p class="text-gray-500 mb-1 text-xs sm:text-base">{{$doctor->qualification ?? 'N/A'}}</p>
                            <div class="flex items-center gap-1 mb-1">
                                <span class="flex text-yellow-400 text-base sm:text-lg">★★★★★</span>
                                <span class="text-teal-700 font-semibold ml-1 text-xs sm:text-base">4.9</span>
                                <span class="text-gray-400 text-xs sm:text-sm">(17 reviews)</span>
                            </div>
                            <p class="text-gray-600 flex items-center gap-1 text-xs sm:text-base">
                                <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 1011.314-11.314l-4.243 4.243z" />
                                </svg>
                                Purnea, Bihar
                            </p>
                            <div class="flex space-x-2 mt-2 sm:mt-3">
                                <img src="https://via.placeholder.com/50" alt="Service"
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg shadow object-cover">
                                <img src="https://via.placeholder.com/50" alt="Service"
                                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg shadow object-cover">
                            </div>
                        </div>
                        <div class="text-right mt-4 md:mt-0 md:ml-6 flex flex-col items-end gap-1 sm:gap-2 w-full md:w-auto">
                            <span class="bg-green-100 text-green-700 px-2 sm:px-3 py-1 rounded-full text-xs font-semibold">98% Positive</span>
                            <span class="text-gray-500 text-xs sm:text-sm">17 Feedback</span>
                            <span class="text-teal-700 font-bold text-base sm:text-lg">{{$doctor->fees ?? 'N/A'}}</span>
                            <div class="flex flex-col gap-1 sm:gap-2 mt-2 w-full md:w-auto">
                                <button
                                    class="bg-orange-500 text-white px-3 sm:px-4 py-2 rounded-lg font-semibold shadow hover:from-teal-600 hover:to-teal-500 transition text-xs sm:text-base">View Profile</button>
                                <a href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}" class="text-blue-600 hover:underline">
                                    <button
                                        class="bg-teal-500 text-white px-3 sm:px-4 py-2 rounded-lg font-semibold shadow hover:from-teal-500 hover:to-teal-700 transition text-xs sm:text-base">Book Appointment</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </section>
        </div>
    </div>
</div>