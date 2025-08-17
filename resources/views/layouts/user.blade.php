<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'My Dashboard | MedBuzzy' }}</title>
    
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 font-sans antialiased">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
        <button onclick="toggleSidebar()" class="text-gray-600">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h1 class="text-xl font-bold text-brand-blue-600">My Profile</h1>
        <a href="{{ route('appointment') }}" class="bg-brand-orange-500 text-white px-3 py-1 rounded-lg text-sm">
            <i class="fas fa-plus mr-1"></i> Book
        </a>
    </header>

    <!-- Desktop Header -->
    <header class="hidden lg:flex bg-white shadow-sm p-4 justify-between items-center sticky top-0 z-10">
        <h1 class="text-2xl font-bold text-brand-blue-600">Welcome, {{ auth()->user()->name }}</h1>
        <div class="flex space-x-4">
            <a href="{{ route('appointment') }}" class="bg-brand-orange-500 hover:bg-brand-orange-600 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i> New Appointment
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex min-h-screen">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed w-64 h-full bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform z-30">
            <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-blue-100 rounded-full flex items-center justify-center text-brand-blue-600 font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>
            <nav class="p-4 space-y-2">
                <a wire:navigate href="" class="flex items-center p-3 rounded-lg hover:bg-brand-blue-50 text-brand-blue-600 font-medium">
                    <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i> Dashboard
                </a>
                <a wire:navigate href="" class="flex items-center p-3 rounded-lg hover:bg-brand-blue-50 text-gray-700">
                    <i class="fas fa-calendar-check mr-3 w-5 text-center"></i> My Appointments
                </a>
                <a wire:navigate href="" class="flex items-center p-3 rounded-lg hover:bg-brand-blue-50 text-gray-700">
                    <i class="fas fa-user-edit mr-3 w-5 text-center"></i> Profile Settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center p-3 rounded-lg hover:bg-red-50 text-red-600">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Page Content -->
        <main class="flex-1 lg:ml-64 p-4 md:p-6 bg-gray-50 min-h-screen">
            {{ $slot }}
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
    @livewireScripts
</body>
</html>