<div class="md:py-10 mt-5 flex items-center justify-center  p-4"  x-data="{
         password: '',
         strength: 0,
         strengthText: '',
         strengthColor: 'bg-gray-200',
         calculateStrength() {
             let score = 0;
             if (!this.password) {
                 this.strength = 0;
                 this.strengthText = '';
                 this.strengthColor = 'bg-gray-200';
                 return;
             }
             
             // Length check
             if (this.password.length > 5) score++;
             if (this.password.length > 8) score++;
             
             // Complexity checks
             if (/[A-Z]/.test(this.password)) score++; // Uppercase
             if (/[0-9]/.test(this.password)) score++; // Numbers
             if (/[^A-Za-z0-9]/.test(this.password)) score++; // Special chars
             
             this.strength = score;
             
             // Set visual feedback
             if (score <= 2) {
                 this.strengthText = 'Weak';
                 this.strengthColor = 'bg-red-400';
             } else if (score <= 4) {
                 this.strengthText = 'Medium';
                 this.strengthColor = 'bg-yellow-400';
             } else {
                 this.strengthText = 'Strong';
                 this.strengthColor = 'bg-teal-400';
             }
         }
     }"
     x-init="calculateStrength()">
        
    
    <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with decorative gradient bar -->
        <div class="h-2   bg-brand-blue-500"></div>
        
        <div class="p-8">
            <!-- Icon and Heading -->
            <div class="text-center mb-8">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-brand-blue-100 mb-4">
                    <svg class="h-8 w-8 text-brand-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-800">Reset Password</h2>
                <p class="mt-2 text-gray-600">Create a strong new password for your account</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-700 rounded-lg text-sm flex items-start">
                    <svg class="h-5 w-5 mr-2 text-teal-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('status') }}</div>
                </div>
            @endif 

            <form wire:submit.prevent="resetPassword" class="space-y-5">
                <!-- Password Field -->
                  <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <div class="relative">
                <input id="password" type="password" 
                       x-model="password"
                       @input="calculateStrength()"
                       wire:model="password"
                       required
                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 placeholder-gray-400"
                       placeholder="Enter new password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-start">
                            <svg class="h-4 w-4 mr-1 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" wire:model="password_confirmation" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-brand-blue-500 focus:border-brand-blue-500 placeholder-gray-400"
                            placeholder="Confirm new password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                 <!-- Password Strength Indicator -->
        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200" x-show="password">
            <div class="flex justify-between items-center mb-1">
                <p class="text-xs font-medium text-gray-500">PASSWORD STRENGTH</p>
                <p class="text-xs font-medium" x-text="strengthText"
                   x-bind:class="{
                       'text-red-500': strength <= 2,
                       'text-yellow-500': strength > 2 && strength <= 4,
                       'text-teal-500': strength > 4
                   }"></p>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
                <div class="h-1.5 rounded-full transition-all duration-300" 
                     x-bind:class="strengthColor"
                     x-bind:style="'width: ' + (strength * 20) + '%'"></div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                Use 8+ characters with a mix of uppercase, numbers & symbols
            </p>
        </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full px-6 py-3 bg-brand-blue-600 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white hover:from-brand-blue-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 disabled:opacity-75 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-[1.01]">
                        <span wire:loading.remove class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Reset Password
                        </span>
                        <span wire:loading class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Updating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>