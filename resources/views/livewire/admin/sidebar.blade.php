<aside id="sidebar"
    class="fixed h-full w-64 bg-white lg:translate-x-0 transition-transform duration-150 ease-in-out z-20 border-r border-gray-200">
    <div class="flex flex-col h-full">
        <!-- Brand/Logo -->
        <div
            class="flex items-center justify-center h-16 lg:h-20 border-b border-gray-200 px-4 lg:px-6 bg-white lg:block hidden">

            <img src="/logo/logo1.png" alt="MedBuzzy Logo" class="h-16 lg:h-20 lg:block hidden">

        </div>

        <!-- Navigation -->
        <nav class="flex-1 mt-4 lg:mt-6 px-2 lg:px-4 space-y-1 overflow-y-auto">
            <a wire:navigate href="/admin/dashboard"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-chart-line text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Dashboard</span>
            </a>

            <a wire:navigate href="{{ route('admin.appointment') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-calendar-check text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Appointments</span>
            </a>

            <a wire:navigate href="{{ route('admin.departments') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-building text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Departments</span>
            </a>

            <a wire:navigate href="{{ route('admin.doctors.list') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-user-md text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Manage Doctors</span>
            </a>

            <a wire:navigate href="{{ route('admin.reviewapprovel') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-star text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Reviews</span>
            </a>

            <a href="{{ route('admin.enquiry') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-question-circle text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Enquiry</span>
            </a>

            <a href="{{ route('admin.ManagePayment') }}"
                class="sidebar-link flex items-center w-full px-3 py-3 text-gray-700 responsive-text-base rounded-md hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300 focus-visible:ring-offset-1 transition-colors">
                <i class="fas fa-credit-card text-blue-500 w-5 text-center" aria-hidden="true"></i>
                <span class="ml-3 truncate">Manage Payment</span>
            </a>
        </nav>

        <!-- User Profile Section -->
        <div class="border-t border-gray-200 p-3 lg:p-4">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    @auth
                        <span class="text-gray-700 font-medium text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    @else
                        <i class="fas fa-user text-gray-700"></i>
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
                <button type="submit"
                    class="flex items-center w-full px-3 py-3 text-red-600 responsive-text-base rounded-md hover:bg-red-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-200 focus-visible:ring-offset-1 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span class="ml-3 truncate">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
