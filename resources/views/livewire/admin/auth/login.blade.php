<div class="lg:min-h-screen bg-gradient-to-br from-teal-50 via-white to-teal-100 flex items-center justify-center p-2 sm:p-4">
    <div class="bg-white p-4 sm:p-6 lg:p-10 rounded-2xl w-full max-w-md sm:max-w-md lg:max-w-lg mx-auto transition-all duration-300 border border-teal-100/50">
        <!-- Header with Branding -->
        <div class="text-center mb-6 sm:mb-8">
           
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-1">Welcome to <span class="text-orange-400">MedBuzzy</span></h1>
            <p class="text-teal-600 font-medium text-sm sm:text-base">Your trusted health partner</p>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">Sign in to continue your health journey</p>
        </div>

        <!-- Loading Indicator - Only show on form submission -->
        <div wire:loading.flex wire:target="login" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-teal-600"></div>
                <span class="text-gray-700 font-medium">Signing in...</span>
            </div>
        </div>

        <!-- Single Message Display Priority: Success > Error > Validation -->
        @if (session()->has('success'))
            <div class="bg-teal-50 border border-teal-200 text-teal-700 px-3 sm:px-4 py-3 rounded-lg mb-4 sm:mb-6 flex items-start text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <div>{{ session('success') }}</div>
            </div>
        @elseif (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-3 sm:px-4 py-3 rounded-lg mb-4 sm:mb-6 flex items-start text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div>{{ session('error') }}</div>
            </div>
        @elseif ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-3 sm:px-4 py-3 rounded-lg mb-4 sm:mb-6 flex items-start text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="login" class="space-y-4 sm:space-y-5">
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1 sm:mb-1.5">Email Address</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <input type="email" id="email" wire:model.defer="email" placeholder="your@email.com"
                        class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                </div>
                @error('email')
                    <p class="mt-1 sm:mt-1.5 text-xs sm:text-sm text-red-600 flex items-start">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-1 sm:mb-1.5">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <a wire:navigate href="#" class="text-xs text-teal-600 hover:text-teal-700 hover:underline transition duration-150">Forgot password?</a>
                </div>
                <div class="relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-teal-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="password" id="password" wire:model.defer="password" placeholder="••••••••"
                        class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition duration-150 placeholder-gray-400 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                </div>
                @error('password')
                    <p class="mt-1 sm:mt-1.5 text-xs sm:text-sm text-red-600 flex items-start">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $message }}</span>
                    </p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" id="remember" wire:model.defer="remember"
                    class="h-3 w-3 sm:h-4 sm:w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-xs sm:text-sm text-gray-700">Remember me</label>
            </div>

            <!-- Submit Button -->
            <div class="pt-1">
                <button type="submit" wire:loading.attr="disabled"
                    class="w-full flex justify-center items-center py-2 sm:py-2.5 px-4 border border-transparent rounded-lg text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md disabled:opacity-75 disabled:cursor-not-allowed">
                    <div wire:loading.remove wire:target="login" class="flex items-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In
                    </div>
                    <div wire:loading wire:target="login" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Signing in...
                    </div>
                </button>
                
                <!-- Divider -->
                <div class="relative my-4 sm:my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-xs sm:text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>
                
                <!-- Google Login -->
                <a  href="{{ route('google.login') }}"
                    class="w-full flex justify-center items-center py-2 sm:py-2.5 px-4 border border-gray-300 rounded-lg text-xs sm:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 -ml-1" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"></path>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"></path>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"></path>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"></path>
                    </svg>
                    Continue with Google
                </a>
                
                <p class="mt-4 sm:mt-6 text-center text-xs sm:text-sm text-gray-600">
                    Don't have an account?
                    <a wire:navigate href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-500 hover:underline transition duration-150">Sign up</a>
                </p>
            </div>
        </form>
         <!-- Additional Styles for Enhanced UX -->
    <style>
        @media (max-width: 640px) {
            .hover\:shadow-2xl:hover {
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            }
        }
        
        /* Custom focus styles for better accessibility */
        input:focus {
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }
        
        /* Smooth transitions for all interactive elements */
        * {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        /* Enhanced loading state */
        .disabled\:opacity-75:disabled {
            opacity: 0.75;
            cursor: not-allowed;
        }
    </style>
    </div>

    </div>

