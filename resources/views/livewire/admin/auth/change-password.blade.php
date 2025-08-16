<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="mb-6 text-center">
        <svg class="mx-auto h-12 w-12 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
        <h2 class="mt-2 text-2xl font-bold text-gray-800">Reset Password</h2>
        <p class="mt-1 text-sm text-gray-600">Create a new password for your account</p>
    </div>

    @if (session('status'))
        <div class="mb-6 p-4 bg-teal-50 text-brand-blue-600 rounded-md text-sm">
            {{ session('status') }}
        </div>
    @endif 

    <form wire:submit.prevent="resetPassword" class="space-y-4">
        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input id="password" type="password" wire:model="password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-600 focus:border-brand-blue-600 sm:text-sm"
                placeholder="Enter new password">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
            <input id="password_confirmation" type="password" wire:model="password_confirmation" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-brand-blue-600 focus:border-brand-blue-600 sm:text-sm"
                placeholder="Confirm new password">
        </div>

        <div class="pt-2">
           <button type="submit" wire:loading.attr="disabled"
    class="w-full px-4 py-2 bg-brand-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 disabled:opacity-75 disabled:cursor-not-allowed transition-colors duration-150">
                <span wire:loading.remove>Reset Password</span>
                <span wire:loading>
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Updating...
                </span>
            </button>
        </div>
    </form>
</div>