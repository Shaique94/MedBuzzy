<div class="bg-white shadow-sm px-4 sm:px-6 py-3 flex items-center justify-between sticky top-0 z-40">
    <!-- Left Section -->
    <div class="flex items-center space-x-4">
        <!-- Mobile menu button - always visible but hidden on lg+ -->
        <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-indigo-600 transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        
        <!-- Logo/Brand - hidden on mobile, visible from sm up -->
        <div class="hidden sm:flex items-center space-x-2">
            <!-- Optional logo image -->
            <h1 class="text-xl font-bold text-gray-800 whitespace-nowrap">Doctor Manager Dashboard</h1>
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-4 sm:space-x-6">
        <!-- Notification icon -->
        <button class="relative p-1 text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 8 7.388 8 9v5.159c0 .538-.214 1.055-.595 1.436L6 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">3</span>
        </button>

        <!-- Profile dropdown -->
        <div class="relative" x-data="{ open: false }">
            <div class="flex items-center cursor-pointer space-x-1 group" @click="open = !open">
                @if (auth()->user()->image)
                    <img class="h-8 w-8 sm:h-9 sm:w-9 rounded-full object-cover border-2 border-indigo-100 shadow-sm group-hover:border-indigo-200 transition-all duration-200"
                        src="{{ auth()->user()->image }}" alt="Profile Image">
                @else
                    <div class="h-8 w-8 sm:h-9 sm:w-9 rounded-full bg-indigo-100 border-2 border-indigo-100 shadow-sm group-hover:border-indigo-200 transition-all duration-200 flex items-center justify-center text-indigo-600 font-medium">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-100 z-50 overflow-hidden">
                <!-- Profile Link -->
                <a wire:navigate href="{{ route('manager.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd"/>
                    </svg>
                    <span>Profile</span>
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-100"></div>

                <!-- Logout -->
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>