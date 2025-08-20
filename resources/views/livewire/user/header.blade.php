<header class="hidden lg:flex bg-white shadow-sm p-4 justify-between items-center sticky top-0 z-10 ">
    <div class="flex items-center">
        <button onclick="toggleSidebar()" class="mr-4 text-gray-600 hover:text-brand-blue-600">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <img src="/logo/logo1.png" alt="MedBuzzy Logo" class="h-10 lg:h-12">
    </div>
    
    <div class="flex items-center space-x-6">
        <a href="{{ route('hero') }}" class="bg-brand-orange-500 hover:bg-brand-orange-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
            <i class="fas fa-home mr-2"></i> Home
        </a>
        
        <!-- User Dropdown -->
        <div class="relative group">
            <button class="flex items-center space-x-2 focus:outline-none">
                <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-semibold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                <i class="fas fa-chevron-down text-gray-500 text-xs transition-transform group-hover:rotate-180"></i>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                <a wire:navigate href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-blue-50 flex items-center space-x-2">
                    <i class="fas fa-user-edit w-4 text-center"></i>
                    <span>My Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt w-4 text-center"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<header class="lg:hidden bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
    <button onclick="toggleSidebar()" class="text-gray-600">
        <i class="fas fa-bars text-xl"></i>
    </button>
    <h1 class="text-xl font-bold text-brand-blue-600">My Dashboard</h1>
       <a href="{{ route('hero') }}" class="bg-brand-orange-500 hover:bg-brand-orange-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
            <i class="fas fa-home mr-2"></i> Home
        </a>
</header>

