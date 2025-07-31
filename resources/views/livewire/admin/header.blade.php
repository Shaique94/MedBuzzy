 <header class="bg-white shadow-md hidden w-full  sm:block py-4 rounded px-6 sticky top-0 z-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Dashboard</h1>
        </div>
        <div class="flex items-center space-x-6">
            <div class="relative">
                <button class="text-gray-600 hover:text-blue-600">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
            <div class="flex items-center">
                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=200&h=200&q=80"
                    class="w-10 h-10 rounded-full object-cover border-2 border-blue-200" alt="Profile">
                <span class="ml-3 font-medium text-gray-700 hidden md:inline">@auth
    Mr. {{ auth()->user()->name ?? 'Unknown' }}
@else
    Guest
@endauth
</span>
            </div>
        </div>
    </div>
</header>

