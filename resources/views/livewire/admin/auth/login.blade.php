<div
    class="lg:min-h-screen bg-gradient-to-br from-brand-blue-50 via-white to-brand-blue-100 flex items-center justify-center p-2 sm:p-4">
    <div
        class="bg-white m-4 p-4 sm:p-6 lg:p-10 rounded-2xl w-full max-w-md sm:max-w-md lg:max-w-lg mx-auto transition-all duration-300 border border-brand-blue-100/50">
        <!-- Header with Branding -->
        <div class="text-center mb-6 sm:mb-8">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 mb-1">Welcome to <span
                    class="text-orange-400">MedBuzzy</span></h1>
            <p class="text-brand-blue-600 font-medium text-sm sm:text-base">Your trusted health partner</p>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">Sign in to continue your health journey</p>
        </div>

        <!-- Loading Indicator for Login -->
        <div wire:loading.flex wire:target="login"
            class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-xl flex items-center space-x-3">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-brand-blue-600"></div>
                <span class="text-gray-700 font-medium">
                    @if ($showOtpField)
                        Verifying OTP...
                    @else
                        Signing in...
                    @endif
                </span>
            </div>
        </div>

        <!-- Messages -->
        {{-- @if (session()->has('success'))
            <div
                class="bg-brand-blue-50 border border-brand-blue-200 text-brand-blue-700 px-3 sm:px-4 py-3 rounded-lg mb-4 sm:mb-6 flex items-start text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 mt-0.5 flex-shrink-0"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <div>{{ session('success') }}</div>
            </div>
       
        @elseif ($errors->any())
            <div
                class="bg-red-50 border border-red-200 text-red-700 px-3 sm:px-4 py-3 rounded-lg mb-4 sm:mb-6 flex items-start text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-2 mt-0.5 flex-shrink-0"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif --}}

       

       <form wire:submit.prevent="login" class="space-y-4 sm:space-y-5" x-data="{ phone: '' }">
    <!-- Phone Field -->
   <div>
    @if (session('message'))
        <div class="mb-2 sm:mb-3 p-3 bg-blue-100 border border-blue-300 text-blue-700 rounded-lg text-sm sm:text-base flex items-start">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11a1 1 0 112 0v4a1 1 0 11-2 0V7zm1 8a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1 sm:mb-1.5">Mobile Number</label>
    <div class="relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-brand-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
        </div>
        <input 
            type="tel" 
            id="phone" 
            wire:model.live="phone" 
            placeholder="9708798149"
            value="{{ session('phone') ?? old('phone', $phone) }}" 
            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
            class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150 placeholder-gray-400 @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
        >
    </div>
    @error('phone')
        <p class="mt-1 sm:mt-1.5 text-xs sm:text-sm text-red-600 flex items-start">
            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <span>{{ $message }}</span>
        </p>
    @enderror
