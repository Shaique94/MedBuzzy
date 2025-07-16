<div class="h-full bg-white shadow-md flex flex-col">
    <!-- Profile -->
    <div class="p-6 border-b flex items-center space-x-4">
        <img src="https://i.pravatar.cc/100?img=12" alt="Doctor Avatar" class="w-12 h-12 rounded-full object-cover">
        <div>
            <h2 class="font-semibold text-gray-800 text-lg">{{$doctor->user->name}}</h2>
            <p class="text-gray-500 text-sm">{{$doctor->department->name}}</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1">
        <a wire:navigate href="{{ route('doctor.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0l2 2m-2-2l-2 2m4 0v6" />
            </svg>
            Dashboard
        </a>

        <!-- Create Manager -->
        <a wire:navigate href="{{ route('doctor.create-manager') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Manager
        </a>

        <a wire:navigate href="{{ route('doctor.create-slot') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Slot
        </a>

        <!-- Add more doctor links here -->


    </nav>

    <!-- Logout -->
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-100 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
