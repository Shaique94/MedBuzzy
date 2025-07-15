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

        <!-- Add more doctor links here -->

         <!-- Add Profile -->
        <a wire:navigate href="{{ route('doctor.profile') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg transition">
          <svg class="w-6 h-6 text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
</svg>
            Profile
        </a>

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
