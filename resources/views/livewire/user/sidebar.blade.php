<aside id="sidebar" class="fixed w-64 h-full bg-white shadow-lg transform -translate-x-full lg:translate-x-0 sidebar-transition z-30 lg:w-64">

     <div class="flex flex-col h-full">
    <!-- Navigation -->
    <nav class="p-4 space-y-1">
        <a wire:navigate href="{{ route('user.dashboard') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-blue-600 font-medium sidebar-item-transition">
            <i class="fas fa-tachometer-alt w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Dashboard</span>
        </a>
        <a wire:navigate href="{{ route('appointment') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-calendar-check w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">My Appointments</span>
        </a>
        <a wire:navigate href="{{ route('user.profile') }}" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-user-edit w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Profile Settings</span>
        </a>
         <a wire:navigate href="" 
               class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
                <i class="fas fa-star w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-text ml-3">Review</span>
            </a>
        <a wire:navigate href="" 
           class="flex items-center p-3 rounded-lg hover:bg-blue-50 text-gray-700 sidebar-item-transition">
            <i class="fas fa-prescription w-5 text-center flex-shrink-0"></i>
            <span class="sidebar-text ml-3">Prescriptions</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full text-left flex items-center p-3 rounded-lg hover:bg-red-50 text-red-600 sidebar-item-transition">
                <i class="fas fa-sign-out-alt w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-text ml-3">Logout</span>
            </button>
        </form>
    </nav>


        <!-- User Profile -->
          <div class="border-t border-gray-400  p-3 lg:p-4 fixed bottom-4">
    <div class="p-4  flex items-center space-x-3 sidebar-item-transition overflow-hidden">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold flex-shrink-0">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <div class="sidebar-text ml-0 whitespace-nowrap">
            <p class="font-medium">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
        </div>
    </div>

      <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full text-left flex items-center p-3 rounded-lg hover:bg-red-50 text-red-600 sidebar-item-transition">
                <i class="fas fa-sign-out-alt w-5 text-center flex-shrink-0"></i>
                <span class="sidebar-text ml-3">Logout</span>
            </button>
        </form>
    </div>
</div>
</aside>

