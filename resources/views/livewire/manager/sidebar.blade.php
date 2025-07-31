<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">
    <!-- Sidebar header with logo and close icon -->
    <div class="flex items-center justify-between h-20 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white px-4">
        <div class="flex items-center space-x-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h1 class="text-xl font-bold text-blue-600">MedBuzzy<span class="font-light">Manager</span></h1>
        </div>
        <!-- Close icon for mobile -->
        <button id="closeSidebar" class="md:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation links -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <a wire:navigate href="{{ route('manager.dashboard') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-blue-100 p-2 rounded-lg group-hover:bg-blue-200 transition-colors duration-200">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </span>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>

        <a href="{{ route('manager.manage.doctors') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-green-100 p-2 rounded-lg group-hover:bg-green-200 transition-colors duration-200">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </span>
            <span class="ml-3 font-medium">Doctors</span>
        </a>

        <a href="{{route('manager.appointments')}}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-yellow-100 p-2 rounded-lg group-hover:bg-yellow-200 transition-colors duration-200">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </span>
            <span class="ml-3 font-medium">Appointments</span>
        </a>
    </nav>

    <!-- User profile and logout -->
    <div class="p-4 border-t border-gray-100 bg-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1"></path>
                </svg>
                Sign Out
            </button>
        </form>
    </div>
</div>

<!-- JavaScript for toggling sidebar on mobile -->
<script>
    document.getElementById('closeSidebar')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    });
</script>