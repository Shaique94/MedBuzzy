<div class="bg-white shadow-md px-6 py-4 flex items-center justify-between">

    <!-- Left: Page title -->
    <h1 class="text-xl font-semibold text-gray-800">
        Dashboard
    </h1>

    <!-- Right: Actions -->
    <div class="flex items-center space-x-4">

        <!-- Notifications icon (optional) -->
        <button class="text-gray-500 hover:text-gray-700 focus:outline-none relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">3</span>
        </button>

<!-- Profile Dropdown Wrapper -->
<div class="relative" x-data="{ open: false }">
    <!-- Trigger -->
    <div class="flex items-center cursor-pointer space-x-2 group" @click="open = !open">
        <img class="h-10 w-10 rounded-full object-cover border-2 border-indigo-100 shadow-md group-hover:border-indigo-200 transition-all duration-200"
             src="https://i.pravatar.cc/100?img=12"
             alt="Doctor Avatar">
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-4 w-4 text-gray-500 group-hover:text-indigo-600 transition-colors duration-200"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>

    <!-- Dropdown Box -->
    <div x-show="open" @click.outside="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 z-50 overflow-hidden">
        <!-- Profile Link -->
        <a wire:navigate href="{{ route('doctor.profile') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
            <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
            </svg>
            <span>Profile</span>
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-100"></div>

        <!-- Logout Form -->
        <form method="POST" action="/logout">
            @csrf
            <button type="submit"
                    class="flex items-center gap-3 w-full px-4 py-3 text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-400" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>


    </div>
</div>