</div>
{{-- <div>
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1 sm:mb-1.5">Mobile Number</label>
        <div class="relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-brand-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
            </div>
            <input 
                type="tel" 
                id="phone" 
                wire:model.live="phone" 
                placeholder="9708798149"
                value="{{ session('phone') ?? old('phone', $phone) }}" 
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150 placeholder-gray-400 @error('phone') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
            >
        </div>
        @error('phone')
            <p class="mt-1 sm:mt-1.5 text-xs sm:text-sm text-red-600 flex items-start">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div> --}}

    @if (!$showOtpField)
        <!-- Password Field -->
        <div>
            <div class="flex justify-between items-center mb-1 sm:mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a wire:navigate href="{{ route('password.request') }}"
                    class="text-xs text-brand-blue-600 hover:text-brand-blue-700 hover:underline transition duration-150">Forgot password?</a>
            </div>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-brand-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="password" id="password" wire:model.live="password" placeholder="••••••••"
                    class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150 placeholder-gray-400 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                    >
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

        <!-- Login Method Toggle -->
        <div class="flex items-center justify-between mt-4" >
            <div class="flex items-center">
                <input type="checkbox" id="useOtp" wire:model.change="showOtpField"
                    class="h-5 w-5 text-brand-blue-600 focus:ring-brand-blue-500 border-gray-300 rounded">
                <label for="useOtp" class="ml-2 block text-lg text-gray-700">Use OTP instead</label>
            </div>
        </div>
    @else
        <!-- OTP Field -->
        <div>
            <label for="otp" class="block text-sm font-medium text-gray-700 mb-1 sm:mb-1.5">OTP Code</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-brand-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="otp" wire:model.live="otp" placeholder="Enter 6-digit OTP"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);"
                    class="block w-full pl-9 sm:pl-10 pr-3 py-2 sm:py-2.5 text-sm sm:text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue-500 focus:border-brand-blue-500 transition duration-150 placeholder-gray-400 @error('otp') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
            </div>
            @error('otp')
                <p class="mt-1 sm:mt-1.5 text-xs sm:text-sm text-red-600 flex items-start">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-1.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ $message }}</span>
                </p>
            @enderror
            <div class="mt-2 text-xs text-gray-500">
                OTP will expire in 30 minutes
            </div>
        </div>

        <!-- Resend OTP Button Section -->
        <div class="flex items-center justify-between mt-2">
            <div class="flex items-center">
                <input type="checkbox" id="usePassword" wire:model.change="showOtpField"
                    class="h-4 w-4 text-brand-blue-600 focus:ring-brand-blue-500 border-gray-300 rounded">
                <label for="usePassword" class="ml-2 block text-sm text-gray-700">Use Password instead</label>
            </div>
            <div class="relative">
                        <button type="button" wire:click="requestOtp" wire:loading.attr="disabled"
                            wire:target="requestOtp" @disabled($otpCooldown > 0)
                            class="text-xs text-brand-blue-600 hover:text-brand-blue-800 hover:underline transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed disabled:no-underline">
                            <span wire:loading wire:target="requestOtp" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-brand-blue-600"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sending OTP...
                            </span>
                            <span wire:loading.remove wire:target="requestOtp">
                                @if ($otpCooldown > 0)
                                    Resend OTP in <span x-text="$wire.otpCooldown">{{ $otpCooldown }}</span>s
                                @else
                                    Resend OTP
                                @endif
                            </span>
                        </button>
                    </div>
        </div>
    @endif

    <!-- Submit Button -->
    <div class="pt-1">
        <button type="submit" wire:loading.attr="disabled" wire:target="login"
            class="w-full flex justify-center items-center py-2 sm:py-2.5 px-4 border border-transparent rounded-lg text-sm font-semibold text-white bg-brand-blue-600 hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md disabled:opacity-75 disabled:cursor-not-allowed">
            <div wire:loading.remove wire:target="login" class="flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                {{ $showOtpField ? 'Verify OTP' : 'Sign In' }}
            </div>
            <div wire:loading wire:target="login" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 sm:h-5 sm:w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ $showOtpField ? 'Verifying...' : 'Signing in...' }}
            </div>
        </button>
    </div>
</form>
    </div>
    <div
        wire:target="showOtpField"
        wire:loading.class.remove="hidden"
        wire:loading.class=" flex items-center"
        class="hidden fixed inset-0 z-50 items-center justify-center bg-brand-blue-600 bg-opacity-95">
        <div class="text-center">
            <div class="inline-block w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin mb-4" aria-hidden="true"></div>
            <div class="text-white font-semibold text-lg">Genterating Otp...</div>
        </div>
    </div>

    @livewireScripts

@script
<script>
    document.addEventListener('livewire:init', () => {
        let countdownInterval;

        // Start countdown when event is received
        Livewire.on('startOtpCountdown', () => {
            // Clear any existing interval first
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            // Start new countdown
            countdownInterval = setInterval(() => {
                // Call the Livewire method to decrement the countdown
                $wire.decrementOtpCountdown().then(() => {
                    // Check if countdown has reached zero
                    if ($wire.otpCooldown <= 0) {
                        clearInterval(countdownInterval);
                    }
                });
            }, 1000);
        });

        // Stop countdown when event is received
        Livewire.on('stopOtpCountdown', () => {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
        });

        // Clean up when component is destroyed
        Livewire.on('destroyed', () => {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }
        });
    });
</script>
@endscript
</div>
