<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Patient Dashboard | MedBuzzy' }}</title>
    
    <!-- Font Awesome -->
    <title>{{ $title ?? 'My Dashboard | MedBuzzy' }}</title>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body x-data="userLayout()" x-cloak class="bg-gray-50 font-sans antialiased">
    <script>
        // Lightweight Alpine component factory (runs before Alpine init)
        function userLayout() {
            return {
                sidebarOpen: false,
                active: localStorage.getItem('mb_active') || 'dashboard',
                init() {
                    // close mobile sidebar on Escape
                    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') this.sidebarOpen = false; });
                },
                toggleMobile() { this.sidebarOpen = !this.sidebarOpen; },
                setActive(id) {
                    this.active = id;
                    localStorage.setItem('mb_active', id);
                    // close mobile when selecting an item
                    this.sidebarOpen = false;
                }
            }
        }
    </script>

    <!-- Main Container -->
    <div class="flex min-h-screen">
        <!-- Mobile Sidebar Overlay -->
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"
            @click="sidebarOpen = false"
            aria-hidden="true"></div>

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed left-0 top-0 h-full bg-white shadow-lg transform transition-all z-50 overflow-y-auto lg:translate-x-0 lg:w-64 w-64"
            aria-label="Sidebar">
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <a wire:navigate href="/" class="flex items-center">
                        <img src="/logo/logo1.png" alt="MedBuzzy" class="h-9" />
                    </a>
                </div>

                <div class="flex items-center gap-2">
                    <!-- Mobile close -->
                    <button class="lg:hidden p-2 rounded-md hover:bg-gray-100" @click="sidebarOpen = false" aria-label="Close menu">
                        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Search -->
            <div class="p-3">
                <div class="flex items-center gap-2">
                    <div class="relative w-full">
                        <input type="search" placeholder="Search doctors, appointments..."
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-transparent" />
                        <button class="hidden lg:inline p-2 rounded-md hover:bg-gray-100">
                            <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Nav -->
            <nav class="p-3 space-y-1">
                <template x-for="item in [
                    { id: 'dashboard', label: 'Dashboard', icon: 'tachometer-alt', href: '' },
                    { id: 'appointments', label: 'My Appointments', icon: 'calendar-check', href: '' },
                    { id: 'profile', label: 'Profile Settings', icon: 'user-edit', href: '' },
                ]" :key="item.id">
                    <a href="#" @click.prevent="setActive(item.id)"
                        :class="(active === item.id) ? 'bg-brand-blue-50 text-primary' : 'text-gray-700 hover:bg-gray-50'"
                        class="flex items-center gap-3 p-2 rounded-md transition-colors text-sm">
                        <i :class="`fas fa-${item.icon} w-4 text-sm`"></i>
                        <span class="truncate lg:block" x-text="item.label"></span>
                    </a>
                </template>

                <!-- Expandable Submenu example -->
                <div x-data="{ open: false }" class="mt-2">
                    <button @click="open = !open" class="flex items-center justify-between w-full p-2 rounded-md hover:bg-gray-50 text-gray-700">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-stethoscope w-4"></i>
                            <span>Doctors</span>
                        </div>
                        <svg :class="open ? 'transform rotate-90' : ''" class="h-4 w-4 text-gray-500 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 6L14 10L6 14V6Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition class="mt-1 space-y-1 pl-9">
                        <a href="{{ route('our-doctors') }}" class="block text-sm text-gray-600 hover:text-gray-800">Browse Doctors</a>
                        <a href="{{ route('our-doctors') }}" class="block text-sm text-gray-600 hover:text-gray-800">By Specialty</a>
                    </div>
                </div>
            </nav>

            <div class="mt-auto p-3 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 p-2 rounded-md hover:bg-red-50 text-red-600">
                        <i class="fas fa-sign-out-alt w-4"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Page Content -->
        <main class="flex-1 lg:ml-64 p-4 md:p-6 bg-gray-50 min-h-screen transition-all">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-5">
                    <button @click="toggleMobile()" class="text-gray-600 focus:outline-none" aria-label="Open menu">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a wire:navigate href="/" class="flex items-center">
                        <img src="/logo/logo1.png" alt="MedBuzzy Logo" class="h-9">
                    </a>
                </div>
                <a href="" class="bg-brand-orange-500 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-plus mr-1"></i> Book
                </a>
            </header>

            {{ $slot }}
        </main>
    </div>

    <!-- No extra JS needed; Alpine takes care of interactions -->
    @livewireScripts
</body>

</html>