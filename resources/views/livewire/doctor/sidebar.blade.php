<div class="h-full bg-white shadow-md flex flex-col">
    <!-- Profile Section -->
   <div class="p-6 border-b flex items-center space-x-4">
    @if($doctor->image)
        <img src="{{ $doctor->image }}?v={{ time() }}" 
             alt="Doctor Profile" 
             class="w-12 h-12 rounded-full object-cover border-2 border-blue-100"
             wire:key="sidebar-profile-image-{{ $doctor->id }}-{{ now()->timestamp }}">
    @else
        <div class="w-12 h-12 rounded-full bg-blue-100 border-2 border-blue-200 flex items-center justify-center text-blue-600 font-semibold">
            {{ substr($doctor->user->name, 0, 1) }}
        </div>
    @endif
        <div>
            <h2 class="font-semibold text-gray-800 text-lg">{{ $doctor->user->name }}</h2>
            <p class="text-gray-500 text-sm">{{ $doctor->department->name ?? 'No Department' }}</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1">
        <a wire:navigate href="{{ route('doctor.dashboard') }}"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0l2 2m-2-2l-2 2m4 0v6" />
            </svg>
            Dashboard
        </a>

        <!-- Create Manager -->
        <a wire:navigate href="{{ route('doctor.manager.create') }}"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Manager
        </a>

        <a wire:navigate href="{{ route('doctor.create-slot') }}"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Slot
        </a>

        <a wire:navigate href="{{ route('doctor.add-leave') }}"
            class="flex items-center px-4 py-2 text-gray-700 hover:bg-red-100 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-red-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            </svg>
            Add Leave
        </a>


        <!-- Add more doctor links here -->

    </nav>

    <!-- Logout -->
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-100 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('profile-picture-updated', (event) => {
            // Update the image source with cache busting
            const img = document.querySelector('[wire\\:key^="sidebar-profile-image"]');
            if (img) {
                img.src = `${event.imageUrl}?v=${new Date().getTime()}`;
            }
        });
    });
</script>