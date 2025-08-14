<!-- Inside your desktop header -->
<div class="hidden lg:flex items-center space-x-3 group relative">
    <div class="flex items-center space-x-2 cursor-pointer">
        <div class="w-9 h-9 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
    </div>
    
    <!-- Dropdown Menu -->
    <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
        <a 
            wire:navigate 
            href="{{ route('user.dashboard') }}" 
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand-teal-50 flex items-center space-x-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>My Profile</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>



<!-- Inside your mobile menu -->
@auth
    <div class="flex items-center space-x-3 px-3 py-2">
        <div class="w-8 h-8 rounded-full bg-brand-teal-100 flex items-center justify-center text-brand-teal-800 font-semibold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
    </div>
    
    <a 
        wire:navigate 
        href="{{ route('user.dashboard') }}" 
        class="block text-gray-700 hover:text-brand-teal-600 font-medium py-2 px-3 rounded-lg hover:bg-brand-teal-50 transition-colors duration-200 flex items-center space-x-2 mobile-menu-link"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span>My Profile</span>
    </a>
   <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
@endauth