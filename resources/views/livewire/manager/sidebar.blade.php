<div>
    <div id="sidebar" class="fixed inset-y-0 left-0 w-64 sm:w-72 md:w-64 bg-white border-r border-gray-200 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">
    <!-- Sidebar header with logo and close icon -->
    <div class="flex items-center justify-between h-16 sm:h-20 border-b border-gray-200 bg-white px-4 sm:px-6">
        <!-- Logo Section - Now visible on all screen sizes -->
        <div class="flex items-center space-x-3">
            <img src="/logo/logo1.png" alt="MedBuzzy Logo" class="h-8 sm:h-10 w-auto">
           
        </div>
        
        <!-- Close icon for mobile -->
        <button id="closeSidebar" class="md:hidden text-gray-500 hover:text-gray-700 hover:bg-gray-100 p-2 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation links -->
    <nav class="flex-1 px-4 sm:px-6 py-4 space-y-2 overflow-y-auto">
        <!-- Dashboard Link -->
        <a wire:navigate href="{{ route('manager.dashboard') }}" 
           class="flex items-center px-4 py-3 text-gray-700 hover:bg-brand-blue-50 hover:text-brand-blue-700 rounded-lg transition-colors group">
            <div class="bg-brand-blue-100 p-2 rounded-lg group-hover:bg-brand-blue-200 transition-colors">
                <svg class="w-5 h-5 text-brand-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <span class="ml-3 font-medium">Dashboard</span>
            <div class="ml-auto">
                <div class="w-2 h-2 bg-brand-blue-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </a>

        <!-- Doctors Management Link -->
        <a wire:navigate href="{{ route('manager.manage.doctors') }}" 
           class="flex items-center px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors group">
            <div class="bg-green-100 p-2 rounded-lg group-hover:bg-green-200 transition-colors">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <span class="ml-3 font-medium">Manage Doctors</span>
            <div class="ml-auto">
                <div class="w-2 h-2 bg-green-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </a>

        <!-- Appointments Link -->
        <a wire:navigate href="{{route('manager.appointments')}}" 
           class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors group">
            <div class="bg-yellow-100 p-2 rounded-lg group-hover:bg-yellow-200 transition-colors">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="ml-3 font-medium">Appointments</span>
            <div class="ml-auto">
                <div class="w-2 h-2 bg-yellow-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </a>


         <a wire:navigate href="{{route('manager.report')}}" 
           class="flex items-center px-4 py-3 text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors group">
            <div class="bg-yellow-100 p-2 rounded-lg group-hover:bg-yellow-200 transition-colors">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="ml-3 font-medium">Report</span>
            <div class="ml-auto">
                <div class="w-2 h-2 bg-yellow-600 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        </a>




      
    </nav>

    <!-- User profile and logout -->
    <div class="p-4 sm:p-6 border-t border-gray-200 bg-gray-50">
        <!-- User Info Card -->
        <div class="mb-4 p-3 bg-white rounded-lg border border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-brand-blue-600 font-medium text-sm">
                        {{ substr(auth()->user()->name ?? 'M', 0, 1) }}
                    </span>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ auth()->user()->name ?? 'Manager' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'manager@medbuzzy.com' }}</p>
                    <div class="flex items-center mt-1">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-1"></div>
                        <span class="text-xs text-gray-500">Online</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-2">
            <!-- Profile Button -->
           
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-700 hover:bg-red-50 hover:text-red-800 rounded-lg transition-colors border border-red-200 group">
                    <svg class="w-4 h-4 mr-3 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1"></path>
                    </svg>
                    <span class="font-medium">Sign Out</span>
                </button>
            </form>
        </div>

        
    </div>
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
        
        // Add animation class
        setTimeout(() => {
            overlay.classList.add('opacity-100');
        }, 10);
    }

    // Function to close sidebar
    function closeSidebar() {
        overlay.classList.remove('opacity-100');
        setTimeout(() => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 150);
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

    // Active link highlighting
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('nav a[wire\\:navigate]');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.split('/').pop())) {
                link.classList.add('bg-brand-blue-100', 'text-brand-blue-700', 'border-r-2', 'border-brand-blue-600');
                link.classList.remove('text-gray-700');
                
                // Add active indicator
                const indicator = link.querySelector('.ml-auto div');
                if (indicator) {
                    indicator.classList.remove('opacity-0');
                    indicator.classList.add('opacity-100');
                }
            }
        });
    });

    // Add smooth scroll behavior for better UX
    document.documentElement.style.scrollBehavior = 'smooth';
</script>


</div>