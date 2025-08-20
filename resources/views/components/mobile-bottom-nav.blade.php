<div x-data="{ activeTab: '{{ Route::currentRouteName() }}' }">
    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-200/50 z-50 lg:hidden">
        <div class="flex items-center justify-around py-3 px-2 max-w-lg mx-auto">
            <!-- Home -->
            <a 
                href="{{ route('hero') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200 group"
                :class="{ 'text-brand-blue-600': activeTab === 'hero' }"
                @click="activeTab = 'hero'"
            >
                <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200"
                    :class="activeTab === 'hero' 
                        ? 'bg-brand-blue-600 text-white scale-110' 
                        : 'bg-gray-100 text-gray-600 group-hover:bg-brand-blue-50 group-hover:text-brand-blue-600'">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <!-- Active indicator dot -->
                    <div x-show="activeTab === 'hero'" 
                         class="absolute -top-1 -right-1 w-3 h-3 bg-brand-orange-500 rounded-full border-2 border-white"></div>
                </div>
                <span class="text-[10px] font-medium transition-colors"
                      :class="activeTab === 'hero' ? 'text-brand-blue-600' : 'text-gray-500'">Home</span>
            </a>
            
            <!-- Find Doctor -->
            <a 
                href="{{ route('our-doctors') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200 group"
                :class="{ 'text-brand-blue-600': activeTab === 'our-doctors' }"
                @click="activeTab = 'our-doctors'"
            >
                <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200"
                    :class="activeTab === 'our-doctors' 
                        ? 'bg-brand-blue-600 text-white scale-110' 
                        : 'bg-gray-100 text-gray-600 group-hover:bg-brand-blue-50 group-hover:text-brand-blue-600'">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <!-- Active indicator dot -->
                    <div x-show="activeTab === 'our-doctors'" 
                         class="absolute -top-1 -right-1 w-3 h-3 bg-brand-orange-500 rounded-full border-2 border-white"></div>
                </div>
                <span class="text-[10px] font-medium transition-colors"
                      :class="activeTab === 'our-doctors' ? 'text-brand-blue-600' : 'text-gray-500'">Find Doctor</span>
            </a>
            
            <!-- Book Now - Center button with special styling -->
            <a 
                href="{{ route('our-doctors') }}" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200 group"
                :class="{ 'text-brand-orange-600': activeTab === 'appointment' }"
                @click="activeTab = 'appointment'"
            >
                <div class="relative w-12 h-12 flex items-center justify-center rounded-full transition-all duration-200 shadow-lg"
                    :class="activeTab === 'appointment' 
                        ? 'bg-gradient-to-r from-brand-orange-500 to-brand-orange-600 text-white scale-110' 
                        : 'bg-gradient-to-r from-brand-orange-400 to-brand-orange-500 text-white group-hover:from-brand-orange-500 group-hover:to-brand-orange-600'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <!-- Active indicator dot -->
                    <div x-show="activeTab === 'appointment'" 
                         class="absolute -top-1 -right-1 w-3 h-3 bg-brand-blue-500 rounded-full border-2 border-white"></div>
                </div>
                <span class="text-[10px] font-medium transition-colors"
                      :class="activeTab === 'appointment' ? 'text-brand-orange-600' : 'text-gray-500'">Find Doctor</span>
            </a>
            
            <!-- Call Us -->
            <a 
                href="tel:+919430808079" 
                class="flex flex-col items-center space-y-1 p-2 rounded-xl transition-all duration-200 group"
            >
                <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200 bg-gray-100 text-gray-600 group-hover:bg-brand-blue-50 group-hover:text-brand-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium transition-colors text-gray-500">Call Us</span>
            </a>
        </div>
        
        <!-- Bottom safe area for iOS -->
        <div class="h-safe-bottom bg-white/95"></div>
    </nav>

    <!-- Spacer to prevent content hiding behind nav -->
    <div class="pb-20 lg:pb-0"></div>
</div>

<style>
    /* Custom safe area handling for iOS */
    .h-safe-bottom {
        height: env(safe-area-inset-bottom, 0px);
    }
    
    /* Add subtle animation for active state changes */
    @keyframes bounce-in {
        0% { transform: scale(0.9); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .mobile-bottom-nav .active-tab {
        animation: bounce-in 0.3s ease-out;
    }
</style>