<div class="bg-white shadow-sm px-3 sm:px-4 lg:px-6 py-2 sm:py-3 flex items-center justify-between sticky top-0 z-40">
    <!-- Left Section -->
    <div class="flex items-center space-x-2 sm:space-x-4">
        <!-- Mobile menu button -->
        <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-indigo-600 transition-colors p-2 rounded-lg hover:bg-gray-100">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        
        <!-- Logo/Brand - responsive visibility -->
        <div class="flex items-center space-x-2 sm:space-x-3">
            <!-- Logo for mobile -->
            <div class="sm:hidden">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <!-- Full logo for larger screens -->
            <div class="hidden sm:flex items-center space-x-2">
                <svg class="w-7 h-7 lg:w-8 lg:h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <div>
                    <h1 class="text-lg lg:text-xl font-bold text-gray-800 whitespace-nowrap">
                        <span class="hidden lg:inline">Doctor Manager Dashboard</span>
                        <span class="lg:hidden">Manager Dashboard</span>
                    </h1>
                    <p class="text-xs text-gray-500 hidden lg:block">Medical Management System</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Center Section - Search Bar (hidden on mobile) -->
    <div class="hidden md:flex flex-1 max-w-md mx-4 lg:mx-6">
        <div class="relative w-full">
            <input type="text" 
                   placeholder="Search appointments, doctors..." 
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="flex items-center space-x-2 sm:space-x-3 lg:space-x-4">
        <!-- Mobile Search Button -->
        <button class="md:hidden p-2 text-gray-500 hover:text-indigo-600 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>

        <!-- Quick Actions - visible on larger screens -->
        <div class="hidden lg:flex items-center space-x-2">
            <button class="p-2 text-gray-500 hover:text-indigo-600 rounded-lg hover:bg-gray-100 transition-colors relative" title="Quick Add">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
            
            <button class="p-2 text-gray-500 hover:text-indigo-600 rounded-lg hover:bg-gray-100 transition-colors relative" title="Calendar">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </button>
        </div>

        <!-- Notification icon -->
        <button class="relative p-2 text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors rounded-lg hover:bg-gray-100">
            <svg class="h-5 w-5 sm:h-6 sm:w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 8 7.388 8 9v5.159c0 .538-.214 1.055-.595 1.436L6 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-1 right-1 inline-flex items-center justify-center w-4 h-4 sm:w-5 sm:h-5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">3</span>
        </button>

        <!-- Profile dropdown -->
        <div class="relative" x-data="{ open: false }">
            <div class="flex items-center cursor-pointer space-x-1 sm:space-x-2 group p-1 rounded-lg hover:bg-gray-50" @click="open = !open">
                @if (auth()->user()->image)
                    <img class="h-7 w-7 sm:h-8 sm:w-8 lg:h-9 lg:w-9 rounded-full object-cover border-2 border-indigo-100 shadow-sm group-hover:border-indigo-200 transition-all duration-200"
                        src="{{ auth()->user()->image }}" alt="Profile Image">
                @else
                    <div class="h-7 w-7 sm:h-8 sm:w-8 lg:h-9 lg:w-9 rounded-full bg-indigo-100 border-2 border-indigo-100 shadow-sm group-hover:border-indigo-200 transition-all duration-200 flex items-center justify-center text-indigo-600 font-medium text-xs sm:text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                
                <!-- User name - hidden on mobile -->
                <div class="hidden sm:block">
                    <p class="text-sm font-medium text-gray-700 group-hover:text-indigo-600">
                        {{ Str::limit(auth()->user()->name, 15) }}
                    </p>
                    <p class="text-xs text-gray-500 hidden lg:block">Manager</p>
                </div>
                
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-gray-400 group-hover:text-indigo-600 transition-colors duration-200"
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
                class="absolute right-0 mt-2 w-48 sm:w-56 bg-white rounded-lg shadow-lg border border-gray-100 z-50 overflow-hidden">
                
                <!-- User Info Header -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <!-- Profile Link -->
                <a wire:navigate href="{{ route('manager.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 sm:py-3 text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z"
                            clip-rule="evenodd"/>
                    </svg>
                    <span>Profile Settings</span>
                </a>

                <!-- Settings -->
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 sm:py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition duration-150">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Settings</span>
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-100"></div>

                <!-- Logout -->
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-2.5 sm:py-3 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>