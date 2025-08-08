<div id="sidebar" class="fixed inset-y-0 left-0 w-64 sm:w-72 md:w-64 bg-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">
    <!-- Sidebar header with logo and close icon -->
    <div class="flex items-center justify-between h-16 sm:h-20 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-3 sm:px-4">
        <div class="flex items-center space-x-2 sm:space-x-3">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <div>
                <h1 class="text-lg sm:text-xl font-bold text-blue-600">
                    MedBuzzy<span class="font-light">Manager</span>
                </h1>
                <p class="text-xs text-blue-500 hidden sm:block">Medical Management</p>
            </div>
        </div>
        <!-- Close icon for mobile -->
        <button id="closeSidebar" class="md:hidden text-gray-600 hover:text-gray-800 focus:outline-none p-1 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation links -->
    <nav class="flex-1 px-3 sm:px-4 py-4 sm:py-6 space-y-1 sm:space-y-2 overflow-y-auto">
        <a wire:navigate href="{{ route('manager.dashboard') }}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-blue-100 p-1.5 sm:p-2 rounded-lg group-hover:bg-blue-200 transition-colors duration-200 flex-shrink-0">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </span>
            <span class="ml-2 sm:ml-3 font-medium text-sm sm:text-base">Dashboard</span>
        </a>

        <a wire:navigate href="{{ route('manager.manage.doctors') }}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-green-100 p-1.5 sm:p-2 rounded-lg group-hover:bg-green-200 transition-colors duration-200 flex-shrink-0">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </span>
            <span class="ml-2 sm:ml-3 font-medium text-sm sm:text-base">Doctors</span>
        </a>

        <a wire:navigate href="{{route('manager.appointments')}}" class="flex items-center px-3 sm:px-4 py-2.5 sm:py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-yellow-100 p-1.5 sm:p-2 rounded-lg group-hover:bg-yellow-200 transition-colors duration-200 flex-shrink-0">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </span>
            <span class="ml-2 sm:ml-3 font-medium text-sm sm:text-base">Appointments</span>
        </a>

        
    </nav>

    <!-- User profile and logout -->
    <div class="p-3 sm:p-4 border-t border-gray-100 bg-gray-50">
        <!-- User Info Card -->
        <div class="mb-2 sm:mb-3 p-2 sm:p-3 bg-white rounded-lg shadow-sm">
            <div class="flex items-center space-x-2 sm:space-x-3">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-indigo-600 font-semibold text-xs sm:text-sm">
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    </span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'manager@medbuzzy.com' }}</p>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-3 sm:px-4 py-2 sm:py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors duration-200 group">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-red-500 group-hover:text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1"></path>
                </svg>
                <span class="font-medium">Sign Out</span>
            </button>
        </form>
    </div>
<!-- Mobile Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden transition-opacity duration-300"></div>


    <!-- JavaScript for toggling sidebar on mobile -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const closeBtn = document.getElementById('closeSidebar');

    // Function to open sidebar
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    // Function to close sidebar
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Global function for header button
    window.toggleSidebar = function() {
        if (sidebar.classList.contains('-translate-x-full')) {
            openSidebar();
        } else {
            closeSidebar();
        }
    };

    // Close button event
    closeBtn?.addEventListener('click', closeSidebar);
    
    // Overlay click to close
    overlay?.addEventListener('click', closeSidebar);

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });

    // Close sidebar on large screen resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeSidebar();
        }
    });
</script>
</div>

