 <header class="bg-white shadow-md hidden lg:block w-full py-3 sm:py-4 rounded px-4 sm:px-6 sticky top-0 z-10 border-b border-gray-100">
    <div class="flex items-center justify-between max-w-full">
        <div>
            <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 truncate">Dashboard</h1>
            <p class="text-xs sm:text-sm text-gray-500 hidden sm:block">Welcome back to MedBuzzy</p>
        </div>
        <div class="flex items-center space-x-3 sm:space-x-4 lg:space-x-6">
            <!-- Notifications -->
            {{-- <div class="relative">
                <button class="text-gray-600 hover:text-blue-600 transition-colors duration-200 p-2 rounded-lg hover:bg-blue-50">
                    <i class="fas fa-bell text-lg sm:text-xl"></i>
                    <span class="absolute top-1 right-1 inline-block w-2 h-2 bg-red-500 rounded-full notification-dot"></span>
                </button>
            </div>
             --}}
            <!-- User Profile -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80"
                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-full object-cover border-2 border-blue-200 hover:border-blue-400 transition-colors duration-200" alt="Profile">
                    <div class="absolute bottom-0 right-0 w-2 h-2 sm:w-3 sm:h-3 bg-green-400 border-2 border-white rounded-full"></div>
                </div>
                <div class="hidden md:block text-left">
                    <span class="font-medium text-gray-700 text-sm lg:text-base block leading-tight">
                        @auth
                            {{ auth()->user()->name ?? 'Unknown' }}
                        @else
                            Guest
                        @endauth
                    </span>
                    <span class="text-xs text-gray-500">
                        @auth
                            {{ ucfirst(auth()->user()->role ?? 'User') }}
                        @else
                            Not logged in
                        @endauth
                    </span>
                </div>
                <!-- Dropdown arrow for profile menu -->
                {{-- <button class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button> --}}
            </div>
        </div>
    </div>

<style>
    /* Notification dot animation */
    .notification-dot {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    /* Responsive text utilities */
    @media (max-width: 640px) {
        .truncate {
            max-width: 150px;
        }
    }
    
    @media (min-width: 641px) and (max-width: 1024px) {
        .truncate {
            max-width: 200px;
        }
    }
    
    /* Profile hover effects */
    .group:hover .profile-dropdown {
        opacity: 1;
        transform: translateY(0);
        visibility: visible;
    }
</style>
</header>


