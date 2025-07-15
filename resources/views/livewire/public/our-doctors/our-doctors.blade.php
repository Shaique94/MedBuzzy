<div class="min-h-screen bg-gradient-to-br from-teal-50 to-cyan-50 px-4 py-8 sm:py-12">
    <div class="container mx-auto max-w-7xl">
        <!-- Page Heading -->
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-bold text-teal-800 mb-3">Find Your Perfect Doctor</h1>
            <p class="text-teal-600 max-w-2xl mx-auto text-lg">Connect with trusted healthcare professionals in your area
            </p>
        </div>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-10">
            <form wire:submit.prevent="loadDoctors" class="relative">
                <div class="relative">
                    <input type="text" wire:model.live="searchQuery"
                        placeholder="Search doctors by name, email, or qualification..."
                        class="w-full pl-5 pr-12 py-3 border-0 rounded-full focus:outline-none focus:ring-2 focus:ring-teal-300 shadow-md text-teal-800 placeholder-teal-400">
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-teal-500 text-white p-2 rounded-full hover:bg-teal-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filter

 Section -->
            <aside
                class="w-full lg:w-1/4 bg-white p-6 rounded-xl shadow-sm border border-teal-100 lg:sticky top-24 h-fit">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-teal-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-teal-800">Filters</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-teal-700 mb-2">Specialty</label>
                        <div class="relative">
                            <select wire:model.live="department_id"
                                class="block w-full pl-3 pr-10 py-2 text-base border-teal-200 focus:outline-none focus:ring-2 focus:ring-teal-300 focus:border-teal-300 rounded-lg shadow-sm">
                                <option value="">All Specialties</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <button wire:click="loadDoctors"
                        class="w-full bg-teal-500 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-teal-600 transition flex items-center justify-center gap-2">
                        Apply Filters
                    </button>
                </div>
            </aside>

            <!-- Main Content -->
            <section class="w-full lg:w-3/4">
                <!-- Results Header -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-teal-100 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h2 class="text-xl font-bold text-teal-800 mb-2 md:mb-0">
                            <span class="text-teal-600">{{ count($doctors) }}</span> doctors found
                            @if ($department_id)
                                in <span
                                    class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full">{{ $departments->find($department_id)->name ?? '' }}</span>
                            @endif
                            @if (!empty($gender))
                                ({{ implode(', ', $gender) }})
                            @endif
                        </h2>
                        <div>
                            <select wire:model.live="sortBy"
                                class="border-teal-200 rounded-lg shadow-sm focus:ring-teal-300 focus:border-teal-300 text-teal-700">
                                <option value="name">Sort by: Name</option>
                                <option value="rating">Sort by: Rating</option>
                                <option value="experience">Sort by: Experience</option>
                                <option value="availability">Sort by: Availability</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Doctor Cards -->
                <div class="space-y-6">
                    @forelse ($doctors as $doctor)
                        <div
                            class="bg-white p-6 rounded-xl shadow-sm border border-teal-100 hover:shadow-md transition-all duration-300 group">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Doctor Image -->
                                <div
                                    class="w-28 h-28 bg-white rounded-full flex items-center justify-center shadow-lg overflow-hidden border border-gray-200">
                                    @if ($doctor->image)
                                        <img src="{{ asset('storage/' . $doctor->image) }}"
                                            alt="{{ $doctor->name }}'s Photo" class="w-full h-full object-cover">
                                    @else
                                        <!-- Fallback content if no image exists -->
                                        <div class="text-gray-400 text-center p-2">No Photo</div>
                                    @endif
                                </div>


                                <!-- Doctor Info -->
                                <div class="flex-grow">
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                                        <h3 class="text-xl font-bold text-teal-800">{{ $doctor->user->name ?? 'N/A' }}
                                        </h3>
                                        <span
                                            class="bg-teal-100 text-teal-700 text-sm px-3 py-1 rounded-full font-medium">{{ $doctor->department->name ?? 'N/A' }}</span>
                                    </div>

                                    <p class="text-teal-600 mb-3">
                                        @if (is_array($doctor->qualification))
                                            {{ implode(', ', $doctor->qualification) }}
                                        @else
                                            {{ $doctor->qualification ?? 'N/A' }}
                                        @endif
                                    </p>

                                    <div class="flex items-center gap-2 mb-3">
                                        <div class="flex text-orange-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            <span
                                                class="ml-1 text-teal-700 font-medium">{{ $doctor->rating ?? '4.9' }}</span>
                                            <span class="text-teal-400 ml-1">({{ $doctor->review_count ?? '24' }}
                                                reviews)</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 text-teal-600 mb-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 12.414a4 4 0 00-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a1 1 0 00-1.414 1.414l4.243 4.243a6 6 0 01-8.486 8.486l-4.242-4.242a1 1 0 00-1.414 1.414l4.242 4.243a4 4 0 005.657-5.657l-4.243-4.243a1 1 0 00-1.414 1.414l4.243 4.243z">
                                            </path>
                                        </svg>
                                        <span>{{ $doctor->location ?? 'Purnea, Bihar' }}</span>
                                    </div>

                                    <div class="flex gap-2">
                                        <span class="bg-cyan-100 text-cyan-800 text-xs px-2 py-1 rounded">General
                                            Checkup</span>
                                        <span
                                            class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded">Pediatric</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex-shrink-0 flex flex-col items-end gap-4">
                                    <div class="text-right">
                                        <p class="text-sm text-teal-600">Consultation Fee</p>
                                        <p class="text-2xl font-bold text-teal-800">₹{{ $doctor->fee ?? 'N/A' }}</p>
                                    </div>

                                    <div class="flex flex-col gap-2 w-full sm:w-auto">
                                        <a wire:navigate
                                            href="{{ route('appointment', ['doctor_id' => $doctor->id]) }}"
                                            class="bg-teal-500 text-white px-6 py-2 rounded-lg font-medium shadow hover:bg-teal-600 transition text-center">
                                            Book Appointment
                                        </a>
                                        <a wire:navigate
                                            href="{{ route('doctor-detail', ['doctor_id' => $doctor->id]) }}"
                                            class="border border-teal-500 text-teal-600 px-6 py-2 text-center rounded-lg font-medium hover:bg-teal-50 transition">
                                            View Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-teal-600">
                            No doctors found matching your criteria.
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</div>
