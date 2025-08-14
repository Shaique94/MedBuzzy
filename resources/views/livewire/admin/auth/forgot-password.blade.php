<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    @if (!$emailSent)
        <div class="mb-6 text-sm text-gray-600">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Forgot your password?</h2>
            <p>No problem. Just enter your email address and we'll email you a password reset link.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 bg-teal-50 text-brand-blue-600 rounded-md text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit.prevent="sendResetLink" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                <input 
                    id="email" 
                    type="email" 
                    wire:model.live="email" 
                    autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-600 focus:border-brand-blue-600 sm:text-sm"
                    placeholder="you@example.com" 
                />
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
                    class="w-full sm:w-auto px-4 py-2 bg-brand-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-brand-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-600 disabled:opacity-75 disabled:cursor-not-allowed transition-colors duration-150"
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
                    class="w-full sm:w-auto inline-flex justify-center px-4 py-2 bg-brand-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-brand-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-600"
                >
                    Return to login
                </a>
            </div>
        </div>
    @endif
</div>