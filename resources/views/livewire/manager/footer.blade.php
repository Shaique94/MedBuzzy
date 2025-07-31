<div class="bg-white border-t border-gray-200 px-3 sm:px-4 lg:px-6 py-3 sm:py-4 mt-auto">
    <div class="max-w-7xl mx-auto">
        <!-- Mobile Layout (Stack) -->
        <div class="md:hidden text-center space-y-2">
            <p class="text-xs text-gray-600">
                © {{ date('Y') }} MedBuzzy Manager Panel. All rights reserved.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="text-xs text-gray-500 hover:text-indigo-600 transition-colors">Privacy Policy</a>
                <a href="#" class="text-xs text-gray-500 hover:text-indigo-600 transition-colors">Terms</a>
                <a href="#" class="text-xs text-gray-500 hover:text-indigo-600 transition-colors">Support</a>
            </div>
            <!-- Mobile Status Info -->
            <div class="mt-2 pt-2 border-t border-gray-100">
                <div class="flex items-center justify-center space-x-2">
                    <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-500">System Online</span>
                    <span class="mx-2 text-gray-300">•</span>
                    <span class="text-xs text-gray-500">v2.1.0</span>
                </div>
            </div>
        </div>

        <!-- Tablet & Desktop Layout (Inline) -->
        <div class="hidden md:flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <p class="text-sm text-gray-600">
                    © {{ date('Y') }} MedBuzzy Manager Panel. All rights reserved.
                </p>
                <div class="hidden lg:flex items-center space-x-1 text-xs text-gray-500">
                    <span>Version 2.1.0</span>
                    <span class="mx-1">•</span>
                    <span>Build {{ date('Ymd') }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        Privacy Policy
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        Terms of Service
                    </a>
                    <a href="#" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors duration-200">
                        Support
                    </a>
                </div>

                <!-- Status Indicator -->
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-xs text-gray-500">System Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

