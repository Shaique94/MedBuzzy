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

       @livewire('user.sidebar')

        <!-- Page Content -->
        <main class="flex-1 lg:ml-64 p-4 md:p-6 bg-gray-50 min-h-screen transition-all">
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-10">
                <div class="flex items-center gap-5">
                    <button @click="toggleMobile()" class="text-gray-600 focus:outline-none" aria-label="Open menu">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <a wire:navigate href="/" class="flex items-center">
                        <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-9">
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
    <script>
    // Listen for Livewire notification event
    Livewire.on('notify', message => {
        Toastify({
            text: message,
            duration: 3000,
            gravity: "top", 
            position: "right",
            backgroundColor: "#4ade80", 
        }).showToast();
    });
</script>
</body>

</html>