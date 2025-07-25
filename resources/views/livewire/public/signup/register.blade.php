<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden my-8">
    <div class="md:flex">
        <!-- Left Column - Benefits -->
        <div class="md:w-1/2 p-8 bg-brand-teal-50 text-brand-teal-900 border-r border-brand-teal-100">
            <div class="mb-8 flex justify-center">
                <img src="/logo/logo.png" alt="MedBuzzy Logo" class="h-16 w-auto">
            </div>
            
            <div class="max-w-md mx-auto">
                <h1 class="text-3xl font-bold mb-4 text-center text-brand-teal-800">Join MedBuzzy Today</h1>
                <p class="mb-8 text-lg text-center text-brand-teal-600">Create your account to access healthcare services</p>
                
                <ul class="space-y-4 mb-10">
                    <li class="flex items-start p-3 rounded-lg hover:bg-brand-teal-100 transition">
                        <div class="bg-brand-orange-400 rounded-full p-1.5 mr-3 mt-0.5 flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg">Book appointments with doctors</span>
                    </li>
                    <li class="flex items-start p-3 rounded-lg hover:bg-brand-teal-100 transition">
                        <div class="bg-brand-orange-400 rounded-full p-1.5 mr-3 mt-0.5 flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg">Access medical records</span>
                    </li>
                    <li class="flex items-start p-3 rounded-lg hover:bg-brand-teal-100 transition">
                        <div class="bg-brand-orange-400 rounded-full p-1.5 mr-3 mt-0.5 flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg">Get health recommendations</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Right Column - Signup Form -->
        <div class="md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-brand-teal-800 mb-2">Create Account</h2>
            <p class="text-brand-teal-600 mb-6">Fill in your details to get started</p>
            
            <form wire:submit.prevent="register" class="space-y-4">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-brand-teal-800 mb-1">Full Name *</label>
                    <input type="text" id="name" wire:model.live="name" 
                           class="w-full px-4 py-2 border border-brand-teal-200 rounded-lg focus:ring-2 focus:ring-brand-teal-400 focus:border-brand-teal-400 transition"
                           placeholder="John Doe">
                    @error('name') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-brand-teal-800 mb-1">Email *</label>
                    <input type="email" id="email" wire:model.live="email" 
                           class="w-full px-4 py-2 border border-brand-teal-200 rounded-lg focus:ring-2 focus:ring-brand-teal-400 focus:border-brand-teal-400 transition"
                           placeholder="john@example.com">
                    @error('email') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-brand-teal-800 mb-1">Phone Number</label>
                    <input type="tel" id="phone" wire:model.live="phone" 
                           class="w-full px-4 py-2 border border-brand-teal-200 rounded-lg focus:ring-2 focus:ring-brand-teal-400 focus:border-brand-teal-400 transition"
                           placeholder="+1 (123) 456-7890">
                    @error('phone') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Gender Field -->
                <div>
                    <label class="block text-sm font-medium text-brand-teal-800 mb-1">Gender</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="gender" value="male" class="text-brand-orange-500 focus:ring-brand-orange-500">
                            <span class="ml-2">Male</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model="gender" value="female" class="text-brand-orange-500 focus:ring-brand-orange-500">
                            <span class="ml-2">Female</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" wire:model.live="gender" value="other" class="text-brand-orange-500 focus:ring-brand-orange-500">
                            <span class="ml-2">Other</span>
                        </label>
                    </div>
                    @error('gender') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-brand-teal-800 mb-1">Password *</label>
                    <input type="password" id="password" wire:model.live="password" 
                           class="w-full px-4 py-2 border border-brand-teal-200 rounded-lg focus:ring-2 focus:ring-brand-teal-400 focus:border-brand-teal-400 transition"
                           placeholder="••••••••">
                    @error('password') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-brand-teal-800 mb-1">Confirm Password *</label>
                    <input type="password" id="password_confirmation" wire:model.live="password_confirmation" 
                           class="w-full px-4 py-2 border border-brand-teal-200 rounded-lg focus:ring-2 focus:ring-brand-teal-400 focus:border-brand-teal-400 transition"
                           placeholder="••••••••">
                    @error('password_confirmation') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-brand-orange-500 hover:bg-brand-orange-600 text-white font-medium rounded-lg transition duration-300">
                    Create Account
                </button>
                
                <!-- Login Link -->
                <p class="text-center text-sm text-brand-teal-600 mt-4">
                    Already have an account? 
                    <a href="/login" class="text-brand-orange-500 font-medium hover:underline">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</div>