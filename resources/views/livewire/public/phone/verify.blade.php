<div x-data="{ countdown: {{ $countdown }} }" 
     x-init="
        $watch('countdown', value => {
            if (value > 0) {
                setTimeout(() => countdown--, 1000);
            }
        });
        $wire.on('start-countdown', () => {
            countdown = 30;
            if (countdown > 0) {
                setTimeout(() => countdown--, 1000);
            }
        });
     ">
    @if ($showModal)
        <div x-ref="phoneModal" tabindex="-1"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 transition-opacity duration-300">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6 mx-4 transform transition-all duration-300">
                @if (!$showVerification && !$submitFinalForm)
                    <!-- Phone Number Form -->
                    <div>
                        <div class="flex justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Enter Your Phone Number</h3>
                            <button wire:click="ClosePhoneModal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">We'll send a 6-digit verification code to this number.</p>

                        <div class="mt-4">
                            <input wire:model="phone" type="tel"
                                class="block w-full rounded-md border-gray-300 border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"
                                placeholder="10-digit phone number">
                            @error('phone')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-5 sm:mt-6">
                            <button wire:click="submitPhone" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-blue-600 text-base font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 sm:text-sm">
                                Send Verification Code
                            </button>
                        </div>
                    </div>
                @elseif ($showVerification && !$submitFinalForm)
                    <!-- OTP Verification Form -->
                    <div>
                        <div class="flex justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Verify Your Phone</h3>
                            <button wire:click="ClosePhoneModal">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">We sent a 6-digit code to {{ $phone }}.
                            <button wire:click="editPhone" class="text-sm text-brand-blue-600 hover:text-brand-blue-800">Edit</button>
                        </p>
                        {{-- <p class="mt-1 text-xs text-gray-400">Demo code: {{ $generatedCode }}</p> --}}

                        <div class="mt-4">
                            <input wire:model="verificationCode" type="text"
                                class="block w-full rounded-md border-gray-300 border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                                placeholder="6-digit code" maxlength="6"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);">
                            @error('verificationCode')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <button wire:click="resendOtp" type="button" :disabled="countdown > 0"
                                class="text-sm text-brand-blue-600 hover:text-brand-blue-800 disabled:text-gray-400">
                                <span x-text="countdown > 0 ? 'Resend OTP (' + countdown + 's)' : 'Resend OTP'"></span>
                            </button>

                            {{-- <span class="text-sm text-gray-500">
                                @if ($otpSent)
                                    OTP sent successfully!
                                @endif
                            </span> --}}
                        </div>

                        <div class="mt-5 sm:mt-6">
                            <button wire:click="verifyCode" type="button"
                                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-blue-600 text-base font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 sm:text-sm">
                                Verify & Continue
                            </button>
                        </div>
                    </div>
                @elseif ($submitFinalForm)
                    <!-- Final Form with Name and Email -->
                    <div>
                        <div class="flex justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Patient Information</h3>
                            <button wire:click="ClosePhoneModal" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Please provide your details to continue.</p>

                       

                        @if ($errors->any())
                            <div class="text-red-500 text-sm mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- <form wire:submit.prevent=""> --}}
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input wire:model="name" type="text" id="name"
                                        class="block w-full rounded-md border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                                        placeholder="Your full name">
                                    @error('name')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input wire:model="email" type="email" id="email"
                                        class="block w-full rounded-md border border-brand-blue-500 p-2 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                                        placeholder="Your email address">
                                    @error('email')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <input wire:model="phone" hidden type="tel" id="phone" readonly
                                        class="block w-full rounded-md border border-brand-blue-500 p-2 bg-gray-100 focus:border-brand-blue-500 focus:ring-brand-blue-500"
                                        placeholder="10-digit phone number">
                                    @error('phone')
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div> 
                            </div>

                            <div class="mt-5 sm:mt-6">
                                <button wire:click="submit" type="submit"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-brand-blue-600 text-base font-medium text-white hover:bg-brand-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-blue-500 sm:text-sm">
                                    Submit & Find Doctors
                                </button>
                            </div>
                        {{-- </form> --}}
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>