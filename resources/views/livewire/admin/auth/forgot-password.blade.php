<div class=" md:py-10  flex items-center justify-center p-4  mt-8">
    <div class=" w-full  bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl">
        <div class="md:flex">
            <!-- Image Section - Hidden on mobile -->
            <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-brand-blue-500 to-brand-blue-700">
                <div class="h-full flex flex-col justify-center items-center p-8 text-white">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-semiblod mb-2">Reset Your Password</h2>
                    <p class="text-center opacity-90">Enter your email and we'll send you a link to reset your password</p>
                </div>
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2 p-8">
                @if (!$emailSent)
                    <!-- Mobile-only logo -->
                    <div class="md:hidden flex justify-center mb-6">
                        <div class="h-12 w-12 rounded-full bg-brand-blue-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Forgot password?</h2>
                    <p class="text-sm text-gray-600 mb-6">No problem. Just enter your email and we'll send you a reset link.</p>

                    @if (session('status'))
                        <div class="mb-6 p-4 bg-teal-50 text-brand-blue-600 rounded-md text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="sendResetLink" class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    wire:model.live="email" 
                                    autofocus
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 sm:text-sm"
                                    placeholder="you@example.com" 
                                />
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                            <a 
                                href="{{ route('login') }}" 
                                wire:navigate
                                class="w-full sm:w-auto text-center text-sm text-gray-700 hover:text-brand-blue-600 hover:underline"
                            >
                                Back to login
                            </a>
                            <button 
                                type="submit" 
                                wire:target="sendResetLink" 
                                wire:loading.attr="disabled"
                                class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-brand-blue-500 to-brand-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-brand-blue-600 hover:to-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 disabled:opacity-75 disabled:cursor-not-allowed transition-all duration-200"
                            >
                                <span wire:loading.remove wire:target="sendResetLink">
                                    Send Reset Link
                                </span>
                                <span wire:loading wire:target="sendResetLink">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-4">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-teal-100">
                            <svg class="h-6 w-6 text-brand-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="mt-3 text-lg font-medium text-gray-900">Reset link sent!</h2>
                        <p class="mt-2 text-sm text-gray-500">We've emailed a password reset link to your email address.</p>
                        <div class="mt-6">
                            <a 
                                href="{{ route('login') }}" 
                                wire:navigate
                                class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-gradient-to-r from-brand-blue-500 to-brand-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:from-brand-blue-600 hover:to-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 transition-all duration-200"
                            >
                                Return to login
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>