<aside class="w-64 bg-white shadow-lg h-screen fixed">
    <div class="p-4">
        <!-- Logo -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Admin Panel</h1>

        <!-- Navigation Links -->
        <nav class="space-y-4">
            <a href="/admin/dashboard" class="block text-gray-700 hover:text-blue-600 font-semibold">
                Dashboard
            </a>
            <a href="{{route('admin.departments')}}" class="block text-gray-700 hover:text-blue-600 font-semibold">
                Manage Departments
            </a>
            <a href="{{route('admin.appointments')}}" class="block text-gray-700 hover:text-blue-600 font-semibold">
                Manage Doctors
            </a>
            <a href="/admin/appointments" class="block text-gray-700 hover:text-blue-600 font-semibold">
                Appointments
            </a>
            <a href="/admin/settings" class="block text-gray-700 hover:text-blue-600 font-semibold">
                Settings
            </a>
            <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="text-gray-700 hover:text-blue-600 font-semibold w-full text-left">
                    Logout
                </button>
            </form>
        </nav>
    </div>
</aside>