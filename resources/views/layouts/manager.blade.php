<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manager Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Open Graph & canonical tags (optional) -->
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="{{ url()->current() }}">
</head>

<body class="bg-gray-100 font-sans antialiased">

    <!-- Mobile header -->
  

    <!-- Page container -->
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <livewire:manager.sidebar />

        <!-- Main content -->
        <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">

            <!-- Header -->
            <livewire:manager.header />

            <!-- Page content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto  ">
                    {{ $slot }}
                      @livewire('livewire-ui-modal')
                </div>
            </main>

            <!-- Footer -->
            <livewire:manager.footer />
        </div>
    </div>

    <!-- Sidebar toggle script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>

    @livewireScripts
</body>
</html>
