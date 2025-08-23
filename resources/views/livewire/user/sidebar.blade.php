<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed left-0 top-0 h-full bg-white shadow-lg transform transition-all z-50 overflow-y-auto lg:translate-x-0 lg:w-64 w-64"
    aria-label="Sidebar">
    
    <div class="flex items-center justify-between p-4 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <a wire:navigate href="/" class="flex items-center">
                <img src="/logo/logo1.png" alt="MedBuzzy" class="h-9" />
            </a>
        </div>
        <div class="flex items-center gap-2">
            <button class="lg:hidden p-2 rounded-md hover:bg-gray-100" @click="sidebarOpen = false" aria-label="Close menu">
                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Your sidebar navigation content here -->
    <nav class="p-4 space-y-1">
        <a wire:navigate href="{{ route('user.dashboard') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-blue-600 font-medium sidebar-item-transition">
            <i class="fas fa-tachometer-alt w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Dashboard</span>
        </a>
        <a wire:navigate href="{{ route('user.appointments') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-calendar-check w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">My Appointments</span>
        </a>
          <a wire:navigate href="{{ route('user.profile') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-user-edit w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Profile Settings</span>
        </a>
                   <a wire:navigate href="" 
               class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
                <i class="fas fa-star w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-text ml-3">Review</span>
            </a>
             {{-- <a wire:navigate href="" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-prescription w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Prescriptions</span>
        </a> --}}
        <!-- Other navigation items -->
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full text-left flex items-center p-3 rounded-lg hover:bg-red-50 text-red-600 sidebar-item-transition">
                <i class="fas fa-sign-out-alt w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-text ml-3">Logout</span>
            </button>
        </form>
    </nav>
    
    <!-- User profile section -->
    <div class="border-t border-gray-400 p-3 lg:p-4 mt-auto fixed bottom-0">
        <div class="p-4 flex items-center space-x-3 sidebar-item-transition overflow-hidden">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="sidebar-text ml-0 whitespace-nowrap">
                <p class="font-medium">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </div>
</aside>

