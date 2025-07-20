<div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50 flex flex-col">
    <!-- Sidebar header with logo -->
    <div class="flex items-center justify-center h-20 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">
        <div class="flex items-center space-x-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h1 class="text-xl font-bold text-blue-600">MedBuzzy<span class="font-light">Manager</span></h1>
        </div>
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
            <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded-full">12</span>
        </a>

        <a href="{{route('manager.appointments')}}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-yellow-100 p-2 rounded-lg group-hover:bg-yellow-200 transition-colors duration-200">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-7 4h4m-9 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z"></path>
                </svg>
            </span>
            <span class="ml-3 font-medium">Appointments</span>
            <span class="ml-auto bg-red-100 text-red-800 text-xs font-semibold px-2 py-0.5 rounded-full">5</span>
        </a>

        <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200 group">
            <span class="bg-gray-100 p-2 rounded-lg group-hover:bg-gray-200 transition-colors duration-200">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </span>
            <span class="ml-3 font-medium">Settings</span>
        </a>
    </nav>

    <!-- User profile and logout -->
    <div class="p-4 border-t border-gray-100 bg-gray-50">
      <div class="flex items-center mb-4">
    @if(auth()->user()->image_url)
        <img class="w-10 h-10 rounded-full object-cover" 
             src="{{ auth()->user()->image_url }}" 
             alt="{{ auth()->user()->name }} profile picture">
    @else
        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
            <span class="text-blue-600 font-medium text-sm uppercase">
                {{ substr(auth()->user()->name, 0, 1) }}
            </span>
        </div>
    @endif
    <div class="ml-3">
        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
    </div>
</div>
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