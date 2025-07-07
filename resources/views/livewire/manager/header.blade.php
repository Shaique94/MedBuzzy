<div class="bg-white shadow px-6 py-4 flex items-center justify-between">
    <!-- Left: Title -->
    <div class="flex items-center space-x-3">
        <svg class="h-7 w-7 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zm0 2c-2.67 0-8 1.337-8 4v1h16v-1c0-2.663-5.33-4-8-4z"/>
        </svg>
        <h1 class="text-xl font-bold text-gray-800">Doctor Manager Dashboard</h1>
    </div>

    <!-- Right: User info / Profile -->
    <div class="flex items-center space-x-4">
        <!-- Notification icon -->
        <button class="relative text-gray-600 hover:text-blue-600 focus:outline-none">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C8.67 6.165 8 7.388 8 9v5.159c0 .538-.214 1.055-.595 1.436L6 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">3</span>
        </button>

        <!-- Profile image -->
        <div class="relative">
            <button class="flex items-center focus:outline-none">
                <img src="https://i.pravatar.cc/40" alt="Profile" class="h-9 w-9 rounded-full border-2 border-blue-600">
            </button>
        </div>
    </div>
</div>

