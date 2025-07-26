<div x-data="{ activeTab: '{{ Route::currentRouteName() }}' }">
    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-200/50 z-50 lg:hidden shadow-lg">
        <div class="flex items-center justify-around py-2 px-2 max-w-lg mx-auto">
            <!-- Home -->
            <a 
                href="{{ route('hero') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200"
                :class="{ 'text-teal-600': activeTab === 'hero' }"
                @click="activeTab = 'hero'"
            >
                <div class="w-8 h-8 flex items-center justify-center rounded-full transition-all"
                    :class="activeTab === 'hero' 
                        ? 'bg-teal-600 text-white shadow-md' 
                        : 'bg-gray-100 text-gray-600'">
                    <i class="fas fa-home text-xs"></i>
                </div>
                <span class="text-[10px] font-medium">Home</span>
            </a>
            
            <!-- Doctors -->
            <a 
                href="{{ route('our-doctors') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200"
                :class="{ 'text-teal-600': activeTab === 'our-doctors' }"
                @click="activeTab = 'our-doctors'"
            >
                <div class="w-8 h-8 flex items-center justify-center rounded-full transition-all"
                    :class="activeTab === 'our-doctors' 
                        ? 'bg-teal-600 text-white shadow-md' 
                        : 'bg-gray-100 text-gray-600'">
                    <i class="fas fa-user-md text-xs"></i>
                </div>
                <span class="text-[10px] font-medium">Doctors</span>
            </a>
            
            <!-- Appointments -->
            <a 
                href="{{ route('appointment') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200"
                :class="{ 'text-teal-600': activeTab === 'appointment' }"
                @click="activeTab = 'appointment'"
            >
                <div class="w-8 h-8 flex items-center justify-center rounded-full transition-all"
                    :class="activeTab === 'appointment' 
                        ? 'bg-teal-600 text-white shadow-md' 
                        : 'bg-gray-100 text-gray-600'">
                    <i class="fas fa-calendar-check text-xs"></i>
                </div>
                <span class="text-[10px] font-medium">Appointments</span>
            </a>
            
            <!-- Contact -->
            <a 
                href="{{ route('contact-us') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200"
                :class="{ 'text-teal-600': activeTab === 'contact-us' }"
                @click="activeTab = 'contact-us'"
            >
                <div class="w-8 h-8 flex items-center justify-center rounded-full transition-all"
                    :class="activeTab === 'contact-us' 
                        ? 'bg-teal-600 text-white shadow-md' 
                        : 'bg-gray-100 text-gray-600'">
                    <i class="fas fa-phone-alt text-xs"></i>
                </div>
                <span class="text-[10px] font-medium">Contact</span>
            </a>
        </div>
    </nav>

    <!-- Spacer to prevent content hiding behind nav -->
    <div class="pb-16 lg:pb-0"></div>
</div>