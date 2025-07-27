<aside id="sidebar"
    class="fixed h-full w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-20">
    <div class="flex flex-col h-full">
        <!-- Brand/Logo -->
        <div class="flex items-center justify-center h-20 border-b border-gray-200 px-6">
            <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center mr-3">
                <i class="fas fa-user-md"></i>
            </div>
            <span class="text-xl font-bold text-blue-800">Medbuzzy</span>
        </div>
        <!-- Navigation -->
        <nav class="flex-1 mt-6 px-4 space-y-1">
            <a href="/admin/dashboard" class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-chart-line text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <a href="{{route('admin.appointment')}}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-calendar-check text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Appointments</span>
                <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">12</span>
            </a>

            <a href="{{ route('admin.departments') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-building text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Departments</span>
            </a>
            <a href="{{ route('admin.manage.doctors') }}"
                class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-user-md text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Manage Doctors</span>
            </a>

            <a href="#" class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-users text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Patients</span>
            </a>

             <a href="{{route('admin.reviewapprovel')}}" class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-users text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Review</span>
            </a>
            <a href="/admin/settings" class="sidebar-link flex items-center px-4 py-3 text-gray-700 transition-all">
                <i class="fas fa-cog text-blue-500 w-6 text-center"></i>
                <span class="ml-3">Settings</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="sidebar-link flex items-center w-full px-4 py-3 text-gray-700 transition-all">
                    <i class="fas fa-sign-out-alt text-blue-500 w-6 text-center"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </nav>
    </div>

</aside>
