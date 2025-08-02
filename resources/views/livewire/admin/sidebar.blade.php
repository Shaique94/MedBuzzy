<aside id="sidebar"
    class="fixed h-full w-64 bg-white shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-20 border-r border-gray-200">
    <div class="flex flex-col h-full">
        <!-- Brand/Logo -->
        <div class="flex items-center justify-center h-16 lg:h-20 border-b border-gray-200 px-4 lg:px-6 bg-gradient-to-r from-blue-600 to-blue-700">
            <div class="bg-white text-blue-600 rounded-full w-10 h-10 flex items-center justify-center mr-3 shadow-lg">
                <i class="fas fa-user-md text-lg"></i>
            </div>
            <span class="text-xl font-bold text-white">Medbuzzy</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 mt-4 lg:mt-6 px-3 lg:px-4 space-y-1 overflow-y-auto">
            <a href="/admin/dashboard" class="sidebar-link flex items-center px-3 lg:px-4 py-3 text-gray-700 responsive-text-base">
                <i class="fas fa-chart-line text-blue-500 w-5 lg:w-6 text-center"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <a href="{{route('admin.appointment')}}" class="sidebar-link flex items-center px-3 lg:px-4 py-3 text-gray-700 responsive-text-base">
                <i class="fas fa-calendar-check text-blue-500 w-5 lg:w-6 text-center"></i>
                <span class="ml-3">Appointments</span>
            </a>

            <a href="{{ route('admin.departments') }}" class="sidebar-link flex items-center px-3 lg:px-4 py-3 text-gray-700 responsive-text-base">
                <i class="fas fa-building text-blue-500 w-5 lg:w-6 text-center"></i>
                <span class="ml-3">Departments</span>
            </a>

            <a href="{{ route('admin.doctors.list') }}" class="sidebar-link flex items-center px-3 lg:px-4 py-3 text-gray-700 responsive-text-base">
                <i class="fas fa-user-md text-blue-500 w-5 lg:w-6 text-center"></i>
                <span class="ml-3">Manage Doctors</span>
            </a>

            <a href="{{route('admin.reviewapprovel')}}" class="sidebar-link flex items-center px-3 lg:px-4 py-3 text-gray-700 responsive-text-base">
                <i class="fas fa-star text-blue-500 w-5 lg:w-6 text-center"></i>
                <span class="ml-3">Reviews</span>
            </a>

           
           
        </nav>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200 p-3 lg:p-4">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    @auth
                        <span class="text-blue-600 font-medium text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    @else
                        <i class="fas fa-user text-blue-600"></i>
                    @endauth
                </div>
                <div class="flex-1 min-w-0">
                    <p class="responsive-text-sm font-medium text-gray-900 truncate">
                        @auth
                            {{ auth()->user()->name ?? 'Admin User' }}
                        @else
                            Guest
                        @endauth
                    </p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
            
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="sidebar-link flex items-center w-full px-3 lg:px-4 py-3 text-red-600 responsive-text-base hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5 lg:w-6 text-center"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
